<?php

use App\Models\KnownInstance;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redirects the user to the correct mastadon link for known_instances', function () {
    KnownInstance::factory()->create([
        'domain' => 'coulb.test'
    ]);

    $this->get(route('redirect', [1, '@coulb']))
        ->assertRedirect('https://coulb.test/@coulb');
});

it('creates an known_instance and returns link page after validating a new instance is mastadon', function () {
    $this->followingRedirects()
        ->get(route('redirect', ['coulb.test', '@coulb']))
        ->assertSee(route('redirect', [1, '@coulb'], true));
});

it('still returns link page after new instance is created', function () {
    $this->followingRedirects()
        ->get(route('redirect', ['coulb.test', '@coulb']))
        ->assertSee(route('redirect', [1, '@coulb'], true));

    $this->followingRedirects()
        ->get(route('redirect', ['coulb.test', '@coulb']))
        ->assertSee(route('redirect', [1, '@coulb'], true));
});
