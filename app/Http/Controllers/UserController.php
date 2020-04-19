<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function create()
    {

        return view('users.create');
    }

    public function store(UserRequest $request, User $model)
    {
//        hash password

        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('users.index')->withStatus(__('User successfully created.'));
    }

    public function edit(User $user)
    {

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',

        ]);

//         Get the user
        $user = User::findOrFail($id);

        // Update user
        $user->fill($request->except( 'password'));

        // check for password change
        if($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }


        $user->save();

        return redirect()->route('users.index')->withStatus(__('User successfully updated.'));
    }



    public function destroy(User  $user)
    {

        $user->delete();

        return redirect()->route('users.index')->withStatus(__('User successfully deleted.'));
    }
}
