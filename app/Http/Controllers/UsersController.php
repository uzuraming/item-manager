<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // Userを名前空間として利用

use Auth; // ログインユーザー


class UsersController extends Controller
{
    // 表示
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }
    
    // user削除機能
    public function destroy($id){
        
        
        // 管理者ユーザーか判別
        if(Auth::user()->admin === 0){
            $user = User::findOrFail($id);
            $user->delete();
        }
        
        return redirect('/users');
    }
}
