<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;


class CheckAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param \App\Models\Article $article
     * @param \App\Models\User $user
     * @return mixed
     */
    public function handle(Request $request, Closure $next, Article $article, User $user)
    {
        if( $article->users()->first()->user_id == Auth::user()->id){
            return $next($request);
        }

    }
}
