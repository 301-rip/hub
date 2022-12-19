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
}
