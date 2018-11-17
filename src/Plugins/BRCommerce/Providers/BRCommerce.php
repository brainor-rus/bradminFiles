<?php
/**
 * class: BRCommerce
 * nameSpace: Bradmin\Plugins\BRCommerce\Providers
 */
namespace Bradmin\Plugins\BRCommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Bradmin\Plugins\BRCommerce\Navigation\PluginNavigation;
use Bradmin\Plugins\BrainorPay\Helpers\Payment;
use Bradmin\Plugins\BrainorPay\Helpers\GetData;

class BRCommerce extends ServiceProvider
{
    public $navigation;

    public function __construct(\Illuminate\Contracts\Foundation\Application  $app=null)
    {
        $this->navigation = PluginNavigation::getPluginNav();
        parent::__construct($app);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../../../../config/bradmin.php', 'bradmin');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'BRCommerce');
        $this->publishes([__DIR__.'/../resources/views' => resource_path('views/bradmin/BRCommerce')]);
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind('Payment', Payment::class);
//        $this->app->bind('GetData', GetData::class);
    }
}