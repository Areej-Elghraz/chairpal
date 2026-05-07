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

    'failed'   => 'بيانات الاعتماد هذه غير متطابقة مع سجلاتنا.',
    'password' => 'كلمة المرور المقدمة غير صحيحة.',
    'throttle' => 'عدد محاولات تسجيل الدخول كبير جدًا. يرجى المحاولة مرة أخرى بعد :seconds ثانية.',

    // Custom authentication messages.
    'unauthorized_no_token'      => 'غير مصرح: لا يوجد رمز.',
    'unauthorized_token_expired' => 'غير مصرح: انتهت صلاحية الرمز.',
    'unauthorized'               => 'غير مصرح!',
    'forbidden_action'           => 'غير مسموح بتنفيذ هذا الإجراء.',
    'csrf_token_mismatch'        => 'انتهت صلاحية الجلسة. يرجى تحديث الصفحة والمحاولة مرة أخرى.',
    'email_not_verified'         => 'لم يتم التحقق من عنوان بريدك الإلكتروني.',
    'account_not_verified'       => 'لم يتم التحقق من حسابك!',
    'invalid_ability'            => 'ليس لديك الصلاحية لتنفيذ هذا الإجراء.',
    'invalid_scope'              => 'ليست لديك النطاقات المطلوبة للوصول إلى هذا المورد.',

    // Success messages.
    'register_success'             => 'مرحبًا بك في ChairPal! برجاء التحقق من بريدك الإلكتروني باستخدام الكود الذي قمنا بإرساله إليك.',
    'login_success'                => 'تم تسجيل الدخول بنجاح.',
    'devices_success'              => 'تم جلب الاجهزة بنجاح.',
    'logout_success'               => 'تم تسجيل الخروج بنجاح.',
    'profile_data_changed_success' => 'تم تحديث بيانات ملفك الشخصي بنجاح.',
    'password_reset_success'       => 'تم إعادة تعيين كلمة المرور بنجاح.',
    'password_changed_success'     => 'تم تغيير كلمة المرور بنجاح.',
    'sent_success'                 => 'تم إرسال :attribute إلى بريدك الإلكتروني.',
    'verified_success'             => 'تم التحقق من :attribute بنجاح.',
    'token_generated_success'      => 'تم إنشاء رمز الوصول (Access Token) بنجاح.',

    // Verification
    'already_verified'         => ':attribute تم التحقق منه بالفعل — لا حاجة لإعادة التحقق!',
    'no_verification_code'     => 'لم نتمكن من العثور على كود التحقق. برجاء طلب كود جديد.',
    'invalid_code'             => 'أووبس! يبدو أن الكود غير صحيح. برجاء التحقق والمحاولة مرة أخرى.',
    'code_expired'             => 'انتهت صلاحية هذا الكود. دعنا نرسل لك واحدًا جديدًا!',
    'unauthorized_code'        => 'عذرًا، لا يُسمح لك بالتحقق من هذا الكود.',
    'verified_successfully'    => 'رائع! تم التحقق من :attribute بنجاح.',
    'verification_code_resent' => 'تم إعادة إرسال :attribute بنجاح.',
    'must_verify_first'        => 'يجب عليك التحقق من :attribute قبل إكمال العملية.',

    // Error messages
    'expired'            => ':attribute منتهي الصلاحية. يرجى إعادة الإرسال والمحاولة مجددًا!',
    'already_resent'     => 'تم إرسال :attribute إلى بريدك الإلكتروني بالفعل!',
    'wait_before_resend' => 'يرجى الانتظار :remain_seconds ثانية قبل إعادة إرسال :attribute.',
];
