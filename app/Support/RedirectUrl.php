<?php

namespace App\Support;

use App\Models\KnownInstance;
use Illuminate\Support\Facades\Http;

class RedirectUrl
{
    public ?string $host = null;

    public ?string $path = null;

    public ?string $query = null;

    public KnownInstance $instance;

    public function __construct(string $original)
    {
        $parsed = parse_url($original);

        $this->host = $parsed['host'] ?? null;
        $this->path = $parsed['path'] ?? null;
        $this->query = $parsed['query'] ?? null;

        $this->validateHost($this->host);

        $this->instance = KnownInstance::firstOrCreate([
            'domain' => $this->host,
        ]);
    }

    public function __toString(): string
    {
        return route('redirects.show', [
            'instance' => $this->instance,
            'path' => $this->path(),
        ]);
    }

    protected function path(): string
    {
        $path = ltrim($this->path, '/');

        if ($this->query) {
            $path .= "?{$this->query}";
        }

        return $path;
    }

    protected function validateHost(string $host): void
    {
        $source_url = Http::baseUrl($host)->get('/api/v2/instance')->json('source_url');

        abort_unless('https://github.com/mastodon/mastodon' === $source_url, 404);

        // FIXME: Have some deny list somewhere
    }
}
