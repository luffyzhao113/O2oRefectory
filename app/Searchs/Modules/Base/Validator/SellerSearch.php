<?php

namespace App\Searchs\Modules\Base\Validator;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SellerSearch extends SearchAbstract
{
    protected $relationship = [
        'domain' => '='
    ];
}
