@extends('layouts.hmmc')

@section('title', 'Create New User')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/hmmc_create-new-user.css') }}">

<div class="main-content">
    <div class="page-header">
        <h1>Create New {{ ucfirst($role) }} User</h1>
    </div>

    <div class="create-user-container">
        <form class="create-user-form" method="POST" action="{{ route('hmmc.users.store') }}">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">

            <!-- Role Badge -->
            <div class="role-badge-section">
                <div class="selected-role-badge {{ $role }}">
                    <i class="fas fa-{{ getRoleIcon($role) }}"></i>
                    <span>{{ ucfirst($role) }}</span>
                </div>
            </div>

            {{-- ====================== COMMON PERSONAL INFORMATION ====================== --}}
            <div class="form-section">
                <h3 class="section-title"><i class="fas fa-user"></i> Personal Information</h3>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Full Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact Number <span class="required">*</span></label>
                        <input type="tel" name="contact" id="contact" class="form-control" placeholder="e.g., +60 12-3456789" required>
                    </div>

                    {{-- For LabTech only --}}
                    @if($role === 'labtech')
                    <div class="form-group">
                        <label for="nric">NRIC <span class="required">*</span></label>
                        <input type="text" name="nric" id="nric" class="form-control" placeholder="Enter NRIC" required>
                    </div>
                    @endif

                    <div class="form-group full-width">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter full address"></textarea>
                    </div>
                </div>
            </div>

            {{-- ====================== PROFESSIONAL INFORMATION ====================== --}}
            @if(in_array($role, ['doctor','nurse','clinician','labtech','shariah']))
            <div class="form-section">
                <h3 class="section-title"><i class="fas fa-briefcase"></i> Professional Information</h3>
                <div class="form-grid">

                    @if($role === 'labtech')
                    <div class="form-group">
                        <label for="institution">Institution <span class="required">*</span></label>
                        <input type="text" name="institution" id="institution" class="form-control" placeholder="Enter institution name">
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="department">Department / Unit</label>
                        <select name="department" id="department" class="form-control">
                            <option value="">Select department</option>
                            <option value="pediatrics">Pediatrics</option>
                            <option value="nicu">NICU</option>
                            <option value="maternity">Maternity</option>
                            <option value="lactation">Lactation Services</option>
                            <option value="laboratory">Laboratory</option>
                            <option value="shariah">Shariah Committee</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="qualification">Qualification <span class="required">*</span></label>
                        <input type="text" name="qualification" id="qualification" class="form-control" placeholder="Enter qualification" required>
                    </div>

                    @if($role === 'labtech')
                    <div class="form-group">
                        <label for="certification">Certification</label>
                        <input type="text" name="certification" id="certification" class="form-control" placeholder="Enter certification">
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="specialization">Specialization <span class="required">*</span></label>
                        <input type="text" name="specialization" id="specialization" class="form-control" placeholder="Enter specialization">
                    </div>

                    <div class="form-group">
                        <label for="experience">Years of Experience</label>
                        <input type="number" name="experience" id="experience" class="form-control" placeholder="0">
                    </div>
                </div>
            </div>
            @endif

            {{-- ====================== ACCOUNT SETTINGS ====================== --}}
            <div class="form-section">
                <h3 class="section-title"><i class="fas fa-key"></i> Account Settings</h3>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="username">Username <span class="required">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Temporary Password <span class="required">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                    </div>

                    <div class="form-group full-width">
                        <label>Account Status</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="status" value="active" checked> <span>Active</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="status" value="pending"> <span>Pending</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====================== SUBMIT ====================== --}}
            <div class="form-actions">
                <a href="{{ route('hmmc.manage-users') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn-create">
                    <i class="fas fa-check"></i> Create User
                </button>
            </div>
        </form>
    </div>
</div>

@php
function getRoleIcon($role) {
    return [
        'doctor' => 'stethoscope',
        'nurse' => 'user-nurse',
        'clinician' => 'user-doctor',
        'labtech' => 'flask',
        'shariah' => 'book-quran',
        'admin' => 'user-shield'
    ][$role] ?? 'user';
}
@endphp
@endsection
