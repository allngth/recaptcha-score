<?php

require_once __DIR__ . '/recaptcha.php';
require_once __DIR__ . '/config.php';

$html = <<<HTML
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Check reCAPTCHA score</title>
<script src="https://www.google.com/recaptcha/enterprise.js?render=:recaptchaSiteKey"></script>
<script>
function submitForm(token) {
    fetch('/validate.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ "token": token })
    }).then(response => response.json()).then(function (response) {
        const resultElement = document.getElementById('result');
        const text = document.createTextNode(JSON.stringify(response, null, 4));
        resultElement.appendChild(text);
    });
}

function solveRecaptcha() {
    grecaptcha.enterprise.ready(function() {
        grecaptcha.enterprise.execute(':recaptchaSiteKey').then(function(token) {
            submitForm(token);
        });
    });
}
</script>
</head>
<body>
    <div style="padding: 5px 10px; border: 1px solid black; display: inline-block; border-radius: 10px; cursor: pointer" onclick="solveRecaptcha()">Get score</div>
    <pre id="result"></pre>
</body>
</html>
HTML;

print_r(strtr($html, [
    ':recaptchaSiteKey' => RECAPTCHA_SITE_KEY,
]));