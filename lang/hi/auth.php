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

    'failed'   => 'ये क्रेडेंशियल्स हमारे रिकॉर्ड से मेल नहीं खाते।',
    'password' => 'प्रदान किया गया पासवर्ड गलत है।',
    'throttle' => 'बहुत सारे लॉगिन प्रयास। कृपया :seconds सेकंड में पुन: प्रयास करें।',

    // Custom authentication messages.
    'unauthorized_no_token'      => 'अनधिकृत: कोई टोकन नहीं।',
    'unauthorized_token_expired' => 'अनधिकृत: टोकन समाप्त हो गया।',
    'unauthorized'               => 'अनधिकृत!',
    'forbidden_action'           => 'आपको यह कार्रवाई करने की अनुमति नहीं है।',
    'csrf_token_mismatch'        => 'सत्र समाप्त हो गया है। कृपया पृष्ठ को रिफ्रेश करें और पुनः प्रयास करें।',
    'email_not_verified'         => 'आपका ईमेल पता सत्यापित नहीं है।',
    'account_not_verified'       => 'आपका खाता सत्यापित नहीं है!',
    'invalid_ability'            => 'आपके पास इस कार्रवाई को करने के लिए आवश्यक क्षमता नहीं है।',
    'invalid_scope'              => 'आपके पास इस संसाधन तक पहुँचने के लिए आवश्यक दायरा नहीं है।',

    // Success messages.
    'register_success'             => 'ChairPal में आपका स्वागत है! कृपया अपना खाता सत्यापित करने के लिए अपना ईमेल जांचें।',
    'login_success'                => 'सफलतापूर्वक लॉगिन किया गया।',
    'devices_success'              => 'उपकरण सफलतापूर्वक प्राप्त किए गए।',
    'logout_success'               => 'आपको सफलतापूर्वक लॉग आउट कर दिया गया है।',
    'profile_data_changed_success' => 'आपका प्रोफ़ाइल डेटा सफलतापूर्वक अपडेट किया गया।',
    'password_reset_success'       => 'आपका पासवर्ड सफलतापूर्वक रीसेट कर दिया गया है।',
    'password_changed_success'     => 'आपका पासवर्ड सफलतापूर्वक बदल दिया गया है।',
    'sent_success'                 => ':attribute आपके ईमेल पर भेज दिया गया है।',
    'verified_success'             => ':attribute सफलतापूर्वक सत्यापित किया गया है।',
    'token_generated_success'      => 'एक्सेस टोकन सफलतापूर्वक जनरेट किया गया।',

    // Verification
    'already_verified'         => 'आपका :attribute पहले से ही सत्यापित है — इसे दोबारा करने की आवश्यकता नहीं है!',
    'no_verification_code'     => 'हमें कोई सत्यापन कोड नहीं मिला। दूसरा अनुरोध करने का प्रयास करें।',
    'invalid_code'             => 'अरे! वह कोड सही नहीं लग रहा है। कृपया जांचें और पुनः प्रयास करें।',
    'code_expired'             => 'वह कोड समाप्त हो गया है। दूसरा अनुरोध करने का प्रयास करें!',
    'unauthorized_code'        => 'क्षमा करें, आपको इस कोड को सत्यापित करने की अनुमति नहीं है।',
    'verified_successfully'    => 'बहुत बढ़िया! आपका :attribute सफलतापूर्वक सत्यापित हो गया है।',
    'verification_code_resent' => ':attribute सफलतापूर्वक फिर से भेज दिया गया है।',
    'must_verify_first'        => 'अपना पासवर्ड रीसेट करने से पहले आपको अपना :attribute सत्यापित करना होगा।',

    // Error messages.
    'expired'            => ':attribute समाप्त हो गया। :attribute फिर से भेजें और पुनः प्रयास करें!',
    'already_resent'     => ':attribute पहले ही आपके ईमेल पर भेजा जा चुका है!',
    'wait_before_resend' => 'कृपया :attribute फिर से भेजने से पहले :remain_seconds सेकंड प्रतीक्षा करें।',
];
