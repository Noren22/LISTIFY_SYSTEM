<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Forgot Password | Listify</title>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-box">

        <h1 class="auth-title">Forgot Your Password?</h1>
        <p class="auth-subtitle">No problem. Just let us know your email address and we will email you a password reset link.</p>

        <!-- Session Status (e.g., "Password reset link sent") -->
        @if (session('status'))
            <div class="alert-custom alert-success mb-5">
                <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5 position-relative">
                <input
                    type="email"
                    name="email"
                    class="form-control pe-5"
                    placeholder="Enter your email address"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success-custom w-100 py-3">
                    Email Password Reset Link
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-secondary hover-text-teal">
                ← Back to sign in
            </a>
        </div>
    </div>
</div>

<style>
    body {
        min-height: 100vh;
        background: radial-gradient(circle at top, #1f2430 0%, #0f1218 45%, #0b0d12 100%);
        color: #ffffff;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .auth-box {
        width: 100%;
        max-width: 480px;
        text-align: center;
        background-color: rgba(22, 26, 34, 0.6);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 3rem 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .auth-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .auth-subtitle {
        font-size: 1rem;
        color: #a0a6b4;
        margin-bottom: 3rem;
        line-height: 1.5;
    }

    .form-control {
        background-color: #161a22;
        border: 1px solid #2a2f3d;
        color: #ffffff;
        padding: 0.9rem 2rem;
        border-radius: 10px;
        font-size: 1rem;
    }

    .form-control::placeholder {
        color: #6c7280;
    }

    .form-control:focus {
        background-color: #161a22;
        border-color: #39a876;
        box-shadow: 0 0 0 4px rgba(57, 168, 118, 0.15);
    }

    .btn-success-custom {
        background-color: #39a876;
        border: none;
        color: #ffffff;
        border-radius: 10px;
        font-size: 1rem;
        padding: 0.6rem 1.75rem;
        margin-top: 1.5rem;
        margin-bottom: 1.3rem;
    }

    .btn-success-custom:hover {
        background-color: #2f8f63;
    }

    .alert-custom {
        padding: 1.25rem;
        border-radius: 14px;
        text-align: left;
    }

    .alert-success {
        background-color: #2a4f3a;
        color: #8fffc0;
    }

    .error-text {
        font-size: 0.85rem;
        color: #ff6b6b;
        text-align: left;
        margin-top: 0.5rem;
    }

    .text-secondary {
        color: #a0a6b4;
        font-size: 0.95rem;
    }

    .hover-text-teal:hover {
        color: #39a876 !important;
    }
</style>

</body>
</html>