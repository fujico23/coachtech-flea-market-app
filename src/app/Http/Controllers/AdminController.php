<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Role;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {
        // $users = User::with('role')->get();
        $users = User::with('role')->paginate(3);
        return view('admin.admin_index', compact('users'));
    }
    public function destroyMultiple(Request $request)
    {
        $userIds = $request->input('users', []);

        if (!empty($userIds)) {
            User::whereIn('id', $userIds)->delete();
            return redirect()->back()->with('success', '選択されたユーザーが削除されました。');
        }

        return redirect()->back()->with('error', '削除するユーザーを選択してください。');
    }
    public function show(User $user)
    {
        $roles = Role::all();

        // スコープを使ってユーザーの自宅住所を取得
        $homeAddress = Address::homeAddress($user->id)->first();
        $shippingAddresses = Address::shippingAddress($user->id)->get();

        // スコープを使ってユーザーのコメントを取得
        $comments = Comment::userComment($user->id)->paginate(3);

        return view('admin.admin_detail', compact('user', 'roles', 'homeAddress', 'shippingAddresses', 'comments'));
    }
    public function update(Request $request, User $user)
    {
        $role = $request->input('role_id');

        $user->update(['role_id' => $role]);

        return redirect()->back()->with('success', '権限が変更されました');
    }
}
