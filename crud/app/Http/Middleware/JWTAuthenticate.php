<?php

namespace App\Http\Middleware;

use Closure;

class JWTAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->server('HTTP_AUTHORIZATION')) {
            $token = $request->server('HTTP_AUTHORIZATION');
            list($header, $payload, $signature) = explode('.', $token);
            $newsignature = hash_hmac('sha256', $header . "." . $payload, 'secretkey', true);
            $newsignature = base64_encode($newsignature);
            if ($newsignature === $signature) {
                return $next($request);
            }
        }

        return response(null, 401);
    }

    public function generateDummyJwt()
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $base64UrlHeader = base64_encode($header);
        $payload = json_encode(['user_id' => 1]);
        $base64UrlPayload = base64_encode($payload);
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'secretkey', true);
        $base64UrlSignature = base64_encode($signature);
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
}
