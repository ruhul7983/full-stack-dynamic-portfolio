<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portfolio Management Dashboard</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* 🎨 BASE LAYOUT STYLES */
        body { 
            margin: 0; 
            display: flex; /* Kept for overall layout structure */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f7f6; 
        }
        
        /* Dashboard Container: Now responsible for the scrolling main area */
        /* Must have a left margin equal to the sidebar width */
        .dashboard-container { 
            flex-grow: 1; 
            padding: 0;
            margin-left: 250px; /* <--- CRUCIAL: Pushes content past the fixed sidebar */
        }
        
        /* Header/Nav Bar */
        .dashboard-header { 
            background: white; 
            padding: 15px 30px; 
            border-bottom: 1px solid #e0e0e0; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            /* Optional: Make header sticky too */
            /* position: sticky; 
            top: 0; 
            z-index: 100; */
        }
        .user-info { display: flex; align-items: center; }
        .role-badge { 
            background-color: {{ Auth::user()->role === 'admin' ? '#e74c3c' : '#2ecc71' }}; 
            color: white; 
            padding: 5px 10px; 
            border-radius: 20px; 
            font-size: 0.8em; 
            margin-right: 15px; 
            font-weight: bold;
        }
        .logout-btn { background: none; border: none; color: #3498db; cursor: pointer; font-size: 1em; }

        /* Main Content wrapper */
        .main-content { padding: 30px; }
        
        /* SIDEBAR STYLES */
        .sidebar { 
            width: 250px; 
            background-color: #2c3e50; 
            color: white; 
            
            /* <--- CRITICAL FIXES ---> */
            position: fixed; /* Fixes the position relative to the viewport */
            top: 0;          /* Aligns it to the top of the viewport */
            height: 100vh;   /* Makes it span the full viewport height */
            /* <--- CRITICAL FIXES END ---> */
            
            padding-top: 20px; 
            flex-shrink: 0; 
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 50; /* Ensure it stays above content if needed */
        }
        .sidebar-header { text-align: center; margin-bottom: 30px; padding: 0 15px; }
        .sidebar-header h3 {
            color: #ecf0f1; margin: 0; font-size: 1.5em; border-bottom: 1px solid #34495e; padding-bottom: 10px;
        }
        .sidebar-nav a { 
            display: flex; align-items: center; padding: 12px 20px; color: #bdc3c7; 
            text-decoration: none; border-left: 5px solid transparent; transition: all 0.2s;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active { 
            background-color: #34495e; color: white; border-left-color: #3498db; 
        }
        .sidebar-nav i { margin-right: 10px; font-size: 1.2em; }
    </style>
</head>
<body>

    <!-- 1. Include the Sidebar Partial -->
    @include('admin.partials.sidebar')

    <div class="dashboard-container">
        
        <!-- 2. Header (Always visible) -->
        <div class="dashboard-header">
            <h2>{{ Auth::user()->role === 'admin' ? 'Administrative' : 'User' }} Panel</h2>
            
            <div class="user-info">
                <span class="role-badge">{{ strtoupper(Auth::user()->role) }}</span>
                <p style="margin: 0; font-weight: 600; margin-right: 20px;">
                    {{ Auth::user()->email }}
                </p>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- 3. CONTENT YIELD AREA -->
        <div class="main-content">
            @yield('content')
        </div>

    </div>

</body>
</html>