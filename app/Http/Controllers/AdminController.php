<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            return response()->json(['result' => $result]);
        }

        /**обновление адреса и контактных данных*/ 
        if($request->action === 'user_data') {

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
