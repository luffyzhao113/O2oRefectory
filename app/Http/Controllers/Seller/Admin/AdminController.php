<?php

namespace App\Http\Controllers\Seller\Admin;

use App\Http\Requests\Seller\Admin\Admin\DestroyRequest;
use App\Http\Requests\Seller\Admin\Admin\EditRequest;
use App\Http\Requests\Seller\Admin\Admin\StoreRequest;
use App\Http\Requests\Seller\Admin\Admin\UpdateRequest;
use App\Repositories\Modules\SellerAdmin\Interfaces;
use App\Searchs\Modules\Seller\Admin\Admin\CreateSearch;
use App\Searchs\Modules\Seller\Admin\Admin\EditSearch;
use App\Searchs\Modules\Seller\Admin\Admin\IndexSearch;
use App\Searchs\Modules\Seller\Admin\Admin\ListsSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 查找角色
     * index
     * @author luffyzhao@vip.126.com
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function lists(Request $request){
        $search = new ListsSearch($request->all());

        return $this->respondWithSuccess(
            app(\App\Repositories\Modules\SellerRole\Interfaces::class)->getWhere(
                $search->toArray()
            )
        );
    }

    /**
     * index
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request)
    {
        $search = new IndexSearch($request->all());

        return $this->respondWithSuccess(
            $this->repo->with(['role'])->paginate(
                $search->toArray()
            )
        );
    }

    /**
     * create
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    public function create(Request $request)
    {
        $search = new CreateSearch($request->all());

        return $this->respondWithSuccess(
            app(\App\Repositories\Modules\SellerRole\Interfaces::class)->getWhere(
                $search->toArray()
            )
        );
    }

    /**
     * store
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function store(StoreRequest $request)
    {
        return $this->respondWithSuccess(
            $this->repo->create($request->only(['name', 'password', 'status', 'role_id', 'email', 'seller_id']))
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditRequest $request
     * @param $domain
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function edit(EditRequest $request, $domain, $id)
    {
        $search = new EditSearch($request->all());

        return $this->respondWithSuccess([
            'row' => $this->repo->find($id),
            'roles' => app(\App\Repositories\Modules\SellerRole\Interfaces::class)->getWhere(
                $search->toArray()
            )
        ]);
    }

    /**
     * 修改
     * @param UpdateRequest $request
     * @param $domain
     * @param $id
     */
    public function update(UpdateRequest $request, $domain, $id)
    {
        $admin = $this->repo->find($id);
        // 验证
        $request->existsSeller($admin);

        $this->respondWithSuccess(
            $this->repo->update($admin, $request->only(['name', 'password', 'status', 'role_id', 'email', 'seller_id']))
        );

    }

    /**
     * @param DestroyRequest $request
     * @param $domain
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyRequest $request, $domain, $id)
    {
        $admin = $this->repo->find($id);
        // 验证
        $request->isSuper($admin);

        if($this->repo->delete($admin)){
            return $this->respondWithSuccess([]);
        }else{
            return $this->respondWithError('删除失败');
        }
    }
}
