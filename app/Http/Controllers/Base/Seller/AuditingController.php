<?php
/**
 * O2oRefectory
 * AuditingController.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Controllers\Base\Seller;


use App\Http\Controllers\Controller;
use App\Http\Requests\Base\Seller\Auditing\FailRequest;
use App\Http\Requests\Base\Seller\Auditing\UpdateRequest;
use App\Repositories\Modules\Seller\Interfaces;
use Illuminate\Http\Request;
use App\Searchs\Modules\Base\Seller\Auditing\IndexSearch;

class AuditingController extends Controller
{
    protected $repo;
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 待审核数据
     * @method index
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request){
        $search = new IndexSearch(
            $request->only(['auditing_status', 'name'])
        );

        return $this->respondWithSuccess(
            $this->repo->scope(['auditing'=> [[0,2]]])->paginate(
                $search->toArray(),
                20,
                ['id', 'name', 'auditing_status']
            )
        );
    }

    /**
     * 查看店铺详情
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id){
        return $this->respondWithSuccess(
            $this->repo->make(['certificates'])->find($id)
        );
    }

    /**
     * 审核成功
     * @method update
     * @param UpdateRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $id){

        $res = $this->repo->updateWhere([
            'auditing_status' => 1,
            'logs' => [
                'remark' => '审核成功',
                'admin_id' => auth()->user()->id
            ]
        ], [
            'id' => $id,
            'auditing_status' => 0
        ]);

        if($res){
            $this->respondWithSuccess('审核成功');
        }else{
            $this->respondWithError('审核失败');
        }
    }

    /**
     * 审核失败
     * @method fail
     * @param FailRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     */
    public function fail(FailRequest $request, $id){
        $res = $this->repo->updateWhere([
            'auditing_status' => 2,
            'logs' => [
                'remark' => '审核不能过，原因：'. $request->input('remark'),
                'admin_id' => auth()->user()->id
            ]
        ], [
            'id' => $id,
            'auditing_status' => 0
        ]);

        if($res){
            $this->respondWithSuccess('审核成功');
        }else{
            $this->respondWithError('审核失败');
        }
    }
}