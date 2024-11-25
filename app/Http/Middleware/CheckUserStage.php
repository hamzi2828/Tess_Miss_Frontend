<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $requiredStage
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $requiredStage)
    {
        $userStage = auth()->user()->getDepartmentStage(auth()->user()->department);
    

        // Check if the user's stage matches the required stage
        if ($userStage != $requiredStage) {
            return redirect()->back()->with('error', 'You are not authorized to access this stage.');
        }
    
        return $next($request); // Allow request to proceed
    }
    
    
}
