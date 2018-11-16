<?php

namespace App\Http\Controllers\Base;

use App\Http\Requests\Base\Seller\StoreRequest;
use App\Http\Requests\Base\Seller\UpdateRequest;
use App\Searchs\Modules\Base\Seller\IndexSearch;
use App\Searchs\Modules\Base\Seller\SelectSearch;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Modules\Seller\Interfaces;
use Illuminate\Support\Facades\DB;

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
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(Request $request)
    {
        $search = new IndexSearch(
            $request->only(['status', 'name'])
        );

        return $this->respondWithSuccess(
            $this->repo->paginate(
                $search->toArray(),
                20,
                ['id', 'name', 'status']
            )
        );
    }

    /**
     * 选择
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    public function select(Request $request)
    {
        $search = new SelectSearch(
            $request->only(['name', 'status'])
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
     * 添加店铺
     * @param StoreRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        return $this->respondWithSuccess(
            DB::transaction(
                function () use ($request) {
                    return $this->repo->create(
                        $request->only(
                            [
                                'name',
                                'status',
                                'admin',
                            ]
                        )
                    );
                }
            )
        );
    }

    /**
     * 更新店铺 get
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $with = [
            'admin' => function (HasOne $builder) {
                $builder->where('role_id', 0)->addSelect(['id', 'seller_id', 'email', 'name']);
            },
        ];

        return $this->respondWithSuccess(
            $this->repo->with($with)->find($id)
        );
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->respondWithSuccess(
            DB::transaction(
                function () use ($request, $id) {
                    $this->repo->update(
                        $this->repo->find($id),
                        $request->only(
                            [
                                'name',
                                'status',
                                'admin',
                            ]
                        )
                    );
                }
            )
        );
    }

    /**
     * 查看店铺详情
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->respondWithSuccess(
            $this->repo->find($id)
        );
    }
}
