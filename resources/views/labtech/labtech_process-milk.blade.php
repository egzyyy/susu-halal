@extends('layouts.labtech')

@section('title', 'Milk Processing')

@section('content')
<link rel="stylesheet" href="{{ asset('css/labtech_process-milk.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container">
  <div class="main-content">

    <div class="page-header">
      <h1>Add Record Details - {{ $milk->formatted_id }}</h1>
      <a href="{{ route('labtech.labtech_manage-milk-records') }}" style="text-decoration: none;"><button class="btn-back"><i class="fas fa-arrow-left"></i> Back</button></a>
    </div>

    {{-- === Tab Navigation === --}}
    <div class="stage-tabs">
      <button class="stage-tab active" data-stage="first">First Stage</button>
      <button class="stage-tab" data-stage="second">Second Stage</button>
      <button class="stage-tab" data-stage="third">Third Stage</button>
    </div>

    {{-- === First Stage === --}}
            <div class="process-card stage-content active" id="first-stage"
              data-start="{{ $milk->milk_stage1StartDate ?? '' }}"
              data-starttime="{{ $milk->milk_stage1StartTime ?? '' }}"
              data-end="{{ $milk->milk_stage1EndDate ?? '' }}"
              data-endtime="{{ $milk->milk_stage1EndTime ?? '' }}"
              data-status="{{ $milk->milk_Status ?? '' }}">
      <h2>First Stage</h2>
      <h3>Screening</h3>
      <img src="{{ asset('images/lab_screening.jpg') }}" alt="Screening" style="width: 270px; height: auto;">

      <form id="addRecordForm" method="POST" action="{{ route('labtech.labtech_process-milk.update' , $milk->milk_ID) }}">
        @csrf
        <input type="hidden" name="_method" value="PUT">  <!-- THIS IS REQUIRED -->
        <input type="hidden" name="stage" value="1">

        <div class="form-grid">
          <div>
            <label>Start Date</label>
            @if ($milk->milk_stage1StartDate)
            <input type="date" name="milk_stage1StartDate" value="{{ $milk->milk_stage1StartDate }}" readonly>
            @else
            <input type="date" name="milk_stage1StartDate" placeholder="Enter Date" required>
            @endif
          </div>
          <div>
            <label>End Date</label>
            @if ($milk->milk_stage1EndDate)
            <input type="date" name="milk_stage1EndDate" value="{{ $milk->milk_stage1EndDate }}" readonly>
            @else
            <input type="date" name="milk_stage1EndDate" placeholder="Enter Date" required>
            @endif
          </div>
          <div>
            <label>Start Time</label>
            @if ($milk->milk_stage1StartTime)
            <input type="time" name="milk_stage1StartTime" value="{{ $milk->milk_stage1StartTime }}" readonly>
            @else
            <input type="time" name="milk_stage1StartTime" placeholder="Enter Time" required>
            @endif
          </div>
          <div>
            <label>End Time</label>
            @if ($milk->milk_stage1EndTime)
            <input type="time" name="milk_stage1EndTime" value="{{ $milk->milk_stage1EndTime }}" readonly>
            @else
            <input type="time" name="milk_stage1EndTime" placeholder="Enter Time" required>
            @endif
          </div>
        </div>
        <div class="stage-footer">
            <p id="liveDuration" class="time-status pending">
                <i class="fas fa-clock"></i> Status: <strong>NOT STARTED</strong>
            </p>

            @if (!$milk->milk_stage1StartDate)
                <button type="button" class="btn-submit-stage swal-submit">
                    <i class="fas fa-play"></i> Start Screening Stage
                </button>
            @else
                <div class="text-center mt-3 text-muted small">
                    <p class="note-info">* Screening process has started and cannot be edited.</p>
                </div>
            @endif
        </div>

      </form>
      
      
      
      {{-- Data Table --}}
      <div class="data-table-container" id="screeningTableContainer" style="display: none;">
          <div class="table-header-info">
              <span class="animals-selected" id="first-count">
                  @if($milk->milk_stage1Result && json_decode($milk->milk_stage1Result, true))
                      {{ count(json_decode($milk->milk_stage1Result)) }} Screening Results Loaded
                  @else
                      No results yet – waiting for screening to complete
                  @endif
              </span>
              <button class="btn-add-row" onclick="addTableRow('first')">
                  <i class="fas fa-plus"></i> Add Row
              </button>
          </div>

          <table class="data-table" id="first-table">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Contents</th>
                      <th>Tolerance</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody id="results-tbody">
                  @php
                      $results = $milk->milk_stage1Result ? json_decode($milk->milk_stage1Result, true) : [];
                  @endphp

                  @if($results && count($results) > 0)
                      @foreach($results as $index => $item)
                          <tr>
                              <td contenteditable="true" style="font-weight:bold; color:#1A5F7A;">
                                  {{ $index + 1 }}
                              </td>
                              <td contenteditable="true">
                                  {{ $item['contents'] ?? 'Unknown Test' }}
                              </td>
                              <td contenteditable="true">
                                  {{ $item['tolerance'] ?? 'Pending' }}
                              </td>
                              <td class="actions">
                                  <button class="btn-delete-row" onclick="deleteTableRow(this)">
                                      <i class="fas fa-trash"></i>
                                  </button>
                              </td>
                          </tr>
                      @endforeach
                  @else
                      <!-- Default row when no data -->
                      <tr>
                          <td contenteditable="true" style="font-weight:bold; color:#1A5F7A;">1</td>
                          <td contenteditable="true">E Coli</td>
                          <td contenteditable="true">Pending</td>
                          <td class="actions">
                              <button class="btn-delete-row" onclick="deleteTableRow(this)">
                                  <i class="fas fa-trash"></i>
                              </button>
                          </td>
                      </tr>
                  @endif
              </tbody>
          </table>
      </div>

      <!-- Save Button -->
      <div class="text-center mt-4">
          <button id="saveResultsBtn" class="btn-submit-stage" style="display:none; padding:14px 40px; font-size:16px;">
              Save Screening Results
          </button>
      </div>

      <div class="button-row">
        <a href="{{ route('labtech.labtech_manage-milk-records') }}" style="text-decoration: none;"><button class="btn-back-nav"><i class="fas fa-arrow-left"></i> Back</button></a>
        <button class="btn-next" onclick="switchStage('second')">Next Stage <i class="fas fa-arrow-right"></i></button>
      </div>
    </div>

    {{-- === Second Stage === --}}
        <div class="process-card stage-content" id="second-stage"
          data-start="{{ $milk->milk_stage2StartDate ?? '' }}"
          data-starttime="{{ $milk->milk_stage2StartTime ?? '' }}"
          data-end="{{ $milk->milk_stage2EndDate ?? '' }}"
          data-endtime="{{ $milk->milk_stage2EndTime ?? '' }}"
          data-status="{{ $milk->milk_Status ?? '' }}">
      <h2>Second Stage</h2>
      <h3>Collecting</h3>
      <img src="{{ asset('images/lab_collecting.jpg') }}" alt="Collecting" style="width: 270px; height: auto;">
      <form id="addRecordForm" method="POST" action="{{ route('labtech.labtech_process-milk.update' , $milk->milk_ID) }}">
        @csrf
        <input type="hidden" name="_method" value="PUT">  <!-- THIS IS REQUIRED -->
        <input type="hidden" name="stage" value="2">

        <div class="form-grid">
          <div>
            <label>Start Date</label>
            @if ($milk->milk_stage2StartDate)
            <input type="date" name="milk_stage2StartDate" value="{{ $milk->milk_stage2StartDate }}" readonly>
            @else
            <input type="date" name="milk_stage2StartDate" placeholder="Enter Date" required>
            @endif
          </div>
          <div>
            <label>End Date</label>
            @if ($milk->milk_stage2EndDate)
            <input type="date" name="milk_stage2EndDate" value="{{ $milk->milk_stage2EndDate }}" readonly>
            @else
            <input type="date" name="milk_stage2EndDate" placeholder="Enter Date" required>
            @endif
          </div>
          <div>
            <label>Start Time</label>
            @if ($milk->milk_stage2StartTime)
            <input type="time" name="milk_stage2StartTime" value="{{ $milk->milk_stage2StartTime }}" readonly>
            @else
            <input type="time" name="milk_stage2StartTime" placeholder="Enter Time" required>
            @endif
          </div>
          <div>
            <label>End Time</label>
            @if ($milk->milk_stage2EndTime)
            <input type="time" name="milk_stage2EndTime" value="{{ $milk->milk_stage2EndTime }}" readonly>
            @else
            <input type="time" name="milk_stage2EndTime" placeholder="Enter Time" required>
            @endif
          </div>
        </div>
        <div class="stage-footer">
            <p id="liveDuration" class="time-status pending">
                <i class="fas fa-clock"></i> Status: <strong>NOT STARTED</strong>
            </p>

            @if (!$milk->milk_stage2StartDate && $milk->milk_stage1Result)
                <button type="button" class="btn-submit-stage swal-submit">
                    <i class="fas fa-play"></i> Start Collecting Stage
                </button>
            @elseif (!$milk->milk_stage1Result)
                <div class="text-center mt-3 text-muted small">
                    <p class="note-info">* Please complete the Screening stage first before starting the Collecting stage.</p>
                </div>
            @else
                <div class="text-center mt-3 text-muted small">
                    <p class="note-info">* Collecting process has started and cannot be edited.</p>
                </div>
            @endif
        </div>

      </form>

      <div class="button-row">
        <button class="btn-back-stage" onclick="switchStage('first')"><i class="fas fa-arrow-left"></i> Previous</button>
        <button class="btn-next" onclick="switchStage('third')">Next Stage <i class="fas fa-arrow-right"></i></button>
      </div>
    </div>

    {{-- === Third Stage === --}}
        <div class="process-card stage-content" id="third-stage"
          data-start="{{ $milk->milk_stage3StartDate ?? '' }}"
          data-starttime="{{ $milk->milk_stage3StartTime ?? '' }}"
          data-end="{{ $milk->milk_stage3EndDate ?? '' }}"
          data-endtime="{{ $milk->milk_stage3EndTime ?? '' }}"
          data-status="{{ $milk->milk_Status ?? '' }}">
      <h2>Third Stage</h2>
      <h3>Distributing</h3>
      <img src="{{ asset('images/lab_pasteurizing.jpg') }}" alt="Distributing" style="width: 270px; height: auto;">
      <form id="addRecordForm" method="POST" action="{{ route('labtech.labtech_process-milk.update' , $milk->milk_ID) }}">
        @csrf
        <input type="hidden" name="_method" value="PUT">  <!-- THIS IS REQUIRED -->
        <input type="hidden" name="stage" value="3">

        <div class="form-grid">
          <div>
            <label>Start Date</label>
            @if ($milk->milk_stage3StartDate)
            <input type="date" name="milk_stage3StartDate" value="{{ $milk->milk_stage3StartDate }}" readonly>
            @else
            <input type="date" name="milk_stage3StartDate" placeholder="Enter Date" required>
            @endif
          </div>
          <div>
            <label>End Date</label>
            @if ($milk->milk_stage3EndDate)
            <input type="date" name="milk_stage3EndDate" value="{{ $milk->milk_stage3EndDate }}" readonly>
            @else
            <input type="date" name="milk_stage3EndDate" placeholder="Enter Date" required>
            @endif
          </div>
          <div>
            <label>Start Time</label>
            @if ($milk->milk_stage3StartTime)
            <input type="time" name="milk_stage3StartTime" value="{{ $milk->milk_stage3StartTime }}" readonly>
            @else
            <input type="time" name="milk_stage3StartTime" placeholder="Enter Time" required>
            @endif
          </div>
          <div>
            <label>End Time</label>
            @if ($milk->milk_stage3EndTime)
            <input type="time" name="milk_stage3EndTime" value="{{ $milk->milk_stage3EndTime }}" readonly>
            @else
            <input type="time" name="milk_stage3EndTime" placeholder="Enter Time" required>
            @endif
          </div>
        </div>
        <div class="stage-footer">
            <p id="liveDuration" class="time-status pending">
                <i class="fas fa-clock"></i> Status: <strong>NOT STARTED</strong>
            </p>

            @if (!$milk->milk_stage3StartDate && $milk->milk_stage1Result && $milk->milk_Status == 'Labelling Completed')
                <button type="button" class="btn-submit-stage swal-submit">
                    <i class="fas fa-play"></i> Start Distributing Stage
                </button>
            @elseif (!$milk->milk_stage1Result && $milk->milk_Status != 'Labelling Completed')
                <div class="text-center mt-3 text-muted small">
                    <p class="note-info">* Please complete the Collecting stage first before starting the Distributing stage.</p>
                </div>
            @else
                <div class="text-center mt-3 text-muted small">
                    <p class="note-info">* Distributing process has started and cannot be edited.</p>
                </div>
            @endif
        </div>

      </form>

      <div class="button-row">
        <button class="btn-back-stage" onclick="switchStage('second')"><i class="fas fa-arrow-left"></i> Previous</button>
        <!-- <a href="{{ route('labtech.labtech_manage-milk-records') }}" class="btn-completete-stage" style="text-decoration: none;">
          Done <i class="fas fa-check"></i>
        </a> -->
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
// Switch between stages
function switchStage(stage) {
  document.querySelectorAll('.stage-content').forEach(content => {
    content.classList.remove('active');
  });
  
  document.querySelectorAll('.stage-tab').forEach(tab => {
    tab.classList.remove('active');
  });
  
  document.getElementById(stage + '-stage').classList.add('active');
  document.querySelector(`[data-stage="${stage}"]`).classList.add('active');
  
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Tab click handlers
document.querySelectorAll('.stage-tab').forEach(tab => {
  tab.addEventListener('click', function() {
    const stage = this.getAttribute('data-stage');
    switchStage(stage);
  });
});

// ==================== UPDATED: Add Row for New Table (No, Contents, Tolerance) ====================
function addTableRow(stage) {
    const tableBody = document.querySelector(`#${stage}-table tbody`);
    const rowCount = tableBody.rows.length + 1; // Auto-increment No

    const newRow = tableBody.insertRow();

    // Cell 1: No (auto number)
    const cellNo = newRow.insertCell(0);
    cellNo.contentEditable = "true";
    cellNo.textContent = rowCount;
    cellNo.style.fontWeight = "bold";
    cellNo.style.color = "#1A5F7A";

    // Cell 2: Contents
    const cellContent = newRow.insertCell(1);
    cellContent.contentEditable = "true";
    cellContent.textContent = "New Test Item";
    cellContent.style.color = "#334155";

    // Cell 3: Tolerance
    const cellTolerance = newRow.insertCell(2);
    cellTolerance.contentEditable = "true";
    cellTolerance.textContent = "Pending";
    cellTolerance.style.color = "#000000ff";

    // Cell 4: Actions (Delete Button)
    const cellActions = newRow.insertCell(3);
    cellActions.className = "actions";
    cellActions.innerHTML = `
        <button class="btn-delete-row" onclick="deleteTableRow(this)" title="Delete Row">
            <i class="fas fa-trash"></i>
        </button>
    `;

    // Update header count
    updateRowCount(stage);

    // Focus on Contents cell
    cellContent.focus();
}

// ==================== UPDATED: Delete Row ====================
function deleteTableRow(button) {
    const row = button.closest('tr');
    const table = row.closest('table');
    const tbody = table.querySelector('tbody');

    // Prevent deleting the last row
    if (tbody.rows.length <= 1) {
        Swal.fire({
            icon: 'warning',
            title: 'Cannot Delete',
            text: 'At least one screening result is required.',
            timer: 2000,
            showConfirmButton: false
        });
        return;
    }

    // Optional: Confirm delete
    Swal.fire({
        title: 'Delete this result?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            row.remove();
            renumberRows(table); // Re-number all rows after delete
            updateRowCount('first');
        }
    });
}

// ==================== Auto Re-number Rows After Delete ====================
function renumberRows(table) {
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach((row, index) => {
        row.cells[0].textContent = index + 1;
    });
}

// ==================== Update Header Count (e.g. "5 Results Added") ====================
function updateRowCount(stage) {
    const table = document.getElementById(stage + '-table');
    const rowCount = table.querySelector('tbody').rows.length;
    const countElement = document.getElementById(stage + '-count');

    if (countElement) {
        if (rowCount === 0) {
            countElement.textContent = "No results added yet";
        } else if (rowCount === 1) {
            countElement.textContent = "1 Screening Result Added";
        } else {
            countElement.textContent = `${rowCount} Screening Results Added`;
        }
    }
}

// Add enter key navigation for cells
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.data-table tbody td[contenteditable="true"]').forEach(cell => {
    cell.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        const nextCell = this.nextElementSibling;
        if (nextCell && nextCell.contentEditable === "true") {
          nextCell.focus();
        }
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {

  // Attach handler to all start buttons (first, second, third if present)
  document.querySelectorAll(".swal-submit").forEach(button => {
    button.addEventListener("click", function () {
      const btn = this;
      const form = btn.closest("form");
      const stageInput = form ? form.querySelector('input[name="stage"]') : null;
      const stageVal = stageInput ? stageInput.value : btn.dataset.stage || '1';

      const stageNames = {
        '1': 'Screening',
        '2': 'Collecting',
        '3': 'Distributing'
      };
      const stageLabel = stageNames[stageVal] || `Stage ${stageVal}`;

      Swal.fire({
        title: `Start ${stageLabel}?`,
        text: `Are you sure the ${stageLabel.toLowerCase()} process details are correct?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#10b981",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, submit"
      }).then((result) => {
        if (result.isConfirmed) {
          // Validate that end datetime is not earlier than start datetime
          try {
            const sdEl = form.querySelector(`[name="milk_stage${stageVal}StartDate"]`);
            const stEl = form.querySelector(`[name="milk_stage${stageVal}StartTime"]`);
            const edEl = form.querySelector(`[name="milk_stage${stageVal}EndDate"]`);
            const etEl = form.querySelector(`[name="milk_stage${stageVal}EndTime"]`);

            const sd = sdEl?.value?.trim();
            const st = stEl?.value?.trim();
            const ed = edEl?.value?.trim();
            const et = etEl?.value?.trim();

            if (sd && st && ed && et) {
              const normalizedST = st.length === 8 ? st : st + ':00';
              const normalizedET = et.length === 8 ? et : et + ':00';
              const startDT = new Date(`${sd}T${normalizedST}`);
              const endDT = new Date(`${ed}T${normalizedET}`);

              if (isNaN(startDT.getTime()) || isNaN(endDT.getTime())) {
                Swal.fire({ icon: 'error', title: 'Invalid date/time', text: 'Please check the date and time values.', timer: 3000 });
                return;
              }

              if (endDT < startDT) {
                Swal.fire({
                  icon: 'error',
                  title: 'Invalid range',
                  html: `<p>End date/time cannot be earlier than start date/time. Please correct the values.</p>`,
                  timer: 3500
                });
                return; // don't submit
              }
            }
          } catch (e) {
            console.error('Date comparison error', e);
          }

          // Validate required inputs for this stage before submitting
          if (form) {
            const requiredNames = [
              `milk_stage${stageVal}StartDate`,
              `milk_stage${stageVal}StartTime`,
              `milk_stage${stageVal}EndDate`,
              `milk_stage${stageVal}EndTime`
            ];

            const missing = requiredNames.filter(name => {
              const el = form.querySelector(`[name="${name}"]`);
              return !el || !el.value || !el.value.toString().trim();
            });

            if (missing.length > 0) {
              Swal.fire({
                icon: 'error',
                title: 'Missing fields',
                html: `<p>Please fill all the fields before starting`,
                timer: 3000
              });
              return; // don't submit
            }

            Swal.fire({
              title: "Saving...",
              text: `Updating milk record for ${stageLabel}...`,
              icon: "info",
              allowOutsideClick: false,
              showConfirmButton: false
            });

            // submit the specific form for this stage
            form.submit();
          } else {
            // fallback if no form is present for this stage
            Swal.fire({
              icon: 'error',
              title: 'Form Not Found',
              text: 'Cannot start this stage because the form is missing.',
              timer: 2500,
              showConfirmButton: false
            });
          }
        }
      });

    });
  });

});

// ==================== FINAL COUNTDOWN + AUTO SHOW TABLE (supports multiple stages) ====================
document.addEventListener("DOMContentLoaded", function () {
  function initStageTimer(stageId, namePrefix) {
    const container = document.getElementById(stageId);
    if (!container) return;

    const statusContainer = container.querySelector('.time-status');
    const dataTableContainer = document.querySelector('.data-table-container');
    const nextButton = container.querySelector('.btn-next');
    const saveButton = document.getElementById('saveResultsBtn');

    if (!statusContainer) return;

    const startDate = (container.querySelector(`input[name="${namePrefix}StartDate"]`)?.value || container.dataset.start || '').trim();
    const startTime = (container.querySelector(`input[name="${namePrefix}StartTime"]`)?.value || container.dataset.starttime || '').trim();
    const endDate   = (container.querySelector(`input[name="${namePrefix}EndDate"]`)?.value || container.dataset.end || '').trim();
    const endTime   = (container.querySelector(`input[name="${namePrefix}EndTime"]`)?.value || container.dataset.endtime || '').trim();

    console.log("Stage timer init -> " + stageId + ": " + startDate + " " + startTime + " to " + endDate + " " + endTime);

    // Determine behavior based on available values:
    // - If endDate+endTime present => show countdown to end
    // - Else if startDate+startTime present => show IN PROGRESS
    // - Else => NOT STARTED

    const hasStart = !!(startDate && startTime);
    const hasEnd = !!(endDate && endTime);

    if (!hasStart && !hasEnd) {
      statusContainer.className = "time-status pending";
      statusContainer.innerHTML = 'Status: <strong>NOT STARTED</strong>';
      return;
    }

    if (!hasEnd && hasStart) {
      // Stage has started but no end set yet
      statusContainer.className = "time-status active";
      statusContainer.innerHTML = 'Status: <strong>IN PROGRESS</strong>';
      if (nextButton) {
        nextButton.disabled = true;
        nextButton.innerHTML = 'Waiting for Completion...';
        nextButton.style.background = "#9ca3af";
        nextButton.style.cursor = "not-allowed";
      }

      // If DB status is not updated yet, mark stage as in-progress on the server
      try {
        const currentStatus = (container.dataset.status || '').trim();
        let expectedStatus = null;
        let postUrl = null;
        if (stageId === 'second-stage') {
          expectedStatus = 'Labelling';
          postUrl = "{{ route('labtech.labelling-in-progress', ['milk' => $milk->milk_ID]) }}";
        } else if (stageId === 'third-stage') {
          expectedStatus = 'Distributing';
          postUrl = "{{ route('labtech.distributing-in-progress', ['milk' => $milk->milk_ID]) }}";
        }

        if (expectedStatus && postUrl && currentStatus !== expectedStatus) {
          fetch(postUrl, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
          })
          .then(r => r.json())
          .then(data => {
            if (data && data.success) {
              container.dataset.status = expectedStatus; // update client-side cache
            }
          })
          .catch(err => console.error('Failed to set in-progress status', err));
        }
      } catch (e) {
        console.error('In-progress status check/POST failed', e);
      }
      return;
    }

    // hasEnd === true: try to compute endDateTime and run countdown
    const normalizedEndTime = endTime.length === 8 ? endTime : endTime + ':00';
    const endDateTime = new Date(`${endDate}T${normalizedEndTime}`);

    if (isNaN(endDateTime.getTime())) {
      statusContainer.className = "time-status pending";
      statusContainer.innerHTML = 'Status: <strong>INVALID TIME</strong>';
      return;
    }

    // If an end time exists and is in the future (countdown active), ensure server marks this stage as in-progress
    try {
      const currentStatus = (container.dataset.status || '').trim();
      let expectedStatus = null;
      let postUrl = null;
      if (stageId === 'second-stage') {
        expectedStatus = 'Labelling';
        postUrl = "{{ route('labtech.labelling-in-progress', ['milk' => $milk->milk_ID]) }}";
      } else if (stageId === 'third-stage') {
        expectedStatus = 'Distributing';
        postUrl = "{{ route('labtech.distributing-in-progress', ['milk' => $milk->milk_ID]) }}";
      }

      // Only send if endDateTime is still in the future and status is not already set
      if (expectedStatus && postUrl && currentStatus !== expectedStatus && endDateTime > new Date()) {
        fetch(postUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({})
        })
        .then(r => r.json())
        .then(data => {
          if (data && data.success) {
            container.dataset.status = expectedStatus;
            console.log('Milk status set to', expectedStatus);
          }
        })
        .catch(err => console.error('Failed to set in-progress status during countdown', err));
      }
    } catch (e) {
      console.error('Error while ensuring in-progress status during countdown', e);
    }

    function updateTimer() {
      const now = new Date();
      const diffMs = endDateTime - now;

      if (diffMs <= 0) {
        statusContainer.className = "time-status completed";
        statusContainer.innerHTML = '<i class="fas fa-check-circle"></i> COMPLETED';

        // For Stage 1 we show the screening results table and save button
        if (dataTableContainer && stageId === 'first-stage') {
          dataTableContainer.style.display = "block";
          dataTableContainer.style.animation = "fadeInUp 0.8s ease-out";
        }

        if (nextButton) {
          nextButton.disabled = false;
          nextButton.innerHTML = 'Next Stage <i class="fas fa-arrow-right"></i>';
          nextButton.style.background = "linear-gradient(135deg, #10b981, #059669)";
          nextButton.style.cursor = "pointer";
        }

        if (saveButton && stageId === 'first-stage') {
          saveButton.style.display = "inline-block";
          saveButton.style.animation = "fadeInUp 0.8s ease-out";
        }

        // If stage 2 is completed, mark labelling complete via AJAX
        if (stageId === 'second-stage') {
          fetch("{{ route('labtech.labelling-complete', ['milk' => $milk->milk_ID]) }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
          })
          .then(r => r.json())
          .then(data => {
            if (data.success) {
              console.log('Milk status updated to Labelling Completed');
            } else {
              console.error('Failed to update milk status');
            }
          })
          .catch(() => console.error('Network error updating milk status'));
        }

        // If stage 3 is completed, mark distributing complete via AJAX
        if (stageId === 'third-stage') {
          fetch("{{ route('labtech.distributing-complete', ['milk' => $milk->milk_ID]) }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
          })
          .then(r => r.json())
          .then(data => {
            if (data.success) {
              console.log('Milk status updated to Distributing Completed');
            } else {
              console.error('Failed to update milk status');
            }
          })
          .catch(() => console.error('Network error updating milk status'));
        }

        clearInterval(timer);
        return;
      }

      // Still counting
      const totalSeconds = Math.floor(diffMs / 1000);
      const hours = Math.floor(totalSeconds / 3600);
      const minutes = Math.floor((totalSeconds % 3600) / 60);
      const seconds = totalSeconds % 60;

      statusContainer.className = "time-status active";
      statusContainer.innerHTML = `Time Remaining: ${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

      if (dataTableContainer && stageId === 'first-stage') dataTableContainer.style.display = "none";
      if (nextButton) {
        nextButton.disabled = true;
        nextButton.innerHTML = 'Waiting for Completion...';
        nextButton.style.background = "#9ca3af";
        nextButton.style.cursor = "not-allowed";
      }
    }

    // Start timer
    updateTimer();
    const timer = setInterval(updateTimer, 1000);

    // Auto-check on load (in case time already passed)
    if (new Date() >= endDateTime) {
      updateTimer();
      clearInterval(timer);
    }
  }

  // Always initialize both timers and log their results
  try {
    initStageTimer('first-stage', 'milk_stage1');
    console.log('Stage 1 timer attempted');
  } catch (e) {
    console.error('Stage 1 timer error:', e);
  }
  try {
    initStageTimer('second-stage', 'milk_stage2');
    console.log('Stage 2 timer attempted');
  } catch (e) {
    console.error('Stage 2 timer error:', e);
  }

  try {
    initStageTimer('first-stage', 'milk_stage1');
    console.log('Stage 1 timer attempted');
  } catch (e) {
    console.error('Stage 1 timer error:', e);
  }
  try {
    initStageTimer('third-stage', 'milk_stage3');
    console.log('Stage 3 timer attempted');
  } catch (e) {
    console.error('Stage 3 timer error:', e);
  }
});

// SAVE RESULTS TO DATABASE
document.getElementById('saveResultsBtn')?.addEventListener('click', function() {
    const rows = document.querySelectorAll('#first-table tbody tr');
    if (rows.length === 0) {
        Swal.fire('Error', 'Please add at least one result', 'error');
        return;
    }

    const results = Array.from(rows).map(row => ({
        contents: row.cells[1].textContent.trim(),
        tolerance: row.cells[2].textContent.trim()
    }));

    Swal.fire({
        title: 'Save Results?',
        text: 'This will save all screening results.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Save',
        confirmButtonColor: '#10b981'
    }).then(res => {
        if (!res.isConfirmed) return;

        fetch("{{ route('labtech.save-screening-results', $milk->milk_ID) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ results: results })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Saved!', 'Screening results saved successfully.', 'success');
            } else {
                Swal.fire('Error', data.message || 'Failed to save', 'error');
            }
        })
        .catch(() => Swal.fire('Error', 'Network error', 'error'));
    });
});
</script>

@endsection