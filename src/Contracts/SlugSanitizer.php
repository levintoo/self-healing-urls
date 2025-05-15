<?php

namespace Levintoo\SelfHealingUrls\Contracts;

interface SlugSanitizer
{
    public function sanitize(string $slug): string;
}
