<?php

namespace Levintoo\SelfHealingUrls\SlugSanitizers;

use Levintoo\SelfHealingUrls\Contracts\SlugSanitizer;

class BaseSlugSanitizer implements SlugSanitizer
{
    public function sanitize(string $slug): string
    {
        return str($slug)
            ->lower()
            ->replaceMatches('/[^a-z0-9-_ ]/', '');
    }
}
