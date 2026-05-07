<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Diese Zugangsdaten stimmen nicht mit unseren Aufzeichnungen überein.',
    'password' => 'Das angegebene Passwort ist falsch.',
    'throttle' => 'Zu viele Anmeldeversuche. Bitte versuchen Sie es in :seconds Sekunden erneut.',

    // Custom authentication messages.
    'unauthorized_no_token'      => 'Unbefugt: Kein Token.',
    'unauthorized_token_expired' => 'Unbefugt: Token abgelaufen.',
    'unauthorized'               => 'Unbefugt!',
    'forbidden_action'           => 'Sie sind nicht berechtigt, diese Aktion durchzuführen.',
    'csrf_token_mismatch'        => 'Die Sitzung ist abgelaufen. Bitte aktualisieren Sie die Seite und versuchen Sie es erneut.',
    'email_not_verified'         => 'Ihre E-Mail-Adresse ist nicht verifiziert.',
    'account_not_verified'       => 'Ihr Konto ist nicht verifiziert!',
    'invalid_ability'            => 'Sie haben nicht die erforderliche Berechtigung, um diese Aktion durchzuführen.',
    'invalid_scope'              => 'Sie haben nicht den erforderlichen Umfang, um auf diese Ressource zuzugreifen.',

    // Success messages.
    'register_success'             => 'Willkommen bei ChairPal! Bitte überprüfen Sie Ihre E-Mail, um Ihr Konto zu verifizieren.',
    'login_success'                => 'Erfolgreich eingeloggt.',
    'devices_success'              => 'Geräte erfolgreich abgerufen.',
    'logout_success'               => 'Sie wurden erfolgreich ausgeloggt.',
    'profile_data_changed_success' => 'Ihre Profildaten wurden erfolgreich aktualisiert.',
    'password_reset_success'       => 'Ihr Passwort wurde erfolgreich zurückgesetzt.',
    'password_changed_success'     => 'Ihr Passwort wurde erfolgreich geändert.',
    'sent_success'                 => 'Das :attribute wurde an Ihre E-Mail gesendet.',
    'verified_success'             => 'Das :attribute wurde erfolgreich verifiziert.',
    'token_generated_success'      => 'Zugangstoken erfolgreich generiert.',

    // Verification
    'already_verified'         => 'Ihr :attribute ist bereits verifiziert — keine Notwendigkeit, es erneut zu tun!',
    'no_verification_code'     => 'Wir konnten keinen Bestätigungscode finden. Versuchen Sie, einen anderen anzufordern.',
    'invalid_code'             => 'Hoppla! Dieser Code scheint nicht richtig zu sein. Bitte überprüfen und erneut versuchen.',
    'code_expired'             => 'Dieser Code ist abgelaufen. Versuchen Sie, einen anderen anzufordern!',
    'unauthorized_code'        => 'Entschuldigung, Sie sind nicht berechtigt, diesen Code zu verifizieren.',
    'verified_successfully'    => 'Großartig! Ihr :attribute wurde erfolgreich verifiziert.',
    'verification_code_resent' => ':attribute wurde erfolgreich erneut gesendet.',
    'must_verify_first'        => 'Sie müssen Ihr :attribute verifizieren, bevor Sie Ihr Passwort zurücksetzen.',

    // Error messages.
    'expired'            => ':attribute abgelaufen. Senden Sie :attribute erneut und versuchen Sie es noch einmal!',
    'already_resent'     => ':attribute bereits an Ihre E-Mail gesendet!',
    'wait_before_resend' => 'Bitte warten Sie :remain_seconds Sekunde(n), bevor Sie das :attribute erneut senden.',
];
