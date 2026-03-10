<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KnowledgeBaseController extends Controller
{
    public function index()
    {
        return Inertia::render('Employees/KnowledgeBase/Index');
    }

    public function create()
    {
        return Inertia::render('Employees/KnowledgeBase/Create');
    }
}
