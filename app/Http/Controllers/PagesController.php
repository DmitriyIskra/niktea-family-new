<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PagesController extends Controller
{
    public function welcomePage()
    {
        // dd(Auth::user());
        return view('welcome');
    }

    public function accountPage(Request $request)
    {
        // ПУСКАТЬ ТОЛЬКО В СЛУЧАЕ АУТЕНТИФИКАЦИИ
        $user = Auth::user();
        // dd(Auth::user());
        if($user && !$user->admin) {
            return view('account', [
                'data' => $user,
            ]);
        } else {
            return to_route('welcome');
        }
    }

    public function rulesPage()
    {
        return view('rules');
    }

    public function trainingsPage()
    {
        return view('trainings');
    }
}
