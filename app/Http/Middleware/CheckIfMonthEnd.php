<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CheckIfMonthEnd
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
        //check if it's the end of the month 
        $today = Carbon::now()->toDateString();
        $lastDayOfTheMonth = Carbon::now()->endOfMonth()->toDateString();
        if($today  !== $lastDayOfTheMonth){
            return redirect('/admin');
        }
        return $next($request);
    }
}
