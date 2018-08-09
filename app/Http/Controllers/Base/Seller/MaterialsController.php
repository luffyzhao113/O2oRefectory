<?php

namespace App\Http\Controllers\Base\Seller;

use App\Http\Requests\Base\Seller\Material\IndexRequest;
use App\Http\Requests\Base\Seller\Material\UpdateRequest;
use App\Searchs\Modules\Base\Seller\CertificateSearch;
use App\Searchs\Modules\Base\Seller\Material\IndexSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Modules\SellerMaterial\Interfaces;

class MaterialsController extends Controller
{
    protected $repo;
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(IndexRequest $request){
        $search = new IndexSearch($request->only([
            'seller_id', 'status'
        ]));


        return $this->respondWithSuccess(
            $this->repo->make(['seller:id,name'])->paginate(
                $search->toArray()
            )
        );
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id){
        return $this->respondWithSuccess(
            $this->repo->make(['seller:id,name'])->find($id)
        );
    }

    public function update(UpdateRequest $request, $id){

    }
}
