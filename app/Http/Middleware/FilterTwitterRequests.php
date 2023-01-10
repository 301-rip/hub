<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\IpUtils;

class FilterTwitterRequests
{
    protected const IP_BLOCKS = [
        '103.252.112.0/23',
        '103.252.114.0/23',
        '104.244.40.0/24',
        '104.244.41.0/24',
        '104.244.42.0/24',
        '104.244.44.0/24',
        '104.244.45.0/24',
        '104.244.46.0/24',
        '104.244.47.0/24',
        '185.45.5.0/24',
    ];

    public function handle(Request $request, Closure $next)
    {
        $request->attributes->set('twitter', $this->isTwitter($request));

        return $next($request);
    }

    protected function isTwitter(Request $request): bool
    {
        return $this->isTwitterUserAgent($request) || $this->isInTwitterIpBlock($request);
    }

    protected function isTwitterUserAgent(Request $request): bool
    {
        // Headers can come in as array so just in case
        $agents = Arr::wrap($request->header('user-agent'));

        return Str::of(implode(' ', $agents))->lower()->contains('twitterbot');
    }

    protected function isInTwitterIpBlock(Request $request): bool
    {
        return IpUtils::checkIp($request->server->get('REMOTE_ADDR', ''), static::IP_BLOCKS);
    }
}
