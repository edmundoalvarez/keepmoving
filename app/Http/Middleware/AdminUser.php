<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $id = $request->user();

        // $user = User::findOrFail($id);
        $user = $request->user();


        if($user->rol !== 1){
            return redirect()
                ->route('home');
        }

        return $next($request);
    }
}
