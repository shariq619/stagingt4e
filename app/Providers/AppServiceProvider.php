<?php

namespace App\Providers;

use App\Models\FrontOrderDetails;
use App\Models\User;
use App\Models\UserContact;
use App\Observers\FrontOrderDetailsObserver;
use App\Observers\UserContactObserver;
use App\Observers\UserObserver;
use App\Services\CustomImpersonateManager;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Lab404\Impersonate\Services\ImpersonateManager;
use App\Models\ProductInvoice;
use App\Models\ProductInvoiceLine;
use App\Observers\ProductInvoiceObserver;
use App\Observers\ProductInvoiceLineObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       // $this->app->singleton(ImpersonateManager::class, CustomImpersonateManager::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // use bootstrap pagination
        Paginator::useBootstrap();

        config(['app.locale' => 'en']);
        Carbon::setLocale('en');
        ProductInvoice::observe(ProductInvoiceObserver::class);
        ProductInvoiceLine::observe(ProductInvoiceLineObserver::class);
        FrontOrderDetails::observe(FrontOrderDetailsObserver::class);
        User::observe(UserObserver::class);
        UserContact::observe(UserContactObserver::class);
    }
}
