<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
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
     * Handle an incoming password reset request via email or contact.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['nullable', 'email'],
            'contact' => ['nullable', 'string'],
        ]);

        if (!$request->email && !$request->contact) {
            return back()->withErrors([
                'email' => 'Please provide either email or contact number.',
            ]);
        }

        // Find the user across all tables
        $user = $this->findUser($request->email, $request->contact);

        if (!$user) {
            return back()->withErrors([
                'email' => 'No user found with the provided email or contact.',
            ]);
        }

        // Determine email and contact columns
        $email = $user->dn_Email ?? $user->pr_Email ?? $user->dr_Email ?? $user->ns_Email ?? $user->lt_Email ?? $user->ad_Email ?? $user->sc_Email ?? null;
        $contact = $user->dn_Contact ?? $user->pr_Contact ?? $user->dr_Contact ?? $user->ns_Contact ?? $user->lt_Contact ?? $user->ad_Contact ?? $user->sc_Contact ?? null;

        // If user chose contact (WhatsApp)
        if ($request->contact && $contact) {
            // Send reset code via WhatsApp (replace with your WhatsApp service)
            // Example: WhatsApp::to($contact)->send("Your password reset code is: 123456");
            return back()->with('status', 'A reset code has been sent to your WhatsApp number.');
        }

        // If user chose email
        if ($email) {
            $status = Password::sendResetLink(['email' => $email]);

            return $status === Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
        }

        return back()->withErrors([
            'email' => 'Cannot reset password: no email or contact found.',
        ]);
    }

    /**
     * Search all user tables for a matching email or contact.
     */
    protected function findUser($email = null, $contact = null)
    {
        $tables = [
            'donor' => ['email' => 'dn_Email', 'contact' => 'dn_Contact'],
            'parent' => ['email' => 'pr_Email', 'contact' => 'pr_Contact'],
            'doctor' => ['email' => 'dr_Email', 'contact' => 'dr_Contact'],
            'nurse' => ['email' => 'ns_Email', 'contact' => 'ns_Contact'],
            'labtech' => ['email' => 'lt_Email', 'contact' => 'lt_Contact'],
            'hmmcadmin' => ['email' => 'ad_Email', 'contact' => 'ad_Contact'],
            'shariahcomittee' => ['email' => 'sc_Email', 'contact' => 'sc_Contact'],
        ];

        foreach ($tables as $table => $cols) {
            $query = \DB::table($table);
            if ($email) $query->where($cols['email'], $email);
            if ($contact) $query->orWhere($cols['contact'], $contact);

            $user = $query->first();
            if ($user) return $user;
        }

        return null;
    }

}
