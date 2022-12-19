<?php

namespace App\Http\Controllers;

use App\Models\KnownInstance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RedirectsController extends Controller
{
    protected function validateUrl($url)
    {
        $url = $this->sanitizeUrl($url);

        // check that this url is a mastadon instance
        return $url;
    }

    protected function sanitizeUrl($url)
    {
        // implement sanitizing logic here.
        return $url;
    }

    public function __invoke($instance, $user = null, $post = null)
    {
        $known_instance = KnownInstance::find($instance);

        if (! $known_instance) {
            $known_instance = KnownInstance::firstOrCreate([
                'domain' => $this->validateUrl($instance)
            ]);
            return redirect()
                ->route('redirects.show')
                ->with(
                    'redirect',
                    route('redirect', [
                        'instance' => $known_instance->id,
                        'user' => $user,
                        'post' => $post,
                    ], true)
                );
        }

        // Do some validation on $user and $post

        $redirect_url = str(
            route('redirects.external', [
                'domain' => $known_instance->domain,
                'user' => $user,
                'post' => $post,
            ], true)
        )->replace('http://', 'https://');

        return redirect($redirect_url);
    }
}
