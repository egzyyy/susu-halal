@extends('layouts.hmmc')

@section('title', 'Manage Milk Records')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/hmmc_manage-milk-records.css') }}">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="main-content">
        <div class="page-header">
            <h1>Milk Records Management</h1>
            <p>Milk Processing and Records</p>
        </div>

        <div class="table-controls">
            <div class="search-filter">
                <button class="btn-search">
                    <i class="fas fa-search"></i> Search
                </button>
                <button class="btn-filter">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
            <button class="btn-more-options">
                <i class="fas fa-ellipsis-v"></i>
            </button>
        </div>

        <div class="table-wrapper">
            <table class="records-table">
                <thead>
                    <tr>
                        <th>MILKS DONOR</th>
                        <th>CLINICAL STATUS</th>
                        <th>SHARIAH APPROVAL</th>
                        <th>EXPIRATION DATE</th>
                        <th>ELIGIBILITY</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="donor-info">
                                <div class="donor-avatar">1</div>
                                <div>
                                    <div class="donor-name">Milk ID #1</div>
                                    <div class="donor-details">Sarah Ahmad Binti Fauzi</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="status-badge status-labelling">Labelling</span></td>
                        <td><span class="status-badge status-approved">Approved</span></td>
                        <td>May 15, 2024</td>
                        <td>Passed</td>
                        <td class="actions">
                            <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                            <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="donor-info">
                                <div class="donor-avatar">2</div>
                                <div>
                                    <div class="donor-name">Milk ID #2</div>
                                    <div class="donor-details">Maryam Binti Othman</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="status-badge status-storaging">Storaging</span></td>
                        <td><span class="status-badge status-approved">Approved</span></td>
                        <td>May 14, 2024</td>
                        <td>Passed</td>
                        <td class="actions">
                            <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                            <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="donor-info">
                                <div class="donor-avatar">3</div>
                                <div>
                                    <div class="donor-name">Milk ID #3</div>
                                    <div class="donor-details">Fatimah Az-zahra Binti Mohd Nor</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="status-badge status-screening">Screening</span></td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                        <td>Jun 23, 2024</td>
                        <td>Passed</td>
                        <td class="actions">
                            <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                            <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="donor-info">
                                <div class="donor-avatar">4</div>
                                <div>
                                    <div class="donor-name">Milk ID #4</div>
                                    <div class="donor-details">Aishah Fathihah Binti Izzuddin</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="status-badge status-labelling">Labelling</span></td>
                        <td><span class="status-badge status-approved">Approved</span></td>
                        <td>May 15, 2024</td>
                        <td>Passed</td>
                        <td class="actions">
                            <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                            <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="donor-info">
                                <div class="donor-avatar">5</div>
                                <div>
                                    <div class="donor-name">Milk ID #5</div>
                                    <div class="donor-details">Nor Afiqah Humaira Binti Ishak</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="status-badge status-dispatching">Dispatching</span></td>
                        <td><span class="status-badge status-rejected">Rejected</span></td>
                        <td>Apr 28, 2024</td>
                        <td>Failed due to smoker</td>
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
@endsection