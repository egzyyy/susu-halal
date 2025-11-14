@extends('layouts.hmmc')

@section('title', 'User Management')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/hmmc_manage-users.css') }}">

    <div class="main-content">
        <div class="page-header">
            <div class="header-top">
                <h1>User Management</h1>
                <div class="header-actions">
                    <button class="btn-export" onclick="exportUsers()">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <button class="btn-add-user" onclick="openRoleModal()">
                        <i class="fas fa-plus"></i> Add New User
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Users</h3>
                    <div class="stat-number">{{ $totalUsers }}</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i> All registered users
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-hand-holding-medical"></i>
                </div>
                <div class="stat-content">
                    <h3>Donors</h3>
                    <div class="stat-number">{{ $donors->count() }}</div>
                    <div class="stat-change positive">
                        <i class="fas fa-heart"></i> Milk donors
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-baby"></i>
                </div>
                <div class="stat-content">
                    <h3>Recipients</h3>
                    <div class="stat-number">{{ $parents->count() }}</div>
                    <div class="stat-change neutral">
                        <i class="fas fa-users"></i> Parents registered
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-user-nurse"></i>
                </div>
                <div class="stat-content">
                    <h3>Staff Members</h3>
                    <div class="stat-number">{{ $doctors->count() + $nurses->count() + $labtechs->count() + $shariahs->count() + $admins->count() }}</div>
                    <div class="stat-change negative">
                        <i class="fas fa-briefcase-medical"></i> Healthcare team
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="table-container">
            <div class="table-header">
                <h2>All Users</h2>
                <div class="table-controls">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search users..." onkeyup="searchUsers()">
                        <i class="fas fa-search"></i>
                    </div>
                    <select id="roleFilter" onchange="filterByRole()" class="filter-select">
                        <option value="all">All Roles</option>
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option value="nurse">Nurse</option>
                        <option value="labtech">Lab Tech</option>
                        <option value="shariah">Shariah</option>
                        <option value="parent">Parent</option>
                        <option value="donor">Donor</option>
                    </select>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab active" data-tab="all" onclick="filterTab('all')">
                    All Users <span class="tab-count">{{ $totalUsers }}</span>
                </button>
                <button class="tab" data-tab="donors" onclick="filterTab('donor')">
                    Donors <span class="tab-count">{{ $donors->count() }}</span>
                </button>
                <button class="tab" data-tab="parents" onclick="filterTab('parent')">
                    Recipients <span class="tab-count">{{ $parents->count() }}</span>
                </button>
                <button class="tab" data-tab="staff" onclick="filterTab('staff')">
                    Staff <span class="tab-count">
                        {{ $doctors->count() + $nurses->count() + $labtechs->count() + $shariahs->count() + $admins->count() }}
                    </span>
                </button>
            </div>

            <!-- Table -->
            <div class="table-wrapper">
                <table class="records-table" id="usersTable">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">USER <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable(1)">ROLE <i class="fas fa-sort"></i></th>
                            <th>CONTACT</th>
                            <th>STATUS</th>
                            <th onclick="sortTable(4)">REGISTRATION DATE <i class="fas fa-sort"></i></th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($allUsers->count() > 0)
                        @foreach ($allUsers as $user)
                            <tr data-role="{{ $user->role }}">
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar {{ ['teal', 'blue', 'green', 'purple', 'orange'][array_rand(['teal', 'blue', 'green', 'purple', 'orange'])] }}">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $user->name }}</div>
                                            <div class="user-email">{{ $user->email }}</div>
                                            <div class="user-username">{{ '@' . $user->username }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-{{ $user->role }}">
                                        @if($user->role == 'admin')
                                            <i class="fas fa-user-shield"></i>
                                        @elseif($user->role == 'doctor')
                                            <i class="fas fa-stethoscope"></i>
                                        @elseif($user->role == 'nurse')
                                            <i class="fas fa-user-nurse"></i>
                                        @elseif($user->role == 'labtech')
                                            <i class="fas fa-flask"></i>
                                        @elseif($user->role == 'shariah')
                                            <i class="fas fa-book-quran"></i>
                                        @elseif($user->role == 'parent')
                                            <i class="fas fa-baby"></i>
                                        @elseif($user->role == 'donor')
                                            <i class="fas fa-hand-holding-heart"></i>
                                        @endif
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="contact-info">
                                        <i class="fas fa-phone"></i> {{ $user->contact }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $user->status }}">
                                        <i class="fas fa-circle"></i> {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="date-info">
                                        <i class="far fa-calendar-alt"></i>
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action btn-view" title="View Details" 
                                            onclick="viewUser('{{ $user->original_id }}', '{{ $user->original_table }}')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-action btn-edit" title="Edit" 
                                            onclick="editUser('{{ $user->original_id }}', '{{ $user->original_table }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-action btn-delete" title="Delete" 
                                            onclick="confirmDelete('{{ $user->original_id }}', '{{ $user->original_table }}', '{{ $user->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr id="noResults">
                            <td colspan="6" class="text-center">
                                <div class="empty-state">
                                    <i class="fas fa-users-slash"></i>
                                    <p>No users found.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Role Selection Modal -->
    <div id="roleModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-title">Select User Role</h2>
            <p class="modal-subtitle">Choose the type of user you want to create</p>
            
            <div class="role-cards">
                <a href="{{ route('hmmc.create-new-user', ['role' => 'admin']) }}" class="role-card">
                    <div class="role-card-content">
                        <div class="role-icon blue">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3>HMMC Admin</h3>
                        <p>System administrator</p>
                    </div>
                </a>

                <a href="{{ route('hmmc.create-new-user', ['role' => 'doctor']) }}" class="role-card">
                    <div class="role-card-content">
                        <div class="role-icon green">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <h3>Doctor</h3>
                        <p>Medical practitioner</p>
                    </div>
                </a>

                <a href="{{ route('hmmc.create-new-user', ['role' => 'nurse']) }}" class="role-card">
                    <div class="role-card-content">
                        <div class="role-icon teal">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <h3>Nurse</h3>
                        <p>Healthcare professional</p>
                    </div>
                </a>

                <a href="{{ route('hmmc.create-new-user', ['role' => 'labtech']) }}" class="role-card">
                    <div class="role-card-content">
                        <div class="role-icon purple">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h3>Lab Technician</h3>
                        <p>Laboratory specialist</p>
                    </div>
                </a>

                <a href="{{ route('hmmc.create-new-user', ['role' => 'shariah']) }}" class="role-card">
                    <div class="role-card-content">
                        <div class="role-icon orange">
                            <i class="fas fa-book-quran"></i>
                        </div>
                        <h3>Shariah Committee</h3>
                        <p>Islamic compliance expert</p>
                    </div>
                </a>

                <a href="{{ route('hmmc.create-new-user', ['role' => 'parent']) }}" class="role-card">
                    <div class="role-card-content">
                        <div class="role-icon pink">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h3>Parent</h3>
                        <p>Milk recipient</p>
                    </div>
                </a>
            </div>

            <button class="btn-cancel-modal" onclick="closeRoleModal()">
                <i class="fas fa-times"></i> Cancel
            </button>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content modal-small">
            <div class="modal-icon-warning">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h2 class="modal-title">Confirm Deletion</h2>
            <p class="modal-subtitle" id="deleteMessage"></p>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="btn-confirm-delete" onclick="executeDelete()">
                    <i class="fas fa-trash"></i> Delete User
                </button>
            </div>
        </div>
    </div>

    <script>
        let deleteUserId, deleteUserTable;

        function openRoleModal() {
            document.getElementById('roleModal').style.display = 'flex';
        }

        function closeRoleModal() {
            document.getElementById('roleModal').style.display = 'none';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const roleModal = document.getElementById('roleModal');
            const deleteModal = document.getElementById('deleteModal');
            if (event.target === roleModal) {
                closeRoleModal();
            }
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        }

        // Search functionality
        function searchUsers() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const table = document.getElementById('usersTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            }
        }

        // Filter by role
        function filterByRole() {
            const select = document.getElementById('roleFilter');
            const role = select.value;
            const table = document.getElementById('usersTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const rowRole = row.getAttribute('data-role');
                
                if (role === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = rowRole === role ? '' : 'none';
                }
            }
        }

        // Tab filtering
        function filterTab(type) {
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.closest('.tab').classList.add('active');

            const table = document.getElementById('usersTable');
            const rows = table.getElementsByTagName('tr');
            const staffRoles = ['admin', 'doctor', 'nurse', 'labtech', 'shariah'];

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const rowRole = row.getAttribute('data-role');
                
                if (type === 'all') {
                    row.style.display = '';
                } else if (type === 'staff') {
                    row.style.display = staffRoles.includes(rowRole) ? '' : 'none';
                } else {
                    row.style.display = rowRole === type ? '' : 'none';
                }
            }
        }

        // Sort table
        function sortTable(columnIndex) {
            const table = document.getElementById('usersTable');
            let switching = true;
            let shouldSwitch, i;
            let dir = 'asc';
            let switchcount = 0;

            while (switching) {
                switching = false;
                const rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    const x = rows[i].getElementsByTagName('TD')[columnIndex];
                    const y = rows[i + 1].getElementsByTagName('TD')[columnIndex];

                    if (dir === 'asc') {
                        if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir === 'desc') {
                        if (x.textContent.toLowerCase() < y.textContent.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount === 0 && dir === 'asc') {
                        dir = 'desc';
                        switching = true;
                    }
                }
            }
        }

        function editUser(userId, userTable) {
            window.location.href = `/admin/users/${userTable}/${userId}/edit`;
        }

        function confirmDelete(userId, userTable, userName) {
            deleteUserId = userId;
            deleteUserTable = userTable;
            document.getElementById('deleteMessage').textContent = `Are you sure you want to delete ${userName}? This action cannot be undone.`;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function executeDelete() {
            fetch(`/admin/users/${deleteUserTable}/${deleteUserId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeDeleteModal();
                    // Show success message
                    const successMsg = document.createElement('div');
                    successMsg.className = 'alert alert-success';
                    successMsg.style.cssText = 'position:fixed;top:20px;right:20px;background:#10b981;color:white;padding:16px 24px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:9999;';
                    successMsg.innerHTML = '<i class="fas fa-check-circle"></i> User deleted successfully!';
                    document.body.appendChild(successMsg);
                    setTimeout(() => {
                        successMsg.remove();
                        location.reload();
                    }, 2000);
                } else {
                    alert('Error deleting user. Please try again.');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Error deleting user. Please try again.');
            });
        }

        function viewUser(userId, userTable) {
            window.location.href = `/admin/users/${userTable}/${userId}`;
        }

        function exportUsers() {
            // Add export functionality here
            alert('Export functionality coming soon!');
        }
    </script>
@endsection