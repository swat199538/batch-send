<?php

namespace App\Http\Middleware;

use App\Model\AssistantSubmitLog;
use Closure;

class verfyuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, AssistantSubmitLog $assistantSubmitLog)
    {
        $id = $request->input('id');
        return $next($request);
    }
}
