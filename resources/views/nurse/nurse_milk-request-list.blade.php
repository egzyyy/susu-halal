@extends('layouts.nurse')

@section('title', 'Choose Milk ID')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/nurse_milk-request-list.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/nurse_milk-modal.css') }}">

  <div class="container">
    <div class="main-content">

      <div class="page-header">
        <h1>Choose Milk</h1>
        <p>Milk Request Records</p>
      </div>

      <div class="card">
        <div class="card-header">
          <h2>Milk Request Records</h2>
          <div class="actions">
            <button class="btn"><i class="fas fa-search"></i> Search</button>
            <button class="btn"><i class="fas fa-filter"></i> Filter</button>
            <button class="btn"><i class="fas fa-ellipsis-h"></i></button>
          </div>
        </div>

        <table class="records-table">
          <thead>
            <tr>
              <th>Patient Name</th>
              <th>NICU Cubicle No.</th>
              <th>Date Requested</th>
              <th>Date Time to Give</th>
              <th>Request Status</th>
              <th>Volume (ML)</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ([
              ['id' => 'P001', 'name' => 'Sarah Ahmad Binti Fauzi', 'nicu' => 'A101', 'date_requested' => 'Jan 12, 2024', 'date_give' => 'Jan 14, 2024', 'status' => 'Approved'],
              ['id' => 'P002', 'name' => 'Ahmad Jebon Bin Arif', 'nicu' => 'A102', 'date_requested' => 'Jan 12, 2024', 'date_give' => 'Jan 15, 2024', 'status' => 'Waiting']
            ] as $milk)
              <tr>
                <td>
                  <div class="patient-info">
                    <i class="fas fa-bottle-droplet milk-icon"></i>
                    <div>
                      <strong>{{ $milk['id'] }}</strong><br>
                      <span>{{ $milk['name'] }}</span>
                    </div>
                  </div>
                </td>
                <td>{{ $milk['nicu'] }}</td>
                <td>{{ $milk['date_requested'] }}</td>
                <td>{{ $milk['date_give'] }}</td>
                <td>
                  <span class="status {{ strtolower($milk['status']) }}">{{ $milk['status'] }}</span>
                </td>
                <td><button type="button" class="select-text">SELECT</button></td>
                <td class="actions">
                  <button class="btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                  <button class="btn-view" title="View"><i class="fas fa-list"></i></button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>

  {{-- Add this modal HTML before @endsection in your blade file --}}

<!-- Milk Selection Modal -->
<div id="milkModal" class="modal">
  <div class="modal-overlay"></div>
  <div class="modal-content">
    <div class="modal-header">
      <h2>Milk Request Records</h2>
      <button class="modal-close" onclick="closeMilkModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <div class="modal-body">
      <div class="patient-profile">
        <div class="profile-icon">
          <i class="fas fa-user"></i>
        </div>
        <div class="profile-id">P001</div>
      </div>

      <form id="milkAllocationForm">
        <div class="form-group">
          <label>Patient Name</label>
          <input type="text" value="Sarah Ahmad Binti Fauzi" readonly>
        </div>

        <div class="form-group">
          <label>Patient ID</label>
          <input type="text" value="P001" readonly>
        </div>

        <div class="form-group">
          <label>Medical Record Number</label>
          <input type="text" value="MRN-2024-001" readonly>
        </div>

        <div class="form-group">
          <label>Date of Birth</label>
          <input type="text" value="2024-01-01" readonly>
        </div>

        <div class="form-group">
          <label>Diagnosis</label>
          <input type="text" value="Premature Birth - 32 weeks" readonly>
        </div>

        <div class="form-group">
          <label>Ward</label>
          <input type="text" value="NICU - A101" readonly>
        </div>

        <div class="form-group">
          <label>Patient Weight (kg)</label>
          <input type="text" value="2.3" readonly>
        </div>

        <div class="form-group">
          <label>Prescribed Volume (ml)</label>
          <input type="text" value="43.1 ml per feeding" readonly>
        </div>

        <div class="form-group">
          <label>Milk Unit ID <span class="required">*</span></label>
          <select id="milkUnitId" required>
            <option value="">Click to select...</option>
            <option value="MU-2024-001">MU-2024-001 (50ml - Expires: Jan 20, 2024)</option>
            <option value="MU-2024-002">MU-2024-002 (45ml - Expires: Jan 21, 2024)</option>
            <option value="MU-2024-003">MU-2024-003 (60ml - Expires: Jan 22, 2024)</option>
          </select>
        </div>

        <div class="form-group">
          <label>Volume (ml)</label>
          <input type="number" id="volume" placeholder="Enter volume">
        </div>

        <div class="form-group">
          <label>Expiry Date & Time</label>
          <input type="datetime-local" id="expiryDate">
        </div>

        <div class="form-group">
  <label>Storage Location</label>
  <input type="text" id="storageLocation" value="NICU Storage Room A" readonly>
</div>


        <button type="submit" class="btn-allocate">ALLOCATE MILK UNIT</button>
      </form>
    </div>
  </div>
</div>

<script>
// Open modal when SELECT is clicked
document.addEventListener('DOMContentLoaded', function() {
  const selectButtons = document.querySelectorAll('.select-text');
  selectButtons.forEach(button => {
    button.addEventListener('click', function() {
      document.getElementById('milkModal').classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  });
});

// Close modal
function closeMilkModal() {
  document.getElementById('milkModal').classList.remove('active');
  document.body.style.overflow = 'auto';
}

// Close on overlay click
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('modal-overlay')) {
    closeMilkModal();
  }
});

// Handle form submission
document.getElementById('milkAllocationForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const milkUnitId = document.getElementById('milkUnitId').value;
  const volume = document.getElementById('volume').value;
  const expiryDate = document.getElementById('expiryDate').value;
  const storageLocation = document.getElementById('storageLocation').value;
  
  if (!milkUnitId) {
    alert('Please select a Milk Unit ID');
    return;
  }
  
  // Here you would send the data to your Laravel backend
  console.log({
    milkUnitId,
    volume,
    expiryDate,
    storageLocation
  });
  
  alert('Milk unit allocated successfully!');
  closeMilkModal();
});
</script>

@endsection
