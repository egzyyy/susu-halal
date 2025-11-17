@extends('layouts.shariah')

@section('title', 'View Milk Processing Records')

@section('content')
<link rel="stylesheet" href="{{ asset('css/shariah_view-milk-processing.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="container">

    <div class="main-content">
<div class="page-content-wrapper"> 
    
    <div class="page-header">
        <div class="header-left">
            <h1>Milk ID #1 - Sarah Ahmad Binti Fauzi</h1>
        </div>
        <button class="btn-back" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Back</button>
    </div>

    <div class="stage-card">
        <div class="stage-title">
            <h2>First Stage</h2>
            <p class="stage-subtitle">SCREENING</p>
        </div>

        <div class="stage-content-wrapper">
            <div class="stage-image-section">
                <img src="{{ asset('images/lab_screening.jpg') }}" alt="Screening Process">
            </div>

            <div class="stage-details">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Start Date:</label>
                        <p>11 January 2025</p>
                    </div>
                    <div class="detail-item">
                        <label>End Date:</label>
                        <p>13 January 2025</p>
                    </div>
                    <div class="detail-item">
                        <label>Start Time:</label>
                        <p>08:00</p>
                    </div>
                    <div class="detail-item">
                        <label>End Time:</label>
                        <p>17:00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="time-status-section">
            <p class="time-label">Time left: <span class="status-badge completed">COMPLETED</span></p>
        </div>

        <div class="results-section">
            <h3>Microbiological Results:</h3>
            
            <div class="results-table-container">
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bacteria Name</th>
                            <th>Percentage</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Staphylococcus aureus</td>
                            <td>0.01%</td>
                            <td><span class="status passed">Passed</span></td>
                            <td class="actions">
                                <button class="btn-view" title="View Detail"><i class="fas fa-eye"></i></button>
                                <button class="btn-delete" title="Delete Record"><i class="fas fa-trash"></i></button>
                                <button class="btn-more" title="More Options"><i class="fas fa-ellipsis-v"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>E. coli</td>
                            <td>0.05%</td>
                            <td><span class="status failed">Failed</span></td>
                            <td class="actions">
                                <button class="btn-view" title="View Detail"><i class="fas fa-eye"></i></button>
                                <button class="btn-delete" title="Delete Record"><i class="fas fa-trash"></i></button>
                                <button class="btn-more" title="More Options"><i class="fas fa-ellipsis-v"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Total Coliform</td>
                            <td>< 0.01%</td>
                            <td><span class="status passed">Passed</span></td>
                            <td class="actions">
                                <button class="btn-view" title="View Detail"><i class="fas fa-eye"></i></button>
                                <button class="btn-delete" title="Delete Record"><i class="fas fa-trash"></i></button>
                                <button class="btn-more" title="More Options"><i class="fas fa-ellipsis-v"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Listeria sp.</td>
                            <td>0%</td>
                            <td><span class="status passed">Passed</span></td>
                            <td class="actions">
                                <button class="btn-view" title="View Detail"><i class="fas fa-eye"></i></button>
                                <button class="btn-delete" title="Delete Record"><i class="fas fa-trash"></i></button>
                                <button class="btn-more" title="More Options"><i class="fas fa-ellipsis-v"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="shariah-actions">
            <button class="btn-decline"><i class="fas fa-times-circle"></i> Decline Milk</button>
            <button class="btn-approve"><i class="fas fa-check-circle"></i> Approve Milk</button>
        </div>
        </div>
</div>
</div>
</div>

@endsection