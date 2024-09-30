<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\View\Components\OutSiteNav;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{

    public function welcomePage()
    {
        return view('welcome', [
            'index_page' => true,
        ]);
    }

    public function accountPage(Request $request)
    {
        // ПУСКАТЬ ТОЛЬКО В СЛУЧАЕ АУТЕНТИФИКАЦИИ
        $user = Auth::user();
        // dd(Auth::user());
        if($user && !$user->admin && $user->user_active) {
            return view('account', [
                'data' => $user,
            ]);
        } else if($user && !$user->admin && !$user->user_active) {
            Auth::logout(); 
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return to_route('welcome');
        }else if($user && $user->admin) {
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

    public function giftsPage() 
    {
        return view('gifts');
    } 

    public function admin_panel(Request $request)
    {
        $is_auth = Auth::user();

        if($is_auth && $is_auth->admin) {
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
        
            $cheques = DB::table('cheques')->where('user_id','!=', 1)->latest()->get();
        
            // перебираем пользователь и добавляем соответствующие чеки
            // в users нет админа, поэтому перебирая чеки не может быть выборки чека админа
            // так сравниваем user_id чека c id пользователя item
            foreach($users as $item) {
                $item->cheques = [];
                $item->gifts_for_points = json_decode($item->gifts_for_points);
                
                foreach($cheques as $check) {
                    if($check->user_id === $item->id) {
                        $check->created_at = Carbon::parse($check->created_at)->format('Дата: d-m-Y')
                            .'   '
                            .Carbon::parse($check->created_at)->format('время: H:i ');
                        $item->cheques[] = $check;
                    }
                }
            }

            return view('admin-panel', [
                'title' => 'panel',
                'data' => $users,
            ]);
        } else {
            return to_route('welcome');
        }
        
    } 

    public function page_not_found() 
    {
        return view('404');
    }
    
}
