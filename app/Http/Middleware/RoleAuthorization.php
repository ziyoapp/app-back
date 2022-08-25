<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$rolesIds)
    {
        try {
            $token = JWTAuth::parseToken();
            $user = $token->authenticate();
        } catch (TokenExpiredException $e) {
            //Thrown if token has expired
            return $this->unauthorized('Expired token');
        } catch (TokenInvalidException $e) {
            //Thrown if token invalid
            return $this->unauthorized('Token invalid');
        } catch (JWTException $e) {
            //Thrown if token was not found in the request.
            return $this->unauthorized('Token not found');
        }

        //If user was authenticated successfully and user is in one of the acceptable roles,
        // send to next request.
        if ($user && in_array($user->role_id, $rolesIds)) {
            return $next($request);
        }

        return $this->unauthorized();
    }

    private function unauthorized($message = null) {
        return response()->json([
            'error' => $message ? $message : 'You are unauthorized to access this resource'
        ], 401);
    }
}
