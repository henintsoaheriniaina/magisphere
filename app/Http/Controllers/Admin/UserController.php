<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateeUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Affiliation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = User::count();
        return view("pages.admin.users.index", ['count' => $count]);
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
    public function edit(User $user)
    {
        Gate::authorize("manage_user", $user);
        return view("pages.admin.users.edit", [
            "user" => $user,
            "affiliations" => Affiliation::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize("manage_user", $user);
        $fields = $request->validated();
        $user->update([
            "firstname" => $fields["firstname"],
            "lastname" => $fields["lastname"],
            "matriculation" => $fields["matriculation"],
            "email" => $fields["email"],
            "status" => "approved"
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
        Gate::authorize("manage_user", $user);

        if (!Auth::user()->hasRole('admin')) {
            abort(403, "Action non autorisée");
        }
        $user->delete();
        return redirect()->route("admin.users.index")->with("success", "Utilisateur supprimé avec succès");
    }
    public function setSTatus(Request $request, User $user)
    {
        Gate::authorize("manage_user", $user);

        $fields = $request->validate([
            'status' => 'required|in:banned,approved'
        ]);
        $user->status = $fields['status'];
        $user->save();
        return redirect()->back()->with("success", "Status du compte mis à jour avec succès");
    }
}
