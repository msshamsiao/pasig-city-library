<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\MemberLibrary;
use App\Models\Transaction;
use App\Models\User;

class UserController extends Controller
{
    # this is for dashboard
    public function user()
    {
        return view('admin.user');
    }

    public function index(Request $request)
    {
        $users = User::query();

        if ($request->has('user_type')) {
            $users->where('admin', $request->input('user_type'));
        }

        if ($request->has('member_library')) {
            $users->whereHas('user_member_library', function ($query) use ($request) {
                $query->where('id', $request->input('member_library'));
            });
        }

        $users = $users->get();

        return view('admin.user', [
            'users' => $users,
            'memberLibraries' => MemberLibrary::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6', // Adjust the validation rule for the password
            'user_type' => 'required|in:0,1,2',
            'member_library' => 'required|exists:member_libraries,id'
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'admin' => $request->input('user_type'),
            'member_library' => $request->input('member_library'),
        ]);

        return response()->json(['success' => 'User created successfully!']);
    }

    public function edit(User $user)
    {
        return response()->json(['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'edit_name' => 'required|string',
                'edit_email' => 'required|email',
                'edit_user_type' => 'required|in:0,1,2',
                'edit_member_library' => 'required|exists:member_libraries,id',
            ]);

            $user->update([
                'name' => $request->input('edit_name'),
                'email' => $request->input('edit_email'),
                'admin' => $request->input('edit_user_type'),
                'member_library' => $request->input('edit_member_library'),
            ]);

            return response()->json(['success' => 'User updated successfully']);

        } catch (\Exception $e) {
            info("Error updating user: " . $e->getMessage());
            return response()->json(['error' => 'Error updating user.']);
        }
    }

    public function destroy(User $user)
    {
        // Check if the user has any associated transactions
        $hasTransactions = Transaction::where('user_id', $user->id)->exists();

        // If there are transactions, prevent deletion
        if ($hasTransactions) {
            return response()->json(['error' => 'Cannot delete user with associated transactions.'], 400);
        }

        // No transactions, proceed with deletion
        $user->delete();

        return response()->json(['success' => 'User deleted successfully!']);
    }
}
