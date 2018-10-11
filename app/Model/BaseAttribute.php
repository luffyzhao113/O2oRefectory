<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseAttribute extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'category_id'];

    /**
     * categories
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author luffyzhao@vip.126.com
     */
    public function categories(){
        return $this->belongsTo(BaseCategory::class, 'id', 'category_id');
    }

    /**
     * values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author luffyzhao@vip.126.com
     */
    public function values(){
        return $this->hasMany(BaseAttributeValue::class, 'attribute_id', 'id');
    }
}
