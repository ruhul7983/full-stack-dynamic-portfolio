@extends('admin.layouts.admin') 

<style>
    /* ------------------------------------------------ */
    /* CUSTOM FORM STYLES */
    /* ------------------------------------------------ */
    
    .form-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        max-width: 900px;
        margin: 0 auto; /* Center the form container */
    }

    h2 {
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 30px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 25px;
        padding: 0 10px;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        margin-bottom: 8px;
        color: #34495e;
        font-size: 1.05em;
    }

    .form-group input[type="text"],
    .form-group input[type="url"],
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #dcdfe6;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 1em;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #3498db;
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        outline: none;
    }

    .form-group textarea {
        resize: vertical;
    }

    hr {
        margin: 35px 0;
        border: 0;
        border-top: 1px solid #f0f0f0;
    }

    .error-message {
        color: #e74c3c;
        font-size: 0.9em;
        margin-top: 5px;
        display: block;
        font-weight: 500;
    }

    /* Image Management */
    .image-upload p {
        font-weight: 600;
        margin-bottom: 5px;
        color: #34495e;
    }
    .image-upload small {
        display: block;
        color: #7f8c8d;
        margin-top: 5px;
    }
    
    /* Action Buttons */
    .form-actions {
        margin-top: 40px;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }
    
    .btn {
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 1em;
        border: none;
        transition: background-color 0.3s, transform 0.1s;
    }
    .btn-success {
        background-color: #2ecc71;
        color: white;
    }
    .btn-success:hover {
        background-color: #27ae60;
        transform: translateY(-1px);
    }
    .btn-secondary {
        background-color: #bdc3c7;
        color: #34495e;
    }
    .btn-secondary:hover {
        background-color: #aeb4b8;
        transform: translateY(-1px);
    }
</style>

@section('content')
<div class="main-content">
    <div class="form-card">
        <form 
            {{-- Corrected action to use the named routes --}}
            action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" 
            method="POST" 
            enctype="multipart/form-data" 
            class="project-form"
        >
            @csrf
            
            @if(isset($project))
                @method('PUT') 
            @endif

            <h2>{{ isset($project) ? 'Edit Project: ' . $project->title : 'Create New Portfolio Project' }}</h2>
            
            {{-- Standard Form Groups (Title, Description, Category) --}}
            <div class="form-group">
                <label for="title">Project Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title ?? '') }}" required>
                @error('title') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="6" required>{{ old('description', $project->description ?? '') }}</textarea>
                @error('description') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">-- Select Category --</option>
                    @foreach(['Web Design', 'Mobile App', 'Branding', 'Other'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $project->category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <hr>

            {{-- Custom Portfolio Fields --}}
            <div class="form-group">
                <label for="technology_used">Technologies Used (e.g., Laravel, Vue.js)</label>
                <input type="text" id="technology_used" name="technology_used" value="{{ old('technology_used', $project->technology_used ?? '') }}" placeholder="List key technologies used">
                @error('technology_used') <span class="error-message">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="live_view_url">Live View URL</label>
                <input type="url" id="live_view_url" name="live_view_url" value="{{ old('live_view_url', $project->live_view_url ?? '') }}" placeholder="https://live-project-url.com">
                @error('live_view_url') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="github_link">GitHub Link</label>
                <input type="url" id="github_link" name="github_link" value="{{ old('github_link', $project->github_link ?? '') }}" placeholder="https://github.com/user/repo">
                @error('github_link') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <hr>

            {{-- Image Management --}}
            <div class="form-group image-upload">
                <label for="image">Project Image</label>
                {{-- Image is required only on CREATE, optional on EDIT --}}
                <input type="file" id="image" name="image" accept="image/*" {{ !isset($project) ? 'required' : '' }}> 
                
                @if(isset($project) && $project->image_path)
                    <div style="margin-top: 15px;">
                        <p>Current Image:</p>
                        <img src="{{ asset('storage/' . $project->image_path) }}" width="200" style="border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <small>Upload a new image file above to replace the current one.</small>
                    </div>
                @endif
                @error('image') <span class="error-message">{{ $message }}</span> @enderror
            </div>
            
            <hr>

            {{-- Status and Submit --}}
            <div class="form-group">
                <label for="status">Publishing Status</label>
                <select id="status" name="status" required>
                    @foreach(['Draft', 'Published', 'Archived'] as $status)
                        <option value="{{ $status }}" {{ old('status', $project->status ?? 'Draft') == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @error('status') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> {{ isset($project) ? 'Update Project' : 'Publish Project' }}
                </button>
                {{-- Corrected Cancel link --}}
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                    <i class="fa fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection