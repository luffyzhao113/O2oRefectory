<?php

namespace App\Searchs\Modules\Seller\Admin\Admin;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'seller_id' => '=',
        'role_id' => '=',
        'name' => '=',
        'email' => '=',
        'status' => '='
    ];
}
