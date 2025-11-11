@extends('layouts.doctor')

@section('title', 'Edit Profile')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/doctor_edit-profile.css') }}">

    <div class="main-content">
        <div class="edit-profile-layout">
            <!-- Left Sidebar -->
            <div class="profile-sidebar-card">
                <div class="profile-avatar-section">
                    <div class="profile-avatar">DA</div>
                    <button class="avatar-edit-btn" title="Edit Avatar">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                
                <h2 class="profile-name">Dr. Ahmed</h2>
                <span class="profile-badge">Medical Doctor</span>
                <p class="profile-member">Registered since January 2024</p>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $patientsReviewed ?? 89 }}</div>
                        <div class="stat-label">PATIENTS REVIEWED</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $medicalApprovals ?? 156 }}</div>
                        <div class="stat-label">MEDICAL APPROVALS</div>
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
                                <input type="text" id="fullName" value="Dr. Ahmed" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" value="dr.ahmed@email.com" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phone" value="011-34567890" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="doctorId">Doctor ID <span class="required">*</span></label>
                                <input type="text" id="doctorId" value="MD-2024-045" class="form-control" readonly>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="address">Address <span class="required">*</span></label>
                                <textarea id="address" class="form-control" rows="2">123 Medical Plaza, Medina City</textarea>
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
                                <label for="licenseNumber">Medical License Number <span class="required">*</span></label>
                                <input type="text" id="licenseNumber" value="MD-789456123" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="yearsOfPractice">Years of Practice <span class="required">*</span></label>
                                <input type="number" id="yearsOfPractice" value="8" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="hospital">Hospital Affiliation <span class="required">*</span></label>
                                <input type="text" id="hospital" value="Medina Medical Center" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="department">Department <span class="required">*</span></label>
                                <select id="department" class="form-control">
                                    <option value="pediatrics" selected>Pediatrics</option>
                                    <option value="obstetrics">Obstetrics & Gynecology</option>
                                    <option value="family">Family Medicine</option>
                                    <option value="internal">Internal Medicine</option>
                                    <option value="emergency">Emergency Medicine</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Specialization -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-stethoscope"></i> Medical Specialization
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="primarySpecialty">Primary Specialty <span class="required">*</span></label>
                                <select id="primarySpecialty" class="form-control">
                                    <option value="pediatrics" selected>Pediatrics</option>
                                    <option value="lactation">Lactation Medicine</option>
                                    <option value="neonatology">Neonatology</option>
                                    <option value="nutrition">Clinical Nutrition</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="secondarySpecialty">Secondary Specialty</label>
                                <select id="secondarySpecialty" class="form-control">
                                    <option value="">Select specialty (optional)</option>
                                    <option value="lactation" selected>Lactation Medicine</option>
                                    <option value="pediatrics">Pediatrics</option>
                                    <option value="nutrition">Clinical Nutrition</option>
                                    <option value="public-health">Public Health</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="boardCertifications">Board Certifications</label>
                                <textarea id="boardCertifications" class="form-control" rows="3" placeholder="List your board certifications...">American Board of Pediatrics
International Board of Lactation Consultant Examiners
Pediatric Advanced Life Support (PALS)</textarea>
                                <small class="form-helper">Include all relevant board certifications</small>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="medicalExpertise">Areas of Medical Expertise</label>
                                <textarea id="medicalExpertise" class="form-control" rows="3" placeholder="Describe your medical expertise...">Infant nutrition and growth monitoring
Breastfeeding medicine and lactation support
Milk banking medical oversight
Pediatric preventive care</textarea>
                                <small class="form-helper">Describe your specialized medical knowledge</small>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="professionalBio">Professional Biography</label>
                                <textarea id="professionalBio" class="form-control" rows="4" placeholder="Write a brief professional biography...">Dr. Ahmed is a dedicated pediatrician with special interest in lactation medicine and milk banking. With 8 years of experience, he ensures medical compliance and provides expert guidance on infant nutrition and breastfeeding support.</textarea>
                                <small class="form-helper">This will be displayed on your professional profile</small>
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
                                <input type="text" id="contactName" value="Sarah Ahmed" class="form-control">
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
                                <input type="tel" id="contactPhone" value="+1 (555) 123-4567" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Availability & Preferences -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-sliders"></i> Availability & Preferences
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="consultationHours">Consultation Hours</label>
                                <select id="consultationHours" class="form-control">
                                    <option value="morning" selected>Morning (8AM-12PM)</option>
                                    <option value="afternoon">Afternoon (1PM-5PM)</option>
                                    <option value="evening">Evening (6PM-9PM)</option>
                                    <option value="flexible">Flexible Hours</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label>Medical Review Availability</label>
                                <div class="checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Available for donor medical reviews</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Available for urgent case consultations</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox">
                                        <span class="checkbox-text">Available for on-call duties</span>
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked>
                                        <span class="checkbox-text">Receive medical alert notifications</span>
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
                        <a href="{{ route('doctor.profile') }}" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection