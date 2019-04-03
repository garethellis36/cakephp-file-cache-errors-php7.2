Test/repro project for https://github.com/cakephp/cakephp/issues/13085

# Requirements
- PHP 7.2 (any point release)
- MySQL (tested on 5.5, I don't know if other versions will be affected)
- This may be Windows-specific, I am not able to test on another OS 

# Steps to reproduce the issue
- Clone project locally
- Run `composer install`
- Run the SQL in `./setup.sql`
- Update the DB credentials in `./Config/database.php` (just update the constants)
- Run the tests with `Console/cake test app Database`
- You will probably need to run the test more than once to see the error, the error won't occur if you haven't already 
got the method_cache file in your cache directory 
- The error does not seem to occur every time

# Expected output (without Xdebug enabled)

```
Welcome to CakePHP v2.10.15 Console
---------------------------------------------------------------
App : cake-cache-test
Path: C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\
---------------------------------------------------------------
CakePHP Test Shell
---------------------------------------------------------------
PHPUnit 5.7.27 by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: 2.13 seconds, Memory: 8.00MB

OK (1 test, 0 assertions)

Warning: flock(): supplied resource is not a valid stream resource in C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\Vendor\cakephp\cakephp\lib\Cake\Cache\Engine\FileEngine.php on line 138

Warning: SplFileObject::rewind(): stream does not support seeking in C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\Vendor\cakephp\cakephp\lib\Cake\Cache\Engine\FileEngine.php on line 141

Fatal error: Uncaught RuntimeException: Cannot rewind file C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\tmp\cache\persistent\._cake_core_method_cache in C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\Vendor\cakephp\cakephp\lib\Cake\Cache\Engine\FileEngine.php:141
Stack trace:
#0 C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\Vendor\cakephp\cakephp\lib\Cake\Cache\Engine\FileEngine.php(141): SplFileObject->rewind()
#1 C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\Vendor\cakephp\cakephp\lib\Cake\Cache\Cache.php(317): FileEngine->write('._cake_core_met...', 'a:1:{s:4:"name"...', 86317200)
#2 C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\Vendor\cakephp\cakephp\lib\Cake\Model\Datasource\DboSource.php(3748): Cache::write('method_cache', Array, '_cake_core_')
#3 [internal function]: DboSource->__destruct()
#4 {main}
  thrown in C:\Users\EllisG.ICONCR\PhpstormProjects\cake-cache-test\Vendor\cakephp\cakephp\lib\Cake\Cache\Engine\FileEngine.php on line 141

```

# Notes
- To get this to reproduce I had to force a method cache change in `./Test/Case/DatabaseTest.php` by calling 
`flushMethodCache()` directly
- This appears to happen inside `DboSource::__destruct()`; it enters the if block and attempts to write the updated 
method_cache
