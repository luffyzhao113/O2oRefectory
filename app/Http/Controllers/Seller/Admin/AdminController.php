<?php

namespace App\Http\Controllers\Seller\Admin;

use App\Http\Requests\Seller\Admin\Admin\StoreRequest;
use App\Repositories\Modules\SellerAdmin\Interfaces;
use App\Searchs\Modules\Seller\Admin\Admin\CreateSearch;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
