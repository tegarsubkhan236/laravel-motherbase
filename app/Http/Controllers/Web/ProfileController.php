<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function personal_info()
    {
        $item = User::with(['roles'])->where('id',Auth::id())->first();
        return view('pages.profile.personal_information', [
            'id' => $item->id,
            'item' => $item,
            'title' => 'User'
        ]);
    }

    public function personal_info_update(User $user,Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$user->id,id",
        ]);
        DB::beginTransaction();
        try {
            if ($user->id !== Auth::id()){
                return back()->withErrors(['error' => "something wrong on controller logic"]);
            }
            $user->update([
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                'email' => $request->get('email')
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return redirect()->back()->with('success', 'User Personal Info updated successfully');
    }

    public function reset_password()
    {
        $item = User::with(['roles'])->where('id',Auth::id())->first();
        return view('pages.profile.reset_password', [
            'id' => $item->id,
            'item' => $item,
            'title' => 'User'
        ]);
    }

    public function reset_password_update(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|same:confirm_password|different:old_password',
        ]);
        try {
            if ($user->id !== Auth::id()){
                return back()->withErrors(['error' => "something wrong on controller logic"]);
            }
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['error' => "Old password does not match with your password"]);
            }
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
        }catch (Exception $e) {
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return redirect()->back()->with('success', 'User Reset Password updated successfully');
    }
}
