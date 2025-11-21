<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donor;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        $user = User::where('email', $request->email)->first();
        $layout = $this->getRoleLayout($user);
        
        return view('auth.reset-password', [
            'request' => $request,
            'layout' => $layout
        ]);
    }

    /**
     * Get the appropriate layout based on user role
     */
    private function getRoleLayout(?User $user): string
    {
        if (!$user) {
            return 'layouts.guest';
        }

        $roleLayouts = [
            'doctor' => 'layouts.doctor',
            'admin' => 'layouts.admin',
            'nurse' => 'layouts.nurse',
            'shariah' => 'layouts.shariah',
            'donor' => 'layouts.donor',
            'parent' => 'layouts.parent',
            'labtech' => 'layouts.labtech',
        ];

        return $roleLayouts[$user->role] ?? 'layouts.app';
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));

                auth()->login($user);
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            $user = User::where('email', $request->email)->first();
            
            // Role-based redirection
            return $this->redirectBasedOnRole($user, $status);
        }

        return back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
    }

    /**
     * Redirect user based on their role after password reset
     */
    private function redirectBasedOnRole(?User $user, string $status): RedirectResponse
    {
        if (!$user) {
            return redirect()->route('login')->with('status', __($status));
        }

        // Role-based redirection
        switch ($user->role) {
            case 'doctor':
                return redirect()->route('doctor.dashboard')->with('status', __($status));
            case 'hmmc_admin':
                return redirect()->route('hmmc.dashboard')->with('status', __($status));
            case 'nurse':
                return redirect()->route('nurse.dashboard')->with('status', __($status));
            case 'donor':
                return redirect()->route('donor.dashboard')->with('status', __($status));
            case 'parent':
                return redirect()->route('parent.dashboard')->with('status', __($status));
            case 'labtech':
                return redirect()->route('labtech.dashboard')->with('status', __($status));
            case 'shariah_advisor':
                return redirect()->route('shariah.dashboard')->with('status', __($status));
            default:
                return redirect()->route('dashboard')->with('status', __($status));
        }
    }

    // ... keep your existing first-time password methods ...
}