<?php declare(strict_types=1);

namespace Kdrmlhcn\NovaMultiselectFilter;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class FilterServiceProvider extends ServiceProvider
{
    protected const SCRIPT_FILE = __DIR__ . '/../dist/js/filter.js';
    protected static $availableTranslations = [
        'tr',
        'de'
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::serving(static function () {
            Nova::script('nova-multiselect-label-filter', self::SCRIPT_FILE);

            $translations = FilterServiceProvider::getTranslationsFromAppLocale();

            if(!is_null($translations))
                Nova::translations($translations);
        });
    }

    public static function getTranslationsFromAppLocale()
    {
        $locale = App::getLocale();

        if(in_array($locale, static::$availableTranslations))
            return __DIR__ . "/../resources/lang/$locale/filter.json";

        return null;
    }
}