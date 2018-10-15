<?php

namespace App\Http\Controllers\Base;

use App\Http\Requests\Base\Attribute\StoreRequest;
use App\Http\Requests\Base\Attribute\UpdateRequest;
use App\Repositories\Modules\BaseAttribute\Interfaces;
use App\Searchs\Modules\Base\Attribute\IndexSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{

    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
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
        $search = new IndexSearch(
            $request->all()
        );

        return $this->respondWithSuccess(
            $this->repo->paginate(
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
            $this->repo->create(
                $request->only(['name', 'values', 'category_id'])
            )
        );
    }

    /**
     * edit get
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function edit($id)
    {
        return $this->respondWithSuccess(
            $this->repo->find($id)
        );
    }

    /**
     * update put
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $id)
    {
        $model = $this->repo->find($id);

        return $this->respondWithSuccess(
            $this->repo->update($model, $request->only(['name', 'values', 'category_id']))
        );
    }

    /**
     * destroy
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function destroy($id)
    {
        $model = $this->repo->find($id);

        if ($this->repo->delete($model)) {
            return $this->respondWithSuccess([], '删除成功');
        } else {
            return $this->respondWithError('删除失败');
        }
    }
}
