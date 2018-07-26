<?php
/**
 * O2oRefectory
 * SelectSearch.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Searchs\Modules\Base\Seller;


use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SelectSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => 'like',
        'auditing_status' => '=',
        'status' => '='
    ];

    protected function getNameAttribute($value, $data){
        return '%'. $value . '%';
    }
}