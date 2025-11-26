<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\View\View;

class PasswordResetOTPController extends Controller
{
    // Show forgot password form
    public function showRequestForm(): View
    {
        return view('auth.forgot-password');
    }

    // Send OTP (AJAX)
    public function sendOTP(Request $request)
    {
        Log::info('Send OTP request received', $request->all());

        try {
            $request->validate([
                'email' => ['nullable', 'email'],
                'contact' => ['nullable', 'string'],
            ]);

            if (!$request->email && !$request->contact) {
                Log::warning('No email or contact provided');
                return response()->json([
                    'status' => 'error',
                    'errors' => ['email' => ['Provide email or contact number']]
                ], 422);
            }

            $user = $this->findUser($request->email, $request->contact);
            
            Log::info('User lookup result', ['found' => !!$user]);

            if (!$user) {
                Log::warning('User not found', [
                    'email' => $request->email,
                    'contact' => $request->contact
                ]);
                return response()->json([
                    'status' => 'error',
                    'errors' => ['email' => ['User not found with this email or contact number']]
                ], 404);
            }

            $contactOrEmail = $request->email ?? $request->contact;
            $otp = rand(100000, 999999);

            Log::info('Generated OTP', [
                'otp' => $otp,
                'user_table' => $user->table,
                'user_id' => $user->id
            ]);

            // Delete old OTPs for this user
            DB::table('password_otps')
                ->where('contact_or_email', $contactOrEmail)
                ->delete();

            // Save new OTP
            DB::table('password_otps')->insert([
                'user_table' => $user->table,
                'user_id' => $user->id,
                'contact_or_email' => $contactOrEmail,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('OTP saved to database');

            // Send email / WhatsApp
            if ($request->email) {
                try {
                    Mail::raw(
                        "Your OTP for password reset is: $otp\n\nThis code will expire in 5 minutes.\n\nIf you did not request this, please ignore this email.\n\nRegards,\nRahma Milk Bank Team",
                        function($message) use($request) {
                            $message->to($request->email)
                                    ->subject('Password Reset OTP - Rahma Milk Bank');
                        }
                    );
                    Log::info('Email sent successfully to: ' . $request->email);
                } catch (\Exception $e) {
                    Log::error('Email send failed: ' . $e->getMessage());
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to send email. Please check your email address and try again.'
                    ], 500);
                }
            } else {
                // Log OTP for WhatsApp (you can implement actual WhatsApp API here)
                Log::info("OTP for WhatsApp {$request->contact}: $otp");
            }

            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent! Check your ' . ($request->email ? 'email' : 'WhatsApp') . '.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', $e->errors());
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Send OTP failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again.'
            ], 500);
        }
    }

    // Verify OTP (AJAX)
    public function verifyOTP(Request $request)
    {
        Log::info('Verify OTP request received', $request->all());

        try {
            $request->validate([
                'otp' => 'required|string',
                'contact_or_email' => 'required|string',
            ]);

            $otpEntry = DB::table('password_otps')
                ->where('contact_or_email', $request->contact_or_email)
                ->where('expires_at', '>=', now())
                ->orderBy('created_at', 'desc')
                ->first();

            Log::info('OTP lookup result', ['found' => !!$otpEntry]);

            if (!$otpEntry) {
                Log::warning('OTP not found or expired');
                return response()->json([
                    'status' => 'error',
                    'message' => 'OTP has expired. Please request a new one.'
                ]);
            }

            if ($otpEntry->otp != $request->otp) {
                Log::warning('Invalid OTP provided', [
                    'expected' => $otpEntry->otp,
                    'received' => $request->otp
                ]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid OTP. Please check and try again.'
                ]);
            }

            // Delete used OTP
            DB::table('password_otps')
                ->where('id', $otpEntry->id)
                ->delete();

            Log::info('OTP verified successfully', [
                'user_table' => $otpEntry->user_table,
                'user_id' => $otpEntry->user_id
            ]);

            // Success → return user info for reset
            return response()->json([
                'status' => 'success',
                'redirect' => route('password.reset.firsttime', [
                    'user_table' => $otpEntry->user_table,
                    'user_id' => $otpEntry->user_id
                ])
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', $e->errors());
            return response()->json([
                'status' => 'error',
                'message' => 'Please provide OTP and contact/email'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Verify OTP failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to verify OTP. Please try again.'
            ], 500);
        }
    }

    // Show reset password form
    public function showResetForm($user_table, $user_id): View
    {
        Log::info('Show reset form', ['user_table' => $user_table, 'user_id' => $user_id]);

        // Validate user exists
        $validTables = ['donor', 'parent', 'doctor', 'nurse', 'labtech', 'hmmcadmin', 'shariahcomittee'];
        
        if (!in_array($user_table, $validTables)) {
            Log::error('Invalid user table: ' . $user_table);
            abort(404, 'Invalid user type');
        }

        // Get the correct ID column for each table
        $idColumn = $this->getIdColumn($user_table);
        
        $userExists = DB::table($user_table)->where($idColumn, $user_id)->exists();
        
        if (!$userExists) {
            Log::error('User not found', ['table' => $user_table, 'id' => $user_id, 'column' => $idColumn]);
            abort(404, 'User not found');
        }

        return view('auth.reset-password-firsttime', compact('user_table', 'user_id'));
    }

    // Reset password
    public function resetPassword(Request $request, $user_table, $user_id)
    {
        Log::info('Reset password attempt', [
            'user_table' => $user_table,
            'user_id' => $user_id
        ]);

        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Get the correct ID and password columns
        $idColumn = $this->getIdColumn($user_table);
        $passwordColumn = $this->getPasswordColumn($user_table);

        $updateData = [
            $passwordColumn => Hash::make($request->password),
            'updated_at' => now()
        ];

        // Only update first_login if the column exists (for donor/parent)
        if (in_array($user_table, ['donor', 'parent'])) {
            $updateData['first_login'] = 0;
        }

        DB::table($user_table)
            ->where($idColumn, $user_id)
            ->update($updateData);

        Log::info('Password reset successful', [
            'user_table' => $user_table,
            'user_id' => $user_id
        ]);

        return redirect()->route('login')->with('status', 'Password reset successfully! You can now log in with your new password.');
    }

    // Helper: Get ID column name for each table
    protected function getIdColumn($table)
    {
        return match($table) {
            'donor' => 'dn_ID',
            'parent' => 'pr_ID',
            'doctor' => 'dr_ID',
            'nurse' => 'ns_ID',
            'labtech' => 'lt_ID',
            'hmmcadmin' => 'ad_Admin',
            'shariahcomittee' => 'sc_ID',
            default => 'id'
        };
    }

    // Helper: Get password column name for each table
    protected function getPasswordColumn($table)
    {
        return match($table) {
            'donor' => 'dn_Password',
            'parent' => 'pr_Password',
            'doctor' => 'dr_Password',
            'nurse' => 'ns_Password',
            'labtech' => 'lt_Password',
            'hmmcadmin' => 'ad_Password',
            'shariahcomittee' => 'sc_Password',
            default => 'password'
        };
    }

    // Helper: find user by email/contact
    protected function findUser($email = null, $contact = null)
    {
        Log::info('Finding user', ['email' => $email, 'contact' => $contact]);

        $tables = [
            'donor' => [
                'email' => 'dn_Email',
                'contact' => 'dn_Contact',
                'id' => 'dn_ID'
            ],
            'parent' => [
                'email' => 'pr_Email',
                'contact' => 'pr_Contact',
                'id' => 'pr_ID'
            ],
            'doctor' => [
                'email' => 'dr_Email',
                'contact' => 'dr_Contact',
                'id' => 'dr_ID'
            ],
            'nurse' => [
                'email' => 'ns_Email',
                'contact' => 'ns_Contact',
                'id' => 'ns_ID'
            ],
            'labtech' => [
                'email' => 'lt_Email',
                'contact' => 'lt_Contact',
                'id' => 'lt_ID'
            ],
            'hmmcadmin' => [
                'email' => 'ad_Email',
                'contact' => 'ad_Contact',
                'id' => 'ad_Admin'
            ],
            'shariahcomittee' => [
                'email' => 'sc_Email',
                'contact' => 'sc_Contact',
                'id' => 'sc_ID'
            ],
        ];

        foreach ($tables as $table => $cols) {
            $query = DB::table($table);
            
            if ($email && isset($cols['email'])) {
                $query->where($cols['email'], $email);
            } elseif ($contact && isset($cols['contact'])) {
                $query->where($cols['contact'], $contact);
            }
            
            $user = $query->first();
            
            if ($user) {
                Log::info('User found in table: ' . $table);
                $user->table = $table;
                $user->id = $user->{$cols['id']};
                return $user;
            }
        }

        Log::warning('User not found in any table');
        return null;
    }
}