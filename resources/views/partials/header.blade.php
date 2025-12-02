<link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

<nav class="navbar">
    <div class="container nav-container">
        <a href="{{ url('/') }}" class="nav-logo">
            Md Ruhul Amin
        </a>

        <div class="hamburger-menu" id="hamburger-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <ul class="nav-menu" id="nav-menu">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="#about" class="nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="#projects" class="nav-link">Projects</a>
            </li>
            <li class="nav-item">
                <a href="#contact" class="nav-link btn-nav">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<script>
    const hamburger = document.getElementById('hamburger-menu');
    const navMenu = document.getElementById('nav-menu');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    });

    // Close menu when a link is clicked
    document.querySelectorAll('.nav-link').forEach(n => n.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
    }));
</script>