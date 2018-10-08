<?php

namespace App\Http\Controllers\Seller\Admin;

use App\Http\Requests\Seller\Admin\Permission\DestroyRequest;
use App\Http\Requests\Seller\Admin\Permission\IndexRequest;
use App\Http\Requests\Seller\Admin\Permission\StoreRequest;
use App\Http\Requests\Seller\Admin\Permission\UpdateRequest;
use App\Repositories\Modules\SellerPermission\Interfaces;
use App\Searchs\Modules\Seller\Admin\Permission\CreateSearch;
use App\Searchs\Modules\Seller\Admin\Permission\EditSearch;
use App\Searchs\Modules\Seller\Admin\Permission\IndexSearch;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{

    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 获取所有权限
     * index
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    public function index(IndexRequest $request)
    {
        $search = new IndexSearch();

        return $this->respondWithSuccess(
            $this->repo->getWhere(
                $search->toArray(),
                ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
            )
        );
    }

    /**
     * 创建时要获取的数据
     * create
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    public function create()
    {
        $search = new CreateSearch();

        return $this->respondWithSuccess(
            $this->repo->getWhere(
                $search->toArray(),
                ['id', 'parent_id', 'name', 'display_name as title', 'sort']
            )
        );
    }

    /**
     * 创建
     * store
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function store(StoreRequest $request)
    {
        return $this->respondWithSuccess(
            $this->repo->create(
                $request->only(['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort'])
            )
        );
    }

    /**
     * edit
     * @param $domain 域名
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    public function edit($domain, $id)
    {
        $search = new EditSearch();

        $data['parents'] = $this->repo->getWhere(
            $search->toArray(),
            ['id', 'parent_id', 'name', 'display_name as title', 'sort']
        );

        $data['row'] = $this->repo->find(
            $id,
            ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort']
        );

        return $this->respondWithSuccess($data);
    }

    /**
     * update
     * @param UpdateRequest $request
     * @param $domain
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $domain, $id)
    {
        return $this->respondWithSuccess(
            $this->repo->updateOrCreate(
                ['id' => $id],
                $request->only(['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort'])
            )
        );
    }

    /**
     * 删除
     * destroy
     * @param $domain
     * @param $id
     * @author luffyzhao@vip.126.com
     */
    public function destroy(DestroyRequest $request, $domain, $id)
    {
        $valid = $this->repo->delete(
            $this->repo->find($id)
        );

        if ($valid) {
            $this->respondWithSuccess('删除成功');
        } else {
            $this->respondWithError('删除失败');
        }
    }
}
