<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $projects = Project::where('status', 'Published')
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();

    return view('pages.home', compact('projects'));
})->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes (Authentication)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 
    Route::post('/login', [AuthController::class, 'login']);
});


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Main dashboard for any logged-in user
    Route::get('/dashboard', function () {
        return view('admin.pages.dashboard');
    })->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Admin-Only Routes
|-------------------------------------------------------------------------- 
*/

Route::middleware(['auth', 'admin'])
    ->prefix('dashboard')
    ->as('admin.')
    ->group(function () {

        // Admin Dashboard (GET /dashboard)
        Route::get('/', function () {
            return view('admin.pages.dashboard');
        })->name('dashboard');

        // Projects CRUD (GET /dashboard/projects)
        Route::resource('projects', ProjectController::class)
            ->except(['show'])
            ->names([
                'index'   => 'projects.index',
                'create'  => 'projects.create',
                'store'   => 'projects.store',
                'edit'    => 'projects.edit',
                'update'  => 'projects.update',
                'destroy' => 'projects.destroy',
            ]);
    });
