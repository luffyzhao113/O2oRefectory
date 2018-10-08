<?php

namespace App\Searchs\Modules\Seller\Admin\Permission;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => '=',
        'seller_id' => '='
    ];
}
