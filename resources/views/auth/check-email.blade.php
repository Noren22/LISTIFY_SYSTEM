<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('We have sent a password reset link to your email address. Check your email for the link.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-4 text-sm">
        {{ __('If you already received the token you can paste it below with your email to open the reset form immediately.') }}
    </div>

    <form id="open-reset" onsubmit="event.preventDefault(); openReset();">
        <div class="mb-3">
            <label class="form-label">Token</label>
            <input id="token" type="text" class="form-control" placeholder="Paste token here" value="{{ session('password_reset_token', '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input id="email" type="email" class="form-control" placeholder="your@example.com" value="{{ session('password_reset_email', old('email')) }}">
        </div>
        <div class="d-flex gap-2">
            <button id="openBtn" type="submit" class="btn btn-primary">Open Reset Form</button>
            <a href="{{ route('login') }}" class="btn btn-secondary">Back to Login</a>
        </div>
    </form>

    {{-- In-page reset form: allow immediate reset when token + email available --}}
    @if(session('password_reset_token') || session('password_reset_email'))
        <hr class="my-4">
        <h3>Reset password now</h3>
        <p class="text-sm text-muted">Use the token below to reset your password immediately (for local/dev/testing).</p>

        <form method="POST" action="{{ route('password.store') }}" class="mt-3">
            @csrf

            <input type="hidden" name="token" value="{{ session('password_reset_token') }}">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" value="{{ session('password_reset_email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">New password</label>
                <input name="password" type="password" class="form-control" required autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm password</label>
                <input name="password_confirmation" type="password" class="form-control" required autocomplete="new-password">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Reset Password Now</button>
                <a href="{{ route('login') }}" class="btn btn-secondary">Back to Login</a>
            </div>
        </form>
    @endif

    <script>
        function openReset() {
            const token = document.getElementById('token').value.trim();
            const email = document.getElementById('email').value.trim();
            if (!token || !email) {
                alert('Please enter both token and email.');
                return;
            }
            const url = '/reset-password/' + encodeURIComponent(token) + '?email=' + encodeURIComponent(email);
            window.location.href = url;
        }

        // Auto-open if token + email are present (useful in local/log mailer).
        document.addEventListener('DOMContentLoaded', function () {
            const token = document.getElementById('token').value.trim();
            const email = document.getElementById('email').value.trim();
            if (token && email) {
                // small delay to allow users to cancel if needed
                setTimeout(() => openReset(), 800);
            }
        });
    </script>
</x-guest-layout>
