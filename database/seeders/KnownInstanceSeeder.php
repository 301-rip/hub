<?php

namespace Database\Seeders;

use App\Models\KnownInstance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class KnownInstanceSeeder extends Seeder
{
    public function run()
    {
        $servers = Http::get('https://api.joinmastodon.org/servers')->json();

        foreach ($servers as $server) {
            KnownInstance::create([
                'domain' => $server['domain'],
                'slug' => match ($server['domain']) {
                    'mastodon.world' => 'wrld',
                    'mstdn.social' => 'soc',
                    'mas.to' => 'mto',
                    'universeodon.com' => 'univ',
                    'infosec.exchange' => 'isec',
                    'mstdn.jp' => 'jp',
                    'techhub.social' => 'tchhub',
                    'mastodonapp.uk' => 'uk',
                    'hachyderm.io' => 'hachy',
                    'fosstodon.org' => 'foss',
                    'mastodon.uno' => 'uno',
                    'mstdn.party' => 'prty',
                    'masto.ai' => 'ai',
                    'fedibird.com' => 'fbrd',
                    'mstdn.ca' => 'ca',
                    default => null,
                },
            ]);
        }
    }
}
