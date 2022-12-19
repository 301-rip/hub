<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnownInstance extends Model
{
	use HasFactory;

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
