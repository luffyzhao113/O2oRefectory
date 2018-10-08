<?php

namespace App\Searchs\Modules\Seller\Admin\Admin;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class EditSearch extends SearchAbstract
{
    protected $relationship = [
        'seller_id' => '='
    ];
}
