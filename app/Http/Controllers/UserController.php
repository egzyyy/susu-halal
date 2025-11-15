<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use App\Models\LabTech;
use App\Models\Doctor;
use App\Models\ShariahCommittee;
use App\Models\Nurse;
use App\Models\HmmcAdmin;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $roles = [
        'parent', 'shariah', 'nurse', 'doctor', 'labtech', 'admin', 'donor'
    ];

    // Map role to table config
    private $roleConfig = [
        'parent' => ['table' => 'parent', 'prefix' => 'pr', 'id_field' => 'pr_ID'],
        'doctor' => ['table' => 'doctor', 'prefix' => 'dr', 'id_field' => 'dr_ID'],
        'nurse' => ['table' => 'nurse', 'prefix' => 'ns', 'id_field' => 'ns_ID'],
        'labtech' => ['table' => 'labtech', 'prefix' => 'lt', 'id_field' => 'lt_ID'],
        'shariah' => ['table' => 'shariahcomittee', 'prefix' => 'sc', 'id_field' => 'sc_ID'],
        'admin' => ['table' => 'hmmcadmin', 'prefix' => 'ad', 'id_field' => 'ad_Admin'],
        'donor' => ['table' => 'donor', 'prefix' => 'dn', 'id_field' => 'dn_ID']
    ];

    public function index()
    {
        // Get users from all tables first
        $parents = DB::table('parent')->get();
        $doctors = DB::table('doctor')->get();
        $nurses = DB::table('nurse')->get();
        $labtechs = DB::table('labtech')->get();
        $shariahs = DB::table('shariahcomittee')->get();
        $admins = DB::table('hmmcadmin')->get();
        $donors = DB::table('donor')->get();

        // Format and merge all users
        $allUsers = collect();
        $allUsers = $allUsers->merge($this->formatUsers($parents, 'parent', 'pr'));
        $allUsers = $allUsers->merge($this->formatUsers($doctors, 'doctor', 'dr'));
        $allUsers = $allUsers->merge($this->formatUsers($nurses, 'nurse', 'ns'));
        $allUsers = $allUsers->merge($this->formatUsers($labtechs, 'labtech', 'lt'));
        $allUsers = $allUsers->merge($this->formatUsers($shariahs, 'shariah', 'sc'));
        $allUsers = $allUsers->merge($this->formatUsers($admins, 'admin', 'ad'));
        $allUsers = $allUsers->merge($this->formatUsers($donors, 'donor', 'dn'));

        $totalUsers = $allUsers->count();

        return view('hmmc.hmmc_manage-users', [
            'allUsers' => $allUsers,
            'totalUsers' => $totalUsers,
            'donors' => $donors,
            'parents' => $parents,
            'doctors' => $doctors,
            'nurses' => $nurses,
            'labtechs' => $labtechs,
            'shariahs' => $shariahs,
            'admins' => $admins
        ]);
    }
        /**
     * Display user details (Admin view)
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

        $formattedUser = $this->formatUserForAdmin($user, $role, $config['prefix']);

        return view('hmmc.admin_view-user', [
            'user' => $formattedUser,
            'role' => $role
        ]);
    }

    /**
     * Show edit form for specific user (Admin)
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

        $formattedUser = $this->formatUserForAdmin($user, $role, $config['prefix']);

        return view('hmmc.admin_edit-user', [
            'user' => $formattedUser,
            'role' => $role
        ]);
    }

    /**
     * Update specific user (Admin)
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

        // Password is optional for admin edits
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $validated = $request->validate($rules);

        try {
            // Prepare update data
            $updateData = $this->prepareUserUpdateData($validated, $role, $prefix);

            // Add password if provided
            if ($request->filled('password')) {
                $updateData["{$prefix}_Password"] = Hash::make($request->password);
            }

            $updateData['updated_at'] = now();

            // Update user in role-specific table
            DB::table($config['table'])
                ->where($config['id_field'], $id)
                ->update($updateData);

            // Update users table if exists
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
            \Log::error('User update error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    /**
     * Delete user (Admin)
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
            \Log::error('User delete error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Format user data for admin views
     */
    private function formatUserForAdmin($user, $role, $prefix)
    {
        $idField = $prefix === 'ad' ? "{$prefix}_Admin" : "{$prefix}_ID";
        
        $formatted = [
            'id' => $user->$idField,
            'nric' => $user->{"{$prefix}_NRIC"} ?? null,
            'username' => $user->{"{$prefix}_Username"} ?? null,
            'email' => $user->{"{$prefix}_Email"} ?? null,
            'contact' => $user->{"{$prefix}_Contact"} ?? null,
            'address' => $user->{"{$prefix}_Address"} ?? null,
            'created_at' => $user->created_at ?? null,
        ];

        // Name field (different for donor)
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
     * Prepare update data for user editing
     */
    private function prepareUserUpdateData($validated, $role, $prefix)
    {
        $updateData = [
            "{$prefix}_Email" => $validated['email'],
            "{$prefix}_Contact" => $validated['contact'] ?? null,
            "{$prefix}_Address" => $validated['address'] ?? null,
        ];

        // Name field (different for donor)
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

        /**
     * Format users from different tables to consistent structure
     */
    private function formatUsers($users, $role, $prefix)
    {
        return $users->map(function ($user) use ($role, $prefix) {
            // Get ID field based on prefix
            $idField = $prefix === 'ad' ? "{$prefix}_Admin" : "{$prefix}_ID";
            
            // Special handling for donor name field
            $nameField = $role === 'donor' ? "{$prefix}_FullName" : "{$prefix}_Name";
            
            // Get field values safely
            $id = $user->$idField ?? null;
            $name = $user->$nameField ?? 'N/A';
            $email = property_exists($user, "{$prefix}_Email") ? $user->{"{$prefix}_Email"} : 'N/A';
            $username = property_exists($user, "{$prefix}_Username") ? $user->{"{$prefix}_Username"} : 'N/A';
            $contact = property_exists($user, "{$prefix}_Contact") ? $user->{"{$prefix}_Contact"} : 'N/A';
            
            return (object)[
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'contact' => $contact,
                'role' => $role,
                'status' => 'active', // Default status - you can add logic here
                'last_login' => $user->last_login_at ?? null,
                'created_at' => $user->created_at ?? now(),
                'original_id' => $id,
                'original_table' => $role
            ];
        });
    }

    public function create($role)
    {
        if (!in_array($role, $this->roles)) {
            abort(404, 'Invalid role');
        }
        return view('hmmc.hmmc_create-new-user', compact('role'));
    }

    public function store(Request $request)
    {
        \Log::info('Store method called', $request->all());
        
        $role = $request->input('role');

        if (!in_array($role, $this->roles)) {
            abort(400, 'Invalid role');
        }

        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email',
                'username' => 'required|string',
                'password' => 'required|string|min:6',
                'nric'     => 'required_if:role,admin,doctor,labtech,shariah,nurse,parent,donor|string|max:20',
            ]);

            \Log::info('Validation passed');

            $password = Hash::make($request->input('password'));

            switch ($role) {
                case 'admin':
                    DB::table('hmmcadmin')->insert([
                        'ad_Name'     => $request->name,
                        'ad_NRIC'     => $request->nric,
                        'ad_Username' => $request->username,
                        'ad_Password' => $password,
                        'ad_Email'    => $request->email,
                        'ad_Contact'  => $request->contact ?? null,
                        'ad_Address'  => $request->address ?? null,
                        'ad_Gender'   => $request->gender ?? null,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                    break;

                case 'doctor':
                    DB::table('doctor')->insert([
                        'dr_Name'          => $request->name,
                        'dr_NRIC'          => $request->nric,
                        'dr_Username'      => $request->username,
                        'dr_Password'      => $password,
                        'dr_Email'         => $request->email,
                        'dr_Contact'       => $request->contact ?? null,
                        'dr_Address'       => $request->address ?? null,
                        'dr_Qualification' => $request->qualification ?? null,
                        'dr_Certification' => $request->certification ?? null,
                        'dr_Institution'   => $request->institution ?? null,
                        'dr_Specialization'=> $request->specialization ?? null,
                        'dr_YearsOfExperience' => $request->experience ?? 0,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);
                    break;

                case 'nurse':
                    DB::table('nurse')->insert([
                        'ns_Name'          => $request->name,
                        'ns_NRIC'          => $request->nric,
                        'ns_Username'      => $request->username,
                        'ns_Password'      => $password,
                        'ns_Email'         => $request->email,
                        'ns_Contact'       => $request->contact ?? null,
                        'ns_Address'       => $request->address ?? null,
                        'ns_Qualification' => $request->qualification ?? null,
                        'ns_Certification' => $request->certification ?? null,
                        'ns_Institution'   => $request->institution ?? null,
                        'ns_Specialization'=> $request->specialization ?? null,
                        'ns_YearsOfExperience' => $request->experience ?? 0,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);
                    break;

                case 'labtech':
                    DB::table('labtech')->insert([
                        'lt_Name'          => $request->name,
                        'lt_NRIC'          => $request->nric,
                        'lt_Username'      => $request->username,
                        'lt_Password'      => $password,
                        'lt_Email'         => $request->email,
                        'lt_Contact'       => $request->contact ?? null,
                        'lt_Address'       => $request->address ?? null,
                        'lt_Qualification' => $request->qualification ?? null,
                        'lt_Certification' => $request->certification ?? null,
                        'lt_Institution'   => $request->institution ?? null,
                        'lt_Specialization'=> $request->specialization ?? null,
                        'lt_YearsOfExperience' => $request->experience ?? 0,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);
                    break;

                case 'shariah':
                    DB::table('shariahcomittee')->insert([
                        'sc_Name'          => $request->name,
                        'sc_NRIC'          => $request->nric,
                        'sc_Username'      => $request->username,
                        'sc_Password'      => $password,
                        'sc_Email'         => $request->email,
                        'sc_Contact'       => $request->contact ?? null,
                        'sc_Address'       => $request->address ?? null,
                        'sc_Qualification' => $request->qualification ?? null,
                        'sc_Certification' => $request->certification ?? null,
                        'sc_Institution'   => $request->institution ?? null,
                        'sc_Specialization'=> $request->specialization ?? null,
                        'sc_YearsOfExperience' => $request->experience ?? 0,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);
                    break;

                case 'parent':
                    DB::table('parent')->insert([
                        'pr_Name'              => $request->name,
                        'pr_NRIC'              => $request->nric,
                        'pr_Username'          => $request->username, // ADDED THIS
                        'pr_Password'          => $password,
                        'pr_Email'             => $request->email,
                        'pr_Address'           => $request->address ?? null,
                        'pr_Contact'           => $request->contact ?? null,
                        'pr_BabyName'          => $request->baby_name ?? null,
                        'pr_BabyDOB'           => $request->baby_dob ?? null,
                        'pr_BabyGender'        => $request->baby_gender ?? null,
                        'pr_BabyBirthWeight'   => $request->baby_birth_weight ?? null,
                        'pr_BabyCurrentWeight' => $request->baby_current_weight ?? null,
                        'created_at'           => now(),
                        'updated_at'           => now(),
                    ]);
                    break;

                case 'donor':
                    DB::table('donor')->insert([
                        'dn_FullName'            => $request->name,
                        'dn_NRIC'               => $request->nric,
                        'dn_Username'           => $request->username,
                        'dn_Password'           => $password,
                        'dn_Email'              => $request->email,
                        'dn_Contact'            => $request->contact ?? null,
                        'dn_Address'            => $request->address ?? null,
                        'dn_DOB'                => $request->dob ?? null,
                        'dn_InfectionDeseaseRisk' => $request->infection_risk ?? null,
                        'dn_Medication'         => $request->medication ?? null,
                        'dn_RecentIllness'      => $request->recent_illness ?? null,
                        'dn_TobaccoAlcohol'     => $request->tobacco_alcohol ?? false,
                        'dn_DietaryAlerts'      => $request->dietary_alerts ?? null,
                        'created_at'            => now(),
                        'updated_at'            => now(),
                    ]);
                    break;
            }

            \Log::info('User saved successfully');

            return redirect()->route('hmmc.manage-users')
                     ->with('success', ucfirst($role) . ' created successfully!');

        } catch (\Exception $e) {
            \Log::error('Error saving user: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return back()->withInput()->with('error', 'Error creating user: ' . $e->getMessage());
        }
    }
}



