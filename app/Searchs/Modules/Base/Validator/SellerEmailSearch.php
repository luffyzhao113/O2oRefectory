<?php

namespace App\Searchs\Modules\Base\Validator;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SellerEmailSearch extends SearchAbstract
{
    protected $relationship = [
        'email' => '=',
        'except' => '<>'
    ];

    protected function getExceptAttribute($value){
        return function (Builder $query) use ($value){
            $query->where('id', '<>');
        };
    }
}
