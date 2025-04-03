<?php

namespace App\Http\Middleware;

/**
 * Copyright (C) 2025 Chongqing Enzu Technology Co., LTD
 * [KwokCMS] Ver 1.0 (C) 2022: Mr.Kwok
 * FilePath: /app/Http/Middleware/HtmlCompressMiddleware.php
 * Created Time: 2022-06-17 14:16:03
 * Last Edit Time: 2025-03-08 14:06:11
 * Description: 将通过中间件的HTML压缩(清理空格、换行等)
 */

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class HtmlCompressMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (config('app.html_compress', false) && $response->isSuccessful()) {
            $contentType = $response->headers->get('Content-Type');
            if (is_string($contentType) && preg_match('/text\/html/i', $contentType)) {
                $response->setContent(preg_replace("/(<pre.*?>.*?<\/pre>|<textarea.*?>.*?<\/textarea>)|(\s{2,}|\n|\r|\t)/is", '', $response->getContent()));
            }
        }
        return $response;
    }
}
