<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/10/4
 * Time: 12:16
 */

namespace App\Http\Controllers\Seller\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Admin\Auth\LockRequest;
use App\Http\Requests\Seller\Admin\Auth\UserRequest;
use App\Http\Requests\Seller\Admin\StoreRequest;
use App\Repositories\Modules\SellerAdmin\Interfaces;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * 登录
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {

        $token = auth('seller')->attempt(
            $request->only(
                [
                    'email',
                    'seller_id',
                    'password',
                ]
            )
        );

        if (!$token) {
            return $this->respondWithError('用户不存在,或者密码不正确！');
        }

        return $this->respondWithSuccess(
            [
                'token' => $token->get(),
            ]
        );
    }

    /**
     * 获取登录人员信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithSuccess(
            auth('seller')->user()
        );
    }

    /**
     * 登录用户权限
     * permission
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function permission(){
        return $this->respondWithSuccess(
            auth('seller')->user()->cachedPermissions()
        );
    }

    /**
     * 更新用户
     * @method user
     * @param UserRequest $request
     * @param Interfaces $repo
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function user(UserRequest $request, Interfaces $repo)
    {
        return $this->respondWithSuccess(
            $repo->update(
                auth('seller')->user(),
                $request->only(['name', 'password', 'email'])
            )
        );
    }

    /**
     * 验证密码
     * @method lock
     * @param LockRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function lock(LockRequest $request)
    {
        if (!Hash::check($request->input('password'), auth('seller')->user()->password)) {
            return $this->respondWithError('密码错误！');
        } else {
            return $this->respondWithSuccess([]);
        }
    }
}