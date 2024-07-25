<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        } else if($user && $user->admin) {
            return to_route('panel');
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

    public function admin_panel()
    {
        $users = DB::table('users')
            ->where('admin', '!==', '1')
            ->latest()
            ->get(
                [
                    "id",
                    "user_active",
                    "name",
                    "second_name",
                    "patronymic",
                    "balls",
                    "lottery",
                    "phone",
                    "email",
                    "index",
                    "area",
                    "district",
                    "settlement",
                    "street",
                    "house",
                    "appartment",
                    "gifts_for_points",
                    "gift_for_lottery",
                    "awarded",
                ]
            );
    
        $cheques = DB::table('cheques')->where('user_id','!=', true)->latest()->get();
       
        // перебираем пользователь и добавляем соответствующие чеки
        // в users нет админа, поэтому перебирая чеки не может быть выборки чека админа
        // так сравниваем user_id чека c id пользователя item
        foreach($users as $item) {
            $item->cheques = [];
            $item->gifts_for_points = json_decode($item->gifts_for_points);
            
            foreach($cheques as $check) {
                if($check->user_id === $item->id) {
                    $item->cheques[] = $check;
                }
            }
        }

        
      
        return view('admin-panel', [
            'title' => 'panel',
            'data' => $users,
        ]);
    }
}
