<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormateursMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $guards = ['formateur'];
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('formateur')->check()) {
            return redirect('/login');
        }
        // if (!agent()->can('viewAny', AgentDsi::class)) {
        //     abort(403, 'Unauthorized action.');
        // }

        return $next($request);
    }
}
