<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'        => 'يجب قبول حقل :attribute.',
    'accepted_if'     => 'يجب قبول حقل :attribute عندما يكون :other يساوي :value.',
    'active_url'      => 'يجب أن يكون حقل :attribute رابط URL صالح.',
    'after'           => 'يجب أن يكون حقل :attribute تاريخًا بعد :date.',
    'after_or_equal'  => 'يجب أن يكون حقل :attribute تاريخًا مساويًا أو بعد :date.',
    'alpha'           => 'يجب أن يحتوي حقل :attribute على أحرف فقط.',
    'alpha_dash'      => 'يجب أن يحتوي حقل :attribute على أحرف، أرقام، شرطات، أو شرطات سفلية فقط.',
    'alpha_num'       => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام فقط.',
    'any_of'          => 'حقل :attribute غير صالح.',
    'array'           => 'يجب أن يكون حقل :attribute مصفوفة.',
    'phone'           => 'يجب أن يكون الحقل :attribute رقم هاتف صالحًا.',
    'ascii'           => 'يجب أن يحتوي حقل :attribute على رموز وأحرف أبجدية رقمية بايت واحد فقط.',
    'before'          => 'يجب أن يكون حقل :attribute تاريخًا قبل :date.',
    'before_or_equal' => 'يجب أن يكون حقل :attribute تاريخًا قبل أو مساويًا لـ :date.',
    'between' => [
        'array'   => 'يجب أن يحتوي حقل :attribute على ما بين :min و :max عنصر.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute بين :min و :max.',
        'string'  => 'يجب أن يكون طول النص في حقل :attribute بين :min و :max حروف.',
    ],
    'boolean'           => 'يجب أن تكون قيمة حقل :attribute إما true أو false.',
    'can'               => 'حقل :attribute يحتوي على قيمة غير مصرح بها.',
    'confirmed'         => 'تأكيد حقل :attribute غير متطابق.',
    'contains'          => 'يفتقد حقل :attribute قيمة مطلوبة.',
    'current_password'  => 'كلمة المرور غير صحيحة.',
    'date'              => 'يجب أن يكون حقل :attribute تاريخًا صالحًا.',
    'date_equals'       => 'يجب أن يكون حقل :attribute تاريخًا مساويًا لـ :date.',
    'date_format'       => 'يجب أن يتطابق حقل :attribute مع الصيغة :format.',
    'decimal'           => 'يجب أن يحتوي حقل :attribute على :decimal منازل عشرية.',
    'declined'          => 'يجب رفض حقل :attribute.',
    'declined_if'       => 'يجب رفض حقل :attribute عندما يكون :other يساوي :value.',
    'different'         => 'يجب أن يكون حقل :attribute مختلفًا عن :other.',
    'digits'            => 'يجب أن يحتوي حقل :attribute على :digits أرقام.',
    'digits_between'    => 'يجب أن يحتوي حقل :attribute على أرقام بين :min و :max.',
    'dimensions'        => 'حقل :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'          => 'حقل :attribute يحتوي على قيمة مكررة.',
    'doesnt_contain'    => 'حقل :attribute يجب ألا يحتوي على أيٍّ من القيم التالية: :values.',
    'doesnt_end_with'   => 'يجب ألا ينتهي حقل :attribute بأحد القيم التالية: :values.',
    'doesnt_start_with' => 'يجب ألا يبدأ حقل :attribute بأحد القيم التالية: :values.',
    'email'             => 'يجب أن يكون حقل :attribute بريدًا إلكترونيًا صالحًا.',
    'ends_with'         => 'يجب أن ينتهي حقل :attribute بأحد القيم التالية: :values.',
    'enum'              => 'القيمة المختارة في :attribute غير صالحة.',
    'exists'            => 'القيمة المختارة في :attribute غير صالحة.',
    'extensions'        => 'يجب أن يحتوي حقل :attribute على أحد الامتدادات التالية: :values.',
    'file'              => 'يجب أن يكون حقل :attribute ملفًا.',
    'filled'            => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt' => [
        'array'   => 'يجب أن يحتوي حقل :attribute على أكثر من :value عنصر.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute أكبر من :value.',
        'string'  => 'يجب أن يكون طول النص في حقل :attribute أكبر من :value حروف.',
    ],
    'gte' => [
        'array'   => 'يجب أن يحتوي حقل :attribute على :value عنصر أو أكثر.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute أكبر من أو تساوي :value.',
        'string'  => 'يجب أن يكون طول النص في حقل :attribute أكبر من أو يساوي :value حروف.',
    ],
    'hex_color'     => 'يجب أن يكون حقل :attribute لونًا سداسيًا صالحًا.',
    'image'         => 'يجب أن يكون حقل :attribute صورة.',
    'in'            => 'القيمة المختارة في :attribute غير صالحة.',
    'in_array'      => 'يجب أن يوجد حقل :attribute في :other.',
    'in_array_keys' => 'يجب أن يحتوي حقل :attribute على مفتاح واحد على الأقل من القيم التالية: :values.',
    'integer'       => 'يجب أن يكون حقل :attribute عددًا صحيحًا.',
    'ip'            => 'حقل :attribute يجب أن يكون عنوان IP صالح.',
    'ipv4'          => 'حقل :attribute يجب أن يكون عنوان IPv4 صالح.',
    'ipv6'          => 'حقل :attribute يجب أن يكون عنوان IPv6 صالح.',
    'json'          => 'حقل :attribute يجب أن يكون نص JSON صالح.',
    'list'          => 'حقل :attribute يجب أن يكون قائمة.',
    'lowercase'     => 'حقل :attribute يجب أن يكون بحروف صغيرة فقط.',
    'lt' => [
        'array'   => 'حقل :attribute يجب أن يحتوي على أقل من :value عنصر.',
        'file'    => 'حجم ملف :attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أقل من :value.',
        'string'  => 'حقل :attribute يجب أن يحتوي على أقل من :value حرف.',
    ],
    'lte' => [
        'array'   => 'حقل :attribute يجب ألا يحتوي على أكثر من :value عنصر.',
        'file'    => 'حجم ملف :attribute يجب أن يكون أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أقل من أو يساوي :value.',
        'string'  => 'حقل :attribute يجب أن يحتوي على أقل من أو يساوي :value حرف.',
    ],
    'mac_address' => 'حقل :attribute يجب أن يكون عنوان MAC صالح.',
    'max' => [
        'array'   => 'حقل :attribute يجب ألا يحتوي على أكثر من :max عنصر.',
        'file'    => 'حجم ملف :attribute يجب ألا يتجاوز :max كيلوبايت.',
        'numeric' => 'حقل :attribute يجب ألا يكون أكبر من :max.',
        'string'  => 'حقل :attribute يجب ألا يحتوي على أكثر من :max حرف.',
    ],
    'max_digits' => 'حقل :attribute يجب ألا يحتوي على أكثر من :max أرقام.',
    'mimes'      => 'حقل :attribute يجب أن يكون ملف من النوع: :values.',
    'mimetypes'  => 'حقل :attribute يجب أن يكون ملف من النوع: :values.',
    'min' => [
        'array'   => 'حقل :attribute يجب أن يحتوي على الأقل :min عناصر.',
        'file'    => 'حجم ملف :attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون على الأقل :min.',
        'string'  => 'حقل :attribute يجب أن يحتوي على الأقل :min حروف.',
    ],
    'min_digits'       => 'حقل :attribute يجب أن يحتوي على الأقل :min أرقام.',
    'missing'          => 'حقل :attribute يجب أن يكون مفقود.',
    'missing_if'       => 'حقل :attribute يجب أن يكون مفقود عندما يكون :other قيمته :value.',
    'missing_unless'   => 'حقل :attribute يجب أن يكون مفقود إلا إذا كان :other قيمته :value.',
    'missing_with'     => 'حقل :attribute يجب أن يكون مفقود عندما تكون :values موجودة.',
    'missing_with_all' => 'حقل :attribute يجب أن يكون مفقود عندما تكون جميع :values موجودة.',
    'multiple_of'      => 'حقل :attribute يجب أن يكون من مضاعفات :value.',
    'not_in'           => 'القيمة المحددة في :attribute غير صالحة.',
    'not_regex'        => 'صيغة الحقل :attribute غير صالحة.',
    'numeric'          => 'حقل :attribute يجب أن يكون رقم.',
    'password' => [
        'letters'       => 'حقل :attribute يجب أن يحتوي على حرف واحد على الأقل.',
        'mixed'         => 'حقل :attribute يجب أن يحتوي على حرف كبير وحرف صغير على الأقل.',
        'numbers'       => 'حقل :attribute يجب أن يحتوي على رقم واحد على الأقل.',
        'symbols'       => 'حقل :attribute يجب أن يحتوي على رمز واحد على الأقل.',
        'uncompromised' => 'القيمة المعطاة في :attribute ظهرت في تسريب بيانات. الرجاء اختيار :attribute مختلف.',
    ],
    'present'                => 'حقل :attribute يجب أن يكون موجود.',
    'present_if'             => 'حقل :attribute يجب أن يكون موجود عندما يكون :other قيمته :value.',
    'present_unless'         => 'حقل :attribute يجب أن يكون موجود إلا إذا كان :other قيمته :value.',
    'present_with'           => 'حقل :attribute يجب أن يكون موجود عندما تكون :values موجودة.',
    'present_with_all'       => 'حقل :attribute يجب أن يكون موجود عندما تكون جميع :values موجودة.',
    'prohibited'             => 'حقل :attribute ممنوع.',
    'prohibited_if'          => 'حقل :attribute ممنوع عندما يكون :other قيمته :value.',
    'prohibited_if_accepted' => 'حقل :attribute ممنوع عندما يكون :other مقبول.',
    'prohibited_if_declined' => 'حقل :attribute ممنوع عندما يكون :other مرفوض.',
    'prohibited_unless'      => 'حقل :attribute ممنوع إلا إذا كان :other موجود في :values.',
    'prohibits'              => 'حقل :attribute يمنع :other من أن يكون موجود.',
    'regex'                  => 'صيغة الحقل :attribute غير صالحة.',
    'required'               => 'حقل :attribute مطلوب.',
    'required_array_keys'    => 'حقل :attribute يجب أن يحتوي على مفاتيح: :values.',
    'required_if'            => 'حقل :attribute مطلوب عندما يكون :other قيمته :value.',
    'required_if_accepted'   => 'حقل :attribute مطلوب عندما يكون :other مقبول.',
    'required_if_declined'   => 'حقل :attribute مطلوب عندما يكون :other مرفوض.',
    'required_unless'        => 'حقل :attribute مطلوب إلا إذا كان :other موجود في :values.',
    'required_with'          => 'حقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_with_all'      => 'حقل :attribute مطلوب عندما تكون جميع :values موجودة.',
    'required_without'       => 'حقل :attribute مطلوب عندما لا تكون :values موجودة.',
    'required_without_all'   => 'حقل :attribute مطلوب عندما لا تكون أي من :values موجودة.',
    'same'                   => 'حقل :attribute يجب أن يطابق :other.',
    'size' => [
        'array'   => 'حقل :attribute يجب أن يحتوي على :size عنصر.',
        'file'    => 'حجم ملف :attribute يجب أن يكون :size كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون :size.',
        'string'  => 'حقل :attribute يجب أن يحتوي على :size حرف.',
    ],
    'starts_with' => 'حقل :attribute يجب أن يبدأ بأحد القيم التالية: :values.',
    'string'      => 'حقل :attribute يجب أن يكون نص.',
    'timezone'    => 'حقل :attribute يجب أن يكون منطقة زمنية صالحة.',
    'unique'      => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded'    => 'فشل رفع ملف :attribute.',
    'uppercase'   => 'حقل :attribute يجب أن يكون بحروف كبيرة.',
    'url'         => 'حقل :attribute يجب أن يكون رابط URL صالح.',
    'ulid'        => 'حقل :attribute يجب أن يكون ULID صالح.',
    'uuid'        => 'حقل :attribute يجب أن يكون UUID صالح.',

    // Custom validation messages.
    'invalid_credentials'      => 'مدخلات غير صحيحة!',
    'invalid_value'            => 'قيمة :attribute غير صحيحة!',
    'expired_otp'              => 'انتهت صلاحية رمز التحقق!',
    'only_one_position'        => 'مسموح بصورة واحدة فقط في موضع ":attribute".',
    'cannot_update_position'   => 'لا يمكنك تحديث موضع صورة ":attribute".',
    'new_password_must_differ' => 'يجب أن تكون كلمة المرور الجديدة مختلفة عن الحالية!',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'input' => 'اسم المستخدم أو البريد الالكتروني',
        'username' => 'اسم المستخدم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'rating' => 'التقييم',
        'comment' => 'التعليق',
        'latitude' => 'خط العرض',
        'longitude' => 'خط الطول',
        'accessibility_data' => 'بيانات سهولة الوصول',
        'parent_id' => 'التصنيف الأب',
        'owner_id' => 'المالك',
        'country_id' => 'الدولة',
        'city_id' => 'المدينة',
        'address' => 'العنوان',
        'website' => 'الموقع الإلكتروني',
        'code' => 'رمز التحقق',
        'otp' => 'رمز التحقق (OTP)',
        'current_password' => 'كلمة المرور الحالية',
        'new_password' => 'كلمة المرور الجديدة',

        'phone' => 'رقم الهاتف',
        'type' => 'النوع',

        'url' => 'الرابط',
        'social_media' => 'اسم موقع التواصل الاجتماعي',

        'description' => 'الوصف',
        'category_id' => 'التصنيف',
        'category_name' => 'اسم التصنيف',
        'organization_id' => 'المنظمة',
        'per_page' => 'عدد العناصر في الصفحة',

        'image' => 'الصورة',
        'images' => 'الصور',
        'images.*' => 'الصورة',
        'position' => 'موقع الصور',
        'positions' => 'مواقع الصور',
        'positions.*' => 'موقع الصورة',
        'before' => 'قبل',
        'after' => 'بعد',

        'all_devices' => 'الخروج من كل الاجهوة',
        'include' => 'العلاقات',
    ],

];
