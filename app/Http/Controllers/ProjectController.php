<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectView;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Project::query();

        $filter = $request->query('filter', 'all');

        switch ($filter) {
            case 'created_by_me':
                $query->where('user_id', $user->id);
                break;
            case 'templates':
                $query->where('is_template', true);
                break;
            case 'recently_viewed':
                $projectIds = ProjectView::where('user_id', $user->id)
                    ->orderBy('last_viewed_at', 'desc')
                    ->limit(10)
                    ->pluck('project_id');

                $query->whereIn('id', $projectIds)
                    ->orderByRaw('FIELD(id, ' . $projectIds->implode(',') . ')');
                break;
            default:
                break;
        }

        $projects = $query->with('user')->latest()->get();

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'filters' => [
                'current' => $filter
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_template' => 'boolean',
            'visibility' => 'required|in:public,private',
        ]);

        $project = $request->user()->projects()->create($validated);

        return back()->with('success', 'Project created successfully.');
    }

    public function trackView(Project $project)
    {
        ProjectView::updateOrCreate(
            ['user_id' => Auth::id(), 'project_id' => $project->id],
            ['last_viewed_at' => now()]
        );

        return response()->json(['status' => 'success']);
    }
}
