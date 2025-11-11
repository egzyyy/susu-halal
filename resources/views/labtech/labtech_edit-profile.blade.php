@extends('layouts.labtech')

@section('title', 'Edit Profile')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/labtech_edit-profile.css') }}">

    <div class="main-content">
        <div class="edit-profile-layout">
            <!-- Left Sidebar -->
            <div class="profile-sidebar-card">
                <div class="profile-avatar-section">
                    <div class="profile-avatar">LT</div>
                    <button class="avatar-edit-btn" title="Edit Avatar">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                
                <h2 class="profile-name">Lab Tech Rania</h2>
                <span class="profile-badge">Laboratory Technician</span>
                <p class="profile-member">Registered since January 2024</p>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $samplesTested ?? 342 }}</div>
                        <div class="stat-label">SAMPLES TESTED</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $batchesProcessed ?? 128 }}</div>
                        <div class="stat-label">BATCHES PROCESSED</div>
                    </div>
                </div>

                <div class="health-status-card">
                    <div class="health-icon">
                        <i class="fas fa-vial"></i>
                    </div>
                    <div class="health-content">
                        <div class="health-title">Professional Status:</div>
                        <div class="health-value">Active</div>
                        <div class="health-date">Certified until: Dec 2024</div>
                    </div>
                </div>
            </div>

            <!-- Right Form Area -->
            <div class="profile-form-container">
                <form class="edit-profile-form">
                    <!-- Personal Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-user"></i> Personal Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="fullName">Full Name <span class="required">*</span></label>
                                <input type="text" id="fullName" value="Lab Tech Rania" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" value="r.technician@email.com" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phone" value="011-45678901" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="employeeId">Employee ID <span class="required">*</span></label>
                                <input type="text" id="employeeId" value="LT-2024-078" class="form-control" readonly>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="address">Address <span class="required">*</span></label>
                                <textarea id="address" class="form-control" rows="2">456 Science Street, Medina City</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-briefcase"></i> Professional Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="licenseNumber">Laboratory License Number <span class="required">*</span></label>
                                <input type="text" id="licenseNumber" value="MLT-456789123" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="yearsOfExperience">Years of Experience <span class="required">*</span></label>
                                <input type="number" id="yearsOfExperience" value="5" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="laboratory">Laboratory <span class="required">*</span></label>
                                <select id="laboratory" class="form-control">
                                    <option value="quality-control" selected>Quality Control Lab</option>
                                    <option value="microbiology">Microbiology Lab</option>
                                    <option value="chemistry">Chemistry Lab</option>
                                    <option value="hematology">Hematology Lab</option>
                                    <option value="molecular">Molecular Biology Lab</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="position">Position/Title <span class="required">*</span></label>
                                <select id="position" class="form-control">
                                    <option value="technician">Laboratory Technician</option>
                                    <option value="senior-technician" selected>Senior Technician</option>
                                    <option value="supervisor">Lab Supervisor</option>
                                    <option value="manager">Lab Manager</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Qualifications & Certifications -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-graduation-cap"></i> Qualifications & Certifications
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="education">Highest Degree <span class="required">*</span></label>
                                <select id="education" class="form-control">
                                    <option value="diploma">Diploma in Medical Laboratory</option>
                                    <option value="associate">Associate Degree</option>
                                    <option value="bachelor" selected>Bachelor of Medical Laboratory Science</option>
                                    <option value="master">Master's Degree</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="specialization">Laboratory Specialization</label>
                                <select id="specialization" class="form-control">
                                    <option value="microbiology">Microbiology</option>
                                    <option value="chemistry" selected>Clinical Chemistry</option>
                                    <option value="hematology">Hematology</option>
                                    <option value="immunology">Immunology</option>
                                    <option value="molecular">Molecular Biology</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="certifications">Professional Certifications</label>
                                <textarea id="certifications" class="form-control" rows="3" placeholder="List your professional certifications...">Medical Laboratory Technician (MLT)
Clinical Laboratory Improvement Amendments (CLIA)
Food Safety and Handling Certification
Milk Banking Laboratory Specialist</textarea>
                                <small class="form-helper">Include all relevant laboratory certifications</small>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="technicalSkills">Technical Skills & Expertise</label>
                                <textarea id="technicalSkills" class="form-control" rows="3" placeholder="Describe your technical skills and expertise...">Microbiological testing and analysis
Chemical composition analysis
Equipment operation and maintenance
Quality control procedures
Safety protocol implementation
Data recording and reporting</textarea>
                                <small class="form-helper">List your key technical skills and laboratory expertise</small>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="training">Recent Training & Workshops</label>
                                <textarea id="training" class="form-control" rows="3" placeholder="List recent training and professional development...">Advanced Milk Testing Techniques - April 2024
Laboratory Safety Protocols - March 2024
Quality Assurance in Milk Banking - February 2024
New Equipment Training - January 2024</textarea>
                                <small class="form-helper">Include recent professional development activities</small>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-phone-alt"></i> Emergency Contact
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="contactName">Contact Name <span class="required">*</span></label>
                                <input type="text" id="contactName" value="Omar Rania" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="relationship">Relationship <span class="required">*</span></label>
                                <select id="relationship" class="form-control">
                                    <option value="spouse" selected>Spouse</option>
                                    <option value="parent">Parent</option>
                                    <option value="sibling">Sibling</option>
                                    <option value="child">Child</option>
                                    <option value="friend">Friend</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="contactPhone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="contactPhone" value="+1 (555) 234-5678" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <a href="{{ route('labtech.profile') }}" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection