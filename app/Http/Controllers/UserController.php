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
        'parent' => ['table' => 'parent', 'prefix' => 'pr'],
        'doctor' => ['table' => 'doctor', 'prefix' => 'dr'],
        'nurse' => ['table' => 'nurse', 'prefix' => 'ns'],
        'labtech' => ['table' => 'labtech', 'prefix' => 'lt'],
        'shariah' => ['table' => 'shariahcomittee', 'prefix' => 'sc'],
        'admin' => ['table' => 'hmmcadmin', 'prefix' => 'ad'],
        'donor' => ['table' => 'donor', 'prefix' => 'dn']
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