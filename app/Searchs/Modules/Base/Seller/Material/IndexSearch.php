<?php

namespace App\Searchs\Modules\Base\Seller\Material;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'seller_id' => '=',
        'status' => '='
    ];
}
