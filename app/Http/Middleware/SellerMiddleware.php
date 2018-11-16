<?php

namespace App\Http\Middleware;

use App\Model\Seller;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $sellerId = $request->route('seller_id');
        $key = config('seller.cache.seller_prefix').$sellerId;

        $seller = Cache::rememberForever(
            $key,
            function () use ($sellerId) {
                return Seller::find($sellerId);
            }
        );
        if (!$seller) {
            abort(404, '店铺不存在！');
        }
        // 把这个保存起来
        app()->instance('seller', $seller);

        $request->merge([
            'seller_id' => $seller['id'],
        ]);

        return $next($request);
    }
}
