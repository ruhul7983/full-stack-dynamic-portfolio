<div class="sidebar">
    <div class="sidebar-header">
        <h3>Portfolio CMS</h3>
    </div>
    
    <div class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>

            <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <i class="fa-solid fa-diagram-project"></i> Projects
            </a>
            
        
        <a href="#">
            <i class="fa-solid fa-address-book"></i> Contacts & Leads
        </a>
        <a href="#">
            <i class="fa-solid fa-cogs"></i> Skills & Services
        </a>
    </div>
</div>