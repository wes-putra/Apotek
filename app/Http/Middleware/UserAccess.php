<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAccess
{
    public function handle(Request $request, Closure $next, ...$allowedUserTypes)
    {
        $user = $request->user();

        // Memeriksa apakah tipe pengguna saat ini termasuk dalam daftar yang diizinkan
        if (in_array($user->usertype, $allowedUserTypes)) {
            return $next($request);
        }

        // Jika pengguna tidak memiliki tipe yang diizinkan, berikan respons sesuai
        return response()->json(['error' => 'You do not have permission to access this page.'], 403);
        // Atau, Anda dapat mengarahkan pengguna ke halaman lain atau menampilkan halaman kesalahan, seperti yang Anda inginkan.
    }
}
