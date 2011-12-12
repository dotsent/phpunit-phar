#!/usr/bin/env php 
<?php

Phar::mapPhar();

set_include_path(
    __DIR__.'/lib/PHPUnit-3.5.15'.PATH_SEPARATOR.
    __DIR__.'/lib/DbUnit-1.0.0'.PATH_SEPARATOR.
    __DIR__.'/lib/File_Iterator-1.2.3'.PATH_SEPARATOR.
    __DIR__.'/lib/Text_Template-1.0.0'.PATH_SEPARATOR.
    __DIR__.'/lib/PHP_CodeCoverage-1.0.2'.PATH_SEPARATOR.
    __DIR__.'/lib/PHP_TokenStream-1.0.1'.PATH_SEPARATOR.
    __DIR__.'/lib/PHP_Timer-1.0.0'.PATH_SEPARATOR.
    __DIR__.'/lib/PHPUnit_MockObject-1.0.3'.PATH_SEPARATOR.
    __DIR__.'/lib/PHPUnit_Selenium-1.0.1'.PATH_SEPARATOR.
#    __DIR__.'/phpunit-story'.PATH_SEPARATOR.
#    __DIR__.'/php-invoker'.PATH_SEPARATOR.
    get_include_path()
);

require 'PHPUnit/Autoload.php';

PHPUnit_TextUI_Command::main();

__HALT_COMPILER();
