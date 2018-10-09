<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/6/26
 * Time: 20:30
 */

namespace App\Http\Controllers\Base;


use App\Http\Controllers\Controller;
use App\Http\Requests\Base\Admin\DestroyRequest;
use App\Http\Requests\Base\Admin\StoreRequest;
use App\Http\Requests\Base\Admin\UpdateRequest;
use App\Repositories\Modules\BaseAdmin\Interfaces;
use App\Searchs\Modules\Base\Admin\IndexSearch;
use Illuminate\Http\Request;

class AdminController extends Controller
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
    public function lists(Request $request){

        return $this->respondWithSuccess(
            app(\App\Repositories\Modules\BaseRole\Interfaces::class)->getWhere([])
        );
    }

    /**
     * 用户管理
     * @method index
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(Request $request){
        $search = new IndexSearch($request->all());

        $make = ['role' => function($query){
            $query->select(['id', 'name']);
        }];
        
        return $this->respondWithSuccess(
            $this->repo->make($make)->paginate(
                $search->toArray(),
                20,
                ['id', 'email', 'status', 'role_id', 'name']
            )
        );
    }

    /**
     * 创建用户 get
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        return $this->respondWithSuccess(
            app(\App\Repositories\Modules\BaseRole\Interfaces::class)->getWhere([])
        );
    }

    /**
     * 添加用户
     * @method store
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function store(StoreRequest $request){
        return $this->respondWithSuccess(
            $this->repo->create($request->only(['name', 'password', 'status', 'role_id', 'email']))
        );
    }

    /**
     * 修改用户 get
     * edit
     * @param Request $request
     * @param $domain
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function edit(Request $request, $id){
        return $this->respondWithSuccess([
            'roles' =>     app(\App\Repositories\Modules\BaseRole\Interfaces::class)->getWhere([]),
            'row' => $this->repo->find($id)
        ]);
    }

    /**
     * 更新用户
     * @method update
     * @param UpdateRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $id){

        $admin = $this->repo->find($id);
        // 验证
        $request->isSuper($admin);

        return $this->respondWithSuccess(
            $this->repo->update(
                $admin,
                $request->only(['name', 'password', 'status', 'role_id', 'email'])
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
    public function destroy(DestroyRequest $request, $id){
        $admin = $this->repo->find($id);

        // 验证
        $request->isSuper($admin);

        if ($this->repo->delete($admin)) {
            $this->respondWithSuccess([]);
        } else {
            $this->respondWithError('删除失败');
        }
    }
}