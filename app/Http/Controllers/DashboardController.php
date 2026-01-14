<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show dashboard
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show jurnal page
     */
    public function jurnal()
    {
        return view('admin.jurnal');
    }

    /**
     * Show report page
     */
    public function report()
    {
        return view('admin.report');
    }

    /**
     * Show database user page
     */
    public function databaseUser()
    {
        return view('admin.database-user');
    }

    /**
     * Show update data page
     */
    public function updateData()
    {
        return view('admin.update-data');
    }

    /**
     * Handle update data
     */
    public function updateDataPost(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive'
        ]);

        // Here you would update the user in database
        // Example: User::where('id', $request->user_id)->update([...]);

        return redirect()->route('database.user')->with('success', 'User data updated successfully!');
    }

    /**
     * Show reset password page
     */
    public function resetPasswordUser()
    {
        return view('admin.reset-password');
    }

    /**
     * Handle reset password
     */
    public function resetPasswordUserPost(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        // Here you would update the password in database
        // Example: User::where('id', $request->user_id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('database.user')->with('success', 'Password reset successfully!');
    }
}
