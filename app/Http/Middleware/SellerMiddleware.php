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
        $domain = $request->route('domain');
        $key = config('seller.cache.domain_prefix').$domain;

        $seller = Cache::rememberForever(
            $key,
            function () use ($domain) {
                return Seller::where('domain', '=', $domain)->first();
            }
        );
        if (!$seller) {
            abort(404, '域名不存在！');
        }

        return $next($request);
    }
}
