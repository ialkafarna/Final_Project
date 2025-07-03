<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'لا يمكنك حذف مشرف');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,author,reader',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث الدور');
    }
}
