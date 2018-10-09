<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2018/10/9
 * Time: 13:50
 */

namespace App\Plugins\Files;


use Illuminate\Http\Testing\MimeType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Upload
{
    /**
     * updateBase64
     * @param $base64
     * @param null $filename
     * @param null $path
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function updateBase64($base64, $filename = null, $path = null)
    {
        if (!$this->isBase64($base64)) {
            return false;
        }

        $filename = $this->getPath($path).$this->getFilename($filename).'.'.$this->getBase64Extension($base64);

        Storage::disk()->put($filename, $this->getBase64Content($base64));

        return Storage::url($filename);
    }

    /**
     * 验证是否base64
     * isBase64
     * @param $base64
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    public function isBase64($base64)
    {
        $base = explode(',', $base64);

        return (bool)preg_match('/data:[a-z]+\/[a-z]+;base64/', $base[0]);
    }

    /**
     * getBase64Content
     * @param $base64
     * @author luffyzhao@vip.126.com
     * @return bool|string
     */
    public function getBase64Content($base64)
    {
        list($ext, $content) = explode(',', $base64);

        return base64_decode($content);
    }

    /**
     * getPath
     * @param $path
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getPath($path): string
    {
        if ($path === null) {
            $path = 'images/'.date('Ymd/');
        }
        return $path;
    }

    /**
     * getBase64Extension
     * @param $base64
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getBase64Extension($base64): string
    {
        if (preg_match('/^data:(\w+\/\w+);base64/', $base64, $result)) {
            return MimeType::search($result[1]);
        }
    }

    /**
     * getFilename
     * @param null $filename
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getFilename($filename = null): string
    {
        if ($filename === null) {
            $filename = Str::uuid()->toString();
        }

        return $filename;
    }
}