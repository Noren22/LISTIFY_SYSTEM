<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Register | Listify</title>
   
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-box">

        <h1 class="auth-title">Create an account</h1>
        <p class="auth-subtitle">Enter the details to sign up for an account</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Enter your username"
                    value="{{ old('name') }}"
                    required
                    autofocus
                >
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
              <!-- Email -->
            <div class="mb-3 position-relative">
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email address"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                <i class="bi bi-envelope position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"></i>

                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3 position-relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control pe-5"
                    placeholder="Enter your password"
                    required
                >
                <i
                    class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-secondary cursor-pointer"
                    onclick="togglePassword('password', this)"
                    style="cursor:pointer;"
                ></i>

                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>


            <!-- Confirm Password -->
            <div class="mb-4 position-relative">
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control pe-5"
                    placeholder="Repeat password"
                    required
                >
                <i
                    class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"
                    onclick="togglePassword('password_confirmation', this)"
                    style="cursor:pointer;"
                ></i>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between gap-3">
                <a href="{{ route('login') }}" class="btn btn-secondary-dark w-100">
                    Sign in
                </a>
                <button type="submit" class="btn btn-success-custom w-100">
                    Register
                </button>
            </div>

        </form>
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

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-box {
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            font-size: 0.9rem;
            color: #a0a6b4;
            margin-bottom: 2rem;
        }

        .form-control {
            background-color: #161a22;
            border: 1px solid #2a2f3d;
            color: #ffffff;
            padding: 0.75rem;
            border-radius: 10px;
        }

        .form-control::placeholder {
            color: #6c7280;
        }

        .form-control:focus {
            background-color: #161a22;
            color: #ffffff;
            border-color: #39a876;
            box-shadow: none;
        }

        .btn-secondary-dark {
            background-color: #1b1f2a;
            border: 1px solid #2a2f3d;
            color: #ffffff;
            border-radius: 10px;
            padding: 0.6rem 1.75rem;
        }

        .btn-secondary-dark:hover {
            background-color: #23283a;
        }

        .btn-success-custom {
            background-color: #39a876;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.75rem;
        }

        .btn-success-custom:hover {
            background-color: #2f8f63;
        }

        .error-text {
            font-size: 0.8rem;
            color: #ff6b6b;
            text-align: left;
            margin-top: 0.25rem;
        }
    </style>

<script>
    function togglePassword(fieldId, icon) {
        const input = document.getElementById(fieldId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
    }
</script>

</body>
</html> 
