<?php

namespace Modules\PdfBrowserKit\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\BaseCore\Contracts\Services\PdfContract;
use Modules\PdfBrowserKit\Services\PdfBrowserKitService;

class PdfBrowserKitServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'PdfBrowserKit';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'pdfbrowserkit';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PdfContract::class, PdfBrowserKitService::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

}
