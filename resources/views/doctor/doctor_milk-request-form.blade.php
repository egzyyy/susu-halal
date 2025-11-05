@extends('layouts.doctor')

@section('title', 'New Milk Request')

@section('content')
<link rel="stylesheet" href="{{ asset('css/doctor_request-form.css') }}">

<div class="request-page">
  <div class="form-header">
    <h1>🍼 New Milk Request</h1>
    <p>Create donor milk feeding request for NICU patients</p>
  </div>

  <form class="milk-request-form">

    <!-- Patient Information -->
    <section class="form-section">
      <h2>👶 Patient Information</h2>
      <div class="form-group">
        <label for="patient_id">Select Patient ID <span class="required">*</span></label>
        <select id="patient_id" name="patient_id" required>
          <option value="">Select...</option>
          <option value="P001">P001</option>
          <option value="P002">P002</option>
          <option value="P003">P003</option>
        </select>
      </div>
    </section>

    <!-- Patient Details -->
    <section class="form-section">
      <h2>🧾 Patient Details</h2>
      <div class="grid-2">
        <div class="form-group">
          <label>Patient Name</label>
          <input type="text" value="Sarah Ahmad Binti Fauzi" readonly>
        </div>
        <div class="form-group">
          <label>Family</label>
          <input type="text" value="Ahmad Family" readonly>
        </div>
      </div>

      <div class="grid-2">
        <div class="form-group">
          <label>Medical Record Number</label>
          <input type="text" value="MRN-2024-001" readonly>
        </div>
        <div class="form-group">
          <label>NICU Cubicle Number</label>
          <input type="text" value="A101" readonly>
        </div>
      </div>

      <div class="grid-2">
        <div class="form-group">
          <label>Date of Birth</label>
          <input type="text" value="01/01/2024" readonly>
        </div>
        <div class="form-group">
          <label>Diagnosis</label>
          <input type="text" value="Premature Birth - 32 weeks" readonly>
        </div>
      </div>
    </section>

    <!-- Clinical Information -->
    <section class="form-section">
      <h2>🩺 Clinical Information</h2>
      <div class="grid-2">
        <div class="form-group">
          <label for="weight">Current Weight (kg) <span class="required">*</span></label>
          <input type="text" id="weight" name="weight" placeholder="e.g. 2.5">
        </div>
        <div class="form-group">
          <label>Recommended Volume per Feeding</label>
          <input type="text" value="Enter weight to calculate" readonly>
        </div>
      </div>
    </section>

    <!-- Feeding Schedule -->
    <section class="form-section">
      <h2>🗓️ Feeding Schedule</h2>
      <div class="grid-2">
        <div class="form-group">
          <label for="feeding_date">Scheduled Feeding Date</label>
          <input type="date" id="feeding_date" name="feeding_date">
        </div>
        <div class="form-group">
          <label for="feeding_time">Scheduled Feeding Time <span class="required">*</span></label>
          <input type="time" id="feeding_time" name="feeding_time" required>
        </div>
      </div>
    </section>

    <!-- Form Buttons -->
    <div class="form-actions">
      <button type="button" class="btn-cancel">Cancel</button>
      <button type="submit" class="btn-submit">Submit Request</button>
    </div>
  </form>
</div>
@endsection
