@extends('admin.layouts.admin') 
{{-- NOTE: Replace 'admin.layouts.admin' with your actual layout file if different. --}}

<style>
    /* Basic Styling for Table and Buttons */
    .main-content { padding: 30px; }
    .header-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .projects-table { width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 4px 8px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; }
    .projects-table th, .projects-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
    .projects-table th { background-color: #f8f9fa; color: #34495e; font-weight: 600; }
    
    /* Buttons */
    .btn { padding: 8px 15px; border-radius: 4px; text-decoration: none; cursor: pointer; transition: background-color 0.2s; }
    .btn-primary { background-color: #3498db; color: white; border: none; }
    .btn-primary:hover { background-color: #2980b9; }
    
    /* Action Buttons (Table) */
    .action-btn { display: inline-block; padding: 6px 12px; border-radius: 4px; font-size: 0.9em; margin-right: 5px; text-decoration: none; }
    .edit { background-color: #f39c12; color: white; border: none; }
    .delete { background-color: #e74c3c; color: white; border: none; }
    .edit:hover, .delete:hover { opacity: 0.9; }

    /* Status Badges */
    .status-badge { padding: 5px 10px; border-radius: 12px; font-weight: bold; font-size: 0.8em; }
    .status-published { background-color: #e6f7d5; color: #52c41a; }
    .status-draft { background-color: #fffbe6; color: #faad14; }
    .status-archived { background-color: #f0f2f5; color: #8c8c8c; }
    
    .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
    .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
</style>

@section('content')
<div class="main-content">
    <div class="header-bar">
        <h2>Portfolio Projects</h2>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            Create New Project
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="projects-table">
        <thead>
            <tr>
                <th style="width: 10%;">Image</th>
                <th style="width: 25%;">Title</th>
                <th style="width: 20%;">Technology</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 30%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $project->image_path) }}" 
                         alt="{{ $project->title }}" 
                         style="width: 100%; max-width: 80px; height: auto; border-radius: 4px; object-fit: cover;">
                </td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->technology_used }}</td>
                <td>
                    <span class="status-badge status-{{ strtolower($project->status) }}">
                        {{ $project->status }}
                    </span>
                </td>
                <td>
                    {{-- Edit Link --}}
                    <a href="{{ route('admin.projects.edit', $project) }}" class="action-btn edit">Edit</a>
                    
                    {{-- DELETE FORM --}}
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" onclick="return confirm('Are you sure you want to permanently delete \'{{ $project->title }}\'?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 20px;">No projects found. Click "Create New Project" to begin managing your portfolio.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $projects->links() }}
    </div>
</div>
@endsection