<?php

namespace App\Searchs\Modules\Base\Validator;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SellerSearch extends SearchAbstract
{
    protected $relationship = [
        'domain' => '=',
        'except' => '<>'
    ];

    protected function getExceptAttribute($value){
        return function (Builder $query) use ($value){
            $query->where('id', '<>');
        };
    }
}
