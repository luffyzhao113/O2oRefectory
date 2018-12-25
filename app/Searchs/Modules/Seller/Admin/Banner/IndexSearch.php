<?php

namespace App\Searchs\Modules\Seller\Admin\Banner;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'seller_id' => '='
    ];
}
