<?php

namespace App\Http\Middleware;

use App\Enums\LanguagePreferenceEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetUserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = LanguagePreferenceEnum::EN->value;

        if (Auth::check()) {
            $userOrNull = $request->user();
        } elseif ($request->bearerToken()) {
            $userOrNull = Auth::guard('sanctum')->user();
        }

        if (isset($userOrNull) && !empty($userOrNull->language)) {
             $locale = $userOrNull->language instanceof LanguagePreferenceEnum
                ? $userOrNull->language->value
                : $userOrNull->language;
        } elseif ($request->hasHeader('Accept-Language')) {
            $headerLocale = $request->header('Accept-Language');
            $preferredLocale = substr($headerLocale, 0, 2); 
            
            // Map standard German 'de' to custom 'ge' code
            if ($preferredLocale === 'de') {
                $preferredLocale = 'ge';
            }

            if (in_array($preferredLocale, LanguagePreferenceEnum::values())) {
                $locale = $preferredLocale;
            }
        }

        App::setLocale($locale);

        return $next($request);
    }
}
