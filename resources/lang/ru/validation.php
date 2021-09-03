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

    'accept' => ':attribute должен быть принят.',
    'active_url' => ':attribute не является допустимым URL.',
    'after' => ':attribute должен быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после или равной дате.',
    'alpha' => ':attribute может содержать только буквы.',
    'alpha_dash' => ':attribute может содержать только буквы, цифры и дефисы.',
    'alpha_num' => ':attribute может содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должен быть датой до :date.',
    'before_or_equal' => ':attribute должен быть датой до или равной :date.',
    'между' => [
        'numeric' => ':attribute должен находиться между :min и :max.',
        'file' => ':attribute должен находиться в диапазоне от :min до :max килобайт.',
        'string' => ':attribute должен быть между :min и :max символами.',
        'array' => ':attribute должен иметь от :min до :max элементов.',
    ],
    'boolean' => 'Поле :attribute должно быть истинным или ложным.',
    'Verified' => 'Подтверждение :attribute не совпадает.',
    'date' => ':attribute не является допустимой датой.',
    'date_format' => ':attribute не соответствует формату :format.',
    'different' => ':attribute и: другие должны быть разными.',
    'digits' => ':attribute должен быть: digits digits.',
    'digits_between' => ':attribute должен быть между :min и :max цифрами.',
    'sizes' => ':attribute имеет недопустимые размеры изображения.',
    'independent' => 'Поле :attribute имеет повторяющееся значение.',
    'email' => ':attribute должен быть действующим адресом электронной почты.',
    'exists' => 'Атрибут selected: недействителен.',
    'file' => ':attribute должен быть файлом.',
    'fill' => 'Поле :attribute должно иметь значение.',
    'image' => ':attribute должен быть изображением.',
    'in' => 'Атрибут selected: недействителен.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer' => ':attribute должен быть целым числом.',
    'ip' => ':attribute должен быть действительным IP-адресом.',
    'ipv4' => ':attribute должен быть действительным адресом IPv4.',
    'ipv6' => ':attribute должен быть действительным IPv6-адресом.',
    'json' => ':attribute должен быть допустимой строкой JSON.',
    'max' => [
        'numeric' => ':attribute не может быть больше, чем :max.',
        'file' => ':attribute не может быть больше, чем :max килобайт.',
        'string' => ':attribute не может быть больше, чем :max символов.',
        'array' => ':attribute не может содержать более :max элементов.',
    ],
    'mimes' => ':attribute должен быть файлом типа: :values.',
    'mimetypes' => ':attribute должен быть файлом типа: :values.',
    'min' => [
        'numeric' => ':attribute должен быть не меньше :min.',
        'file' => ':attribute должен быть не меньше :min килобайт.',
        'string' => ':attribute должен содержать не менее :min символов.',
        'array' => ':attribute должен содержать как минимум :min элементов.',
    ],
    'not_in' => 'Атрибут selected: недействителен.',
    'numeric' => ':attribute должен быть числом.',
    'present' => 'Поле :attribute должно присутствовать.',
    'regex' => 'Недействительный формат :attribute.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_if' => 'Поле :attribute необходимо, когда :other is :value.',
    'required_unless' => 'Поле :attribute является обязательным, если :other не находится в :values.',
    'required_with' => 'Поле :attribute обязательно, если присутствует :values.',
    'required_with_all' => 'Поле :attribute обязательно, если присутствует :values.',
    'required_without' => 'Поле :attribute необходимо, если :values не указан.',
    'required_without_all' => 'Поле :attribute является обязательным, если ни одно из: значений не присутствует.',
    'same' => ':attribute и: другие должны совпадать.',
    'size' => [
        'numeric' => ':attribute должен быть :size.',
        'file' => ':attribute должен быть: размер в килобайтах.',
        'string' => ':attribute должен содержать символы :size.',
        'array' => ':attribute должен содержать элементы :size.',
    ],
    'string' => ':attribute должен быть строкой.',
    'timezone' => ':attribute должен быть допустимой зоной.',
    'unique' => ':attribute уже занят.',
    'uploaded' => 'Не удалось загрузить :attribute.',
    'url' => 'Недопустимый формат :attribute.',

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

    'attributes' => [],

];
