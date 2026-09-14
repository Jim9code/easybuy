<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyBuy Password Reset Code</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAF6EE;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #191917;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 560px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border: 1px solid #E0D3C1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }
        .header {
            background-color: #191917;
            padding: 26px 32px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #FAF6EE;
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -0.5px;
        }
        .header .badge {
            display: inline-block;
            margin-top: 8px;
            background-color: #FFD000;
            color: #191917;
            font-size: 11px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 36px 32px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 800;
            color: #191917;
            margin: 0 0 12px 0;
        }
        .description {
            font-size: 14px;
            line-height: 1.6;
            color: #5C5549;
            margin: 0 0 28px 0;
        }
        .code-container {
            background-color: #FAF6EE;
            border: 2px dashed #D8C9B5;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            margin-bottom: 28px;
        }
        .code-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #7A7365;
            margin-bottom: 12px;
            display: block;
        }
        .code-digits {
            display: inline-block;
            background-color: #191917;
            color: #FFD000;
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace;
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 12px;
            padding: 14px 24px 14px 36px;
            border-radius: 12px;
            border: 1px solid #333330;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .code-expiry {
            margin-top: 12px;
            font-size: 12px;
            color: #8A857A;
            font-weight: 600;
        }
        .code-expiry span {
            color: #D97706;
            font-weight: 700;
        }
        .cta-btn {
            display: block;
            width: 100%;
            box-sizing: border-box;
            background-color: #FFD000;
            color: #191917;
            text-align: center;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 28px;
        }
        .security-box {
            background-color: #F8F9FA;
            border: 1px solid #E9ECEF;
            border-left: 4px solid #FFD000;
            border-radius: 8px;
            padding: 14px 16px;
            font-size: 12px;
            line-height: 1.5;
            color: #6C757D;
            margin-bottom: 8px;
        }
        .security-box strong {
            color: #191917;
        }
        .footer {
            background-color: #F7F3EB;
            padding: 24px;
            text-align: center;
            font-size: 11px;
            color: #8A857A;
            border-top: 1px solid #E0D3C1;
        }
        .footer a {
            color: #191917;
            text-decoration: underline;
        }
    </style>
</head>
<body style="padding: 24px 12px; background-color: #FAF6EE;">
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>EASYBUY</h1>
            <div class="badge">Security & Access Control</div>
        </div>

        <!-- Content -->
        <div class="content">
            <h2 class="greeting">
                Hello{{ $user ? ', ' . ($user->username ?? $user->name) : '' }}! 👋
            </h2>
            <p class="description">
                We received a request to reset the password for your EasyBuy account (<strong>{{ $email }}</strong>). Enter the verification code below on the password recovery screen to complete your update.
            </p>

            <!-- Verification Code Card -->
            <div class="code-container">
                <span class="code-label">Your 5-Digit Verification Code</span>
                <div class="code-digits">
                    {{ $code }}
                </div>
                <div class="code-expiry">
                    ⏱️ This code expires in <span>{{ $expiresMinutes ?? 15 }} minutes</span>.
                </div>
            </div>

            <!-- Direct Action Button -->
            <a href="{{ $resetUrl }}" class="cta-btn">
                Reset Password on EasyBuy &rarr;
            </a>

            <!-- Security Notice -->
            <div class="security-box">
                <strong>🔒 Didn't request a password reset?</strong>
                <br>
                If you did not initiate this request, you can safely ignore this email. Your existing password remains secure and active.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0 0 6px 0;">
                EasyBuy Technologies Nigeria Ltd • Unified B2B Wholesale Procurement
            </p>
            <p style="margin: 0; color: #9C9283;">
                Need help? Contact our security & support team at <a href="mailto:support@easybuy.ng">support@easybuy.ng</a>
            </p>
        </div>
    </div>
</body>
</html>
