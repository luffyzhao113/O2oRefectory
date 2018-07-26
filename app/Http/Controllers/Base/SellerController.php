<?php

namespace App\Http\Controllers\Base;

use App\Searchs\Modules\Base\Seller\IndexSearch;
use App\Searchs\Modules\Base\Seller\SelectSearch;
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

    /**
     * 店铺列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $search = new IndexSearch(
            $request->only(['status', 'name'])
        );

        return $this->respondWithSuccess(
            $this->repo->scope(['auditing'=> [1]])->paginate(
                $search->toArray(),
                20,
                ['id', 'name', 'status']
            )
        );
    }

    public function select(Request $request){
        $search = new SelectSearch(
            $request->only(['name', 'auditing_status', 'status'])
        );

        return $this->respondWithSuccess(
            $this->repo->simplePaginate(
                $search->toArray(),
                20,
                ['id', 'name']
            )
        );
    }


    /**
     * 查看店铺详情
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id){
        return $this->respondWithSuccess(
            $this->repo->make(['certificates', 'logs'])->find($id)
        );
    }
}
