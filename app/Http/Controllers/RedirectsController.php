<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RedirectsController extends Controller
{
    public function __invoke($payload)
    {
        $username_regex = '/([a-zA-Z0-9_]+)\#([0-9]{4})/';

        if (
            ! ($username = Str::match($username_regex, $payload))
        ) {
            return redirect()->route('home');
        }

        $user = User::firstWhere('username', $username);

        return redirect($user->redirect);
    }
}
