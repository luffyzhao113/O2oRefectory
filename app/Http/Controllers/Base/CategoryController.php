<?php

namespace App\Http\Controllers\Base;

use App\Http\Requests\Base\Category\DestroyRequest;
use App\Http\Requests\Base\Category\StoreRequest;
use App\Http\Requests\Base\Category\UpdateRequest;
use App\Repositories\Modules\BaseCategory\Interfaces;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * index
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function index()
    {
        return $this->respondWithSuccess(
            $this->repo->with(['attributes:id,category_id,name'])->get(
                ['id', 'parent_id', 'name', 'sort']
            )
        );
    }

    /**
     * create
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function create(Request $request)
    {
        return $this->respondWithSuccess(
            $this->repo->getWhere(
                [['parent_id', '=', 0]],
                ['id', 'parent_id', 'name']
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
            $this->repo->create(
                $request->only(['name', 'parent_id', 'sort'])
            )
        );
    }

    /**
     * edit
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function edit(Request $request, $id)
    {
        return $this->respondWithSuccess(
            [
                'row' => $this->repo->find($id),
                'parents' => $this->repo->getWhere(
                    [['parent_id', '=', 0]],
                    ['id', 'parent_id', 'name']
                ),
            ]
        );
    }

    /**
     * update
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $id)
    {
        $category = $this->repo->find($id);

        $request->hasChild($category);

        return $this->respondWithSuccess(
            $this->repo->update(
                $category,
                $request->only(['name', 'parent_id', 'sort'])
            )
        );
    }

    /**
     * destroy
     * @param DestroyRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @author luffyzhao@vip.126.com
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $category = $this->repo->find($id);

        $request->hasChild($category);

        if ($this->repo->delete($category)) {
            return $this->respondWithSuccess([]);
        } else {
            return $this->respondWithError('删除失败');
        }
    }
}
