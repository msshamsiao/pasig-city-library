<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\MemberLibrary;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function dashboard()
    {
        $countMemberLibraries = MemberLibrary::count();
    
        $countPendingUsers = User::where('admin', 0)
                             ->when(auth()->user()->admin != 1, function ($query) {
                                 return $query->where('member_library', auth()->user()->member_library);
                             })
                             ->where('registration_status', 'pending')
                             ->count();
        
        $countBooksAvailable = Book::where('available', '>', 0)->count();
        
        $countBooksNotAvailable = Book::where('available', '=', 0)->count();

        $hideMemberLibrary = true; // Set this variable based on your condition

        if(auth()->user()->admin == 1){
            $pendingMembers = User::where(['admin' => 0])->get();
        }else{
            $pendingMembers = User::where(['admin' => 0, 'member_library' => auth()->user()->member_library])->get();
        }

        return view('admin.dashboard', [
            'countMemberLibraries' => $countMemberLibraries,
            'countPendingUsers' => $countPendingUsers,
            'countBooksAvailable' => $countBooksAvailable,
            'countBooksNotAvailable' => $countBooksNotAvailable,
            'pendingMembers' => $pendingMembers,
            'hideMemberLibrary' => $hideMemberLibrary
        ]);
    }

    public function approveUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            if ($user->registration_status === "pending") {

                $user->update(['registration_status' => "approve"]);

                return redirect()->back()->with('success', 'User approved successfully');
            } else {
                // Flash error message to session
                return redirect()->back()->with('error', 'User is not pending approval');
            }
        } else {
            // Flash error message to session
            return redirect()->back()->with('error', 'User not found');
        }
    }

    public function unapproveUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            if ($user->registration_status === "approve") {

                $user->update(['registration_status' => "pending"]);

                return redirect()->back()->with('success', 'User unapproved successfully');
            } else {
                // Flash error message to session
                return redirect()->back()->with('error', 'User is not approved');
            }
        } else {
            // Flash error message to session
            return redirect()->back()->with('error', 'User not found');
        }
    }
}
