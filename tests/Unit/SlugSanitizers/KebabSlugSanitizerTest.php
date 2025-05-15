<?php

use Levintoo\SelfHealingUrls\SlugSanitizers\StringHelperSlugSanitizer;

it('replaces spaces with hyphens', function () {
    $sanitizer = new StringHelperSlugSanitizer();
    $result = $sanitizer->sanitize('what are you doing?');

    expect($result)->toBe('what-are-you-doing');
});

it('removes multiple hyphens', function () {
    $sanitizer = new StringHelperSlugSanitizer();
    $result = $sanitizer->sanitize('what--are------you-doing');

    expect($result)->toBe('what-are-you-doing');
});

it('removes hyphens from the start and end', function () {
    $sanitizer = new StringHelperSlugSanitizer();
    $result = $sanitizer->sanitize('-what-are-you-doing-');

    expect($result)->toBe('what-are-you-doing');
});
