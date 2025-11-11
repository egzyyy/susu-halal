@extends('layouts.doctor')

@section('title', 'Doctor Profile')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/doctor_profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="main-content">
        <div class="page-header">
            <h1>My Profile</h1>
        </div>

        <div class="profile-container">
            <!-- Left Sidebar Profile Card -->
            <div class="profile-sidebar">
                <div class="profile-card">
                    <div class="profile-avatar">
                        <div class="avatar-circle">DA</div>
                    </div>
                    <h2 class="profile-name">Dr. Ahmed</h2>
                    <p class="profile-role">Medical Doctor</p>
                    <p class="profile-registered">Registered since January 2024</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $patientsReviewed ?? 89 }}</div>
                            <div class="stat-label">PATIENTS REVIEWED</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $medicalApprovals ?? 156 }}</div>
                            <div class="stat-label">MEDICAL APPROVALS</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">PATIENTS REVIEWED</div>
                            <div class="stat-number">{{ $patientsReviewed ?? 89 }}</div>
                            <div class="stat-change positive">↑ 8 this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">MEDICAL APPROVALS</div>
                            <div class="stat-number">{{ $medicalApprovals ?? 156 }}</div>
                            <div class="stat-change positive">↑ 12 this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">CONSULTATIONS</div>
                            <div class="stat-number">{{ $consultations ?? 203 }}</div>
                            <div class="stat-change current">15 this week</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">DOCTOR LEVEL</div>
                            <div class="stat-number">Senior Doctor</div>
                            <div class="stat-change">5 years experience</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="profile-content">
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Professional Information</h3>
                        <a href="{{ route('doctor.edit-profile') }}" class="btn-edit">
                            Edit Profile
                        </a>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>FULL NAME</label>
                            <p>Dr. Ahmed</p>
                        </div>
                        <div class="info-item">
                            <label>EMAIL</label>
                            <p>dr.ahmed@email.com</p>
                        </div>
                        <div class="info-item">
                            <label>PHONE</label>
                            <p>011-34567890</p>
                        </div>
                        <div class="info-item">
                            <label>MEDICAL LICENSE</label>
                            <p>MD-2024-045</p>
                        </div>
                        <div class="info-item">
                            <label>SPECIALIZATION</label>
                            <p>Pediatrics & Lactation Medicine</p>
                        </div>
                        <div class="info-item">
                            <label>HOSPITAL AFFILIATION</label>
                            <p>Medina Medical Center</p>
                        </div>
                        <div class="info-item">
                            <label>EMERGENCY CONTACT</label>
                            <p>Sarah Ahmed (Spouse) +1 (555) 123-4567</p>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Specialization & Qualifications</h3>
                    <div class="qualifications">
                        <div class="qualification-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Doctor of Medicine (MD)</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Board Certified Pediatrician</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Lactation Medicine Specialist</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Milk Bank Medical Director</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Medical Reviews -->
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Recent Medical Reviews</h3>
                        <div class="section-actions">
                            <button class="btn-icon"><i class="fas fa-search"></i> Search</button>
                            <button class="btn-icon"><i class="fas fa-filter"></i> Filter</button>
                            <button class="btn-icon"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>

                    <div class="tabs">
                        <button class="tab active">All Reviews <span class="badge">{{ $totalReviews ?? 45 }}</span></button>
                        <button class="tab">This Week <span class="badge">{{ $weekReviews ?? 8 }}</span></button>
                        <button class="tab">Pending <span class="badge">{{ $pendingReviews ?? 3 }}</span></button>
                    </div>

                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>PATIENT</th>
                                <th>REVIEW TYPE</th>
                                <th>STATUS</th>
                                <th>RECOMMENDATION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>May 15, 2024</td>
                                <td>Sarah Ahmad</td>
                                <td>Donor Screening</td>
                                <td><span class="status-badge completed">Approved</span></td>
                                <td>Cleared for donation</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>May 14, 2024</td>
                                <td>Fatima Khan</td>
                                <td>Medical Clearance</td>
                                <td><span class="status-badge completed">Approved</span></td>
                                <td>Conditional approval</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection