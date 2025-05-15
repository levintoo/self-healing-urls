<?php

namespace Levintoo\SelfHealingUrls\Rerouters;

use Illuminate\Http\Request;
use Levintoo\SelfHealingUrls\Contracts\Rerouter;

class NamedRouteRerouter implements Rerouter
{
    public function __construct(protected Request $request)
    {
    }

    public function reroute(string $parameterValue, string $actualValue): never
    {
        $route = $this->request->route();

        $originalParameters = $route->originalParameters();
        $parameterName = collect($originalParameters)
            ->search(fn ($value) => $parameterValue === $value);

        $url = route(
            $route->getName(),
            [
                ...$originalParameters,
                $parameterName => $actualValue,
                ...$this->request->query(),
            ]
        );

        abort(redirect($url, status: 307));
    }
}
