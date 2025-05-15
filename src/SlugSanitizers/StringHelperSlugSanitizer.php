<?php

namespace Levintoo\SelfHealingUrls\SlugSanitizers;

use Levintoo\SelfHealingUrls\Contracts\SlugSanitizer;

class StringHelperSlugSanitizer implements SlugSanitizer
{
    public function __construct(
        private string $separator = '-',
        private SlugSanitizer $decoratedSanitizer = new BaseSlugSanitizer(),
    ) {
    }

    public function sanitize(string $slug): string
    {
        return str($this->decoratedSanitizer->sanitize($slug))->slug($this->separator);
    }
}
