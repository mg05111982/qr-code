<?php
return [
    // set target language to be Russian
    'language' => 'ru-RU',

    // set source language to be English
    'sourceLanguage' => 'en-US',

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
