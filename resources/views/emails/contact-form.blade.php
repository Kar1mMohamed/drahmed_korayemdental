<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission - Dr. Ahmed Korayem</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 650px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: #fff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }
        .content {
            padding: 40px 30px;
        }

        .field {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .field:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .value {
            font-size: 16px;
            color: #444;
            word-wrap: break-word;
            line-height: 1.5;
        }

        .message-value {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #3498db;
            white-space: pre-wrap;
        }

        .email-value {
            color: #3498db;
        }

        .phone-value {
            font-family: 'Courier New', monospace;
            font-weight: 500;
        }

        .date-value {
            color: #7f8c8d;
            font-style: italic;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .container {
                border-radius: 8px;
            }

            .header {
                padding: 20px 15px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Form Submission</h1>
            <p style="margin-top: 5px; opacity: 0.9; font-size: 14px;">Dr. Ahmed Korayem</p>
        </div>
        <div class="content">
            <div class="field">
                <div class="label">Full Name</div>
                <div class="value">{{ $contact->name }}</div>
            </div>

            <div class="field">
                <div class="label">Phone Number</div>
                <div class="value phone-value">{{ $contact->phone }}</div>
            </div>

            <div class="field">
                <div class="label">Email Address</div>
                <div class="value email-value">{{ $contact->email }}</div>
            </div>

            @if($contact->message)
            <div class="field">
                <div class="label">Message</div>
                <div class="value message-value">{{ $contact->message }}</div>
            </div>
            @endif

            <div class="field">
                <div class="label">Submission Date</div>
                <div class="value date-value">{{ $contact->created_at->format('l, F j, Y \a\t g:i A') }}</div>
            </div>
        </div>
    </div>
</body>
</html>
