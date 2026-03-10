<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkTimeController extends Controller
{
    public function index()
    {
        return Inertia::render('Employees/WorkTime/Index');
    }
}
