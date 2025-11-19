<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\SEOHelper;

class InjectStaticSEOMiddleware
{
//    public function handle($request, Closure $next)
//    {
//        $response = $next($request);
//
//        // Get the current route name
//        $currentPage = $this->getPageKey($request);
//
//        // Fetch SEO data for the current page
//        $seo = SEOHelper::get($currentPage);
//
//       // dd($seo);
//
//        // Share SEO data with all views
//        view()->share('seo', $seo);
//
//        return $response;
//    }
//
//    private function getPageKey($request)
//    {
//        // Get route name or fallback to 'home'
//        return $request->route()->getName() ?? 'home';
//    }
}
