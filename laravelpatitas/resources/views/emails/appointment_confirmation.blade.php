<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('appointments.confirmation_email_title') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 0 0 5px 5px;
        }
        .detail-row {
            margin-bottom: 15px;
            padding: 10px;
            background-color: white;
            border-left: 3px solid #0d6efd;
        }
        .detail-label {
            font-weight: bold;
            color: #0d6efd;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ __('appointments.confirmation_email_title') }}</h1>
    </div>
    
    <div class="content">
        <p>{{ __('appointments.confirmation_greeting') }},</p>
        
        <p>{{ __('appointments.confirmation_message') }}</p>
        
        <div class="detail-row">
            <span class="detail-label">{{ __('appointments.pet_name') }}:</span> {{ $appointment->getPetName() }}
        </div>
        
        <div class="detail-row">
            <span class="detail-label">{{ __('appointments.pet_type') }}:</span> {{ $appointment->getPetType() }}
        </div>
        
        <div class="detail-row">
            <span class="detail-label">{{ __('appointments.date') }}:</span> {{ $appointment->getDate() }}
        </div>
        
        <div class="detail-row">
            <span class="detail-label">{{ __('appointments.time') }}:</span> {{ $appointment->getTime() }}
        </div>
        
        <div class="detail-row">
            <span class="detail-label">{{ __('appointments.reason') }}:</span> {{ $appointment->getReason() }}
        </div>
        
        <p>{{ __('appointments.confirmation_footer') }}</p>
        
        <p>{{ __('appointments.confirmation_regards') }},<br>{{ __('appointments.team_name') }}</p>
    </div>
    
    <div class="footer">
        <p>{{ __('appointments.confirmation_footer_note') }}</p>
    </div>
</body>
</html>
