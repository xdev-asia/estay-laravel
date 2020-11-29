<?php

namespace Torann\Currency\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CurrencyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $condition = env('INSTALLED', false);
        if($condition){
            // Don't redirect the console
            if ($this->runningInConsole()) {
                return $next($request);
            }

            // Check for a user defined currency
            if (($currency = Session::get('currency')) === null) {
                $currency = $this->getDefaultCurrency();
            }

            // Set user currency
            $this->setUserCurrency($currency, $request);
        }

        return $next($request);
    }

    /**
     * Get the user selected currency.
     *
     * @param Request $request
     *
     * @return string|null
     */
    protected function getUserCurrency(Request $request)
    {
        // Check request for currency
        $currency = $request->get('currency');
        if ($currency && currency()->isActive($currency) === true) {
            return $currency;
        }

        // Get currency from session
        $currency = $request->getSession()->get('currency');
        if ($currency && currency()->isActive($currency) === true) {
            return $currency;
        }

        return null;
    }

    /**
     * Get the application default currency.
     *
     * @return string
     */
    protected function getDefaultCurrency()
    {
        $currency = get_setting('currency_code', 'site');
        return $currency ? $currency : currency()->config('default');
    }

    /**
     * Determine if the application is running in the console.
     *
     * @return bool
     */
    private function runningInConsole()
    {
        return app()->runningInConsole();
    }

    /**
     * Set the user currency.
     *
     * @param string  $currency
     * @param Request $request
     *
     * @return string
     */
    private function setUserCurrency($currency, $request)
    {
        $currency = strtoupper($currency);

        // Set user selection globally
        currency()->setUserCurrency($currency);

        // Save it for later too!
        $request->getSession()->put(['currency' => $currency]);

        return $currency;
    }
}