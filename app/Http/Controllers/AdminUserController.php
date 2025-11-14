<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    private $roleConfig = [
        'parent' => ['table' => 'parent', 'prefix' => 'pr', 'id_field' => 'pr_ID'],
        'doctor' => ['table' => 'doctor', 'prefix' => 'dr', 'id_field' => 'dr_ID'],
        'nurse' => ['table' => 'nurse', 'prefix' => 'ns', 'id_field' => 'ns_ID'],
        'labtech' => ['table' => 'labtech', 'prefix' => 'lt', 'id_field' => 'lt_ID'],
        'shariah' => ['table' => 'shariahcomittee', 'prefix' => 'sc', 'id_field' => 'sc_ID'],
        'admin' => ['table' => 'hmmcadmin', 'prefix' => 'ad', 'id_field' => 'ad_Admin'],
        'donor' => ['table' => 'donor', 'prefix' => 'dn', 'id_field' => 'dn_ID']
    ];

    /**
     * Display user details
     */
    public function show($role, $id)
    {
        if (!isset($this->roleConfig[$role])) {
            abort(404, 'Invalid role');
        }

        $config = $this->roleConfig[$role];
        $user = DB::table($config['table'])
            ->where($config['id_field'], $id)
            ->first();

        if (!$user) {
            abort(404, 'User not found');
        }

        $formattedUser = $this->formatUser($user, $role, $config['prefix']);

        return view('hmmc.admin_view-user', [
            'user' => $formattedUser,
            'role' => $role
        ]);
    }

    /**
     * Show edit form
     */
    public function edit($role, $id)
    {
        if (!isset($this->roleConfig[$role])) {
            abort(404, 'Invalid role');
        }

        $config = $this->roleConfig[$role];
        $user = DB::table($config['table'])
            ->where($config['id_field'], $id)
            ->first();

        if (!$user) {
            abort(404, 'User not found');
        }

        $formattedUser = $this->formatUser($user, $role, $config['prefix']);

        return view('hmmc.admin_edit-user', [
            'user' => $formattedUser,
            'role' => $role
        ]);
    }

    /**
     * Update user
     */
    public function update(Request $request, $role, $id)
    {
        if (!isset($this->roleConfig[$role])) {
            abort(404, 'Invalid role');
        }

        $config = $this->roleConfig[$role];
        $prefix = $config['prefix'];

        // Base validation
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ];

        // Role-specific validation
        if (in_array($role, ['doctor', 'nurse', 'labtech', 'shariah'])) {
            $rules = array_merge($rules, [
                'qualification' => 'nullable|string|max:255',
                'certification' => 'nullable|string|max:255',
                'institution' => 'nullable|string|max:255',
                'specialization' => 'nullable|string|max:255',
                'experience' => 'nullable|integer|min:0',
            ]);
        }

        if ($role === 'parent') {
            $rules = array_merge($rules, [
                'baby_name' => 'nullable|string|max:255',
                'baby_dob' => 'nullable|date',
                'baby_gender' => 'nullable|in:Male,Female',
                'baby_birth_weight' => 'nullable|numeric',
                'baby_current_weight' => 'nullable|numeric',
            ]);
        }

        if ($role === 'donor') {
            $rules = array_merge($rules, [
                'dob' => 'nullable|date',
                'infection_risk' => 'nullable|string|max:500',
                'medication' => 'nullable|string|max:500',
                'recent_illness' => 'nullable|string|max:500',
                'tobacco_alcohol' => 'nullable|boolean',
                'dietary_alerts' => 'nullable|string|max:500',
            ]);
        }

        // Password is optional
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $validated = $request->validate($rules);

        try {
            // Prepare update data
            $updateData = $this->prepareUpdateData($validated, $role, $prefix);

            // Add password if provided
            if ($request->filled('password')) {
                $updateData["{$prefix}_Password"] = Hash::make($request->password);
            }

            // Update user
            DB::table($config['table'])
                ->where($config['id_field'], $id)
                ->update($updateData);

            // Update users table if exists
            $email = $role === 'donor' ? $validated['name'] : $validated['email'];
            DB::table('users')
                ->where('role', $role)
                ->where('role_id', $id)
                ->update([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'updated_at' => now()
                ]);

            return redirect()
                ->route('hmmc.manage-users')
                ->with('success', ucfirst($role) . ' updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Admin user update error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    /**
     * Delete user
     */
    public function destroy($role, $id)
    {
        if (!isset($this->roleConfig[$role])) {
            return response()->json(['error' => 'Invalid role'], 404);
        }

        $config = $this->roleConfig[$role];

        try {
            // Delete from role-specific table
            DB::table($config['table'])
                ->where($config['id_field'], $id)
                ->delete();

            // Delete from users table
            DB::table('users')
                ->where('role', $role)
                ->where('role_id', $id)
                ->delete();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            \Log::error('Admin user delete error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Format user data
     */
    private function formatUser($user, $role, $prefix)
    {
        $formatted = [
            'id' => $user->{$prefix === 'ad' ? "{$prefix}_Admin" : "{$prefix}_ID"},
            'nric' => $user->{"{$prefix}_NRIC"} ?? null,
            'username' => $user->{"{$prefix}_Username"} ?? null,
            'email' => $user->{"{$prefix}_Email"} ?? null,
            'contact' => $user->{"{$prefix}_Contact"} ?? null,
            'address' => $user->{"{$prefix}_Address"} ?? null,
            'created_at' => $user->created_at ?? null,
        ];

        // Name field
        if ($role === 'donor') {
            $formatted['name'] = $user->{"{$prefix}_FullName"} ?? null;
        } else {
            $formatted['name'] = $user->{"{$prefix}_Name"} ?? null;
        }

        // Staff fields
        if (in_array($role, ['doctor', 'nurse', 'labtech', 'shariah', 'admin'])) {
            $formatted['qualification'] = $user->{"{$prefix}_Qualification"} ?? null;
            $formatted['certification'] = $user->{"{$prefix}_Certification"} ?? null;
            $formatted['institution'] = $user->{"{$prefix}_Institution"} ?? null;
            $formatted['specialization'] = $user->{"{$prefix}_Specialization"} ?? null;
            $formatted['experience'] = $user->{"{$prefix}_YearsOfExperience"} ?? 0;
        }

        // Parent fields
        if ($role === 'parent') {
            $formatted['baby_name'] = $user->pr_BabyName ?? null;
            $formatted['baby_dob'] = $user->pr_BabyDOB ?? null;
            $formatted['baby_gender'] = $user->pr_BabyGender ?? null;
            $formatted['baby_birth_weight'] = $user->pr_BabyBirthWeight ?? null;
            $formatted['baby_current_weight'] = $user->pr_BabyCurrentWeight ?? null;
        }

        // Donor fields
        if ($role === 'donor') {
            $formatted['dob'] = $user->dn_DOB ?? null;
            $formatted['infection_risk'] = $user->dn_InfectionDeseaseRisk ?? null;
            $formatted['medication'] = $user->dn_Medication ?? null;
            $formatted['recent_illness'] = $user->dn_RecentIllness ?? null;
            $formatted['tobacco_alcohol'] = $user->dn_TobaccoAlcohol ?? false;
            $formatted['dietary_alerts'] = $user->dn_DietaryAlerts ?? null;
        }

        // Admin fields
        if ($role === 'admin') {
            $formatted['gender'] = $user->ad_Gender ?? null;
        }

        return (object) $formatted;
    }

    /**
     * Prepare update data
     */
    private function prepareUpdateData($validated, $role, $prefix)
    {
        $updateData = [
            "{$prefix}_Email" => $validated['email'],
            "{$prefix}_Contact" => $validated['contact'] ?? null,
            "{$prefix}_Address" => $validated['address'] ?? null,
            'updated_at' => now()
        ];

        // Name field
        if ($role === 'donor') {
            $updateData["{$prefix}_FullName"] = $validated['name'];
        } else {
            $updateData["{$prefix}_Name"] = $validated['name'];
        }

        // Staff fields
        if (in_array($role, ['doctor', 'nurse', 'labtech', 'shariah'])) {
            $updateData["{$prefix}_Qualification"] = $validated['qualification'] ?? null;
            $updateData["{$prefix}_Certification"] = $validated['certification'] ?? null;
            $updateData["{$prefix}_Institution"] = $validated['institution'] ?? null;
            $updateData["{$prefix}_Specialization"] = $validated['specialization'] ?? null;
            $updateData["{$prefix}_YearsOfExperience"] = $validated['experience'] ?? 0;
        }

        // Parent fields
        if ($role === 'parent') {
            $updateData['pr_BabyName'] = $validated['baby_name'] ?? null;
            $updateData['pr_BabyDOB'] = $validated['baby_dob'] ?? null;
            $updateData['pr_BabyGender'] = $validated['baby_gender'] ?? null;
            $updateData['pr_BabyBirthWeight'] = $validated['baby_birth_weight'] ?? null;
            $updateData['pr_BabyCurrentWeight'] = $validated['baby_current_weight'] ?? null;
        }

        // Donor fields
        if ($role === 'donor') {
            $updateData['dn_DOB'] = $validated['dob'] ?? null;
            $updateData['dn_InfectionDeseaseRisk'] = $validated['infection_risk'] ?? null;
            $updateData['dn_Medication'] = $validated['medication'] ?? null;
            $updateData['dn_RecentIllness'] = $validated['recent_illness'] ?? null;
            $updateData['dn_TobaccoAlcohol'] = $validated['tobacco_alcohol'] ?? false;
            $updateData['dn_DietaryAlerts'] = $validated['dietary_alerts'] ?? null;
        }

        return $updateData;
    }
}