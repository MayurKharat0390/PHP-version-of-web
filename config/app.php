<?php
/**
 * Application Configuration
 */

return [
    'name' => 'UHV PCCOE - Universal Human Values Cell',
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => getenv('APP_DEBUG') !== 'false',
    'url' => getenv('APP_URL') ?: '',
    'timezone' => 'Asia/Kolkata',
    
    // Contact form email notification
    'mail' => [
        'from_address' => getenv('EMAIL_HOST_USER') ?: 'uhv.cell.pccoe@gmail.com',
        'from_name' => 'UHV PCCOE Platform',
        'contact_recipient' => getenv('CONTACT_RECIPIENT_EMAIL') ?: 'uhv@pccoepune.org',
    ],
    
    // Security
    'session_name' => 'uhv_session',
    'csrf_token_name' => 'csrf_token'
];
