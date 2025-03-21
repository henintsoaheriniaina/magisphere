<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateeUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
            "firstname" => $fields["firstname"],
            "lastname" => $fields["lastname"],
            "email" => $fields["email"],
            "password" => $fields["password"],
            "matriculation" => $fields["matriculation"],
        ]);

        $user->affiliation()->associate($fields["affiliation"]);
        $user->save();

        $roles = [];
        empty($fields["roles"]) ?
            $roles = ["user"] :
            $roles = array_merge($roles, $fields["roles"]);

        $user->syncRoles($roles);

        return redirect()->route("admin.users.index")->with("success", "Utilisateur créé avec succès");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("pages.admin.users.edit", [
            "user" => User::findOrFail($id),
            "affiliations" => Affiliation::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $fields = $request->validated();
        $user->update([
            "firstname" => $fields["firstname"],
            "lastname" => $fields["lastname"],
            "matriculation" => $fields["matriculation"],
            "email" => $fields["email"],
            "status" => "pending"
        ]);
        $roles = [];
        empty($fields["roles"]) ?
            $roles = ["user"] :
            $roles = array_merge($roles, $fields["roles"]);
        $user->syncRoles($roles);
        return redirect()->route("admin.users.index")->with("success", "Utilisateur modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("admin.users.index")->with("success", "Utilisateur supprimé avec succès");
    }
    public function setSTatus(Request $request, User $user)
    {
        $fields = $request->validate([
            'status' => 'required|in:banned,approved'
        ]);
        $user->status = $fields['status'];
        $user->save();
        return redirect()->back()->with("success", "Status du compte mis à jour avec succès");
    }
}
