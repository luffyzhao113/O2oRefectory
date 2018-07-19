<?php

namespace App\Http\Controllers\Base;

use App\Searchs\Modules\Base\Seller\IndexSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Modules\Seller\Interfaces;

class SellerController extends Controller
{
    protected $repo;
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request){
        $search = new IndexSearch($request->all());

        return $this->respondWithSuccess(
            $this->repo->paginate(
                $search->toArray(),
                20,
                ['id', 'name', 'status', 'verify']
            )
        );
    }
}
