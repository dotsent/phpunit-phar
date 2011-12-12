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
    ->notName('package.xml')
    ->notName('package.sig')
    ->in(__DIR__.'/build/lib')
;

foreach ($finder as $file) {
    $filename = substr((string)$file, strlen(__DIR__.'/'));
    $localFilename =  substr((string)$file, strlen(__DIR__.'/build/'));
    $phar->addFile($filename, $localFilename);
    echo $filename  . ' => ' . $localFilename .PHP_EOL;
}

$phar->setStub(file_get_contents('stub.php'));
$phar->stopBuffering();
unset($phar);
echo "[DONE]" . PHP_EOL;
