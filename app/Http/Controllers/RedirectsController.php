<?php

namespace App\Http\Controllers;

use App\Models\KnownInstance;
use App\Models\User;
use App\Support\RedirectUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Illuminate\Support\Str;

class RedirectsController extends Controller
{
    public function create($url)
    {
		return view('redirects.create', [
			'original' => $url,
			'rip' => (string) new RedirectUrl($url),
		]);
    }
	
	public function show(KnownInstance $instance, $path)
	{
		return view('redirects.show', [
			'url' => $this->obfuscate($instance->url($path)),
		]);
	}
	
	protected function obfuscate(string $url): Js
	{
		$chunks = str_split(base64_encode($url), random_int(5, 10));
		
		return Js::from($chunks);
	}
}
