<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        $countEmployee = Employee::count()->get();
        $countDepartment = Employee::select('department')->groupBy('department')->get();
        return Inertia::render('Dashboard', [
            'countEmployee' => $countEmployee,
            'countDepartment' => $countDepartment,
        ]);
    }
}
