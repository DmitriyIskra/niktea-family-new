<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Cheque;
use App\Models\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            $pass = Str::password(8, true, true, true);
            $files = $request->file('file');

            $dataUser = User::create([
                    'name' => $request->name,
                    'second_name' => $request->second_name,
                    'patronymic' => $request->patronymic,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'index' => $request->index,
                    'area' => $request->area,
                    'district' => $request->district,
                    'settlement' => $request->settlement,
                    'street' => $request->street,
                    'house' => $request->house,
                    'appartment' => $request->appartment,
                    'password' => $pass,
            ]);

            $user_id = $dataUser->id;
            
            foreach($files as $item) {      
                $path = $item->storeAs($user_id, $item->getClientOriginalName(), 's3');
                Cheque::query()->create([
                    'path' => "https://storage.yandexcloud.net/test-laravel-2/$path",
                    'user_id' => $user_id,
                ]);
            }

            
            Auth::login($dataUser);
            
            $request->session()->regenerate();

            Mail::to($request->email)
                ->send(new SendMail('Niktea family', $request->email, $pass));
   
            return redirect()->intended('/account');

        } catch ( Exception $e ) {
            return response()->json(['result' => $e]);
        }
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($validate)) {
            $request->session()->regenerate();

            return to_route('account');
        }

        return back()->withErrors([
            'not_auth' => 'Введён неверный логин или пароль',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function check_user(Request $request) 
    {
        
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $attr = Auth::attempt($validate);

        return response()->json(['result' => $attr]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
