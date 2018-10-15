<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseCategory extends Model
{
    protected $fillable = ['name', 'parent_id', 'sort'];

    /**
     * childs
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author luffyzhao@vip.126.com
     */
    public function childs()
    {
        return $this->hasMany(BaseCategory::class, 'parent_id', 'id');
    }

    /**
     * goods
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author luffyzhao@vip.126.com
     */
    public function goods()
    {
        return $this->hasMany(SellerGoods::class, 'category_id', 'id');
    }

    /**
     * attributes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author luffyzhao@vip.126.com
     */
    public function attributes()
    {
        return $this->hasMany(BaseAttribute::class, 'category_id', 'id');
    }
}
