<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Rahma Milk Bank</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #1a5f7a;
            --secondary: #57cc99;
            --accent: #ffd166;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #2a9d8f;
            --gradient: linear-gradient(135deg, #1a5f7a 0%, #57cc99 100%);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .gradient-text {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .step-item {
            position: relative;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 12px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #e5e7eb;
            z-index: -1;
        }

        .step-item.active:not(:last-child)::after {
            background: linear-gradient(to right, #57cc99, #e5e7eb);
        }

        .step-item.completed:not(:last-child)::after {
            background: #57cc99;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 flex items-center justify-center p-4">
    <!-- Background Decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-10 -left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 float-animation"></div>
        <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 float-animation" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 float-animation" style="animation-delay: 4s;"></div>
    </div>

    <!-- Email Registration Page -->
    <div id="emailPage" class="w-full max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Left Side -->
        <div class="hidden lg:flex flex-col items-center justify-center space-y-8">
            <div class="text-center space-y-4">
                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-[#1a5f7a] to-[#57cc99] rounded-2xl flex items-center justify-center shadow-2xl">
                    <i class="fas fa-baby-carriage text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold gradient-text">Rahma Milk Bank</h1>
                <p class="text-gray-600 text-lg max-w-md mx-auto">
                    Join our community of caring donors and families. Create your account to get started.
                </p>
            </div>

            <div class="space-y-4 mt-8">
                <div class="flex items-center space-x-3 p-4 rounded-2xl glass-effect shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shield-alt text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Secure & Private</h3>
                        <p class="text-sm text-gray-600">Your data is protected</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-4 rounded-2xl glass-effect shadow-sm">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Quick Setup</h3>
                        <p class="text-sm text-gray-600">Get started in minutes</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-4 rounded-2xl glass-effect shadow-sm">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-comments text-purple-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">24/7 Support</h3>
                        <p class="text-sm text-gray-600">We're here to help</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="w-full max-w-md mx-auto">
            <div class="glass-effect rounded-3xl shadow-2xl p-8 space-y-6">
                <!-- Header -->
                <div class="text-center space-y-2">
                    <div class="lg:hidden w-16 h-16 mx-auto bg-gradient-to-br from-[#1a5f7a] to-[#57cc99] rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-baby-carriage text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
                    <p class="text-gray-600">Join our community today</p>
                </div>

                <form id="emailForm" class="space-y-6">
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-envelope text-blue-500 text-sm"></i>
                            <span>Email Address</span>
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                autocomplete="email"
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your email"
                            >
                            <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="flex items-start space-x-3">
                        <input 
                            id="terms" 
                            name="terms" 
                            type="checkbox" 
                            required
                            class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="terms" class="text-sm text-gray-600">
                            I agree to the 
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Terms of Service</a> 
                            and 
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Next Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-[#1a5f7a] to-[#57cc99] text-white py-3 px-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 focus:ring-4 focus:ring-blue-200 focus:outline-none"
                    >
                        <span class="flex items-center justify-center space-x-2">
                            <span>Next</span>
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-600">
                        Already have an account?
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="text-center mt-6 space-y-2">
                <div class="flex justify-center space-x-6 text-sm text-gray-500">
                    <a href="#" class="hover:text-gray-700 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-700 transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-gray-700 transition-colors">Support</a>
                </div>
                <p class="text-xs text-gray-400">&copy; 2024 Rahma Milk Bank. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Personal Information Page -->
    <div id="personalInfoPage" class="w-full max-w-6xl mx-auto hidden">
        <div class="w-full max-w-3xl mx-auto">
            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-between max-w-2xl mx-auto">
                    <div class="step-item completed flex flex-col items-center flex-1">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#57cc99] to-[#2a9d8f] flex items-center justify-center text-white shadow-lg mb-2">
                            <i class="fas fa-check text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Email</span>
                    </div>
                    <div class="step-item active flex flex-col items-center flex-1">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a5f7a] to-[#57cc99] flex items-center justify-center text-white shadow-lg mb-2">
                            <span class="text-sm font-semibold">2</span>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Profile</span>
                    </div>
                    <div class="step-item flex flex-col items-center flex-1">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mb-2">
                            <span class="text-sm font-semibold">3</span>
                        </div>
                        <span class="text-xs font-medium text-gray-400">Health & Lifestyle</span>
                    </div>
                    <div class="step-item flex flex-col items-center flex-1">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mb-2">
                            <span class="text-sm font-semibold">4</span>
                        </div>
                        <span class="text-xs font-medium text-gray-400">Complete</span>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="glass-effect rounded-3xl shadow-2xl p-8 space-y-6">
                <!-- Header -->
                <div class="text-center space-y-2 pb-4 border-b border-gray-200">
                    <h2 class="text-3xl font-bold gradient-text">Personal Information</h2>
                    <p class="text-gray-600">Fill out your profile</p>
                </div>

                <form id="personalInfoForm" class="space-y-5">
                    <!-- NRIC/Passport -->
                    <div class="space-y-2">
                        <label for="nric" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-id-card text-blue-500 text-sm"></i>
                            <span>NRIC/Passport <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                id="nric" 
                                name="nric" 
                                type="text" 
                                required 
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your NRIC/passport"
                            >
                            <i class="fas fa-id-card absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 ml-1">We'll send a verification code to this email address</p>
                    </div>

                    <!-- Full Name -->
                    <div class="space-y-2">
                        <label for="fullname" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-user text-green-500 text-sm"></i>
                            <span>Full Name <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                id="fullname" 
                                name="fullname" 
                                type="text" 
                                required 
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your Full Name"
                            >
                            <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 ml-1">We'll send a verification code to this email address</p>
                    </div>

                    <!-- Date of Birth -->
                    <div class="space-y-2">
                        <label for="dob" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-calendar-alt text-purple-500 text-sm"></i>
                            <span>Date of Birth <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                id="dob" 
                                name="dob" 
                                type="date" 
                                required 
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            >
                            <i class="fas fa-calendar-alt absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 ml-1">We'll send a verification code to this email address</p>
                    </div>

                    <!-- Contact -->
                    <div class="space-y-2">
                        <label for="contact" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-phone text-orange-500 text-sm"></i>
                            <span>Contact <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                id="contact" 
                                name="contact" 
                                type="tel" 
                                required 
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your Phone Number"
                            >
                            <i class="fas fa-phone absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 ml-1">We'll send a verification code to this email address</p>
                    </div>

                    <!-- Address -->
                    <div class="space-y-2">
                        <label for="address" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-home text-pink-500 text-sm"></i>
                            <span>Address <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <textarea 
                                id="address" 
                                name="address" 
                                rows="3"
                                required 
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none"
                                placeholder="Enter your address"
                            ></textarea>
                            <i class="fas fa-home absolute left-4 top-5 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 ml-1">Enter your complete residential address</p>
                    </div>

                    <!-- Parity -->
                    <div class="space-y-2">
                        <label for="parity" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-baby text-indigo-500 text-sm"></i>
                            <span>Parity <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                id="parity" 
                                name="parity" 
                                type="text" 
                                required 
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your parity"
                            >
                            <i class="fas fa-baby absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 ml-1">Number of times you have given birth</p>
                    </div>

                    <!-- Delivery Dates -->
                    <div class="space-y-2">
                        <label for="deliveryDates" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-calendar-check text-teal-500 text-sm"></i>
                            <span>Delivery Dates <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                id="deliveryDates" 
                                name="deliveryDates" 
                                type="text" 
                                required 
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your delivery dates"
                            >
                            <i class="fas fa-calendar-check absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 ml-1">Date(s) of your delivery/deliveries</p>
                    </div>

                    <!-- Breastfeeding Status -->
                    <div class="space-y-2">
                        <label for="breastfeedingStatus" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-heart text-red-500 text-sm"></i>
                            <span>Breastfeeding Status <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                id="breastfeedingStatus" 
                                name="breastfeedingStatus" 
                                type="text" 
                                required 
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your breastfeeding status"
                            >
                            <i class="fas fa-heart absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 ml-1">Current breastfeeding status</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button 
                            type="button"
                            onclick="goBackToEmail()"
                            class="flex-1 bg-gray-100 text-gray-700 py-3 px-4 rounded-2xl font-semibold hover:bg-gray-200 transition-all duration-200 focus:ring-4 focus:ring-gray-200 focus:outline-none"
                        >
                            <span class="flex items-center justify-center space-x-2">
                                <i class="fas fa-arrow-left"></i>
                                <span>Back</span>
                            </span>
                        </button>
                        <button 
                            type="submit" 
                            class="flex-1 bg-gradient-to-r from-[#1a5f7a] to-[#57cc99] text-white py-3 px-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 focus:ring-4 focus:ring-blue-200 focus:outline-none"
                        >
                            <span class="flex items-center justify-center space-x-2">
                                <span>Next</span>
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 space-y-2">
                <div class="flex justify-center space-x-6 text-sm text-gray-500">
                    <a href="#" class="hover:text-gray-700 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-700 transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-gray-700 transition-colors">Support</a>
                </div>
                <p class="text-xs text-gray-400">&copy; 2024 Rahma Milk Bank. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Health & Lifestyle Page -->
<div id="healthLifestylePage" class="w-full max-w-6xl mx-auto hidden">
    <div class="w-full max-w-3xl mx-auto">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-between max-w-2xl mx-auto">
                <div class="step-item completed flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#57cc99] to-[#2a9d8f] flex items-center justify-center text-white shadow-lg mb-2">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Email</span>
                </div>
                <div class="step-item completed flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#57cc99] to-[#2a9d8f] flex items-center justify-center text-white shadow-lg mb-2">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Profile</span>
                </div>
                <div class="step-item active flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a5f7a] to-[#57cc99] flex items-center justify-center text-white shadow-lg mb-2">
                        <span class="text-sm font-semibold">3</span>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Health & Lifestyle</span>
                </div>
                <div class="step-item flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mb-2">
                        <span class="text-sm font-semibold">4</span>
                    </div>
                    <span class="text-xs font-medium text-gray-400">Complete</span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8 space-y-6">
            <!-- Header -->
            <div class="text-center space-y-2 pb-4 border-b border-gray-200">
                <h2 class="text-3xl font-bold gradient-text">Health & Lifestyle</h2>
                <p class="text-gray-600">Fill out your profile</p>
            </div>

            <form id="healthLifestyleForm" class="space-y-5">
                <!-- Infectious Disease Risk -->
                <div class="space-y-2">
                    <label for="infectiousRisk" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-shield-virus text-red-500 text-sm"></i>
                        <span>Infectious Disease Risk <span class="text-red-500">*</span></span>
                    </label>
                    <div class="relative">
                        <input 
                            id="infectiousRisk" 
                            name="infectiousRisk" 
                            type="text" 
                            required 
                            class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            placeholder="Enter your infectious disease risk"
                        >
                        <i class="fas fa-shield-virus absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Medication -->
                <div class="space-y-2">
                    <label for="medication" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-pills text-blue-500 text-sm"></i>
                        <span>Medication <span class="text-red-500">*</span></span>
                    </label>
                    <div class="relative">
                        <input 
                            id="medication" 
                            name="medication" 
                            type="text" 
                            required 
                            class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            placeholder="Enter your medication"
                        >
                        <i class="fas fa-pills absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Recent Illness -->
                <div class="space-y-2">
                    <label for="recentIllness" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-thermometer-half text-orange-500 text-sm"></i>
                        <span>Recent Illness <span class="text-red-500">*</span></span>
                    </label>
                    <div class="relative">
                        <input 
                            id="recentIllness" 
                            name="recentIllness" 
                            type="text" 
                            required 
                            class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            placeholder="Enter your recent illness"
                        >
                        <i class="fas fa-thermometer-half absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Tobacco/Alcohol -->
                <div class="space-y-2">
                    <label for="tobaccoAlcohol" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-smoking-ban text-gray-600 text-sm"></i>
                        <span>Tobacco/Alcohol <span class="text-red-500">*</span></span>
                    </label>
                    <div class="relative">
                        <input 
                            id="tobaccoAlcohol" 
                            name="tobaccoAlcohol" 
                            type="text" 
                            required 
                            class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            placeholder="Enter your tobacco/alcohol usage"
                        >
                        <i class="fas fa-smoking-ban absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Dietary Alerts -->
                <div class="space-y-2">
                    <label for="dietaryAlerts" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-utensils text-green-500 text-sm"></i>
                        <span>Dietary Alerts <span class="text-red-500">*</span></span>
                    </label>
                    <div class="relative">
                        <input 
                            id="dietaryAlerts" 
                            name="dietaryAlerts" 
                            type="text" 
                            required 
                            class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            placeholder="Enter your dietary alerts"
                        >
                        <i class="fas fa-utensils absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-4">
                    <button 
                        type="button"
                        onclick="goBackToPersonalInfo()"
                        class="flex-1 bg-gray-100 text-gray-700 py-3 px-4 rounded-2xl font-semibold hover:bg-gray-200 transition-all duration-200 focus:ring-4 focus:ring-gray-200 focus:outline-none"
                    >
                        <span class="flex items-center justify-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </span>
                    </button>
                    <button 
                        type="submit" 
                        class="flex-1 bg-gradient-to-r from-[#1a5f7a] to-[#57cc99] text-white py-3 px-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 focus:ring-4 focus:ring-blue-200 focus:outline-none"
                    >
                        <span class="flex items-center justify-center space-x-2">
                            <span>Next</span>
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 space-y-2">
            <div class="flex justify-center space-x-6 text-sm text-gray-500">
                <a href="#" class="hover:text-gray-700 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-gray-700 transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-gray-700 transition-colors">Support</a>
            </div>
            <p class="text-xs text-gray-400">&copy; 2024 Rahma Milk Bank. All rights reserved.</p>
        </div>
    </div>
</div>

<!-- Final Completion Page -->
<div id="completePage" class="w-full max-w-6xl mx-auto hidden">
    <div class="w-full max-w-3xl mx-auto">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-between max-w-2xl mx-auto">
                <div class="step-item completed flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#57cc99] to-[#2a9d8f] flex items-center justify-center text-white shadow-lg mb-2">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Email</span>
                </div>
                <div class="step-item completed flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#57cc99] to-[#2a9d8f] flex items-center justify-center text-white shadow-lg mb-2">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Profile</span>
                </div>
                <div class="step-item completed flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#57cc99] to-[#2a9d8f] flex items-center justify-center text-white shadow-lg mb-2">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Health & Lifestyle</span>
                </div>
                <div class="step-item completed flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#57cc99] to-[#2a9d8f] flex items-center justify-center text-white shadow-lg mb-2">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Complete</span>
                </div>
            </div>
        </div>

        <!-- Completion Card -->
        <div class="glass-effect rounded-3xl shadow-2xl p-12 space-y-8">
            <!-- Success Icon with Pulse Animation -->
            <div class="flex justify-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-blue-400 rounded-full pulse-ring"></div>
                    <div class="absolute inset-0 bg-blue-400 rounded-full pulse-ring" style="animation-delay: 1s;"></div>
                    <div class="relative w-32 h-32 bg-gradient-to-br from-[#0066ff] to-[#0052cc] rounded-full flex items-center justify-center shadow-2xl">
                        <i class="fas fa-info text-white text-6xl"></i>
                    </div>
                </div>
            </div>

            <!-- Message -->
            <div class="text-center space-y-4">
                <h2 class="text-3xl font-bold text-gray-800">You will get a</h2>
                <h2 class="text-3xl font-bold text-gray-800">credential via email</h2>
                <h2 class="text-3xl font-bold text-gray-800">once you click "Next"</h2>
                <h2 class="text-3xl font-bold text-gray-800">button</h2>
            </div>

            <!-- Action Buttons -->
<div class="flex justify-between items-center pt-6">
    <!-- Back Button -->
    <button 
        type="button"
        onclick="goBackToHealthLifestyle()"
        class="bg-gray-100 text-gray-700 py-3 px-8 rounded-2xl font-semibold hover:bg-gray-200 transition-all duration-200 focus:ring-4 focus:ring-gray-200 focus:outline-none"
    >
        <span class="flex items-center space-x-2">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </span>
    </button>

    <!-- Confirm Button -->
    <a 
        href="{{ route('login') }}" 
        class="bg-gradient-to-r from-[#1a5f7a] to-[#57cc99] text-white py-3 px-8 rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 focus:ring-4 focus:ring-green-200 focus:outline-none"
    >
        <span class="flex items-center space-x-2">
            <span>Confirm</span>
            <i class="fas fa-check"></i>
        </span>
    </a>
</div>

        </div>

        <!-- Footer -->
        <div class="text-center mt-6 space-y-2">
            <div class="flex justify-center space-x-6 text-sm text-gray-500">
                <a href="#" class="hover:text-gray-700 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-gray-700 transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-gray-700 transition-colors">Support</a>
            </div>
            <p class="text-xs text-gray-400">&copy; 2024 Rahma Milk Bank. All rights reserved.</p>
        </div>
    </div>
</div>

    <script>
        // Handle email form submission
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const terms = document.getElementById('terms').checked;
            
            if (email && terms) {
                // Hide email page and show personal info page
                document.getElementById('emailPage').classList.add('hidden');
                document.getElementById('personalInfoPage').classList.remove('hidden');
                
                // Scroll to top
                window.scrollTo(0, 0);
            }
        });

        // Handle personal info form submission
    document.getElementById('personalInfoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Hide personal info page and show health & lifestyle page
        document.getElementById('personalInfoPage').classList.add('hidden');
        document.getElementById('healthLifestylePage').classList.remove('hidden');
        
        // Scroll to top
        window.scrollTo(0, 0);
    });

    // Handle health & lifestyle form submission
    document.getElementById('healthLifestyleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Hide health & lifestyle page and show complete page
        document.getElementById('healthLifestylePage').classList.add('hidden');
        document.getElementById('completePage').classList.remove('hidden');
        
        // Scroll to top
        window.scrollTo(0, 0);
    });

    // Back button functions
    function goBackToEmail() {
        document.getElementById('personalInfoPage').classList.add('hidden');
        document.getElementById('emailPage').classList.remove('hidden');
        window.scrollTo(0, 0);
    }

    function goBackToPersonalInfo() {
        document.getElementById('healthLifestylePage').classList.add('hidden');
        document.getElementById('personalInfoPage').classList.remove('hidden');
        window.scrollTo(0, 0);
    }

    function goBackToHealthLifestyle() {
        document.getElementById('completePage').classList.add('hidden');
        document.getElementById('healthLifestylePage').classList.remove('hidden');
        window.scrollTo(0, 0);
    }
    </script>
</body>
</html>