<?php

namespace Levintoo\SelfHealingUrls\Concerns;

use Levintoo\SelfHealingUrls\Contracts\IdentifierHandler;
use Levintoo\SelfHealingUrls\Contracts\Rerouter;
use Levintoo\SelfHealingUrls\Contracts\SlugSanitizer;

trait HasSelfHealingUrls
{
    public function getRouteKey()
    {
        $actualKey = parent::getRouteKey();
        $selfHealingUrl = app(IdentifierHandler::class)->joinToSlug($this->getSlug($this), $actualKey);

        return app(SlugSanitizer::class)->sanitize($selfHealingUrl);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $model = parent::resolveRouteBinding(app(IdentifierHandler::class)->separateFromSlug($value), $field);

        if ($model === null) {
            return null;
        }

        if ($model->getRouteKey() === $value) {
            return $model;
        }

        app(Rerouter::class)->reroute($value, $model->getRouteKey());
    }

    protected function getSlug(self $model): string
    {
        $columnName = property_exists($model, 'slug') ? $model->slug : 'slug';

        return $model->getAttribute($columnName);
    }
}
