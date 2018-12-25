<?php

namespace App\Http\Controllers\Seller\Admin;

use App\Http\Requests\Seller\Admin\Banner\StoreRequest;
use App\Http\Services\Seller\Admin\Banner\StoreService;
use App\Searchs\Modules\Seller\Admin\Banner\IndexSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Modules\SellerBanner\Interfaces;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
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
            $this->repo->paginate($search->toArray())
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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
