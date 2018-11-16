<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/10/23
 * Time: 20:52
 */

namespace App\Http\Services\Seller\Admin\Goods;


use App\Plugins\Ueditor\Uploader;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class UpdateService implements Arrayable
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->initialize();
    }

    protected function initialize()
    {
        // 图片
        $this->setImage();

        $this->setImages();
        // 规格
        $this->setSpec();
    }

    /**
     * 规格
     */
    protected function setSpec()
    {
        $spec = [];

        foreach ($this->request->input('specs', []) as $key => $value) {
            foreach ($value['specs'] as $index => $item) {
                if (!isset($spec[$index]) || array_search($item, $spec[$index]) === false) {
                    $spec[$index][] = $item;
                }
            }
        }

        $this->request->merge(
            [
                'spec' => $spec,
            ]
        );
    }

    /**
     * image base64存储
     */
    protected function setImage()
    {
        $this->request->merge(
            [
                'image' => $this->UploaderBase64($this->request->input('image')),
            ]
        );
    }

    /**
     * images base64存储
     */
    protected function setImages()
    {
        $images = [];

        foreach ($this->request->input('images', []) as $key => $value) {
            $image = $this->UploaderBase64($value['path']);
            $images[$key]['path'] = $image;
            $images[$key]['ext'] = strtolower(strrchr($image, '.'));
            $images[$key]['sort'] = $key;
        }

        $this->request->merge(
            [
                'images' => $images,
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
                    "{domain}",
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
                'bar_code',
                'price',
                'stock',
                'sale',
                'is_sale',
                'image',
                'model_id',
                'category_id',
                'attribute',
                'spec',
                'seller_id',
                'specs',
                'images',
                'details'
            ]
        );
    }
}