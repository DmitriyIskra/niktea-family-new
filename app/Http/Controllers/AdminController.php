<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
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
        //
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

    public function search(Request $request) {
        $is_auth = Auth::user();

        if($is_auth && $is_auth->admin) {
            $users = DB::table('users')
            ->whereFullText(['name', 'second_name', 'patronymic', 'phone', 'email', 'index', 'area', 'district', 'settlement', 'street', 'house', 'appartment'], $request->search)
            ->get();
       
            if(!count($users)) {
                return to_route('panel');
            }

            $users_id = [];

            foreach($users as $u) {
                $users_id[] = $u->id;
            }

            // отбираем из БД чеки только по актуальным пользователям
            $cheques = [];
            foreach($users_id as $u_id) {
                $result = DB::table('cheques')->where('user_id', $u_id)->get()->toArray();

                foreach($result as $item) {
                    $cheques[] = $item;
                }
            }

            // составляем массив для передачи его на страницу
            foreach($users as $item) {
                $item->cheques = [];
                $item->gifts_for_points = json_decode($item->gifts_for_points);
                
                foreach($cheques as $check) {
                    if($check->user_id === $item->id) {
                        $item->cheques[] = $check;
                    }
                }
            }

            // dd($users);
            return view('admin-panel', [
                'title' => 'panel',
                'data' => $users,
            ]);
        } else {
            return to_route('welcome');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /**блокировка - разблокировка пользователя*/ 
        if($request->action === 'blocking') {
            $is_active = User::query()->find($id, 'user_active');
            $val = $is_active->user_active ? 0 : 1;
            $result = User::query()->where('id', $id)->update(['user_active' => $val]);

            return response()->json(['response' => $result]);
        }

        /**обновление адреса и контактных данных*/ 
        if($request->action === 'edit_contacts') {
            $result = User::query()
                ->where('id', $id)
                ->update([
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
                ]);

            $user = User::find($id, [
                'name',
                'second_name',
                'patronymic',
                'phone',
                'email',
                'index',
                'area',
                'district',
                'settlement',
                'street',
                'house',
                'appartment',
            ]);

            return response()->json(['response' => $user]);
        }

        /**верификация чеков*/
        if($request->action === 'verified_cheque') {
            $is_verified = Cheque::find($request->cheque_id, 'verified');
            $new_state = $is_verified->verified ? 0 : 1;
            $result = Cheque::where('id', $request->cheque_id)->update(['verified' => $new_state]);
            $is_verified_new = Cheque::find($request->cheque_id, 'verified');

            return response()->json(['response' => $is_verified_new]);
        }

        // редактирование балов
        if($request->action === 'balls') {
            $result = User::query()->where('id', $id)->update(['balls' => $request->data]);
            $balls = User::query()->where('id', $id)->first('balls')->balls;

            return response()->json(['is_changed' => $result, 'balls' => $balls]);
        }
        
        // участие в лотерее
        if($request->action === 'lottery') {
            $is_lottery = User::query()->where('id', $id)->first('lottery')->lottery;
            $is_lottery_new = $is_lottery ? 0 : 1;
            $result = User::query()->where('id', $id)->update(['lottery' => $is_lottery_new]);
            
            return response()->json(['ressponse' => $result]);
        }
        
        // верификация приза за баллы
        if($request->action === 'verifie_gift_point') {
            $data = $request->data;
            $data['id'] = (int)$data['id'];
            
            $gifts = User::query()->where('id', $id)->first('gifts_for_points')->gifts_for_points;

            $gifts = json_decode($gifts);
            
            foreach($gifts as $item) {
                if($item->id === $data['id'] && $item->name === $data['name']) {
                    $item->verified = $item->verified ? 0 : 1;
                }
            }

            $result = User::query()->where('id', $id)->update(['gifts_for_points' => json_encode($gifts)]);
            $gifts = User::query()->where('id', $id)->first('gifts_for_points')->gifts_for_points;
            $gifts = json_decode($gifts);

            $gift = null;

            foreach($gifts as $item) {
                if($item->id === $data['id'] && $item->name === $data['name']) {
                    $gift = $item;
                }
            }
            
            return response()->json(['response' => $gift]);
        }

        // добавление приза за баллы
        if($request->action === 'gift_point') {
            $gifts = User::query()->where('id', $id)->first('gifts_for_points')->gifts_for_points;

            // для чистки
            // $is_changed = User::query()->where('id', $id)->update(['gifts_for_points' => NULL]);
            // если еще пусто (null)
            if(!$gifts) {
                $gifts = [];
                $gifts[] = $request->data;
      
                $is_changed = User::query()->where('id', $id)->update(['gifts_for_points' => json_encode($gifts)]);
                
            } else {
                $gifts = json_decode($gifts);
                array_unshift($gifts, $request->data);
                
                $is_changed = User::query()->where('id', $id)->update(['gifts_for_points' => json_encode($gifts)]);
            }

            $gifts = User::query()->where('id', $id)->first('gifts_for_points')->gifts_for_points;

            $gifts = json_decode($gifts);
            $gifts = $gifts[0];

            return response()->json(['is_changed' => $is_changed, 'gift' => $gifts]);
        }
        

        // редактирование приза по лотерее
        if($request->action === 'gift_lottery') {
            $result = User::query()->where('id', $id)->update(['gift_for_lottery' => $request->data]);
            $gift = User::query()->where('id', $id)->first('gift_for_lottery')->gift_for_lottery;

            return response()->json(['is_changed' => $result, 'gift' => $gift]);
        }

        // получил или не получил подарок по лотерее
        if($request->action === 'awarded') {
            $is_awarded = User::query()->where('id', $id)->first('awarded')->awarded;
            $is_awarded_new = $is_awarded ? 0 : 1;
            $result = User::query()->where('id', $id)->update(['awarded' => $is_awarded_new]);

            return response()->json(['ressponse' => $result]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $action, string $id)
    {
        // удаление из s3
        $s3Client_settings = [
            "key" => env('SECRET_ACCESS_KEY'),
            "url_post" => 'https://s3.alephtrade.com',
            "method" => '/delete',
            "bucket_alias" => '/nikteafamily',
        ];
        
        if($action === 'user') {
            // получили email пользователя
            $email_user = User::query()->where('id', $id)->first('email')->email;
            // удалили пользователя и автоматически все связанные с ним чеки
            $result = User::query()->where('id', $id)->delete();
            
            $cheques = Cheque::query()->where('user_id', $id)->get();
            
            foreach($cheques as $item)
            {
                $name_file = $item->name;
                $name_s3 = $email_user.'_'.$name_file;
                $curl = curl_init();
            
                $url_request = $s3Client_settings["url_post"].$s3Client_settings["method"].$s3Client_settings["bucket_alias"].'/'.$name_s3;
                
                $headers = [
                    "auth: ".$s3Client_settings["key"],
                ];
                
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url_request,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CUSTOMREQUEST => 'DELETE',
                    CURLOPT_HTTPHEADER => $headers,
                ));    
                $res = curl_exec($curl);
                curl_close($curl);

                Log::info($res);
            }
            // Storage::disk('s3')->deleteDirectory($id);

            return response()->json(['response' => $result]);
        }

        if($action === 'cheque') {
            $data_file = Cheque::query()->where('id', $id)->first(['name', 'user_id']);
            $email_user = User::query()->where('id', $data_file->user_id)->first('email')->email;

            $result = Cheque::query()->where('id', $id)->delete();

            $name_s3 = "{$email_user}_{$data_file->name}";
           
            $curl = curl_init();
            
            $url_request = $s3Client_settings["url_post"].$s3Client_settings["method"].$s3Client_settings["bucket_alias"].'/'.$name_s3;
            
            $headers = [
                "auth: ".$s3Client_settings["key"],
            ];
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url_request,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_HTTPHEADER => $headers,
            ));    
            $res = curl_exec($curl);
            curl_close($curl);
            Log::info($res);
            return response()->json(['response' => $result]);
        }
    }
}
