<?php

namespace App\Http\Middleware;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Http/Middleware/AdminMiddleware.php
 * Created Time: 2025-03-07 09:13:29
 * Last Edit Time: 2025-03-07 21:29:15
 * Description: 验证管理帐号中间件
 */

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized(非管理员用户)'], 403);
        }
        return $next($request);
    }
}
