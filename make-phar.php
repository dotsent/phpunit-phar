<?php

/*
 * This file is part of phpunit-phar.
 *
 * (c) Igor Wiedler <igor@wiedler.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';
$loader = new Symfony\Component\ClassLoader\UniversalClassLoader;
$loader->registerNamespace('Symfony', __DIR__.'/symfony/src');
$loader->register();

$pharFile = 'phpunit.phar';

if (file_exists($pharFile)) {
    unlink($pharFile);
}

$phar = new Phar($pharFile, 0, 'phpunit.phar');
$phar->setSignatureAlgorithm(Phar::SHA1);
$phar->startBuffering();

$finder = new Symfony\Component\Finder\Finder();
$finder->files()
    ->ignoreVCS(true)
#    ->notName('make-phar.php')
#    ->notName('phpunit.phar')
#    ->notName('vendors.sh')
    ->notName('package.xml')
    ->notName('package.sig')
#    ->exclude('symfony')
#    ->exclude('Tests')
    ->in(__DIR__.'/lib')
;

foreach ($finder as $file) {
    $filename = substr((string)$file, strlen(__DIR__.'/'));
    $phar->addFile($filename);
}

$phar['_stub.php'] = <<<EOF
<?php

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
EOF;

#$phar->setDefaultStub('_stub.php');
$phar->setStub(file_get_contents('stub.php'));
$phar->stopBuffering();
unset($phar);
