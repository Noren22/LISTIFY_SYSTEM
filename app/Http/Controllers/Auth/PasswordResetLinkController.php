<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Generate a token for local/dev convenience so we can auto-fill the
        // check-email page. Then attempt to send the reset link as usual.
        $user = User::where('email', $request->email)->first();
        $token = null;
        if ($user) {
            try {
                $token = Password::broker()->createToken($user);
            } catch (\Exception $e) {
                $token = null;
            }
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            // In development or when using the `log` mailer, store token/email in
            // session to allow immediate reset without an actual delivered email.
            if (app()->environment('local') || config('mail.default') === 'log') {
                if ($token) {
                    session()->flash('password_reset_token', $token);
                }
                session()->flash('password_reset_email', $request->email);
            }
            return redirect()->route('password.sent')->with('status', __($status));
        }

        // If throttled, allow immediate reset in local/log environments by
        // exposing the previously generated token (developer convenience).
        if ($status == Password::RESET_THROTTLED && (app()->environment('local') || config('mail.default') === 'log')) {
            if ($token) {
                session()->flash('password_reset_token', $token);
            }
            session()->flash('password_reset_email', $request->email);
            return redirect()->route('password.sent')->with('status', 'A reset was recently requested — using existing token for testing.');
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }

    /**
     * Show the "check your email" page with optional token entry.
     */
    public function sent(): View
    {
        return view('auth.check-email');
    }
}
