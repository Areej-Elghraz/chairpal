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

    'failed'   => 'Thông tin đăng nhập này không khớp với hồ sơ của chúng tôi.',
    'password' => 'Mật khẩu được cung cấp không chính xác.',
    'throttle' => 'Quá nhiều lần thử đăng nhập. Vui lòng thử lại sau :seconds giây.',

    // Custom authentication messages.
    'unauthorized_no_token'      => 'Không được phép: Không có mã thông báo.',
    'unauthorized_token_expired' => 'Không được phép: Mã thông báo đã hết hạn.',
    'unauthorized'               => 'Không được phép!',
    'forbidden_action'           => 'Bạn không được phép thực hiện hành động này.',
    'csrf_token_mismatch'        => 'Phiên đã hết hạn. Vui lòng tải lại trang và thử lại.',
    'email_not_verified'         => 'Địa chỉ email của bạn chưa được xác minh.',
    'account_not_verified'       => 'Tài khoản của bạn chưa được xác minh!',
    'invalid_ability'            => 'Bạn không có khả năng cần thiết để thực hiện hành động này.',
    'invalid_scope'              => 'Bạn không có phạm vi cần thiết để truy cập tài nguyên này.',

    // Success messages.
    'register_success'             => 'Chào mừng đến với ChairPal! Vui lòng kiểm tra email của bạn để xác minh tài khoản.',
    'login_success'                => 'Đăng nhập thành công.',
    'devices_success'              => 'Đã lấy thiết bị thành công.',
    'logout_success'               => 'Bạn đã đăng xuất thành công.',
    'profile_data_changed_success' => 'Dữ liệu hồ sơ của bạn đã được cập nhật thành công.',
    'password_reset_success'       => 'Mật khẩu của bạn đã được đặt lại thành công.',
    'password_changed_success'     => 'Mật khẩu của bạn đã được thay đổi thành công.',
    'sent_success'                 => ':attribute đã được gửi đến email của bạn.',
    'verified_success'             => ':attribute đã được xác minh thành công.',
    'token_generated_success'      => 'Mã thông báo truy cập đã được tạo thành công.',

    // Verification
    'already_verified'         => ':attribute của bạn đã được xác minh — không cần phải làm lại!',
    'no_verification_code'     => 'Chúng tôi không thể tìm thấy mã xác minh. Hãy thử yêu cầu một mã khác.',
    'invalid_code'             => 'Rất tiếc! Mã đó có vẻ không đúng. Vui lòng kiểm tra và thử lại.',
    'code_expired'             => 'Mã đó đã hết hạn. Hãy thử yêu cầu một mã khác!',
    'unauthorized_code'        => 'Xin lỗi, bạn không được phép xác minh mã này.',
    'verified_successfully'    => 'Tuyệt vời! :attribute của bạn đã được xác minh thành công.',
    'verification_code_resent' => ':attribute đã được gửi lại thành công.',
    'must_verify_first'        => 'Bạn phải xác minh :attribute của mình trước khi đặt lại mật khẩu.',

    // Error messages.
    'expired'            => ':attribute đã hết hạn. Gửi lại :attribute và thử lại!',
    'already_resent'     => ':attribute đã được gửi đến email của bạn!',
    'wait_before_resend' => 'Vui lòng đợi :remain_seconds giây trước khi gửi lại :attribute.',
];
