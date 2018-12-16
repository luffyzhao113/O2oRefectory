<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/12/8
 * Time: 11:31
 */

namespace App\Http\Services\Seller\Admin\Banner;


use App\Plugins\Ueditor\Uploader;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class StoreService implements Arrayable
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->initialize();
    }

    protected function initialize()
    {
        $this->setImages();
    }

    /**
     * images base64存储
     */
    protected function setImages()
    {
        $images = $this->request->input('banners', []);

        foreach ($images as $key => $value) {
            $image = $this->UploaderBase64($value['path']);
            $images[$key]['path'] = $image;
        }

        $this->request->merge(
            [
                'banners' => $images,
            ]
        );
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function UploaderBase64($value)
    {
        if (Uploader::isBase64($value)) {
            $config = array(
                "pathFormat" => str_replace(
                    "{seller_id}",
                    $this->request->input('seller_id'),
                    config('ueditor.scrawlPathFormat')
                ),
                "maxSize" => config('ueditor.scrawlMaxSize'),
                "allowFiles" => config('ueditor.scrawlAllowFiles'),
                "oriName" => "scrawl.png",
            );
            $up = new Uploader(Uploader::getBase64Content($value), $config, 'base64');
            $value = $up->getFileInfo()['url'];
        }

        return $value;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->request->only(
            [
                'name',
                'position',
                'status',
                'banners',
                'seller_id'
            ]
        );
    }
}