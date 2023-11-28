<?php
// multi role : https://www.sahretech.com/2020/12/cara-membuat-multiple-user-di-laravel.html

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $roles = array_slice(func_get_args(), 1);

        // foreach ($roles as $role) {
        //     $user = \Auth::user()->role;
        //     if ($user == $role) {
        //         return $next($request);
        //     }
        // }

        // return redirect('/');

        if (\Auth::check()) { // Memeriksa apakah pengguna sudah masuk
            $user = \Auth::user();
            $roles = array_slice(func_get_args(), 1);

            foreach ($roles as $role) {
                if ($user->role == $role) {
                    return $next($request);
                }
            }
        }

        return redirect('/')->with('cartgagal', 'Anda harus login terlebih dahulu.');;
    }
}
