<?php

namespace App\Searchs\Modules\Seller\Admin\Admin;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class CreateSearch extends SearchAbstract
{
    protected $relationship = [
        'seller_id' => '='
    ];
}
