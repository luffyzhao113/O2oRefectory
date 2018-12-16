<?php

namespace App\Http\Controllers\Seller\Admin;

use App\Http\Requests\Seller\Admin\Goods\StoreRequest;
use App\Http\Requests\Seller\Admin\Goods\UpdateRequest;
use App\Http\Services\Seller\Admin\Goods\StoreService;
use App\Http\Services\Seller\Admin\Goods\UpdateService;
use App\Model\SellerGoods;
use App\Repositories\Modules\SellerGoods\Interfaces;
use App\Searchs\Modules\Seller\Admin\Goods\IndexSearch;
use App\Searchs\Modules\Seller\Admin\Goods\RecycleSearch;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
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
        $search = new IndexSearch($request->all());

        return $this->respondWithSuccess(
            $this->repo->with(['categories:id,name'])->paginate($search->toArray())
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $model = app(\App\Repositories\Modules\SellerModel\Interfaces::class);
        $category = app(\App\Repositories\Modules\BaseCategory\Interfaces::class);

        return $this->respondWithSuccess(
            [
                'models' => $model->getWhere(
                    [['seller_id', '=', $request->input('seller_id')]],
                    ['id', 'name', 'specs', 'attributes']
                ),
                'categories' => $category->getWhere([], ['id', 'parent_id', 'name']),
            ]
        );
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $service = new StoreService($request);

        return $this->respondWithSuccess(
            DB::transaction(
                function () use ($service) {
                    $this->repo->create($service->toArray());
                }
            )
        );
    }

    /**
     * @param Request $request
     * @param $sellerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function edit(Request $request, $sellerId, $id)
    {
        $model = $this->repo->with(['images:id,path,goods_id', 'details', 'specs'])->find($id);
        $this->isSeller($model);

        $goodsModel = app(\App\Repositories\Modules\SellerModel\Interfaces::class);
        $category = app(\App\Repositories\Modules\BaseCategory\Interfaces::class);

        return $this->respondWithSuccess(
            [
                'models' => $goodsModel->getWhere(
                    [['seller_id', '=', $request->input('seller_id')]],
                    ['id', 'name', 'specs', 'attributes']
                ),
                'categories' => $category->getWhere([], ['id', 'parent_id', 'name']),
                'row' => $model,
            ]
        );
    }

    /**
     * @param UpdateRequest $request
     * @param $sellerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, $sellerId, $id)
    {
        $service = new UpdateService($request);

        $model = $this->repo->find($id);

        $this->isSeller($model);

        return $this->respondWithSuccess(
            DB::transaction(
                function () use ($model, $service) {
                    $this->repo->update(
                        $model,
                        $service->toArray()
                    );
                }
            )
        );
    }

    /**
     * 放置回收站
     * @param Request $request
     * @param $sellerId
     * @param $id
     * @throws AuthorizationException
     */
    public function destroy(Request $request, $sellerId, $id)
    {
        $model = $this->repo->find($id);

        $this->isSeller($model);

        if ($this->repo->delete($model)) {
            $this->respondWithSuccess([], '放置回收站成功');
        } else {
            $this->respondWithError('放置回收站失败');
        }
    }

    /**
     * 回收站
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function recycle(Request $request)
    {
        $search = new RecycleSearch(
            $request->all()
        );

        return $this->respondWithSuccess(
            $this->repo->with(['categories:id,name'])->onlyTrashed()->paginate(
                $search->toArray()
            )
        );
    }

    /**
     * @param Request $request
     * @param $sellerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function restore(Request $request, $sellerId, $id)
    {
        $model = $this->repo->onlyTrashed()->find($id);
        $this->isSeller($model);

        if ($this->repo->restore($model)) {
            return $this->respondWithSuccess([], '恢复成功');
        } else {
            return $this->respondWithError('恢复失败');
        }
    }

    /**
     * 商品必须是店铺的
     * @param SellerGoods $model
     * @throws AuthorizationException
     */
    protected function isSeller(SellerGoods $model)
    {
        if ($model->seller_id !== request()->input('seller_id')) {
            throw new AuthorizationException('This action is unauthorized.');
        }
    }
}
