<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::latest()->paginate(10);
        return view('project.index', compact('projects'));
    }

    public function create() {
        return view('project.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        Project::create($validated);
        return redirect()->route('master.project.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project) {
        return view('project.show', compact('project'));
    }

    public function edit(Project $project) {
        return view('project.edit', compact('project'));
    }

    public function update(Request $request, Project $project) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $project->update($validated);
        return redirect()->route('master.project.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project) {
        $project->delete();
        return redirect()->route('master.project.index')->with('success', 'Project deleted successfully.');
    }
} 