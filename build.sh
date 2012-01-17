#!/bin/bash
#
# 
# Author dotsent <dotsent@uralweb.ru>
#
#

function download {
   url=$1
   filename=$2

   if [ ! -f $filename ]
   then 
     wget $url
   fi 
}



# Step 1.
mkdir -p build/lib
cd build/

# Step 2. Download pear packages for PhpUnit v 3.5.x

download http://pear.phpunit.de/get/PHPUnit_Selenium-1.0.1.tgz PHPUnit_Selenium-1.0.1.tgz
download http://pear.phpunit.de/get/PHPUnit_MockObject-1.0.3.tgz PHPUnit_MockObject-1.0.3.tgz
download http://pear.phpunit.de/get/PHP_Timer-1.0.0.tgz PHP_Timer-1.0.0.tgz 
download http://pear.phpunit.de/get/File_Iterator-1.2.3.tgz File_Iterator-1.2.3.tgz
download http://pear.phpunit.de/get/PHP_CodeCoverage-1.0.2.tgz PHP_CodeCoverage-1.0.2.tgz
download http://pear.phpunit.de/get/Text_Template-1.0.0.tgz Text_Template-1.0.0.tgz
download http://pear.phpunit.de/get/DbUnit-1.0.0.tgz DbUnit-1.0.0.tgz
download http://pear.phpunit.de/get/PHPUnit-3.5.15.tgz PHPUnit-3.5.15.tgz
download http://pear.phpunit.de/get/PHP_TokenStream-1.0.1.tgz PHP_TokenStream-1.0.1.tgz

# Step 3. Unpack

for i in `ls *.tgz`
do 
  tar xf $i -C lib/
done

cd ..

# Step 4. Build phar archive 
php -dphar.readonly=0 make-phar.php 
chmod +x phpunit.phar
