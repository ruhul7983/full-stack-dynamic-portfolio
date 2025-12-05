@extends('admin.layouts.admin') 

@section('content')
<div class="dashboard-content">

    {{-- Welcome/Alert Card (Restored from previous step) --}}
    <div class="welcome-card">
        <h2>Hello, {{ Auth::user()->name }}! 👋</h2>
        @if (session('error'))
            <p style="color: red; font-weight: bold;">{{ session('error') }}</p>
        @endif
        <p>Welcome to your Portfolio Content Management System. You can manage your projects, skills, and contacts using the navigation on the left.</p>
    </div>

    {{-- Dashboard Statistics (Restored from previous step) --}}
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Projects</h3>
            <p>12</p>
        </div>
        <div class="stat-card" style="border-left-color: #2ecc71;">
            <h3>New Leads (Last 30 Days)</h3>
            <p>4</p>
        </div>
        <div class="stat-card" style="border-left-color: #f1c40f;">
            <h3>Skills Updated</h3>
            <p>3 weeks ago</p>
        </div>
        
        @if (Auth::user()->role === 'admin')
            <div class="stat-card" style="border-left-color: #9b59b6;">
                <h3>Active Admins</h3>
                <p>2</p>
            </div>
        @endif
    </div>

</div>

{{-- Add the CSS needed for the welcome card and stats grid, as it was removed from the main layout --}}
<style>
    /* CONTENT-SPECIFIC STYLES */
    .welcome-card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); margin-bottom: 30px; }
    .welcome-card h2 { color: #2c3e50; margin-top: 0; }
    
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
    .stat-card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); border-left: 5px solid #3498db; }
    .stat-card h3 { color: #7f8c8d; font-size: 1em; margin-bottom: 5px; }
    .stat-card p { font-size: 2em; color: #2c3e50; font-weight: 600; margin: 0; }
</style>
@endsection