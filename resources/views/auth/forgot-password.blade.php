<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Rahma Milk Bank</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary: #1a5f7a;
            --secondary: #57cc99;
            --gradient: linear-gradient(135deg, #1a5f7a 0%, #57cc99 100%);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-animation { animation: float 6s ease-in-out infinite; }
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
        @supports not (backdrop-filter: blur(10px)) {
            .glass-effect { background: rgba(255, 255, 255, 0.98); }
        }
        .btn-loading {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 flex items-center justify-center p-4">

    <!-- Background Decor -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-10 -left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 float-animation"></div>
        <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 float-animation" style="animation-delay:2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 float-animation" style="animation-delay:4s;"></div>
    </div>

    <div class="w-full max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Left Side -->
        <div class="hidden lg:flex flex-col items-center justify-center space-y-8">
            <div class="text-center space-y-4">
                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-[#1a5f7a] to-[#57cc99] rounded-2xl flex items-center justify-center shadow-2xl">
                    <i class="fas fa-baby-carriage text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold gradient-text">Rahma Milk Bank</h1>
                <p class="text-gray-600 text-lg max-w-md mx-auto">
                    A Shariah-compliant milk sharing platform helping mothers and infants in need.
                </p>
            </div>
        </div>

        <!-- Right Side -->
        <div class="w-full max-w-md mx-auto">
            <div class="glass-effect rounded-3xl shadow-2xl p-8 space-y-6">

                <div class="text-center space-y-2">
                    <div class="lg:hidden w-16 h-16 mx-auto bg-gradient-to-br from-[#1a5f7a] to-[#57cc99] rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Forgot Password?</h2>
                    <p class="text-gray-600 text-sm">
                        No worries — enter your email or WhatsApp and we'll send you a reset link.
                    </p>
                </div>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Choose Method -->
                <div class="flex justify-center gap-3 mb-4">
                    <button id="btnEmail" class="px-5 py-2.5 rounded-xl font-semibold shadow-md bg-blue-600 text-white border border-blue-600 hover:bg-blue-700 transition">
                        Use Email
                    </button>
                    <button id="btnContact" class="px-5 py-2.5 rounded-xl font-semibold shadow-md bg-white text-green-700 border border-green-300 hover:bg-green-50 transition">
                        Use Contact
                    </button>
                </div>

                <!-- Form -->
                <form id="forgotForm" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div id="emailSection" class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-envelope text-blue-500 text-sm"></i>
                            <span>Email Address</span>
                        </label>
                        <div class="relative">
                            <input id="email" name="email" type="email" 
                                   class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl bg-white/80 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   placeholder="Enter your email">
                            <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <div id="emailError" class="mt-2 text-sm text-red-600 hidden"></div>
                    </div>

                    <!-- Contact -->
                    <div id="contactSection" class="space-y-2 hidden">
                        <label class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-phone text-green-500 text-sm"></i>
                            <span>WhatsApp Number</span>
                        </label>
                        <div class="relative">
                            <input id="contact" name="contact" type="text" 
                                   class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl bg-white/80 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                                   placeholder="e.g., 60123456789">
                            <i class="fas fa-phone absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <div id="contactError" class="mt-2 text-sm text-red-600 hidden"></div>
                    </div>

                    <button type="submit" id="sendOtpBtn" class="w-full bg-gradient-to-r from-[#1a5f7a] to-[#57cc99] text-white py-3 px-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        <span class="flex items-center justify-center space-x-2">
                            <i class="fas fa-paper-plane"></i>
                            <span id="btnText">Send OTP</span>
                        </span>
                    </button>
                </form>

                <!-- OTP Section -->
                <div id="otpSection" class="space-y-4 hidden mt-6">
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl">
                        <p class="text-sm flex items-center space-x-2">
                            <i class="fas fa-info-circle"></i>
                            <span>Enter the OTP sent to <strong id="sentTo"></strong></span>
                        </p>
                    </div>

                    <div class="relative">
                        <input id="otp" type="text" maxlength="6" 
                               class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-2xl bg-white/80 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 text-center text-2xl font-bold tracking-widest" 
                               placeholder="000000">
                        <i class="fas fa-shield-alt absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <div id="otpError" class="text-sm text-red-600 hidden"></div>

                    <div class="flex justify-between items-center text-sm">
                        <button type="button" id="resendOtp" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            <i class="fas fa-redo-alt mr-1"></i>Resend OTP
                        </button>
                        <span class="text-gray-500 font-medium">
                            <i class="fas fa-clock mr-1"></i>
                            <span id="otpTimer">05:00</span>
                        </span>
                    </div>

                    <button id="verifyOtpBtn" type="button" class="w-full bg-gradient-to-r from-[#1a5f7a] to-[#57cc99] text-white py-3 px-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        <span class="flex items-center justify-center space-x-2">
                            <i class="fas fa-check-circle"></i>
                            <span>Verify OTP</span>
                        </span>
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200 flex items-center justify-center space-x-2">
                        <i class="fas fa-arrow-left text-sm"></i>
                        <span>Back to Login</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('Script loaded'); // Debug log

    const emailSection = document.getElementById('emailSection');
    const contactSection = document.getElementById('contactSection');
    const btnEmail = document.getElementById('btnEmail');
    const btnContact = document.getElementById('btnContact');
    const emailInput = document.getElementById('email');
    const contactInput = document.getElementById('contact');

    // Toggle between email and contact
    btnEmail.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('Email button clicked'); // Debug log
        emailSection.classList.remove('hidden');
        contactSection.classList.add('hidden');
        contactInput.value = ''; // Clear contact input
        btnEmail.classList.remove('bg-white', 'text-blue-700');
        btnEmail.classList.add('bg-blue-600', 'text-white');
        btnContact.classList.remove('bg-green-600', 'text-white');
        btnContact.classList.add('bg-white', 'text-green-700');
    });

    btnContact.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('Contact button clicked'); // Debug log
        contactSection.classList.remove('hidden');
        emailSection.classList.add('hidden');
        emailInput.value = ''; // Clear email input
        btnContact.classList.remove('bg-white', 'text-green-700');
        btnContact.classList.add('bg-green-600', 'text-white');
        btnEmail.classList.remove('bg-blue-600', 'text-white');
        btnEmail.classList.add('bg-white', 'text-blue-700');
    });

    // OTP functionality
    const forgotForm = document.getElementById('forgotForm');
    const sendOtpBtn = document.getElementById('sendOtpBtn');
    const btnText = document.getElementById('btnText');
    const otpSection = document.getElementById('otpSection');
    const resendOtp = document.getElementById('resendOtp');
    const otpTimer = document.getElementById('otpTimer');
    const sentTo = document.getElementById('sentTo');
    let countdown = 300;
    let timerInterval;
    let currentContactOrEmail = '';

    function startOtpTimer() {
        clearInterval(timerInterval);
        countdown = 300;
        resendOtp.disabled = true;
        otpTimer.textContent = '05:00';
        
        timerInterval = setInterval(() => {
            let minutes = Math.floor(countdown / 60);
            let seconds = countdown % 60;
            otpTimer.textContent = `${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
            countdown--;
            
            if(countdown < 0) {
                clearInterval(timerInterval);
                resendOtp.disabled = false;
                otpTimer.textContent = 'Expired';
            }
        }, 1000);
    }

    // Send OTP
    forgotForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        console.log('Form submitted'); // Debug log

        const email = emailInput.value.trim() || null;
        const contact = contactInput.value.trim() || null;
        
        // Clear previous errors
        document.getElementById('emailError').classList.add('hidden');
        document.getElementById('contactError').classList.add('hidden');
        document.getElementById('emailError').textContent = '';
        document.getElementById('contactError').textContent = '';

        // Validation
        if(!email && !contact) {
            const activeSection = !emailSection.classList.contains('hidden') ? 'email' : 'contact';
            if(activeSection === 'email') {
                document.getElementById('emailError').textContent = 'Please enter your email address';
                document.getElementById('emailError').classList.remove('hidden');
            } else {
                document.getElementById('contactError').textContent = 'Please enter your contact number';
                document.getElementById('contactError').classList.remove('hidden');
            }
            return;
        }

        // Disable button and show loading
        sendOtpBtn.disabled = true;
        sendOtpBtn.classList.add('btn-loading');
        btnText.textContent = 'Sending...';

        try {
            console.log('Sending OTP request...'); // Debug log
            
            const response = await fetch("{{ route('password.send.otp') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, contact })
            });

            console.log('Response status:', response.status); // Debug log
            
            const data = await response.json();
            console.log('Response data:', data); // Debug log

            if(data.status === 'error') {
                if(data.errors?.email) {
                    document.getElementById('emailError').textContent = data.errors.email[0];
                    document.getElementById('emailError').classList.remove('hidden');
                }
                if(data.errors?.contact) {
                    document.getElementById('contactError').textContent = data.errors.contact[0];
                    document.getElementById('contactError').classList.remove('hidden');
                }
                
                // Re-enable button
                sendOtpBtn.disabled = false;
                sendOtpBtn.classList.remove('btn-loading');
                btnText.textContent = 'Send OTP';
                return;
            }

            // Success - show OTP section
            currentContactOrEmail = email || contact;
            sentTo.textContent = email || contact;
            forgotForm.classList.add('hidden');
            otpSection.classList.remove('hidden');
            startOtpTimer();

            // Show success message
            const successDiv = document.createElement('div');
            successDiv.className = 'bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4';
            successDiv.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fas fa-check-circle"></i>
                    <span>${data.message || 'OTP sent successfully!'}</span>
                </div>
            `;
            otpSection.insertBefore(successDiv, otpSection.firstChild);
            setTimeout(() => successDiv.remove(), 5000);

        } catch (error) {
            console.error('Error:', error); // Debug log
            alert('Failed to send OTP. Please check your internet connection and try again.');
            
            // Re-enable button
            sendOtpBtn.disabled = false;
            sendOtpBtn.classList.remove('btn-loading');
            btnText.textContent = 'Send OTP';
        }
    });

    // Resend OTP
    resendOtp.addEventListener('click', async () => {
        resendOtp.disabled = true;
        
        try {
            const email = emailInput.value.trim() || null;
            const contact = contactInput.value.trim() || null;

            const response = await fetch("{{ route('password.send.otp') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, contact })
            });

            const data = await response.json();

            if(data.status === 'success') {
                startOtpTimer();
                alert('OTP resent successfully!');
            } else {
                alert('Failed to resend OTP');
                resendOtp.disabled = false;
            }
        } catch (error) {
            console.error('Resend error:', error);
            alert('Failed to resend OTP');
            resendOtp.disabled = false;
        }
    });

    // Verify OTP
    const verifyOtpBtn = document.getElementById('verifyOtpBtn');
    const otpInput = document.getElementById('otp');
    const otpError = document.getElementById('otpError');

    // Auto-format OTP input (numbers only)
    otpInput.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    verifyOtpBtn.addEventListener('click', async () => {
        const otp = otpInput.value.trim();
        otpError.classList.add('hidden');

        if(!otp) {
            otpError.textContent = 'Please enter the OTP';
            otpError.classList.remove('hidden');
            return;
        }

        if(otp.length !== 6) {
            otpError.textContent = 'OTP must be 6 digits';
            otpError.classList.remove('hidden');
            return;
        }

        verifyOtpBtn.disabled = true;
        verifyOtpBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';

        try {
            const response = await fetch("{{ route('password.verify.otp') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    otp: otp, 
                    contact_or_email: currentContactOrEmail
                })
            });

            const data = await response.json();
            console.log('Verify response:', data); // Debug log

            if(data.status === 'success') {
                window.location.href = data.redirect;
            } else {
                otpError.textContent = data.message || 'Invalid or expired OTP';
                otpError.classList.remove('hidden');
                verifyOtpBtn.disabled = false;
                verifyOtpBtn.innerHTML = '<span class="flex items-center justify-center space-x-2"><i class="fas fa-check-circle"></i><span>Verify OTP</span></span>';
            }
        } catch (error) {
            console.error('Verify error:', error);
            otpError.textContent = 'Failed to verify OTP. Please try again.';
            otpError.classList.remove('hidden');
            verifyOtpBtn.disabled = false;
            verifyOtpBtn.innerHTML = '<span class="flex items-center justify-center space-x-2"><i class="fas fa-check-circle"></i><span>Verify OTP</span></span>';
        }
    });
});
</script>

</body>
</html>