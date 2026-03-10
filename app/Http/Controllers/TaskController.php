<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        return Inertia::render('Task');
    }

    public function dashboard()
    {
        $tasks = Task::orderBy('start_date')->get();

        return Inertia::render('TaskDashboard', [
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        return Inertia::render('TaskCreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pic_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:ongoing,completed,past_due',
            'priority' => 'nullable|string',
        ]);

        Task::create($validated);

        return redirect()->back()->with('success', 'Task created successfully.');
    }
}
