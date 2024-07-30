<?php

namespace App\Http\Controllers;

use App\Mail\SendMailExchenge_admin;
use App\Mail\SendMailNewCheque_admin;
use App\Mail\SendMailRegister_admin;
use App\Mail\SendMailUserRegister;
use App\Models\Cheque;
use App\Models\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

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
                $name = $item->getClientOriginalName();     
                $path = $item->storeAs($user_id, $name, 's3');
                Cheque::query()->create([
                    'path' => "https://storage.yandexcloud.net/test-laravel-2/$path",
                    'name' => $name,
                    'user_id' => $user_id,
                ]);
            }

            
            Auth::login($dataUser);
            
            $request->session()->regenerate();

            Mail::to($request->email)
                ->send(new SendMailUserRegister('Niktea family', $request->email, $pass));
                
            Mail::to('yesokolova@alephtrade.com')
                ->send(new SendMailRegister_admin('Niktea family', [
                    'user_id' => $dataUser->id,
                    'user_second_name' => $dataUser->second_name,
                    'user_name' => $dataUser->name,
                    'user_patronymic' => $dataUser->patronymic,
                    'user_phone' => $dataUser->phone,
                    'user_email' => $dataUser->email,
                ]));
   
            return redirect()->intended('/account');

        } catch ( Exception $e ) {
            return redirect('/');
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

    /***
     * Проверка данных пользователя при входе 
     */ 
    public function check_user(Request $request)  
    {
        
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $attr = Auth::attempt($validate);

        return response()->json(['result' => $attr]);
    }

    public function check_email(Request $request)
    {
        $email = $request->email;

        $result = User::where('email', $email)->first();

        if($result) return response()->json(['result' => true]);

        return response()->json(['result' => false]);
    }

    /**
     * Загрузка файлов с чеками из аккаунта 
     */ 
    public function upload_cheque_from_account(Request $request) 
    {
        try {
            $user = Auth::user();

            $files = $request->file('file');

            foreach($files as $item) {  
                $hash = $item->hashName();
                $type = $item->getMimeType();
                if(str_contains($type, 'image')) {
                    $path = $item->storeAs($user->id, $hash, 's3');
                    Cheque::query()->create([
                        'path' => "https://storage.yandexcloud.net/test-laravel-2/$path",
                        'name' => $hash,
                        'user_id' => $user->id,
                    ]);
                }
                
            }

            Mail::to('yesokolova@alephtrade.com')
                ->send(new SendMailNewCheque_admin('Добавлен новый чек', [
                    'user_id' => $user->id,
                    'user_second_name' => $user->second_name,
                    'user_name' => $user->name,
                    'user_patronymic' => $user->patronymic,
                    'user_phone' => $user->phone,
                    'user_email' => $user->email,
                ]));

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
        
    }

    /**
    * Получаем чеки по id пользователя
    */ 
    public function get_cheques()
    {
        try {
            $user = Auth::user();
    
            $cheques = Cheque::where('user_id', $user->id)->get();
    
            return response()->json(['cheques' => $cheques]);
        } catch (Exception $e) {
            return response()->json(['cheques' => false]);
        }
    }

    public function send_email_exchange(Request $request) {
        try {
            $user = Auth::user();
            // yesokolova@alephtrade.com
            Mail::to('yesokolova@alephtrade.com')
                ->send(new SendMailExchenge_admin('Niktea family, обмен подарков', [
                    'user_id' => $user->id,
                    'user_second_name' => $user->second_name,
                    'user_name' => $user->name,
                    'user_patronymic' => $user->patronymic,
                    'user_phone' => $user->phone,
                    'user_email' => $user->email,
                    'user_address' => $request->input('address'),
                    'index' => $request->index,
                    'name' => $request->name,
                    'points' => $request->points,
                ]));

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
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
