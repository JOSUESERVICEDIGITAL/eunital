<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\PostTooLargeException;

class ValidatePostSizeCustom
{
    public function handle($request, Closure $next)
    {
        $maxSize = 1000 * 1024 * 1024; // 1000 MB
        $contentLength = $request->server('CONTENT_LENGTH');

        if ($contentLength && $contentLength > $maxSize) {
            throw new PostTooLargeException;
        }

        return $next($request);
    }
}
