<?php

namespace App\Searchs\Modules\Seller\Admin\Goods;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'seller_id' => '='
    ];
}
