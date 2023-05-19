<?php

namespace App\Http\Controllers;

use App\Models\UsersLocation;
use App\Http\Requests\StoreUsersLocationRequest;
use App\Http\Requests\UpdateUsersLocationRequest;

class UsersLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUsersLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsersLocation  $usersLocation
     * @return \Illuminate\Http\Response
     */
    public function show(UsersLocation $usersLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsersLocation  $usersLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersLocation $usersLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersLocationRequest  $request
     * @param  \App\Models\UsersLocation  $usersLocation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersLocationRequest $request, UsersLocation $usersLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsersLocation  $usersLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersLocation $usersLocation)
    {
        //
    }
}
