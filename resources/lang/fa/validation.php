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

    'accepted'             => ':attribute باید پذیرفته شود.',
    'active_url'           => ':attribute وارد شده صحیح نمی باشد.',
    'after'                => ':attribute باید بعد از :date باشد.',
    'alpha'                => ':attribute باید فقط شامل حروف باشد.',
    'alpha_dash'           => ':attribute باید شامل حروف، اعداد و خط تیره باشد.',
    'alpha_num'            => ':attribute باید شامل حروف و اعداد باشد.',
    'array'                => ':attribute باید آرایه باشد.',
    'before'               => ':attribute باید قبل از :date باشد.',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file'    => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'string'  => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array'   => ':attribute باید دارای :min و :max عنصر باشد.',
    ],
    'boolean'              => ':attribute باید صحیح یا غلط باشد.',
    'confirmed'            => ':attribute مطابقت ندارند.',
    'date'                 => ':attribute معتبر نمی باشد.',
    'date_format'          => ':attribute با قالب :format مطابقت ندارد.',
    'different'            => ':attribute و :other باید متفاوت باشند.',
    'digits'               => ':attribute باید :digits عدد باشد.',
    'digits_between'       => ':attribute باید بین :min و :max عدد باشد.',
    'email'                => ':attribute وارد شده معتبر نمی باشد.',
    'exists'               => ':attribute وارد شده قبلا استفاده شده است.',
    'filled'               => ':attribute باید وارد شود.',
    'farsi'                => 'برای :attribute از حروف فارسی استفاده کنید.',
    'image'                => ':attribute باید یک فایل تصویری باشد.',
    'in'                   => ':attribute معتبر نمی باشد.',
    'integer'              => ':attribute باید عدد باشد.',
    'ip'                   => ':attribute باید یک آی پی معتبر باشد.',
    'json'                 => ':attribute باید از نوع JSON باشد.',
    'max'                  => [
        'numeric' => ':attribute نباید بزرگتر از :max باشد.',
        'file'    => ':attribute نباید بیشتر از :max کیلوبایت باشد.',
        'string'  => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'array'   => ':attribute نباید بیشتر از :max عنصر داشته باشد.',
    ],
    'mimes'                => ':attribute باید از نوع: :values باشد.',
    'min'                  => [
        'numeric' => ':attribute نباید کوچکتر از :min باشد.',
        'file'    => ':attribute نباید کمتر از :min کیلوبایت باشد.',
        'string'  => ':attribute نباید کمتر از :min کاراکتر باشد.',
        'array'   => ':attribute نباید کمتر از :min عنصر داشته باشد.',
    ],
    'not_in'               => ':attribute معتبر نمی باشد.',
    'numeric'              => ':attribute باید عدد باشد.',
    'regex'                => ':attribute معتبر نمی باشد.',
    'required'             => 'لطفا :attribute را وارد کنید.',
    'required_if'          => 'در صورتی که :other برابر :value باشد، :attribute الزامی است.',
    'required_unless'      => ':attribute الزامی است، مگر اینکه :other برابر :values باشد.',
    'required_with'        => ':attribute فقط زمانی الزامیست که برابر :values باشد.',
    'required_with_all'    => ':attribute فقط زمانی الزامیست که برابر :values باشد.',
    'required_without'     => ':attribute فقط زمانی الزامیست که برابر :values نباشد.',
    'required_without_all' => ':attribute فقط زمانی الزامیست که برابر :values نباشد.',
    'same'                 => ':attribute و :other باید مطابقت داشته باشتد.',
    'size'                 => [
        'numeric' => ':attribute باید :size باشد.',
        'file'    => ':attribute باید :size کیلوبایت باشد.',
        'string'  => ':attribute باید :size کاراکتر باشد.',
        'array'   => ':attribute باید شامل :size عنصر باشد.',
    ],
    'string'               => ':attribute باید کاراکتر باشد.',
    'timezone'             => ':attribute باید یک موقعیت زمانی معتبر باشد.',
    'unique'               => ':attribute وارد شده قبلا استفاده شده است.',
    'url'                  => ':attribute نامعتبر می باشد.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'نام',
        'family' => 'نام خانوادگی',
        'fullname' => 'نام و نام خانوادگی',
        'username' => 'نام کاربری',
        'email' => 'پست الکترونیکی',
        'mail' => 'پست الکترونیکی',
        'first_name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'password' => 'رمز عبور',
        'password_confirm' => 'تاییدیه رمز عبور',
        'city' => 'شهر',
        'country' => 'کشور',
        'address' => 'نشانی',
        'phone' => 'تلفن',
        'tel' => 'تلفن',
        'mobile' => 'شماره همراه',
        'age' => 'سن',
        'sex' => 'جنسیت',
        'gender' => 'جنسیت',
        'day' => 'روز',
        'month' => 'ماه',
        'year' => 'سال',
        'hour' => 'ساعت',
        'minute' => 'دقیقه',
        'second' => 'ثانیه',
        'title' => 'عنوان',
        'text' => 'متن',
        'content' => 'محتوا',
        'description' => 'توضیحات',
        'des' => 'توضیحات',
        'date' => 'تاریخ',
        'time' => 'زمان',
        'available' => 'موجود',
        'size' => 'اندازه',
        'body' => 'متن',
        'link' => 'آدرس اینترنتی',
        'smalldescription' => 'توضیخات مختصر',
        'cat_id' => 'شناسه دسته ها',
        'image' => 'تصویر',
        'views' => 'تعداد بازدید ها',
        'active' => 'گزینه فعال سازی',
        'code' => 'کد',
        'replymsg' => 'پاسخ',
        'score' => 'امتیاز',
        'uid' => 'شناسه کاربری',
        'comment' => 'دیدگاه',
        'birth' => 'تاریخ تولد',
        'jobtitle' => 'عنوان شغلی',
        'bio' => 'بیوگرافی',
        'duty' => 'وضعیت نظام وظیفه',
        'rel' => 'وضعیت تأهل',
        'lang' => 'عنوان زبان خارجی',
        'uni' => 'دانشگاه یا موسسه',
        'degree' => 'مدرک',
        'uniscore' => 'معدل تحصیلی',
        'startyear' => 'سال شروع',
        'endyear' => 'سال پایان',
        'company' => 'نام شرکت',
        'skill' => 'مهارت',
        'product' => 'محصول',
        'category' => 'دسته',
        'price' => 'قیمت',
    ],

];
