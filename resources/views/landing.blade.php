<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listify</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

   
<body>

<div class="landing-wrapper">
    <div class="landing-content">

        <img
            src="{{ asset('logo.png') }}"
            alt="Listify Logo"
            class="landing-logo"
        >

        <h1 class="landing-title">Welcome to Listify</h1>
        <p class="landing-subtitle">
            Manage your task efficiently and stay organized.
        </p>

        <div class="landing-buttons">
            <a href="{{ route('register') }}" class="btn btn-create">
                Create account
            </a>
            <a href="{{ route('login') }}" class="btn btn-signin">
                Sign in
            </a>
        </div>

    </div>
</div>

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

        .landing-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .landing-content {
            text-align: center;
            max-width: 480px;
        }

        .landing-logo {
            width: 110px;
            margin-bottom: 2rem;
        }

        .landing-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .landing-subtitle {
            color: #b0b6c3;
            font-size: 1rem;
            margin-bottom: 2.5rem;
        }

        .btn-create {
            background-color: #1b1f2a;
            color: #ffffff;
            border: 1px solid #2a2f3d;
            padding: 0.65rem 1.75rem;
            border-radius: 8px;
        }

        .btn-create:hover {
            background-color: #23283a;
            color: #ffffff;
        }

        .btn-signin {
            background-color: #39a876;
            color: #ffffff;
            padding: 0.65rem 1.75rem;
            border-radius: 8px;
        }

        .btn-signin:hover {
            background-color: #2f8f63;
            color: #ffffff;
        }

        .landing-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
    </style>
</head>

</body>
</html>
