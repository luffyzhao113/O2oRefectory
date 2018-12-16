<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/10/21
 * Time: 21:25
 */

namespace App\Http\Controllers\Seller\Admin;


use App\Http\Controllers\Controller;
use App\Plugins\Ueditor\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UeditorController extends Controller
{
    /**
     * @param Request $request
     * @param $sellerId
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function index(Request $request, $sellerId)
    {
        $result = ['state' => '请求地址出错'];

        switch (htmlspecialchars($request->input('action'))) {
            case 'config':
                $result = config('ueditor');
                break;
            /* 列出图片 */
            case 'listimage':
                /* 列出文件 */
            case 'listfile':
                $result = $this->list($request, $sellerId);
                break;
            /* 抓取远程文件 */
            case 'catchimage':
                $result = $this->catchImage($request, $sellerId);
                break;

        }

        return $result;
    }

    /**
     * @param Request $request
     * @param $sellerId
     * @return array
     */
    public function uploader(Request $request, $sellerId)
    {
        /* 上传配置 */
        $base64 = "upload";
        $fieldName = '';
        $config = [];
        switch (htmlspecialchars($request->input('action'))) {
            /* 上传图片 */
            case 'uploadimage':
                $config = array(
                    "pathFormat" => str_replace("{seller_id}", $sellerId, config('ueditor.imagePathFormat')),
                    "maxSize" => config('ueditor.imageMaxSize'),
                    "allowFiles" => config('ueditor.imageAllowFiles'),
                );
                $fieldName = config('ueditor.imageFieldName');
                break;
            /* 上传涂鸦 */
            case 'uploadscrawl':
                $config = array(
                    "pathFormat" => str_replace("{seller_id}", $sellerId, config('ueditor.scrawlPathFormat')),
                    "maxSize" => config('ueditor.scrawlMaxSize'),
                    "allowFiles" => config('ueditor.scrawlAllowFiles'),
                    "oriName" => "scrawl.png",
                );
                $fieldName = request()->input(config('ueditor.scrawlFieldName'));
                $base64 = "base64";
                break;
            /* 上传视频 */
            case 'uploadvideo':
                $config = array(
                    "pathFormat" => str_replace("{seller_id}", $sellerId, config('ueditor.videoPathFormat')),
                    "maxSize" => config('ueditor.videoMaxSize'),
                    "allowFiles" => config('ueditor.videoAllowFiles'),
                );
                $fieldName = config('ueditor.videoFieldName');
                break;
            /* 上传文件 */
            case 'uploadfile':
            default:
                $config = array(
                    "pathFormat" => str_replace("{seller_id}", $sellerId, config('ueditor.filePathFormat')),
                    "maxSize" => config('ueditor.fileMaxSize'),
                    "allowFiles" => config('ueditor.fileAllowFiles'),
                );
                $fieldName = config('ueditor.fileFieldName');
                break;
        }

        $up = new Uploader($fieldName, $config, $base64);

        return $up->getFileInfo();
    }

    /**
     * @param Request $request
     * @param $sellerId
     * @return array
     */
    private function list(Request $request, $sellerId)
    {
        switch (htmlspecialchars($request->input('action'))) {
            /* 列出图片 */
            case 'listimage':
                $allowFiles = substr(str_replace(".", "|", join("", config('ueditor.imageManagerAllowFiles'))), 1);
                $listSize = config('ueditor.imageManagerListSize');
                $path = str_replace("{seller_id}", $sellerId, config('ueditor.imageManagerListPath'));
                break;
            default:
                $allowFiles = substr(str_replace(".", "|", join("", config('ueditor.fileManagerAllowFiles'))), 1);
                $listSize = config('ueditor.fileManagerListSize');
                $path = str_replace("{seller_id}", $sellerId, config('ueditor.fileManagerListPath'));
        }

        /* 获取参数 */
        $size = $request->input('size', $listSize);
        $start = $request->input('start', 0);
        $end = $start + $size;

        $files = $this->getfiles($path, $allowFiles);

        if (!count($files)) {
            return [
                "state" => "no match file",
                "list" => array(),
                "start" => $start,
                "total" => count($files),
            ];
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--) {
            $list[] = $files[$i];
        }

        return [
            "state" => "SUCCESS",
            "list" => $list,
            "start" => $start,
            "total" => count($files),
        ];

    }

    /**
     * @param Request $request
     * @param $sellerId
     * @return array
     */
    private function catchImage(Request $request, $sellerId)
    {
        /* 上传配置 */
        $config = array(
            "pathFormat" => str_replace("{seller_id}", $sellerId, config('ueditor.catcherPathFormat')),
            "maxSize" => config('ueditor.catcherMaxSize'),
            "allowFiles" => config('ueditor.catcherAllowFiles'),
            "oriName" => "remote.png",
        );
        $fieldName = config('ueditor.catcherFieldName');

        /* 抓取远程图片 */
        $list = [];
        $source = $request->input($fieldName);
        foreach ($source as $imgUrl) {
            $item = new Uploader($imgUrl, $config, "remote");
            $info = $item->getFileInfo();
            array_push(
                $list,
                [
                    "state" => $info["state"],
                    "url" => $info["url"],
                    "size" => $info["size"],
                    "title" => htmlspecialchars($info["title"]),
                    "original" => htmlspecialchars($info["original"]),
                    "source" => htmlspecialchars($imgUrl),
                ]
            );
        }

        return [
            'state' => count($list) ? 'SUCCESS' : 'ERROR',
            'list' => $list,
        ];
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param $path
     * @param $allowFiles
     * @param array $files
     * @return array|null
     */
    private function getfiles($path, $allowFiles, &$files = [])
    {
        $files = Storage::allFiles($path);

        foreach ($files as $file) {
            if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
                $files[] = [
                    'url' => Storage::url($file),
                    'mtime' => Storage::lastModified($file),
                ];
            }
        }

        return $files;
    }
}