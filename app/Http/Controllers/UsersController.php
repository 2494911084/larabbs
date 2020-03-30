<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user, ImageUploadHandler $upload)
    {
        $this->authorize('update', $user);

        if ($file = $request->avatar) {
            $result = $upload->save($file, 'avatar', $user->id, 416);
            $user->avatar = $result['path'];
        }
        $user->name = $request->name;
        $user->introduction = $request->introduction;
        $user->save();

        return redirect()->route('users.show', $user->id)->with('status', '个人资料更新成功');
    }
}
