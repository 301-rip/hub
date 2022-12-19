<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use League\OAuth1\Client\Server\Server;
use Revolution\Mastodon\Facades\Mastodon;


class MastodonController extends Controller
{
    public function login(Request $request)
    {
        //input domain by user
        $domain = $request->input('domain');

        //get app info. domain, client_id, client_secret ...
        //Server is Eloquent Model
        $server = Server::where('domain', $domain)->first();

        if (empty($server)) {
            //create new app
            $info = Mastodon::domain($domain)->createApp('my-app', 'https://example.com/callback', 'read');

            //save app info
            $server = Server::create([
                'domain'        => $domain,
                'client_id'     => $info['client_id'],
                'client_secret' => $info['client_secret'],
            ]);
        }

        //change config
        config(['services.mastodon.domain' => $domain]);
        config(['services.mastodon.client_id' => $server->client_id]);
        config(['services.mastodon.client_secret' => $server->client_secret]);

        session(['mastodon_domain' => $domain]);
        session(['mastodon_server' => $server]);

        return Socialite::driver('mastodon')->redirect();
    }
    
    public function callback()
    {
        $domain = session('mastodon_domain');
        $server = session('mastodon_server');
    
        config(['services.mastodon.domain' => $domain]);
        config(['services.mastodon.client_id' => $server->client_id]);
        config(['services.mastodon.client_secret' => $server->client_secret]);
    
        $user = Socialite::driver('mastodon')->user();
        dd($user);
    }
}