@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Update Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">Update Password</div>
            <div class="card-body">
                <form method="POST" action="{{ route('user-password.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3 position-relative">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            class="form-control pe-5"
                            autocomplete="current-password"
                            required
                        >
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"
                           onclick="togglePassword('current_password', this)"
                           style="cursor: pointer; z-index: 10;"></i>

                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">New Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control pe-5"
                            autocomplete="new-password"
                            required
                        >
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"
                           onclick="togglePassword('password', this)"
                           style="cursor: pointer; z-index: 10;"></i>

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control pe-5"
                            autocomplete="new-password"
                            required
                        >
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"
                           onclick="togglePassword('password_confirmation', this)"
                           style="cursor: pointer; z-index: 10;"></i>

                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning">Update Password</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-danger text-white">Delete Account</div>
            <div class="card-body">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    Delete Account
                </button>

                <!-- Modal -->
                <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('DELETE')

                                <div class="modal-header">
                                    <h5 class="modal-title text-danger" id="deleteAccountModalLabel">Delete Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    Are you sure you want to delete your account? This action cannot be undone.
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes, Delete Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(session('status') === 'profile-updated')
                        Profile updated successfully!
                    @elseif(session('status') === 'password-updated')
                        Password updated successfully!
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
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

    .form-label {
        color: #ffffff;
    }

    .form-control {
        border-color: #2A2F3D;
        background: #161A22;
        border-radius: 10px;
        color: #ffffff;
    }

    .form-control:focus {
        border-color: #39a876;
        box-shadow: none;
        background: #161A22;
    }

    .mb-4 {
        background: transparent;
        border-color: #2A2F3D;
    }

    .modal-backdrop.show {
        opacity: 0.75;
        background-color: #020617;
    }

    .modal-content {
        background-color: #0f172a;
        color: #e5e7eb;
        border: 1px solid #1f2937;
        border-radius: 12px;
    }

    .modal-header {
        background-color: #0f2f26;
        border-bottom: 1px solid #1f4f3b;
    }

    .modal-title {
        color: #7de2c3;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }

    .modal-body {
        color: #d1d5db;
        font-size: 0.95rem;
    }

    .modal-footer {
        border-top: 1px solid #1f2937;
    }

    .modal-footer .btn-success {
        background-color: #39a876;
        border-color: #39a876;
    }

    .modal-footer .btn-success:hover {
        background-color: #2f8f63;
        border-color: #2f8f63;
    }

    .text-secondary {
        color: #a0a6b4 !important;
    }

    input[type="password"] {
    color: #ffffff !important;
    }

    .bi-eye-slash, .bi-eye {
        color: #c0c6d4 !important;
        padding-top: 1.8rem;
        font-size: 1.15rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('status'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif
    });

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

@endsection