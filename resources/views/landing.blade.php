<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listify - Your To-Do App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
        }
        .landing-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
        }
        .landing-buttons a {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <h1 class="display-4 mb-3">Welcome to Listify</h1>
        <p class="lead mb-4">Manage your tasks efficiently and stay organized.</p>
        <div class="landing-buttons">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Register</a>
        </div>
    </div>
</body>
</html>
