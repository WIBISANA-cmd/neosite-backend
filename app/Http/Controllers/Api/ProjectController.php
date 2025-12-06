<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('client')
            ->orderByDesc('created_at')
            ->paginate(10);

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->validated());

        return new ProjectResource($project->load('client'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('client')->findOrFail($id);

        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, string $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->validated());

        return new ProjectResource($project->load('client'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->noContent();
    }

    /**
     * Display projects for authenticated client.
     */
    public function clientProjects(Request $request)
    {
        $projects = Project::with('client')
            ->where('client_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return ProjectResource::collection($projects);
    }
}
