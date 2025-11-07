@extends('layouts.shariah')

@section('title', 'View Milk Processing Records')

@section('content')
<link rel="stylesheet" href="{{ asset('css/shariah_view-milk-processing.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container">
  <div class="main-content">
    
    <!-- Header Section -->
    <div class="page-header">
      <div class="header-left">
        <h1>Milk ID #1 - Sarah Ahmad Binti Fauzi</h1>
      </div>
      <button class="btn-back"><i class="fas fa-arrow-left"></i> Back</button>
    </div>

    <!-- Stage Card -->
    <div class="stage-card">
      <div class="stage-title">
        <h2>First Stage</h2>
        <p class="stage-subtitle">SCREENING</p>
      </div>

      <div class="stage-content-wrapper">
        <!-- Image Section -->
        <div class="stage-image-section">
          <img src="{{ asset('images/lab_screening.jpg') }}" alt="Screening Process">
        </div>

        <!-- Details Section -->
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

      <!-- Time Status -->
      <div class="time-status-section">
        <p class="time-label">Time left: <span class="status-badge completed">COMPLETED</span></p>
      </div>

      <!-- Results Section -->
      <div class="results-section">
        <h3>Results:</h3>
        
        <div class="results-table-container">
          <table class="results-table">
            <thead>
              <tr>
                <th>Ctrl No</th>
                <th>Cow Name</th>
                <th>Daily Milk</th>
                <th>Fat</th>
                <th>Pro</th>
                <th>Scc</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2</td>
                <td>ANDROME</td>
                <td>2.4</td>
                <td>5.81</td>
                <td>4.78</td>
                <td>48</td>
                <td class="actions">
                  <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                  <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                  <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                </td>
              </tr>
              <tr>
                <td>9</td>
                <td>SIERRA</td>
                <td>2.6</td>
                <td>6.26</td>
                <td>4.62</td>
                <td>105</td>
                <td class="actions">
                  <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                  <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                  <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                </td>
              </tr>
              <tr>
                <td>10</td>
                <td>RASPBRY</td>
                <td>3.0</td>
                <td>6.24</td>
                <td>4.44</td>
                <td>45</td>
                <td class="actions">
                  <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                  <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                  <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                </td>
              </tr>
              <tr>
                <td>11</td>
                <td>MAYPOP</td>
                <td>3.0</td>
                <td>6.18</td>
                <td>4.03</td>
                <td>82</td>
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
    </div>

  </div>
</div>

@endsection