<?php

namespace App\Support;

use App\Models\KnownInstance;

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

        $this->instance = KnownInstance::forHost($this->host);
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
}
