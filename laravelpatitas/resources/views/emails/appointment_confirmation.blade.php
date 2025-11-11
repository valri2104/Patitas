<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('appointments.confirmation_email_title') }}</title>

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
