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
              <th>Milk Selection</th>
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
                <td><button type="button" class="select-text">SELECT MILK</button></td>
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
          <label>Milk Unit ID (Select Multiple)</label>

          <div id="milkList" class="milk-list">
            <!-- Example items (you can load dynamically later) -->
            <div class="milk-item" data-id="MU-2024-001" data-volume="50">
              MU-2024-001 — 50ml (Expires Jan 20, 2024)
            </div>
            <div class="milk-item" data-id="MU-2024-002" data-volume="45">
              MU-2024-002 — 45ml (Expires Jan 21, 2024)
            </div>
            <div class="milk-item" data-id="MU-2024-003" data-volume="60">
              MU-2024-003 — 60ml (Expires Jan 22, 2024)
            </div>
            <div class="milk-item" data-id="MU-2024-001" data-volume="50">
              MU-2024-001 — 50ml (Expires Jan 20, 2024)
            </div>
            <div class="milk-item" data-id="MU-2024-002" data-volume="45">
              MU-2024-002 — 45ml (Expires Jan 21, 2024)
            </div>
            <div class="milk-item" data-id="MU-2024-003" data-volume="60">
              MU-2024-003 — 60ml (Expires Jan 22, 2024)
            </div>
          </div>

          <p class="total-volume-display">
            <strong>Total Selected Milk:</strong> <span id="totalVolume">0</span> ml
          </p>
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

let selectedMilkUnits = [];

function updateTotalVolume() {
  let total = selectedMilkUnits.reduce((sum, item) => sum + parseFloat(item.volume), 0);
  document.getElementById("totalVolume").textContent = total;
}

document.querySelectorAll(".milk-item").forEach(item => {
  item.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const volume = this.getAttribute("data-volume");

      // Check if already selected
      const index = selectedMilkUnits.findIndex(m => m.id === id);

      if (index === -1) {
          // Add to selection
          selectedMilkUnits.push({ id, volume });
          this.classList.add("selected");
      } else {
          // Remove from selection
          selectedMilkUnits.splice(index, 1);
          this.classList.remove("selected");
      }

      updateTotalVolume();
  });
});

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
  
  if (selectedMilkUnits.length === 0) {
    alert('Please select at least one Milk Unit.');
    return;
  }

  console.log("Selected Milk Units:", selectedMilkUnits);

  alert('Milk units allocated successfully!');
  closeMilkModal();
});

</script>

@endsection
