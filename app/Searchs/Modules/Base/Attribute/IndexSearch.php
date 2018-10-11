<?php

namespace App\Searchs\Modules\Base\Attribute;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'category_id' => '='
    ];
}
