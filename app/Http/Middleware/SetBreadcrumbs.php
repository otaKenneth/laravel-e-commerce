<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetBreadcrumbs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $breadcrumbs = [
            'front.user.account' => 'MY ACCOUNT',
            'user.delivery_address_list.show' => 'ADDRESSES',
            'front.user.security' => 'CHANGE PASSWORD',
            'front.user.orders' => 'ORDER LIST',
            'front.user.wishlist' => 'WISHLIST',
            'user.chats.show' => 'CHATS'
        ];

        $currentRoute = request()->route()->getName();
        $activeBreadcrumb = array_key_exists($currentRoute, $breadcrumbs) ? $breadcrumbs[$currentRoute] : '';

        view()->share('activeBreadcrumb', $activeBreadcrumb);

        return $next($request);
    }
}
