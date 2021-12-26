<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfMonthBegin
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
        $today = Carbon::now()->toDateString();
        $firstDayOfTheMonth = Carbon::now()->firstOfMonth()->toDateString();
        if($today  !== $firstDayOfTheMonth){
            return redirect('/admin');
        }
        return $next($request);
    }
}
