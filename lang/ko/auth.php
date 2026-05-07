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

    'failed'   => '인증 정보가 기록과 일치하지 않습니다.',
    'password' => '제공된 비밀번호가 올바르지 않습니다.',
    'throttle' => '로그인 시도가 너무 많습니다. :seconds초 후에 다시 시도하십시오.',

    // Custom authentication messages.
    'unauthorized_no_token'      => '승인되지 않음: 토큰 없음.',
    'unauthorized_token_expired' => '승인되지 않음: 토큰 만료됨.',
    'unauthorized'               => '승인되지 않음!',
    'forbidden_action'           => '이 작업을 수행할 권한이 없습니다.',
    'csrf_token_mismatch'        => '세션이 만료되었습니다. 페이지를 새로 고치고 다시 시도하십시오.',
    'email_not_verified'         => '이메일 주소가 확인되지 않았습니다.',
    'account_not_verified'       => '계정이 확인되지 않았습니다!',
    'invalid_ability'            => '이 작업을 수행하는 데 필요한 기능이 없습니다.',
    'invalid_scope'              => '이 리소스에 액세스하는 데 필요한 범위가 없습니다.',

    // Success messages.
    'register_success'             => 'ChairPal에 오신 것을 환영합니다! 계정을 확인하려면 이메일을 확인하십시오.',
    'login_success'                => '성공적으로 로그인되었습니다.',
    'devices_success'              => '장치를 성공적으로 검색했습니다.',
    'logout_success'               => '성공적으로 로그아웃되었습니다.',
    'profile_data_changed_success' => '프로필 데이터가 성공적으로 업데이트되었습니다.',
    'password_reset_success'       => '비밀번호가 성공적으로 재설정되었습니다.',
    'password_changed_success'     => '비밀번호가 성공적으로 변경되었습니다.',
    'sent_success'                 => ':attribute이(가) 이메일로 발송되었습니다.',
    'verified_success'             => ':attribute이(가) 성공적으로 확인되었습니다.',
    'token_generated_success'      => '액세스 토큰이 성공적으로 생성되었습니다.',

    // Verification
    'already_verified'         => ':attribute은(는) 이미 확인되었습니다 — 다시 할 필요가 없습니다!',
    'no_verification_code'     => '확인 코드를 찾을 수 없습니다. 다른 코드를 요청해 보십시오.',
    'invalid_code'             => '이런! 코드가 올바르지 않은 것 같습니다. 확인하고 다시 시도하십시오.',
    'code_expired'             => '해당 코드가 만료되었습니다. 다른 코드를 요청해 보십시오!',
    'unauthorized_code'        => '죄송합니다. 이 코드를 확인할 권한이 없습니다.',
    'verified_successfully'    => '멋집니다! :attribute이(가) 성공적으로 확인되었습니다.',
    'verification_code_resent' => ':attribute이(가) 성공적으로 다시 전송되었습니다.',
    'must_verify_first'        => '비밀번호를 재설정하기 전에 :attribute을(를) 확인해야 합니다.',

    // Error messages.
    'expired'            => ':attribute 만료됨. :attribute을(를) 다시 보내고 다시 시도하십시오!',
    'already_resent'     => ':attribute이(가) 이미 이메일로 전송되었습니다!',
    'wait_before_resend' => ':attribute을(를) 다시 보내기 전에 :remain_seconds초를 기다려 주십시오.',
];
