<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(
                circle at top,
                #1f2430 0%,
                #0f1218 45%,
                #0b0d12 100%
            );
            color: #ffffff;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .custom-navbar {
            background: linear-gradient(90deg, #0f1218, #161a22);
            border-bottom: 1px solid #1f2430;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #d1d5db !important;
        }

        .navbar-nav .nav-link:hover {
            color: #39a876 !important;
        }

        .navbar-toggler {
            border-color: #2a2f3d;
        }

        .dropdown-menu-dark {
            background-color: #161a22;
            border: 1px solid #2a2f3d;
        }

        .dropdown-item {
            color: #d1d5db;
        }

        .dropdown-item:hover {
            background-color: #1f2430;
            color: #ffffff;
        }

        .page-container {
            padding-top: 2rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-sm">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img
                src="{{ asset('logo.png') }}"
                alt="Listify Logo"
                width="28"
                height="28"
                class="rounded"
            >
            <span class="fw-semibold">Listify</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tasks.index') }}">Tasks</a>
                    </li>
                @endauth
            </ul>

            <!-- Right -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-success" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>

<div class="container page-container">
    {{ $slot ?? '' }}
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
