<?php
/**
 * O2oRefectory
 * IndexSearchp.
 * @author luffyzhao@vip.126.com
 */

namespace App\Searchs\Modules\Base\Seller\Auditing;


use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'auditing_status' => '=',
        'name' => '='
    ];
}