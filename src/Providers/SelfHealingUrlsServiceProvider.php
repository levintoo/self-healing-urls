<?php

namespace Levintoo\SelfHealingUrls\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Levintoo\SelfHealingUrls\Contracts\IdentifierHandler;
use Levintoo\SelfHealingUrls\Contracts\Rerouter;
use Levintoo\SelfHealingUrls\Contracts\SlugSanitizer;
use Levintoo\SelfHealingUrls\IdentifierHandlers\HyphenIdentifierHandler;
use Levintoo\SelfHealingUrls\Rerouters\NamedRouteRerouter;
use Levintoo\SelfHealingUrls\SlugSanitizers\StringHelperSlugSanitizer;

class SelfHealingUrlsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SlugSanitizer::class, fn () => new StringHelperSlugSanitizer());
        $this->app->singleton(Rerouter::class, NamedRouteRerouter::class);
        $this->app->singleton(IdentifierHandler::class, HyphenIdentifierHandler::class);
    }
}
