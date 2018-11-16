<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerGoods extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'name',
        'bar_code',
        'price',
        'stock',
        'sale',
        'is_sale',
        'image',
        'model_id',
        'attribute',
        'spec',
        'seller_id',
        'category_id'
    ];

    protected $casts = [
        'spec' => 'json',
        'model_id' => 'integer',
    ];

    /**
     * @param $value
     */
    protected function setAttributeAttribute($value){
        if($value){
            $attribute = '';
            foreach ($value as $key=>$item){
                $attribute .= $key.':'.$item . ',';
            }
            $this->attributes['attribute'] = rtrim($attribute, ',');
        }
    }

    /**
     * @param $value
     * @return array
     */
    protected function getAttributeAttribute($value){
       $attr = explode(',', $value);
       $attribute = [];
       foreach ($attr as $item) {
           list($key, $val) = explode(':', $item, 2);
           $attribute[$key] = $val;
       }
       return $attribute;
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
     * @return float|int
     */
    protected function setPriceAttribute($value){
        $this->attributes['price'] = $value * 100;
    }

    /**
     * 商品规格
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specs(){
        return $this->hasMany(SellerGoodsSpec::class, 'goods_id', 'id');
    }

    /**
     * 商品图片
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries(){
        return $this->hasMany(SellerGoodsGallery::class, 'goods_id', 'id')->orderBy('sort');
    }

    /**
     * galleries 别名
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(){
        return $this->galleries();
    }

    /**
     * 商品附表字段
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function details(){
        return $this->hasOne(SellerGoodsDetail::class, 'goods_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories(){
        return $this->belongsTo(BaseCategory::class, 'category_id', 'id');
    }
}
