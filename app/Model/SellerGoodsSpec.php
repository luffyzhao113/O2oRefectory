<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellerGoodsSpec extends Model
{
    protected $fillable = ['goods_id', 'specs', 'price', 'stock'];


    public $timestamps = false;

    /**
     * @param $value
     */
    protected function setSpecsAttribute($value)
    {
        $values = [];
        foreach ($value as $key => $item) {
            $values['attr'.md5($key)] = $key.':'.$item;
        }
        $this->attributes['specs'] = json_encode($values, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return array
     */
    protected function getSpecsAttribute($value)
    {
        $values = json_decode($value);
        $arr = [];
        foreach ($values as $key => $item) {
            list($index, $val) = explode(':', $item);
            $arr[$index] = $val;
        }
        return $arr;
    }

    /**
     * @param $value
     * @return float|int
     */
    protected function getPriceAttribute($value){
        return $value / 100;
    }

    /**
     * @param $value
     * @return void
     */
    protected function setPriceAttribute($value){
        $this->attributes['price'] = $value * 100;
    }
}
