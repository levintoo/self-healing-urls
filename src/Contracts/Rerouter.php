<?php

namespace Levintoo\SelfHealingUrls\Contracts;

interface Rerouter
{
    public function reroute(string $parameterValue, string $actualValue): never;
}
