<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class KnownInstance extends Model
{
    use HasFactory;

    public static function forHost(string $hostname): static
    {
        return DB::transaction(function () use ($hostname) {
            // If we already have the instance, no need to validate it again
            if ($existing = static::firstWhere('domain', $hostname)) {
                return $existing;
            }

            // Otherwise, validate and create
            static::validateHost($hostname);
            return static::create(['domain' => $hostname]);
        });
    }

    protected static function validateHost(string $host): void
    {
        $source_url = Http::baseUrl($host)->get('/api/v2/instance')->json('source_url');

        abort_unless('https://github.com/mastodon/mastodon' === $source_url, 404);
        // FIXME: Have some deny list somewhere
    }

    public function url(string $path): string
    {
        return 'https://'.$this->domain.'/'.ltrim($path, '/');
    }

    public function getRouteKeyName()
    {
        return $this->slug ? 'slug' : 'id';
    }

    public function resolveRouteBindingQuery($query, $value, $field = null)
    {
        return match (true) {
            ctype_alpha($value) => $query->where('slug', $value),
            null !== $field => $query->where($field, $value),
            default => $query->where($this->getRouteKeyName(), $value),
        };
    }
}
