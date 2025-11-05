@extends('layouts.donor')

@section('title', 'Donor Appointments')

@section('content')
<link rel="stylesheet" href="{{ asset('css/donor_appointments.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container">

    <!-- Main Content -->
    <div class="main-content">
        <div class="appointments-page">
            <div class="page-header">
                <h1>My Appointments</h1>
            </div>

            <!-- Appointment Booking Cards -->
            <div class="appointment-cards">
                <div class="appointment-card">
                    <h3>Milk Donation</h3>
                    <button class="btn-book">Book Appointment</button>
                </div>
                <div class="appointment-card">
                    <h3>Pumping Kit</h3>
                    <button class="btn-book">Book Appointment</button>
                </div>
            </div>

            <!-- Current Appointments -->
            <div class="appointments-section">
                <div class="section-header">
                    <h2>My Appointments</h2>
                    <div class="header-actions">
                        <button class="btn-icon" title="Search"><i class="fas fa-search"></i> Search</button>
                        <button class="btn-icon" title="Filter"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </div>

                <div class="tabs">
                    <button class="tab active">All Appointment <span class="badge">2</span></button>
                    <button class="tab">Confirmed <span class="badge">1</span></button>
                    <button class="tab">Pending <span class="badge">1</span></button>
                </div>

                <div class="table-container">
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>AMOUNT</th>
                                <th>STATUS</th>
                                <th>TYPE</th>
                                <th>LOCATION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15.5.2025</td>
                                <td>1000 ml</td>
                                <td><span class="status verified">Verified</span></td>
                                <td>MILK DROP OFF</td>
                                <td>Main Foyer</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>21.5.2025</td>
                                <td>1000 ml</td>
                                <td><span class="status pending">Pending</span></td>
                                <td>MILK DROP OFF</td>
                                <td>Front Counter</td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Appointment History -->
            <div class="appointments-section">
                <div class="section-header">
                    <h2>Appointment History</h2>
                    <div class="header-actions">
                        <button class="btn-icon" title="Search"><i class="fas fa-search"></i> Search</button>
                        <button class="btn-show">Show</button>
                    </div>
                </div>

                <div class="tabs">
                    <button class="tab active">All Appointment <span class="badge">2</span></button>
                    <button class="tab">Completed <span class="badge">1</span></button>
                    <button class="tab">Canceled <span class="badge">1</span></button>
                </div>

                <div class="table-container">
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>AMOUNT</th>
                                <th>STATUS</th>
                                <th>TYPE</th>
                                <th>LOCATION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" style="text-align:center; padding:40px; color:#9ca3af;">
                                    No appointment history yet
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
