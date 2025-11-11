@extends('layouts.donor')

@section('title', 'Donor Profile')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/donor_profile.css') }}">
    <!-- Add Font Awesome -->
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
                    <h2 class="profile-name">Sarah Ahmad</h2>
                    <p class="profile-role">Milk Donor</p>
                    <p class="profile-registered">Registered since January 2024</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $totalDonations ?? 18 }}</div>
                            <div class="stat-label">DONATIONS</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $totalMilk ?? 4.2 }}L</div>
                            <div class="stat-label">TOTAL MILK</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">TOTAL DONATIONS</div>
                            <div class="stat-number">{{ $totalDonations ?? 18 }}</div>
                            <div class="stat-change positive">↑ 2 this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-droplet"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">TOTAL MILK DONATED</div>
                            <div class="stat-number">{{ $totalMilk ?? 4.2 }}L</div>
                            <div class="stat-change positive">↑ 0.5L this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-baby"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">BABIES HELPED</div>
                            <div class="stat-number">{{ $babiesHelped ?? 12 }}</div>
                            <div class="stat-change current">Making a difference</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">DONOR LEVEL</div>
                            <div class="stat-number">Gold</div>
                            <div class="stat-change">Next: Platinum at 5L</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="profile-content">
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Personal Information</h3>
                        <a href="{{ route('donor.edit-profile') }}" class="btn-edit">
                            Edit Profile
                        </a>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>FULL NAME</label>
                            <p>Sarah Ahmad</p>
                        </div>
                        <div class="info-item">
                            <label>EMAIL</label>
                            <p>sarah.ahmad2@email.com</p>
                        </div>
                        <div class="info-item">
                            <label>PHONE</label>
                            <p>011-1341231</p>
                        </div>
                        <div class="info-item">
                            <label>DATE OF BIRTH</label>
                            <p>March 15, 1990</p>
                        </div>
                        <div class="info-item">
                            <label>ADDRESS</label>
                            <p>123 Green Street, Medina City</p>
                        </div>
                        <div class="info-item">
                            <label>BLOOD TYPE</label>
                            <p>O+</p>
                        </div>
                        <div class="info-item">
                            <label>LAST SCREENING</label>
                            <p>April 28, 2024</p>
                        </div>
                        <div class="info-item">
                            <label>EMERGENCY CONTACT</label>
                            <p>Ali Ahmad (Spouse) +1 (555) 987-6543</p>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Specialization & Qualifications</h3>
                    <div class="qualifications">
                        <div class="qualification-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Certified Milk Donor</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Health Screening Passed</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Lactation Education Completed</span>
                        </div>
                        <div class="qualification-item">
                            <i class="fas fa-certificate"></i>
                            <span>Milk Handling Training</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Donations -->
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Recent Donations</h3>
                        <div class="section-actions">
                            <button class="btn-icon"><i class="fas fa-search"></i> Search</button>
                            <button class="btn-icon"><i class="fas fa-filter"></i> Filter</button>
                            <button class="btn-icon"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>

                    <div class="tabs">
                        <button class="tab active">All Donations <span class="badge">{{ $totalDonations ?? 18 }}</span></button>
                        <button class="tab">This Month <span class="badge">{{ $monthDonations ?? 2 }}</span></button>
                        <button class="tab">Pending <span class="badge">{{ $pendingDonations ?? 1 }}</span></button>
                    </div>

                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>DATE & TIME</th>
                                <th>AMOUNT</th>
                                <th>STATUS</th>
                                <th>RECIPIENT</th>
                                <th>LOCATION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>May 15, 2024<br><small>10:00 AM</small></td>
                                <td>250ml</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Baby Girl (3 months)</td>
                                <td>Main Center</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>May 8, 2024<br><small>11:30 AM</small></td>
                                <td>300ml</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Baby Boy (2 months)</td>
                                <td>North Branch</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>May 1, 2024<br><small>2:00 PM</small></td>
                                <td>200ml</td>
                                <td><span class="status-badge processing">Processing</span></td>
                                <td>-</td>
                                <td>Main Center</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>April 24, 2024<br><small>9:15 AM</small></td>
                                <td>350ml</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Baby Girl (4 months)</td>
                                <td>Main Center</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>April 18, 2024<br><small>3:45 PM</small></td>
                                <td>275ml</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Baby Boy (1 month)</td>
                                <td>South Branch</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection