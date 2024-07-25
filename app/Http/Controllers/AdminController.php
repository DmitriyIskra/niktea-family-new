<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $action, string $id)
    {
        if($action === 'user') {
            $result = User::query()->where('id', $id)->delete();

            Storage::disk('s3')->deleteDirectory($id);

            return response()->json(['response' => $result]);
        }

        if($action === 'cheque') {
            $name_file = Cheque::query()->find($id, 'name')->name;
            $id_user = Cheque::query()->find($id, 'user_id')->user_id;

            $result = Cheque::query()->where('id', $id)->delete();

            Storage::disk('s3')->delete($id_user.'/'.$name_file);

            return response()->json(['response' => $result]);
        }
    }
}
