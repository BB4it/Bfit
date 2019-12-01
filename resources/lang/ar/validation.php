<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    'accepted'             => 'يجب قبول :attribute',
    'active_url'           => ':attribute لا يُمثّل رابطًا صحيحًا',
    'after'                => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي :attribute سوى على حروف',
    'alpha_dash'           => 'يجب أن لا يحتوي :attribute على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array'                => 'يجب أن يكون :attribute ًمصفوفة',
    'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute إما true أو false ',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date'                 => ':attribute ليس تاريخًا صحيحًا',
    'date_format'          => 'لا يتوافق :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits'               => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام',
    'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام ',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'exists'               => ':attribute لاغٍ',
    'file'                 => 'الـ :attribute يجب أن يكون ملفا.',
    'filled'               => ':attribute إجباري',
    'image'                => 'يجب أن يكون :attribute صورةً',
    'in'                   => ':attribute لاغٍ',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر لـ :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر لـ :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'not_in'               => ':attribute لاغٍ',
    'numeric'              => 'يجب على :attribute أن يكون رقمًا',
    'present'              => 'يجب تقديم :attribute',
    'regex'                => 'صيغة :attribute .غير صحيحة',
    'required'             => ':attribute مطلوب.',
    'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
    'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالظبط',
    ],
    'string'               => 'يجب أن يكون :attribute نصآ.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique'               => 'قيمة :attribute مُستخدمة من قبل',
    'uploaded'             => 'فشل في تحميل الـ :attribute',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة',
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
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes'           => [
        'name'                  => 'الاسم',
        'username'              => 'اسم المُستخدم',
        'username2'              => 'اسم المُستخدم',
        'username3'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'firstname'            => 'الاسم',
        'lastname'             => 'اسم العائلة',
        'password'              => 'كلمة السر',
        'password_confirmation' => 'تأكيد كلمة السر',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'العنوان',
        'phone_number'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'title'                 => 'اللقب',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'date2'                  => 'التاريخ',
        'date3'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',
        'privacyConditions'                  => 'شروط الخصوصية',
        'register-country'                  => 'الدولة',
        'register-grade'                  => 'المرحلة الدراسية ',
         'message'                  => 'الرسالة ',
         'commission'                  => 'العمولة ',
         'name.ar'                  => 'اسم الموقع ',
         'name.en'                  => 'اسم الموقع  ',
         'name_social.ar'                  => 'الاسم',
         'name_social.en'                  => 'الاسم ',
         'fav_icon'                  => 'أيقونة ',
         'logo_header'                  => 'لوجو أعلى الصفحة',
         'logo_footer'                  => 'لوجو أسفل الصفحة ',
         'type'                  => 'النوع ',
         'link'                  => 'الرابط ',
         'icon'                  => 'أيقونة ',
         'name_bank.ar'                  => 'اسم البنك',
         'name_bank.en'                  => 'اسم البنك ',
         'account_number'                  => 'رقم الحساب ',
         'account_number2'                  => 'رقم الحساب ',
         'account_number3'                  => 'رقم الحساب ',
         'account_id'                  => 'الايبان ',
         'username.ar'                  => 'اسم المستخدم ',
         'username.en'                  => 'اسم المستخدم ',
         'image'                  => 'الصورة',
         'image2'                  => 'الصورة',
         'image3'                  => 'الصورة',
         'text.ar'                  => 'المحتوي',
         'text.en'                  => 'المحتوي',
         'page_name.ar'                  => 'اسم الصفحة',
         'page_name.en'                  => 'اسم الصفحة',
         'order'                  => 'ترتيب العرض',
         'offer.ar'                  => 'الاسم',
         'offer.en'                  => 'الاسم',
         'place'                  => 'المكان',
         'duration'                  => 'المدة',
         'duration_type'                  => 'نوع المدة',
         'price'                  => 'السعر',
         'products_attributes.*.ar'                  => 'المواصفات',
         'products_attributes.*.en'                  => 'المواصفات',
         'attributes_type'                  => 'حقل المواصفات',
         'main_section.ar'                  => 'القسم الرئيسي',
         'main_section.en'                  => 'القسم الرئيسي',
         'main_section'                  => 'القسم الرئيسي',
         'sub_section.ar'                  => 'القسم الفرعي',
         'sub_section.en'                  => 'القسم الفرعي',
         'desc.en'                  => 'الوصف',
         'desc.ar'                  => 'الوصف',
         'keywords.en'                  => 'كلمات دلالية',
         'keywords.ar'                  => 'كلمات دلالية',
         'sub_section'                  => 'القسم الفرعي',
         'subSub_section'                  => 'القسم الفرعي',
         'category_attributes'                  => 'المواصفات',
         'blacklist'                  => 'الحظر',
         'active'                  => 'التفعيل',
         'images.*'                  => 'الصور',
         'images'                  => 'الصور',
         'video'                  => 'الفيديو',
         'subscription_type'                  => 'نوع الاعلان',
         'ads_name'                  => 'اسم الاعلان',
         'end_duration'                  => 'تاريخ الانuser_idتهاء',
         'all_attributes.*'                  => 'المواصفات',
         'attributes_required'                  => 'المواصفات',
         'end_special'                  => 'تاريخ الانتهاء',
         'phone'                  => 'رقم الهاتف',
         'role'                  => 'المجموعة',
         'code'                  => 'الكود',
         'subscription'                  => 'مدة الاعلان',
         'category'                  => 'القسم',
         'type_ads'                  => 'نوع الاعلان',
         'latitude'   => 'الخريطة',
         'sub_category'   => 'القسم الفرعي',
        'register_confirm'   => 'الموافقة على الشروط',
        'amount'   => 'المبلغ',
        'ads_id'   => 'رقم الاعلان',
        'ads_id2'   => 'رقم الاعلان',
        'ads_id3'   => 'رقم الاعلان',
        'reference_number'   => 'الرقم المرجعي',
        'reference_number2'   => 'الرقم المرجعي',
        'reference_number3'   => 'الرقم المرجعي',
        'bank_name'   => 'البنك',
        'bank_name2'   => 'البنك',
        'bank_name3'   => 'البنك',
        'old_password'   => 'كلمة المرور القديمة',
        'user_id'   => 'رقم المستخدم',
        'user_id2'   => 'رقم المستخدم',
        'user_id3'   => 'رقم المستخدم',
        'offer'   => 'الباقات',
        'offer2'   => 'الباقات',
        'subscription_offer'   => 'الباقات',
        'special_offer'   => 'الباقات',
        'ads_type'   => 'نوع الدفع',
        'ads_user'=> 'صاحب الاعلان',
        'comment'=>'التعليق',
        'rate'=>'التقييم',
        'ad_id'=>'رقم الاعلان',
        'sender'=>'اسم المرسل',
        'url'=>'المسار',

        "main_width"    => "العرض",
        "width"    => "العرض",
        "main_height"    => "الطول",
        "height"    => "الطول",
        "inside_width"    => "العرض",
        "inside_height"    => "الطول",
        "home_width"    => "العرض",
        "home_height"    => "الطول",
        "main_image"    => "الصورة الرئيسية",
        "g-recaptcha-response"    => "حقل التحقق",
        "photo_flag"    => "ايقونة علم الدولة",
        "photo"    => "الصورة",
        "text"    => "النص",
        "service"  => "الخدمة",
        "required_services"  => "المطلوب في الخدمات",
        "service_type"  => "نوع الخدمة",
        "upload_file"  => "الملف",
        "scientific_qualification"  => "مؤهلك العلمي",
        "certificate_image"  => "صورة من الشهاده",
        "id_passport_image"  => "صورة من الهوية",
        "condition"  => "الموافقة على الشروط والأحكام",
        "address.country"  => "الدولة",
        "address.city"  => "المدينة",
        'lecturer_science_qualification.*.qualification' => 'المؤهل العلمي',
        'lecturer_science_qualification.*.specific' => 'تخصص المؤهل العلمي',
        'lecturer_trainer_qualification.*.qualification' => 'المؤهل التدريبي',
        'lecturer_trainer_qualification.*.specific' => 'تخصص المؤهل التدريبي',
        'social_media.*' => 'وسائل التواصل الاجتماعي',
        'course_name' => 'اسم الدورة',
        'course_description' => 'تعريف مختصر عن الدورة',
        'target_group.*.name' => 'الفئة المستهدفة',
        'course_features.*.name' => 'مميزات الدورة',
        'course_requirements.*.name' => 'متطلبات الدورة',
        'course_goals.*.name' => 'اهداف الدورة',
        'course_process.*.title' => 'عنوان منهج الدورة',
        'course_process.*.content' => 'محتوى منهج الدورة',
        'course_type' => 'نوع الدورة',
        'course_price' => 'سعر الدورة',
        'certificate_type' => 'الشهادات',
        'course_duration_day' => 'عدد الأيام',
        'course_duration_hour' => 'عدد الساعات',
        'file_upload' => 'الملف',
        'trainer_certificate_image' => 'شهادة اعداد مدرب',
        'cv_image' => 'السيرة الذاتية',
        'course_image_upload' => 'الصورة',
        'program_id'=>'رقم البرنامج',
        'policy'=>'الموافقة على الشروط والأحكام',
        'payment'=>'طريقة الدفع',
        'country_id'=>'الدولة',
        'city_id'=>'المدينة',
        'calling_code'=>'رمز الادخال',
        'weight'=>'الوزن',
        'tall'=>'الطول',
        'health_diseases'=>'المشاكل الصحية',
        'subscription_goals_id'=>'الهدف من الإشتراك',
        'sports_levels_id'=>'مستوى النشاط الرياضى',
        'sports_types_id'=>'نوع النشاط الرياضى',
        'fats_area_id'=>'أكثر المناطق فى جسمك تحتوى على دهون',
        'food_allergy'=>'هل يوجد حساسية تجاه الطعام',
        'medicine_status'=>'هل هناك أدوية معينة تأخذها بإستمرار',
        'medicine_name'=>'اسم الدواء',
        'right_arm'=>'مقاس الذراع الأيمن',
        'left_arm'=>'مقاس الذراع الأيسر',
        'chest'=>'مقاس الصدر',
        'buttocks'=>'مقاس الأرداف',
        'belly'=>'مقاس البطن',
        'right_thigh'=>'مقاس الفخذ الأيمن',
        'left_thigh'=>'مقاس الفخذ الأيسر',
        'spcializtion'=>'التخصص',
        'oldPassword'=>'كلمة المرور القديمة',
        'reset_code'=>'كود الإسترجاع',
        'notification'=>'الإشعارات',

    ],
];