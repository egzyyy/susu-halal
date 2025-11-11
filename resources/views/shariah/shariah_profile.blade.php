@extends('layouts.shariah')

@section('title', 'Shariah Advisor Profile')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/shariah_profile.css') }}">
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
                        <div class="avatar-circle">SA</div>
                    </div>
                    <h2 class="profile-name">Ustaz Ahmad</h2>
                    <p class="profile-role">Shariah Advisor</p>
                    <p class="profile-registered">Registered since January 2024</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $casesReviewed ?? 67 }}</div>
                            <div class="stat-label">CASES REVIEWED</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $fatwaIssued ?? 23 }}</div>
                            <div class="stat-label">FATWA ISSUED</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-scale-balanced"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">CASES REVIEWED</div>
                            <div class="stat-number">{{ $casesReviewed ?? 67 }}</div>
                            <div class="stat-change positive">↑ 5 this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">FATWA ISSUED</div>
                            <div class="stat-number">{{ $fatwaIssued ?? 23 }}</div>
                            <div class="stat-change positive">↑ 2 this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">COMPLIANCE RATE</div>
                            <div class="stat-number">98%</div>
                            <div class="stat-change current">Excellent</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">ADVISOR LEVEL</div>
                            <div class="stat-number">Senior Advisor</div>
                            <div class="stat-change">4 years experience</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="profile-content">
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Professional Information</h3>
                        <a href="{{ route('shariah.edit-profile') }}" class="btn-edit">
                            Edit Profile
                        </a>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>FULL NAME</label>
                            <p>Ustaz Ahmad</p>
                        </div>
                        <div class="info-item">
                            <label>EMAIL</label>
                            <p>ustaz.ahmad@email.com</p>
                        </div>
                        <div class="info-item">
                            <label>PHONE</label>
                            <p>011-56789012</p>
                        </div>
                        <div class="info-item">
                            <label>ADVISOR ID</label>
                            <p>SHA-2024-032</p>
                        </div>
                        <div class="info-item">
                            <label>SPECIALIZATION</label>
                            <p>Islamic Family Law & Medical Ethics</p>
                        </div>
                        <div class="info-item">
                            <label>INSTITUTION</label>
                            <p>Islamic Medical Ethics Board</p>
                        </div>
                        <div class="info-item">
                            <label>EMERGENCY CONTACT</label>
                            <p>Fatima Ahmad (Spouse) +1 (555) 345-6789</p>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Specialization & Qualifications</h3>
                    <div class="qualifications">
                        <div class="qualification-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Bachelor of Islamic Law and Jurisprudence</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Certified Shariah Advisor</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Islamic Medical Ethics Specialist</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Milk Kinship and Family Law Expert</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Shariah Reviews -->
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Recent Shariah Reviews</h3>
                        <div class="section-actions">
                            <button class="btn-icon"><i class="fas fa-search"></i> Search</button>
                            <button class="btn-icon"><i class="fas fa-filter"></i> Filter</button>
                            <button class="btn-icon"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>

                    <div class="tabs">
                        <button class="tab active">All Cases <span class="badge">{{ $totalCases ?? 34 }}</span></button>
                        <button class="tab">This Week <span class="badge">{{ $weekCases ?? 6 }}</span></button>
                        <button class="tab">Pending <span class="badge">{{ $pendingCases ?? 2 }}</span></button>
                    </div>

                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>CASE ID</th>
                                <th>CASE TYPE</th>
                                <th>STATUS</th>
                                <th>DECISION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>May 15, 2024</td>
                                <td>#MK-2024-015</td>
                                <td>Milk Kinship</td>
                                <td><span class="status-badge completed">Approved</span></td>
                                <td>Compliant</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>May 14, 2024</td>
                                <td>#DR-2024-042</td>
                                <td>Donor Registration</td>
                                <td><span class="status-badge completed">Approved</span></td>
                                <td>Conditional</td>
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