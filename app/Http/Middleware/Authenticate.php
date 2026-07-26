<?php
namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            if ($request->is("admin") || $request->is("admin/*")) {
                return route("admin.index");
            } else {
                return route("front.index");
            }
        }
        return null;
    }
}
