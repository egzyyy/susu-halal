@extends('layouts.nurse')

@section('title', 'Edit Profile')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/nurse_edit-profile.css') }}">

    <div class="main-content">
        <div class="edit-profile-layout">
            <!-- Left Sidebar -->
            <div class="profile-sidebar-card">
                <div class="profile-avatar-section">
                    <div class="profile-avatar">NJ</div>
                    <button class="avatar-edit-btn" title="Edit Avatar">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                
                <h2 class="profile-name">Nurse Jamila</h2>
                <span class="profile-badge">Registered Nurse</span>
                <p class="profile-member">Registered since January 2024</p>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $patientsScreened ?? 156 }}</div>
                        <div class="stat-label">PATIENTS SCREENED</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $donationsProcessed ?? 284 }}</div>
                        <div class="stat-label">DONATIONS PROCESSED</div>
                    </div>
                </div>

                <div class="health-status-card">
                    <div class="health-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="health-content">
                        <div class="health-title">Professional Status:</div>
                        <div class="health-value">Active</div>
                        <div class="health-date">License verified: April 28, 2024</div>
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
                                <input type="text" id="fullName" value="Nurse Jamila" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" value="n.jamila@email.com" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phone" value="011-23456789" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="employeeId">Employee ID <span class="required">*</span></label>
                                <input type="text" id="employeeId" value="NUR-2024-015" class="form-control" readonly>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="address">Address <span class="required">*</span></label>
                                <textarea id="address" class="form-control" rows="2">123 Medical Quarters, Medina City</textarea>
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
                                <label for="licenseNumber">Nursing License Number <span class="required">*</span></label>
                                <input type="text" id="licenseNumber" value="RN-789456123" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="yearsOfPractice">Years of Experience <span class="required">*</span></label>
                                <input type="number" id="yearsOfPractice" value="8" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="department">Department <span class="required">*</span></label>
                                <select id="department" class="form-control">
                                    <option value="milk-bank" selected>Milk Bank & Lactation Services</option>
                                    <option value="pediatrics">Pediatrics</option>
                                    <option value="nicu">Neonatal ICU</option>
                                    <option value="maternity">Maternity Ward</option>
                                    <option value="outpatient">Outpatient Clinic</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="position">Position/Title <span class="required">*</span></label>
                                <select id="position" class="form-control">
                                    <option value="staff-nurse">Staff Nurse</option>
                                    <option value="senior-nurse" selected>Senior Nurse</option>
                                    <option value="charge-nurse">Charge Nurse</option>
                                    <option value="nurse-supervisor">Nurse Supervisor</option>
                                    <option value="nurse-manager">Nurse Manager</option>
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
                                <label for="education">Highest Nursing Degree <span class="required">*</span></label>
                                <select id="education" class="form-control">
                                    <option value="diploma">Diploma in Nursing</option>
                                    <option value="associate">Associate Degree in Nursing</option>
                                    <option value="bachelor" selected>Bachelor of Science in Nursing</option>
                                    <option value="master">Master of Science in Nursing</option>
                                    <option value="doctorate">Doctor of Nursing Practice</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="specialization">Specialization</label>
                                <select id="specialization" class="form-control">
                                    <option value="">Select specialization</option>
                                    <option value="lactation" selected>Lactation Consultant</option>
                                    <option value="pediatrics">Pediatric Nursing</option>
                                    <option value="neonatal">Neonatal Nursing</option>
                                    <option value="maternal">Maternal-Child Health</option>
                                    <option value="community">Community Health</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="certifications">Professional Certifications</label>
                                <textarea id="certifications" class="form-control" rows="3" placeholder="List your professional certifications...">International Board Certified Lactation Consultant (IBCLC)
Basic Life Support (BLS) Certified
Pediatric Advanced Life Support (PALS)
Milk Bank Operations Certification</textarea>
                                <small class="form-helper">Include all relevant nursing certifications</small>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="skills">Clinical Skills & Expertise</label>
                                <textarea id="skills" class="form-control" rows="3" placeholder="Describe your clinical skills and areas of expertise...">Donor screening and health assessment
Milk expression guidance and support
Infant feeding assessment and support
Milk processing and pasteurization
Infant weight monitoring and growth tracking
Parent education and counseling</textarea>
                                <small class="form-helper">List your key clinical skills and areas of expertise</small>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="training">Recent Training & Workshops</label>
                                <textarea id="training" class="form-control" rows="3" placeholder="List recent training and professional development...">Advanced Lactation Management - March 2024
Milk Banking Safety Protocols - February 2024
Infant Nutrition Workshop - January 2024
Shariah Compliance in Healthcare - December 2023</textarea>
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
                                <input type="text" id="contactName" value="Ahmed Rahman" class="form-control">
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
                                <input type="tel" id="contactPhone" value="+1 (555) 987-6543" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Communication Preferences -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-sliders"></i> Communication Preferences
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="communication">Primary Communication Method</label>
                                <select id="communication" class="form-control">
                                    <option value="email" selected>Email</option>
                                    <option value="sms">SMS</option>
                                    <option value="phone">Phone Call</option>
                                    <option value="whatsapp">WhatsApp</option>
                                    <option value="hospital-system">Hospital System</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label>Notification Preferences</label>
                                <div class="checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Schedule changes and updates</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Urgent donor screening requests</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Milk processing alerts</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox">
                                        <span class="checkbox-text">Staff meeting reminders</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Training and development opportunities</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <a href="{{ route('nurse.profile') }}" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection