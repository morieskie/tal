TAL Extension for Yii 2
=======================

This extension provides a `ViewRender` that would allow you to use PHPTAL view template engine.

To use this extension, simply add the following code in your application configuration:

```php
return [
    //....
    'components' => [
        'view' => [
            'renderers' => [
                'tpl' => [
                    'class' => 'yii\tal\ViewRenderer',
                    //'cachePath' => '@runtime/Tal/cache',
                ],
            ],
        ],
    ],
];
```

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiisoft/yii2-tal "*"
```

or add

```json
"yiisoft/yii2-tal": "*"
```

to the require section of your composer.json.