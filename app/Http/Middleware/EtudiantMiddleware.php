<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EtudiantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $guards = ['etudiant'];
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('etudiant')->check()) {
            return redirect('/login');
        }
        // if (!agent()->can('viewAny', AgentDsi::class)) {
        //     abort(403, 'Unauthorized action.');
        // }

        return $next($request);
    }
}
