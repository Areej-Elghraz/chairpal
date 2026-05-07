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

    'failed'   => 'Ces identifiants ne correspondent pas à nos enregistrements.',
    'password' => 'Le mot de passe fourni est incorrect.',
    'throttle' => 'Trop de tentatives de connexion. Veuillez réessayer dans :seconds secondes.',

    // Custom authentication messages.
    'unauthorized_no_token'      => 'Non autorisé : Aucun jeton.',
    'unauthorized_token_expired' => 'Non autorisé : Jeton expiré.',
    'unauthorized'               => 'Non autorisé !',
    'forbidden_action'           => 'Vous n\'êtes pas autorisé à effectuer cette action.',
    'csrf_token_mismatch'        => 'La session a expiré. Veuillez actualiser la page et réessayer.',
    'email_not_verified'         => 'Votre adresse e-mail n\'est pas vérifiée.',
    'account_not_verified'       => 'Votre compte n\'est pas vérifié !',
    'invalid_ability'            => 'Vous n\'avez pas la capacité requise pour effectuer cette action.',
    'invalid_scope'              => 'Vous n\'avez pas la portée requise pour accéder à cette ressource.',

    // Success messages.
    'register_success'             => 'Bienvenue sur ChairPal ! Veuillez vérifier votre e-mail pour activer votre compte.',
    'login_success'                => 'Connexion réussie.',
    'devices_success'              => 'Appareils récupérés avec succès.',
    'logout_success'               => 'Vous avez été déconnecté avec succès.',
    'profile_data_changed_success' => 'Vos données de profil ont été mises à jour avec succès.',
    'password_reset_success'       => 'Votre mot de passe a été réinitialisé avec succès.',
    'password_changed_success'     => 'Votre mot de passe a été modifié avec succès.',
    'sent_success'                 => 'Le :attribute a été envoyé à votre e-mail.',
    'verified_success'             => 'Le :attribute a été vérifié avec succès.',
    'token_generated_success'      => 'Jeton d\'accès généré avec succès.',

    // Verification
    'already_verified'         => 'Votre :attribute est déjà vérifié — pas besoin de le refaire !',
    'no_verification_code'     => 'Nous n\'avons pas trouvé de code de vérification. Essayez d\'en demander un autre.',
    'invalid_code'             => 'Oups ! Ce code ne semble pas correct. Veuillez vérifier et réessayer.',
    'code_expired'             => 'Ce code a expiré. Essayez d\'en demander un autre !',
    'unauthorized_code'        => 'Désolé, vous n\'êtes pas autorisé à vérifier ce code.',
    'verified_successfully'    => 'Génial ! Votre :attribute a été vérifié avec succès.',
    'verification_code_resent' => 'Le :attribute a été renvoyé avec succès.',
    'must_verify_first'        => 'Vous devez vérifier votre :attribute avant de réinitialiser votre mot de passe.',

    // Error messages.
    'expired'            => ':attribute expiré. Renvoyez :attribute et réessayez !',
    'already_resent'     => ':attribute déjà envoyé à votre e-mail !',
    'wait_before_resend' => 'Veuillez patienter :remain_seconds seconde(s) avant de renvoyer le :attribute.',
];
