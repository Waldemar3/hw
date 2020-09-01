<?php

namespace App\Http\Middleware;

use App\Ad;
use Closure;

class DeleteAd
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
        if($request->id !== null){
            $ad = Ad::find($request->id);

            if($request->user()->cannot('delete', $ad)){
                return redirect()
                    ->route('home')
                    ->withErrors(['not_allowed' => 'You can not delete this post.']);
            }
        }

        return $next($request);
    }
}
