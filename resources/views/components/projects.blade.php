<link rel="stylesheet" href="{{ asset('assets/css/projects.css') }}">

<section id="projects" class="projects-section">
    <div class="container">
        <div class="section-header">
            <span class="sub-headline">My Work</span>
            <h2>Featured <span class="highlight">Projects</span></h2>
            <p>A selection of my recent full-stack development work.</p>
        </div>

        <div class="projects-grid">
            
            {{-- 🔥 Dynamic Project Cards (same UI, only mapped) --}}
            @foreach($projects as $project)
                <div class="project-card">
                    <div class="card-image">
                        <img 
                            src="{{ asset('storage/' . $project->image_path) }}" 
                            alt="{{ $project->title }}"
                        >
                    </div>

                    <div class="card-content">
                        <h3>{{ $project->title }}</h3>

                        <p>{{ Str::limit($project->description, 150) }}</p>

                        <div class="tech-stack">
                            @foreach(explode(',', $project->technology_used ?? '') as $tech)
                                @if(trim($tech) !== '')
                                    <span>{{ trim($tech) }}</span>
                                @endif
                            @endforeach
                        </div>

                        <div class="card-actions">
                            <a 
                                href="{{ $project->live_view_url ?? '#' }}" 
                                class="btn-link" 
                                target="_blank"
                            >
                                View Live <i class="arrow-icon">→</i>
                            </a>

                            <a 
                                href="{{ $project->github_link ?? '#' }}" 
                                class="github-link" 
                                target="_blank"
                            >
                                GitHub
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
