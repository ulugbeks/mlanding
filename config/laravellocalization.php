<?php

return [
    'supportedLocales' => [
        'lv' => ['name' => 'Latvian', 'script' => 'Latn', 'native' => 'Latviešu', 'regional' => 'lv_LV'],
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
        'ru' => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'Русский', 'regional' => 'ru_RU'],
    ],
    'useAcceptLanguageHeader' => false,
    'hideDefaultLocaleInURL' => true,
    'localesOrder' => ['lv', 'en', 'ru'],
    'localesMapping' => [],
    'utf8suffix' => '.UTF-8',
    'urlsIgnored' => ['/backend/*'],
];