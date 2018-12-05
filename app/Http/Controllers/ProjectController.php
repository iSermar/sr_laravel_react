<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // List all projects with account task complete is false
        $projects = Project::where('is_completed', false)
            ->orderBy('created_at', 'desc')
            ->withCount(['tasks' => function ($query) {
                $query->where('is_completed', false);
            }])
            ->get();

        // Return result
        return $projects->toJson();
    }

    public function store(Request $request)
    {
        // Created all validations 
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Add new data
        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        // Return result with answer
        return response()->json('Project created!');
    }

    public function show($id)
    {
        // Get project by id if completed is false
        $project = Project::with(['tasks' => function ($query) {
            $query->where('is_completed', false);
        }])->find($id);

        // Return result
        return $project->toJson();
    }

    public function markAsCompleted(Project $project)
    {
        // Assign true to variable if mark completed
        $project->is_completed = true;

        // Update field is complete
        $project->update();

        // Return results with answer
        return response()->json('Project updated!');
    }
}
