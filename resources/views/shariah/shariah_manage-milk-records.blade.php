@extends('layouts.shariah')

@section('title', 'Shariah Manage Milk Records')

@section('content')
<link rel="stylesheet" href="{{ asset('css/shariah_manage-milk-records.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body>
    <div class="main-content">
        <div class="page-header">
            <h1>Milk Records Management</h1>
            <p>Milk Processing and Records</p>
        </div>

        <div class="table-controls">
            <div class="search-filter">
                <button class="btn-search"><i class="fas fa-search"></i> Search</button>
                <button class="btn-filter"><i class="fas fa-filter"></i> Filter</button>
            </div>
            <button class="btn-review"><i class="fas fa-plus"></i> Review Milk</button>
        </div>

        <div class="table-wrapper">
            <table class="records-table">
                <thead>
                    <tr>
                        <th>MILK DONOR</th>
                        <th>CLINICAL STATUS</th>
                        <th>SHARIAH APPROVAL</th>
                        <th>SHARIAH REMARKS</th>
                        <th>SHARIAH APPROVAL DATE</th>
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
                        <td><span class="status approved">Approved</span></td>
                        <td>Passed</td>
                        <td class="date green">Jan 12, 2024</td>
                        <td class="actions">
                            <button class="btn-view" onclick="openModal(1)" title="View"><i class="fas fa-eye"></i></button>
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
                        <td><span class="status approved">Approved</span></td>
                        <td>Passed</td>
                        <td class="date green">Feb 05, 2024</td>
                        <td class="actions">
                            <button class="btn-view" onclick="openModal(2)" title="View"><i class="fas fa-eye"></i></button>
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
                        <td><span class="status pending">Pending</span></td>
                        <td>Passed</td>
                        <td>-</td>
                        <td class="actions">
                            <button class="btn-view" onclick="openModal(3)" title="View"><i class="fas fa-eye"></i></button>
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
                                    <div class="donor-details">Aishah Radhi Binti Izzuddin</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="status-badge status-labelling">Labelling</span></td>
                        <td><span class="status approved">Approved</span></td>
                        <td>Passed</td>
                        <td class="date green">Dec 18, 2023</td>
                        <td class="actions">
                            <button class="btn-view" onclick="openModal(4)" title="View"><i class="fas fa-eye"></i></button>
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
                                    <div class="donor-details">Nor Atiqah Humaira Binti Ishak</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="status-badge status-dispatching">Dispatching</span></td>
                        <td><span class="status rejected">Rejected</span></td>
                        <td>Donor is a smoker</td>
                        <td class="date red">Mar 22, 2024</td>
                        <td class="actions">
                            <button class="btn-view" onclick="openModal(5)" title="View"><i class="fas fa-eye"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                            <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-file-medical"></i> Milk Record Details</h2>
                <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be dynamically loaded -->
            </div>
        </div>
    </div>

    <script>
        const milkData = {
            1: {
                milkId: 'Milk ID #1',
                donorName: 'Sarah Ahmad Binti Fauzi',
                donorAvatar: '1',
                clinicalStatus: 'Labelling',
                shariahApproval: 'Approved',
                shariahRemarks: 'All Shariah requirements met. Donor is eligible and follows Islamic guidelines.',
                approvalDate: 'Jan 12, 2024',
                volume: '250 ml',
                collectionDate: 'Jan 10, 2024',
                expiryDate: 'Jul 10, 2024',
                storageLocation: 'Freezer A-12'
            },
            2: {
                milkId: 'Milk ID #2',
                donorName: 'Maryam Binti Othman',
                donorAvatar: '2',
                clinicalStatus: 'Storaging',
                shariahApproval: 'Approved',
                shariahRemarks: 'Verified halal compliance. Donor maintains proper Islamic practices.',
                approvalDate: 'Feb 05, 2024',
                volume: '300 ml',
                collectionDate: 'Feb 03, 2024',
                expiryDate: 'Aug 03, 2024',
                storageLocation: 'Freezer B-05'
            },
            3: {
                milkId: 'Milk ID #3',
                donorName: 'Fatimah Az-zahra Binti Mohd Nor',
                donorAvatar: '3',
                clinicalStatus: 'Screening',
                shariahApproval: 'Pending',
                shariahRemarks: 'Under review. Awaiting final Shariah committee approval.',
                approvalDate: '-',
                volume: '200 ml',
                collectionDate: 'Mar 15, 2024',
                expiryDate: '-',
                storageLocation: 'Pending assignment'
            },
            4: {
                milkId: 'Milk ID #4',
                donorName: 'Aishah Radhi Binti Izzuddin',
                donorAvatar: '4',
                clinicalStatus: 'Labelling',
                shariahApproval: 'Approved',
                shariahRemarks: 'Excellent compliance with Shariah standards. Donor highly recommended.',
                approvalDate: 'Dec 18, 2023',
                volume: '280 ml',
                collectionDate: 'Dec 16, 2023',
                expiryDate: 'Jun 16, 2024',
                storageLocation: 'Freezer A-23'
            },
            5: {
                milkId: 'Milk ID #5',
                donorName: 'Nor Atiqah Humaira Binti Ishak',
                donorAvatar: '5',
                clinicalStatus: 'Dispatching',
                shariahApproval: 'Rejected',
                shariahRemarks: 'Donor is a smoker. Does not meet health and Shariah requirements for milk donation.',
                approvalDate: 'Mar 22, 2024',
                volume: '150 ml',
                collectionDate: 'Mar 20, 2024',
                expiryDate: '-',
                storageLocation: 'Not applicable'
            }
        };

        function openModal(id) {
            const data = milkData[id];
            const modal = document.getElementById('detailModal');
            const modalBody = document.getElementById('modalBody');
            
            const approvalClass = data.shariahApproval.toLowerCase();
            const remarksBoxClass = approvalClass === 'approved' ? 'approved' : approvalClass === 'rejected' ? 'rejected' : '';
            const remarksIcon = approvalClass === 'approved' ? 'fa-check-circle' : approvalClass === 'rejected' ? 'fa-times-circle' : 'fa-clock';
            
            modalBody.innerHTML = `
                <div class="donor-profile">
                    <div class="donor-profile-avatar">${data.donorAvatar}</div>
                    <div class="donor-profile-info">
                        <h3>${data.donorName}</h3>
                        <p>${data.milkId}</p>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Milk Information
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Milk ID</div>
                            <div class="detail-value">${data.milkId}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Volume</div>
                            <div class="detail-value">${data.volume}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Clinical Status</div>
                            <div class="detail-value">
                                <span class="status-badge status-${data.clinicalStatus.toLowerCase()}">${data.clinicalStatus}</span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Storage Location</div>
                            <div class="detail-value">${data.storageLocation}</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="section-title">
                        <i class="fas fa-calendar-alt"></i>
                        Important Dates
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Collection Date</div>
                            <div class="detail-value">${data.collectionDate}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Expiry Date</div>
                            <div class="detail-value">${data.expiryDate}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Shariah Approval Date</div>
                            <div class="detail-value">${data.approvalDate}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Shariah Status</div>
                            <div class="detail-value">
                                <span class="status ${approvalClass}">${data.shariahApproval}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="section-title">
                        <i class="fas fa-clipboard-check"></i>
                        Shariah Review
                    </div>
                    <div class="remarks-box ${remarksBoxClass}">
                        <div class="remarks-icon">
                            <i class="fas ${remarksIcon}"></i>
                        </div>
                        <div class="remarks-content">
                            <h4>Shariah Remarks</h4>
                            <p>${data.shariahRemarks}</p>
                        </div>
                    </div>
                </div>
            `;
            
            modal.classList.add('active');
        }

        function closeModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
@endsection