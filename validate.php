<?php

require_once __DIR__ . '/recaptcha.php';
require_once __DIR__ . '/config.php';

if ($body = file_get_contents('php://input')) {
    $token = json_decode($body, true)['token'];

    print_r(validateRecaptcha($token, GOOGLE_CLOUD_API_KEY, GOOGLE_CLOUD_PROJECT_ID, RECAPTCHA_SITE_KEY));
} else {
    print_r('{"error": "token required"}');
}