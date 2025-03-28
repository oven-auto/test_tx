<?php

namespace App\Http\Middleware;

use App\Classes\Notice\Notice;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class NoticeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = Route::getCurrentRoute();
      
        $subject = $route->getController()->subject ?? 'Запись';

        $genus = $route->getController()->genus ?? '';
        
        $ref = new \ReflectionMethod($route, 'getControllerMethod');
        
        $ref->setAccessible(true);
        
        $controllerMethod = $ref->invoke($route);
        
        $response = $next($request);
        
        if(!($response instanceof JsonResponse))
            return $response;
        
        $content = $response->getData();
        
        $success = ($content->success ?? 0) == 1;
        
        if($success)
        {
            $content->message = Notice::make(subject: $subject, action: $controllerMethod, genus:$genus);
            
            $response->setData($content);
        }
        
        return $response;
    }
}
