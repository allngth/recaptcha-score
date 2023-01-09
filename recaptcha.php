<?php

function validateRecaptcha(string $token, string $googleCloudApiKey, string $googleCloudProjectId, string $recaptchaSiteKey) {
    $ch = curl_init(sprintf('https://recaptchaenterprise.googleapis.com/v1/projects/%s/assessments?key=%s',
        $googleCloudProjectId,
        $googleCloudApiKey,
    ));

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'event' => [
            'token' => $token,
            'siteKey' => $recaptchaSiteKey,
        ],
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Content-Type: application/json; charset=utf-8']);

    return curl_exec($ch);
}