<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    public function index()
    {
        // Join students with users
        $students = DB::table('students')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.gender',
                'users.date_of_birth',
                'students.level',
                'students.class_group'
            )
            ->paginate(10); // Paginate 10 students per page

        return view('dashboard', compact('students'));
    }
}
