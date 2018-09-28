<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2018/9/21
 * Time: 17:33
 */

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Base\Validator\SellerEmailRequest;
use App\Http\Requests\Base\Validator\SellerRequest;
use App\Repositories\Modules\Seller\Interfaces as Seller;
use App\Repositories\Modules\SellerAdmin\Interfaces as SellerAdmin;
use App\Searchs\Modules\Base\Validator\SellerEmailSearch;
use App\Searchs\Modules\Base\Validator\SellerSearch;

class ValidatorController extends Controller
{
    /**
     * seller
     * @param SellerRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    public function seller(SellerRequest $request)
    {
        $search = new SellerSearch(
            $request->all()
        );
        $repo = app(Seller::class);

        return $this->respondWithSuccess(
            $repo->findValue($search->toArray(), 'id')
        );
    }

    /**
     * seller
     * @param SellerEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    public function sellerEmail(SellerEmailRequest $request)
    {
        $search = new SellerEmailSearch(
            $request->all()
        );
        $repo = app(SellerAdmin::class);

        return $this->respondWithSuccess(
            $repo->findValue($search->toArray(), 'id')
        );
    }
}