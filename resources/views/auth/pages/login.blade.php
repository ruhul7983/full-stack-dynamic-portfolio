<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

@extends('auth.layouts.auth')

@section('content')
    <div class="login-wrapper">
        <div class="login-card">
            
            <div class="login-header">
                <div class="brand-logo">R</div>
                <h2>Welcome Back</h2>
                <p>Enter your credentials to access the admin panel.</p>
            </div>

            <form action="" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="amin22205101245@diu.edu.bd" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="form-actions">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Sign In</button>
            </form>
            
            <div class="login-footer">
                <p>&copy; {{ date('Y') }} Admin Panel. Secure Access Only.</p>
            </div>
        </div>
    </div>


@endsection