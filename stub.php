#!/usr/bin/env php 
<?php

Phar::mapPhar();

set_include_path(
    'phar://'.__FILE__.'/lib/PHPUnit-3.5.15'.PATH_SEPARATOR.
    'phar://'.__FILE__.'/lib/DbUnit-1.0.0'.PATH_SEPARATOR.
    'phar://'.__FILE__.'/lib/File_Iterator-1.2.3'.PATH_SEPARATOR.
    'phar://'.__FILE__.'/lib/Text_Template-1.0.0'.PATH_SEPARATOR.
    'phar://'.__FILE__.'/lib/PHP_CodeCoverage-1.0.2'.PATH_SEPARATOR.
    'phar://'.__FILE__.'/lib/PHP_TokenStream-1.0.1'.PATH_SEPARATOR.
    'phar://'.__FILE__.'/lib/PHP_Timer-1.0.0'.PATH_SEPARATOR.
    'phar://'.__FILE__.'/lib/PHPUnit_MockObject-1.0.3'.PATH_SEPARATOR.
    'phar://'.__FILE__.'/lib/PHPUnit_Selenium-1.0.1'.PATH_SEPARATOR.
#    __FILE__.'/phpunit-story'.PATH_SEPARATOR.
#    __FILE__.'/php-invoker'.PATH_SEPARATOR.
    get_include_path()
);

require 'PHPUnit/Autoload.php';

PHPUnit_TextUI_Command::main();

__HALT_COMPILER();
