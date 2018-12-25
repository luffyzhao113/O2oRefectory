<?php

namespace App\Http\Controllers\Seller\Admin;

use App\Http\Requests\Seller\Admin\Model\DestroyRequest;
use App\Http\Requests\Seller\Admin\Model\StoreRequest;
use App\Http\Requests\Seller\Admin\Model\UpdateRequest;
use App\Repositories\Modules\SellerModel\Interfaces;
use App\Http\Controllers\Controller;
use App\Searchs\Modules\Seller\Admin\Model\IndexSearch;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(Request $request)
    {
        $search = new IndexSearch(
            $request->all()
        );

        return $this->respondWithSuccess(
            $this->repo->paginate(
                $search->toArray()
            )
        );
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        return $this->respondWithSuccess(
            $this->repo->create(
                $request->only(
                    [
                        'seller_id',
                        'name',
                        'description',
                        'specs',
                        'attributes',
                    ]
                )
            )
        );
    }

    /**
     * @param $sellerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($sellerId, $id)
    {
        return $this->respondWithSuccess(
            $this->repo->find($id)
        );
    }

    /**
     * @param UpdateRequest $request
     * @param $sellerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $sellerId, $id)
    {

        $model = $this->repo->find($id);
        $request->isSeller($model);

        return $this->respondWithSuccess(
            $this->repo->update(
                $model,
                $request->only(
                    [
                        'seller_id',
                        'name',
                        'description',
                        'specs',
                        'attributes',
                    ]
                )
            )
        );
    }

    /**
     * @param DestroyRequest $request
     * @param $sellerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(DestroyRequest $request, $sellerId, $id)
    {
        $model = $this->repo->find($id);
        $request->isSeller($model);

        if($this->repo->delete($model)){
            return $this->respondWithSuccess([], '删除成功');
        }else{
            return $this->respondWithError('删除失败');
        }
    }

}
