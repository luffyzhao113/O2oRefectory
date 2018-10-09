<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2018/10/9
 * Time: 17:16
 */

namespace App\Http\Controllers\Base\Seller;


use App\Http\Controllers\Controller;
use App\Http\Requests\Base\Seller\Permission\DestroyRequest;
use App\Http\Requests\Base\Seller\Permission\StoreRequest;
use App\Http\Requests\Base\Seller\Permission\UpdateRequest;
use App\Repositories\Modules\SellerPermission\Interfaces;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 获取所有权限
     * @method index
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request)
    {
        return $this->respondWithSuccess(
            $this->repo->getWhere(
                [],
                ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
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
            $this->repo->getWhere(
                [['islink', '=', 1]],
                ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
            )
        );
    }

    /**
     * 新增权限
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
            $this->repo->create(
                $request->only(['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort'])
            )
        );
    }

    /**
     * 更新 get
     * edit
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function edit($id)
    {
        return $this->respondWithSuccess(
            [
                'row' => $this->repo->find(
                    $id,
                    ['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort']
                ),
                'parents' => $this->repo->getWhere(
                    [['islink', '=', 1]],
                    ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
                ),
            ]
        );
    }

    /**
     * 更新
     * @method update
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
                $request->only(['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort'])
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
        if ($this->repo->delete($this->repo->find($id))) {
            $this->respondWithSuccess([], '删除成功');
        } else {
            $this->respondWithError('删除失败');
        }
    }
}