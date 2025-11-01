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

        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
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

    <div class="w-full max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Left Side - Brand & Illustration -->
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

            <!-- Benefits List -->
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

        <!-- Right Side - Registration Form -->
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

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label for="name" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-user text-blue-500 text-sm"></i>
                            <span>Full Name</span>
                        </label>
                        <div class="relative">
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                value="{{ old('name') }}"
                                required 
                                autofocus 
                                autocomplete="name"
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your full name"
                            >
                            <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('name')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

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
                                value="{{ old('email') }}"
                                required 
                                autocomplete="email"
                                class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Enter your email"
                            >
                            <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('email')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-lock text-blue-500 text-sm"></i>
                            <span>Password</span>
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full px-4 py-3 pl-11 pr-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Create a password"
                                oninput="checkPasswordStrength(this.value)"
                            >
                            <i class="fas fa-key absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye" id="password-toggle"></i>
                            </button>
                        </div>
                        
                        <!-- Password Strength Meter -->
                        <div class="space-y-1">
                            <div class="flex space-x-1">
                                <div id="strength-1" class="password-strength flex-1 bg-gray-200"></div>
                                <div id="strength-2" class="password-strength flex-1 bg-gray-200"></div>
                                <div id="strength-3" class="password-strength flex-1 bg-gray-200"></div>
                                <div id="strength-4" class="password-strength flex-1 bg-gray-200"></div>
                            </div>
                            <p id="password-feedback" class="text-xs text-gray-500"></p>
                        </div>

                        @error('password')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-lock text-blue-500 text-sm"></i>
                            <span>Confirm Password</span>
                        </label>
                        <div class="relative">
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full px-4 py-3 pl-11 pr-11 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                placeholder="Confirm your password"
                            >
                            <i class="fas fa-key absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye" id="confirm-password-toggle"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
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

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-[#1a5f7a] to-[#57cc99] text-white py-3 px-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 focus:ring-4 focus:ring-blue-200 focus:outline-none"
                    >
                        <span class="flex items-center justify-center space-x-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Create Account</span>
                        </span>
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">
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

    <script>
        // Password toggle functionality
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId === 'password' ? 'password-toggle' : 'confirm-password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];
            const feedback = document.getElementById('password-feedback');
            
            let strength = 0;
            let feedbackText = '';
            let color = '';

            // Reset bars
            strengthBars.forEach(bar => {
                bar.style.backgroundColor = '#e5e7eb';
            });

            if (password.length === 0) {
                feedbackText = 'Enter a password';
                feedback.style.color = '#6b7280';
                return;
            }

            // Length check
            if (password.length >= 8) strength++;
            // Lowercase check
            if (/[a-z]/.test(password)) strength++;
            // Uppercase check
            if (/[A-Z]/.test(password)) strength++;
            // Number/Special char check
            if (/[0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) strength++;

            // Update bars and feedback
            for (let i = 0; i < strength; i++) {
                if (strength === 1) {
                    strengthBars[i].style.backgroundColor = '#ef4444'; // Red
                    feedbackText = 'Weak password';
                    feedback.style.color = '#ef4444';
                } else if (strength === 2) {
                    strengthBars[i].style.backgroundColor = '#f59e0b'; // Orange
                    feedbackText = 'Fair password';
                    feedback.style.color = '#f59e0b';
                } else if (strength === 3) {
                    strengthBars[i].style.backgroundColor = '#eab308'; // Yellow
                    feedbackText = 'Good password';
                    feedback.style.color = '#eab308';
                } else if (strength === 4) {
                    strengthBars[i].style.backgroundColor = '#22c55e'; // Green
                    feedbackText = 'Strong password';
                    feedback.style.color = '#22c55e';
                }
            }

            feedback.textContent = feedbackText;
        }

        // Enhanced role selection interactions
        document.querySelectorAll('.role-option input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Add subtle animation when selected
                const label = this.closest('.role-option');
                label.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    label.style.transform = 'scale(1)';
                }, 150);
            });
        });

        // Form submission loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Creating Account...</span>';
            button.disabled = true;
        });

        // Auto-select role based on URL parameter (optional)
        const urlParams = new URLSearchParams(window.location.search);
        const presetRole = urlParams.get('role');
        if (presetRole) {
            const roleRadio = document.querySelector(`input[name="role"][value="${presetRole}"]`);
            if (roleRadio) {
                roleRadio.checked = true;
                roleRadio.dispatchEvent(new Event('change'));
            }
        }
    </script>
</body>
</html>