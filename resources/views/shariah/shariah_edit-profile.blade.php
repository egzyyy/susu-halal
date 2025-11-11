@extends('layouts.shariah')

@section('title', 'Edit Profile')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/shariah_edit-profile.css') }}">

    <div class="main-content">
        <div class="edit-profile-layout">
            <!-- Left Sidebar -->
            <div class="profile-sidebar-card">
                <div class="profile-avatar-section">
                    <div class="profile-avatar">SA</div>
                    <button class="avatar-edit-btn" title="Edit Avatar">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                
                <h2 class="profile-name">Ustaz Ahmad</h2>
                <span class="profile-badge">Shariah Advisor</span>
                <p class="profile-member">Registered since January 2024</p>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $casesReviewed ?? 67 }}</div>
                        <div class="stat-label">CASES REVIEWED</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $fatwaIssued ?? 23 }}</div>
                        <div class="stat-label">FATWA ISSUED</div>
                    </div>
                </div>

                <div class="health-status-card">
                    <div class="health-icon">
                        <i class="fas fa-scale-balanced"></i>
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
                                <input type="text" id="fullName" value="Ustaz Ahmad" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" value="ustaz.ahmad@email.com" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phone" value="011-56789012" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="advisorId">Advisor ID <span class="required">*</span></label>
                                <input type="text" id="advisorId" value="SHA-2024-032" class="form-control" readonly>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="address">Address <span class="required">*</span></label>
                                <textarea id="address" class="form-control" rows="2">789 Islamic Quarter, Medina City</textarea>
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
                                <label for="certificationNumber">Shariah Certification Number <span class="required">*</span></label>
                                <input type="text" id="certificationNumber" value="SC-123456789" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="yearsOfExperience">Years of Experience <span class="required">*</span></label>
                                <input type="number" id="yearsOfExperience" value="6" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="institution">Institution <span class="required">*</span></label>
                                <input type="text" id="institution" value="Islamic Medical Ethics Board" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="position">Position/Title <span class="required">*</span></label>
                                <select id="position" class="form-control">
                                    <option value="advisor">Shariah Advisor</option>
                                    <option value="senior-advisor" selected>Senior Advisor</option>
                                    <option value="committee-member">Committee Member</option>
                                    <option value="director">Director</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Specialization & Expertise -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-graduation-cap"></i> Specialization & Expertise
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="primaryExpertise">Primary Expertise <span class="required">*</span></label>
                                <select id="primaryExpertise" class="form-control">
                                    <option value="family-law" selected>Islamic Family Law</option>
                                    <option value="medical-ethics">Medical Ethics</option>
                                    <option value="bioethics">Bioethics</option>
                                    <option value="inheritance">Inheritance Law</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="secondaryExpertise">Secondary Expertise</label>
                                <select id="secondaryExpertise" class="form-control">
                                    <option value="">Select expertise (optional)</option>
                                    <option value="medical-ethics" selected>Medical Ethics</option>
                                    <option value="family-law">Islamic Family Law</option>
                                    <option value="bioethics">Bioethics</option>
                                    <option value="child-welfare">Child Welfare</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="qualifications">Qualifications & Certifications</label>
                                <textarea id="qualifications" class="form-control" rows="3" placeholder="List your qualifications and certifications...">Bachelor of Islamic Law and Jurisprudence
Certified Shariah Advisor
Islamic Medical Ethics Certification
Milk Kinship and Family Law Specialist</textarea>
                                <small class="form-helper">Include all relevant Islamic studies qualifications</small>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="areasOfExpertise">Areas of Shariah Expertise</label>
                                <textarea id="areasOfExpertise" class="form-control" rows="3" placeholder="Describe your areas of Shariah expertise...">Milk kinship (radāʿah) and family relationships
Islamic medical ethics and bioethics
Family law and inheritance
Child welfare and protection
Medical procedures compliance with Shariah</textarea>
                                <small class="form-helper">Describe your specialized knowledge in Shariah law</small>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="professionalBio">Professional Biography</label>
                                <textarea id="professionalBio" class="form-control" rows="4" placeholder="Write a brief professional biography...">Ustaz Ahmad is a respected Shariah advisor specializing in Islamic medical ethics with 6 years of experience. He provides expert guidance on milk kinship issues and ensures all milk banking operations comply with Islamic principles and family law.</textarea>
                                <small class="form-helper">This will be displayed on your professional profile</small>
                            </div>
                        </div>
                    </div>

                    <!-- Case Review Preferences -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-tasks"></i> Case Review Preferences
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="reviewSpecialization">Case Review Specialization</label>
                                <select id="reviewSpecialization" class="form-control">
                                    <option value="milk-kinship" selected>Milk Kinship Cases</option>
                                    <option value="donor-screening">Donor Screening</option>
                                    <option value="medical-ethics">Medical Ethics</option>
                                    <option value="family-law">Family Law Issues</option>
                                    <option value="all-cases">All Case Types</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label>Availability for Case Reviews</label>
                                <div class="checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Available for milk kinship reviews</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Available for urgent case consultations</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox">
                                        <span class="checkbox-text">Available for committee meetings</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Receive case notification alerts</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Available for fatwa issuance</span>
                                    </label>
                                </div>
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
                                <input type="text" id="contactName" value="Fatima Ahmad" class="form-control">
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
                                <input type="tel" id="contactPhone" value="+1 (555) 345-6789" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <a href="{{ route('shariah.profile') }}" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection