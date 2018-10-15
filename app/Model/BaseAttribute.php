<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseAttribute extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'category_id', 'values'];

    protected $casts = [
        'values' => 'array',
    ];

    /**
     * categories
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author luffyzhao@vip.126.com
     */
    public function categories()
    {
        return $this->belongsTo(BaseCategory::class, 'id', 'category_id');
    }

}
