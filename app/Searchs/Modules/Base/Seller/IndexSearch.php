<?php

namespace App\Searchs\Modules\Base\Seller;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'status' => '=',
        'name' => '='
    ];
}
