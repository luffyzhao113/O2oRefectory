<?php

namespace App\Http\Controllers\Seller\Admin;

use App\Http\Requests\Seller\Admin\Role\DestroyRequest;
use App\Http\Requests\Seller\Admin\Role\StoreRequest;
use App\Http\Requests\Seller\Admin\Role\UpdateRequest;
use App\Repositories\Modules\SellerRole\Interfaces;
use App\Searchs\Modules\Seller\Admin\Permission\IndexSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 系统角色列表
     * @method index
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(Request $request)
    {
        $search = new IndexSearch($request->all());

        return $this->respondWithSuccess(
            $this->repo->withCount(['users'])->paginate(
                $search->toArray(),
                20,
                ['id', 'name', 'status']
            )
        );
    }

    /**
     * create
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function create()
    {
        return $this->respondWithSuccess(
            app(\App\Repositories\Modules\SellerPermission\Interfaces::class)->getWhere(
                [],
                ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
            )
        );
    }

    /**
     * store
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function store(StoreRequest $request)
    {
        return $this->respondWithSuccess(
            $this->repo->create($request->only(['name', 'status', 'description', 'seller_id', 'permissions']))
        );
    }


    /**
     * edit
     * @param $sellerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function edit($sellerId, $id)
    {
        return $this->respondWithSuccess(
            [
                'row' => $this->repo->with(['perms'])->find($id, ['id', 'name', 'status', 'description']),
                'permissions' => app(\App\Repositories\Modules\SellerPermission\Interfaces::class)->getWhere(
                    [],
                    ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
                ),
            ]
        );
    }

    /**
     * update
     * @param UpdateRequest $request
     * @param $sellerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $sellerId, $id)
    {
        return $this->respondWithSuccess(
            $this->repo->update(
                $this->repo->find($id),
                $request->only(['name', 'status', 'description', 'permissions'])
            )
        );
    }

    /**
     * destroy
     * @param DestroyRequest $request
     * @param $sellerId
     * @param $id
     * @author luffyzhao@vip.126.com
     * @throws \Illuminate\Validation\ValidationException
     */
    public function destroy(DestroyRequest $request, $sellerId, $id)
    {
        $role = $this->repo->find($id);
        $request->hasUser($role);

        if ($this->repo->delete($role)) {
            $this->respondWithSuccess('删除成功');
        } else {
            $this->respondWithError('删除失败');
        }
    }
}
