<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
    public function index()
    {
        return $this->returnSuccess('get all user success!', User::all());
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        $validator = \Validator::make([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ],[
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->returnFail((string)$validator->messages());
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return $this->returnSuccess('create user success', $user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->returnNotFound();
        }

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        $validator = \Validator::make([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ],[
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->returnFail((string)$validator->messages());
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();

        return $this->returnSuccess('update user success', $user);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->returnNotFound();
        }

        return $this->returnSuccess('get user success', $user);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->returnNotFound();
        }

        return $this->returnSuccess('get user success', $user->delete());
    }
}
