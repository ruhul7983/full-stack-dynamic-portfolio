<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource (Index).
     */
    public function publicIndex()
{
    $projects = Project::where('status', 'Published')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('components.projects', compact('projects'));
}
    public function index()
    {
        // Paginate projects for better performance
        $projects = Project::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource (Create).
     */
    public function create()
    {
        return view('admin.pages.projects.form');
    }

    /**
     * Store a newly created resource in storage (Store).
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $imagePath = $this->handleImageUpload($request);
        
        // Create the project
        Project::create(array_merge($validated, [
            'image_path' => $imagePath,
        ]));

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Show the form for editing the specified resource (Edit).
     */
    public function edit(Project $project)
    {
        return view('admin.pages.projects.form', compact('project'));
    }

    /**
     * Update the specified resource in storage (Update).
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate($this->rules(true));

        $imagePath = $this->handleImageUpdate($request, $project);

        // Update the project
        $project->update(array_merge($validated, [
            'image_path' => $imagePath,
        ]));

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage (Destroy).
     * This is called via AJAX or a form button on the index page.
     */
    public function destroy(Project $project)
    {
        // 1. Delete the image file from storage
        if ($project->image_path) {
            Storage::delete($project->image_path);
        }
        
        // 2. Delete the database record
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    // --- Private Helper Methods ---

    /**
     * Defines validation rules for project data.
     */
    private function rules($isUpdate = false)
    {
        return [
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'category'          => 'required|string|max:100',
            'technology_used'   => 'nullable|string|max:255',
            'live_view_url'     => 'nullable|url|max:255',
            'github_link'       => 'nullable|url|max:255',
            'status'            => ['required', Rule::in(['Draft', 'Published', 'Archived'])],
            // Image is required on create, but optional on update (if not provided, keep old one)
            'image'             => $isUpdate ? 'nullable|image|max:2048' : 'required|image|max:2048', 
        ];
    }

    /**
     * Handles image upload and returns the path.
     */
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            // Store the new image in the 'public/projects' directory
            return $request->file('image')->store('projects', 'public');
        }
        return null;
    }

    /**
     * Handles image update: deletes old image if a new one is provided.
     */
    private function handleImageUpdate(Request $request, Project $project)
    {
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($project->image_path) {
                Storage::delete($project->image_path);
            }
            // Store the new image
            return $request->file('image')->store('projects', 'public');
        }
        // If no new image is uploaded, return the existing path
        return $project->image_path;
    }
}