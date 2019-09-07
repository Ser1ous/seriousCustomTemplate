<?php namespace EvolutionCMS\SeriousCustom;

use EvolutionCMS\SeriousCustom\SeriousTemplateProcessor;
use EvolutionCMS\ServiceProvider;
use EvolutionCMS\TemplateProcessor;

class SeriousCustomTemplateServiceProvider extends ServiceProvider
{
    /**
     * custom commands
     * @var array
     */
    protected $commands = [
        'EvolutionCMS\SeriousCustom\Console\SeriousCustomTemplateCommand'
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //register command for Artisan
        $this->commands($this->commands);

        //change default TemplateProcessor
        $this->app->singleton('TemplateProcessor', function ($app) {
            return new SeriousTemplateProcessor($app);
        });
    }
}
