<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to HMMC - Your Donor Account is Ready</title>
    <style>
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }
        .header {
            background: #2c5aa0;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .logo-container {
            margin-bottom: 20px;
        }
        .content {
            padding: 30px;
        }
        .welcome-message {
            font-size: 16px;
            color: #444;
            margin-bottom: 25px;
        }
        .credentials-card {
            background: #f0f7ff;
            border: 1px solid #d0e3ff;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .login-button {
            display: inline-block;
            background: #2c5aa0;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
            margin: 15px 0;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background: #1e3d6f;
        }
        .security-note {
            background: #fff8e6;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #e6b400;
            margin: 20px 0;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #666;
            font-size: 14px;
        }
        .credential-box {
            background: white;
            padding: 12px;
            border-radius: 4px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            border: 1px solid #e0e0e0;
        }
        .highlight-box {
            background: #e8f5e8;
            padding: 15px;
            border-radius: 6px;
            text-align: center;
            margin: 20px 0;
            border: 1px solid #c8e6c9;
        }
        .section-title {
            color: #2c5aa0;
            font-size: 18px;
            margin-top: 25px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('images/hmmc_logo_clear.png') }}" 
                    alt="HALIMATUSSAADIA Mother's Milk Centre Logo" 
                    style="width: 200px; height: auto;">
            </div>
            <h1 style="margin: 0; font-size: 24px;">Welcome to HMMC</h1>
            <p style="font-size: 16px; margin: 10px 0 0 0; opacity: 0.9;">Your Donor Account is Ready</p>
        </div>
        
        <div class="content">
            <div class="welcome-message">
                <p>Dear <strong>{{ $fullname }}</strong>,</p>
                
                <p>Welcome to the HALIMATUSSAADIA Mother's Milk Centre (HMMC) donor community. We sincerely appreciate your commitment to becoming a milk donor and supporting families in need.</p>
                
                <p>Your generous contribution will make a meaningful difference in the lives of infants and their families.</p>
            </div>

            <div class="section-title">Account Access Information</div>

            <div class="credentials-card">
                <p style="margin-top: 0; color: #2c5aa0; font-size: 16px; font-weight: bold;">Your login credentials:</p>
                
                <div class="credential-box">
                    <strong>Username:</strong> Your NRIC number
                </div>
                
                <div class="credential-box">
                    <strong>Temporary Password:</strong> {{ $password }}
                </div>
            </div>

            <div style="text-align: center;">
                <p style="font-size: 15px; color: #444; margin-bottom: 15px;">
                    Access your donor portal using the button below:
                </p>
                <a href="{{ $loginUrl }}" class="login-button">
                    Access Donor Portal
                </a>
            </div>

            <div class="security-note">
                <strong>Security Information:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>Please change your password after your first login</li>
                    <li>Keep your login credentials confidential</li>
                    <li>Your NRIC is used as username for secure identification</li>
                </ul>
            </div>

            <div class="highlight-box">
                <p style="margin: 0; color: #2d5016; font-size: 15px;">
                    <strong>Your Contribution Matters</strong><br>
                    Your milk donations provide essential nutrition and support to families when they need it most.
                </p>
            </div>

            <p>If you have any questions or need assistance, please contact our support team.</p>
            
            <p>With gratitude,</p>
            <p><strong>The HMMC Team</strong></p>
        </div>
        
        <div class="footer">
            <p style="margin: 0; font-size: 15px;">
                <strong>HALIMATUSSAADIA Mother's Milk Centre</strong>
            </p>
            
            <p style="font-size: 12px; color: #999; margin: 15px 0 0 0;">
                Nourishing futures, one donation at a time<br>
                <em>This is an automated message. Please do not reply to this email.</em>
            </p>
        </div>
    </div>
</body>
</html>