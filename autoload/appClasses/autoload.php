<?php
function autoloadOne($className){
    if(file_exists('appClasses/action/' . $className . '.php')) {
        include_once 'appClasses/action/' . $className . '.php';
    } else if(file_exists('appClasses/model/' . $className . '.php')) {
        include_once 'appClasses/model/' . $className . '.php';
    } else if(file_exists('appClasses/dao/' . $className . '.php')) {
        include_once 'appClasses/dao/' . $className . '.php';
    } else {
        include_once $className . '.php';
    }
}

spl_autoload_register('autoloadOne');

/*
>cd D:\python\phpDesignPatterns\autoload
>composer ini
>Package name: autoload/namespacer
>Descripton: [enter]
>defaults
>no
>no
>Do you confirm generation? yes

add autoload to composer.json

"autoload": {
    "psr-4": {
        "phpDesignPatterns\\": "phpDesignPatterns"
    }

    ou

    "classmap": [
        "phpDesignPatterns/autoload/appClasses/action",
        "phpDesignPatterns/autoload/appClasses/model",
        "phpDesignPatterns/autoload/appClasses/dao"
    ]
}

>composer update

*/