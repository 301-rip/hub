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

    public function show(Request $request, KnownInstance $instance, $path)
    {
        if ($request->attributes->get('twitter', false)) {
            // TODO: Add og:image that shows URL using https://vercel.com/docs/concepts/functions/edge-functions/og-image-generation
            return view('redirects.twitter');
        }

        $response = redirect($instance->url($path));

        if (app()->isProduction()) {
            $response->setStatusCode(301);
            $response->setMaxAge(60 * 60 * 24 * 365);
            $response->setSharedMaxAge(60 * 60 * 24 * 365);
            $response->setPublic();
            $response->setImmutable();
        }

        return $response;
    }
}
