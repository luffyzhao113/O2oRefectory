<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/10/4
 * Time: 12:16
 */

namespace App\Http\Controllers\Seller\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Admin\StoreRequest;

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
}