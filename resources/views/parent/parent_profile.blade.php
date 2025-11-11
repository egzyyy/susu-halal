@extends('layouts.parent')

@section('title', 'Parent Profile')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/parent_profile.css') }}">
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
                        <div class="avatar-circle">FK</div>
                    </div>
                    <h2 class="profile-name">Fatima Khan</h2>
                    <p class="profile-role">Parent</p>
                    <p class="profile-registered">Registered since February 2024</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $milkRequests ?? 8 }}</div>
                            <div class="stat-label">MILK REQUESTS</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $milkReceived ?? 3.25 }}L</div>
                            <div class="stat-label">MILK RECEIVED</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-hand-holding-medical"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">MILK REQUESTS</div>
                            <div class="stat-number">{{ $milkRequests ?? 8 }}</div>
                            <div class="stat-change positive">↑ 2 this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-bottle-droplet"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">MILK RECEIVED</div>
                            <div class="stat-number">{{ $milkReceived ?? 3.25 }}L</div>
                            <div class="stat-change positive">↑ 0.75L this month</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-baby"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">INFANTS REGISTERED</div>
                            <div class="stat-number">{{ $infantsRegistered ?? 1 }}</div>
                            <div class="stat-change current">Active</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-title">SUPPORT LEVEL</div>
                            <div class="stat-number">Priority</div>
                            <div class="stat-change">Medical need</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="profile-content">
                <div class="profile-section">
                    <div class="section-header">
                        <h3>Personal Information</h3>
                        <a href="{{ route('parent.edit-profile') }}" class="btn-edit">
                            Edit Profile
                        </a>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>FULL NAME</label>
                            <p>Fatima Khan</p>
                        </div>
                        <div class="info-item">
                            <label>EMAIL</label>
                            <p>f.khan@email.com</p>
                        </div>
                        <div class="info-item">
                            <label>PHONE</label>
                            <p>011-98765432</p>
                        </div>
                        <div class="info-item">
                            <label>DATE OF BIRTH</label>
                            <p>August 22, 1988</p>
                        </div>
                        <div class="info-item">
                            <label>ADDRESS</label>
                            <p>456 Family Residence, Medina City</p>
                        </div>
                        <div class="info-item">
                            <label>INFANT'S NAME</label>
                            <p>Baby Girl Khan</p>
                        </div>
                        <div class="info-item">
                            <label>INFANT'S AGE</label>
                            <p>3 months</p>
                        </div>
                        <div class="info-item">
                            <label>EMERGENCY CONTACT</label>
                            <p>Omar Khan (Spouse) +1 (555) 876-5432</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Milk Requests -->
                <div class="profile-section">
                    <div class="section-header">
                        <h3>My Infant's Milk Requests</h3>
                        <div class="section-actions">
                            <button class="btn-icon"><i class="fas fa-search"></i> Search</button>
                            <button class="btn-icon"><i class="fas fa-filter"></i> Filter</button>
                            <button class="btn-icon"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>

                    <div class="tabs">
                        <button class="tab active">All Requests <span class="badge">{{ $milkRequests ?? 8 }}</span></button>
                        <button class="tab">This Month <span class="badge">{{ $monthRequests ?? 2 }}</span></button>
                        <button class="tab">Pending <span class="badge">{{ $pendingRequests ?? 1 }}</span></button>
                    </div>

                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>DATE & TIME</th>
                                <th>QUANTITY</th>
                                <th>STATUS</th>
                                <th>INFANT</th>
                                <th>PICKUP LOCATION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>May 18, 2024<br><small>10:00 AM</small></td>
                                <td>500ml</td>
                                <td><span class="status-badge completed">Approved</span></td>
                                <td>Baby Girl (3 months)</td>
                                <td>Main Center</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>May 15, 2024<br><small>11:30 AM</small></td>
                                <td>750ml</td>
                                <td><span class="status-badge processing">Processing</span></td>
                                <td>Baby Girl (3 months)</td>
                                <td>North Branch</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>May 10, 2024<br><small>2:00 PM</small></td>
                                <td>1000ml</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Baby Girl (2 months)</td>
                                <td>Main Center</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>May 5, 2024<br><small>9:15 AM</small></td>
                                <td>300ml</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Baby Girl (2 months)</td>
                                <td>South Branch</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>April 28, 2024<br><small>3:45 PM</small></td>
                                <td>400ml</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>Baby Girl (1 month)</td>
                                <td>Main Center</td>
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