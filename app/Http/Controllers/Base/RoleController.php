<?php

namespace App\Http\Controllers\Base;

use App\Http\Requests\Base\Role\DestroyRequest;
use App\Http\Requests\Base\Role\StoreRequest;
use App\Http\Requests\Base\Role\UpdateRequest;
use App\Searchs\Modules\Base\Role\IndexSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Modules\BaseRole\Interfaces;
use Validator;

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
            app(\App\Repositories\Modules\BasePermission\Interfaces::class)->getWhere(
                [],
                ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
            )
        );
    }

    /**
     * 新增角色
     * @method store
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function store(StoreRequest $request)
    {
        return $this->respondWithSuccess(
            $this->repo->create($request->only(['name', 'status', 'description', 'permissions']))
        );
    }

    /**
     * edit
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function edit($id)
    {
        return $this->respondWithSuccess(
            [
                'row' => $this->repo->with(['perms'])->find($id, ['id', 'name', 'status', 'description']),
                'permissions' => app(\App\Repositories\Modules\BasePermission\Interfaces::class)->getWhere(
                    [],
                    ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
                ),
            ]
        );
    }

    /**
     * 更新角色
     * @method store
     * @param UpdateRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->respondWithSuccess(
            $this->repo->update(
                $this->repo->find($id),
                $request->only(['name', 'status', 'description', 'permissions'])
            )
        );
    }

    /**
     * 删除
     * @method destroy
     * @param DestroyRequest $request
     * @param $id
     *
     * @author luffyzhao@vip.126.com
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $role = $this->repo->find($id);
        // 验证
        $request->hasUser($role);

        if ($this->repo->delete($role)) {
            $this->respondWithSuccess('删除成功');
        } else {
            $this->respondWithError('删除失败');
        }
    }
}
