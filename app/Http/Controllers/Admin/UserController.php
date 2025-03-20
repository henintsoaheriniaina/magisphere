<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Affiliation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.admin.users.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $affiliations = Affiliation::get();
        return view("pages.admin.users.create", [
            "affiliations" => $affiliations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $fields = $request->validated();
        $fields = $request->validated();

        $user = User::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'password' => $fields['password'],
            'matriculation' => $fields['matriculation'],
        ]);

        $user->affiliation()->associate($fields['affiliation']);
        $user->save();
        foreach ($fields['roles'] as $role) {
            $user->assignRole($role);
        }
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès');
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
