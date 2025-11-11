@extends('layouts.labtech')

@section('title', 'Lab Technician Profile')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/labtech_profile.css') }}">
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
                        <div class="avatar-circle">LT</div>
                    </div>
                    <h2 class="profile-name">Lab Tech Rania</h2>
                    <p class="profile-role">Laboratory Technician</p>
                    <p class="profile-registered">Registered since January 2024</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $samplesTested ?? 342 }}</div>
                            <div class="stat-label">SAMPLES TESTED</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $batchesProcessed ?? 128 }}</div>
                            <div class="stat-label">BATCHES PROCESSED</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-vial"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">SAMPLES TESTED</div>
                            <div class="stat-number">{{ $samplesTested ?? 342 }}</div>
                            <div class="stat-change positive">↑ 25 this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-industry"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">BATCHES PROCESSED</div>
                            <div class="stat-number">{{ $batchesProcessed ?? 128 }}</div>
                            <div class="stat-change positive">↑ 8 this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">QUALITY CHECKS</div>
                            <div class="stat-number">{{ $qualityChecks ?? 456 }}</div>
                            <div class="stat-change current">98% pass rate</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">TECHNICIAN LEVEL</div>
                            <div class="stat-number">Senior Technician</div>
                            <div class="stat-change">3 years experience</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="profile-content">
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Professional Information</h3>
                        <a href="{{ route('labtech.edit-profile') }}" class="btn-edit">
                            Edit Profile
                        </a>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>FULL NAME</label>
                            <p>Lab Tech Rania</p>
                        </div>
                        <div class="info-item">
                            <label>EMAIL</label>
                            <p>r.technician@email.com</p>
                        </div>
                        <div class="info-item">
                            <label>PHONE</label>
                            <p>011-45678901</p>
                        </div>
                        <div class="info-item">
                            <label>EMPLOYEE ID</label>
                            <p>LT-2024-078</p>
                        </div>
                        <div class="info-item">
                            <label>LABORATORY</label>
                            <p>Milk Quality Control Lab</p>
                        </div>
                        <div class="info-item">
                            <label>SHIFT</label>
                            <p>Day Shift (7:00 AM - 3:00 PM)</p>
                        </div>
                        <div class="info-item">
                            <label>EMERGENCY CONTACT</label>
                            <p>Omar Rania (Spouse) +1 (555) 234-5678</p>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Specialization & Qualifications</h3>
                    <div class="qualifications">
                        <div class="qualification-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Bachelor of Medical Laboratory Science</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Certified Laboratory Technician</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Food Safety and Quality Control</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Milk Banking Laboratory Specialist</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Lab Activities -->
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Recent Lab Activities</h3>
                        <div class="section-actions">
                            <button class="btn-icon"><i class="fas fa-search"></i> Search</button>
                            <button class="btn-icon"><i class="fas fa-filter"></i> Filter</button>
                            <button class="btn-icon"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>

                    <div class="tabs">
                        <button class="tab active">All Tests <span class="badge">{{ $totalTests ?? 56 }}</span></button>
                        <button class="tab">Today <span class="badge">{{ $todayTests ?? 12 }}</span></button>
                        <button class="tab">Pending <span class="badge">{{ $pendingTests ?? 4 }}</span></button>
                    </div>

                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>BATCH ID</th>
                                <th>TEST TYPE</th>
                                <th>STATUS</th>
                                <th>RESULT</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>May 15, 2024</td>
                                <td>#MB-2024-129</td>
                                <td>Microbiology</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Pass</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>May 15, 2024</td>
                                <td>#MB-2024-128</td>
                                <td>Nutritional Analysis</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Within Range</td>
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