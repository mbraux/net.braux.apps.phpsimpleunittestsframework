net.braux.apps.phpsimpleunittestsframework
==========================================

A PHP simple unit tests framework. Simple to use, simple to deploy.
By the way, this framework is also for simple tests. If you plan complex tests, you should consider using PHPUnit or DBUnit.


Simple to use :
---------------
Put this code in a new file :
``` PHP
<?php
require_once 'PHPSimpleUnitTestsFramework.php';

/**
 *Sample test for PHPSimpleUnitTestsFramework.
 * @author martial@braux.net
 * See the LICENSE file for legal details.
 */
class MyClassTest extends PHPSimpleUnitTestsFramework {
  
  function testMyFirstMethod() {
    $myVar = 'This is a test';
    $this->assertIsset('myVar should be set.', $myVar);
    $this->assertEquals('The value should be correct.', 'This is a test', $myVar);
  }
  
  function testMySecondMethod() {
    $myVar = array('Another test');
    $this->assertIsArray('myVar should be an array.', $myVar);
    $this->assertNotIsArray('myVar should be an array. This test must fail...', $myVar);
    
  }

}

$tests = new MyClassTest();
$tests->run();

?>
```
Now call the page you just created in your browser, see the results.
Each method whose name begins with the word 'test', will be run as a test, others will be ignored.


Simple to deploy :
------------------
Simply copy / paste the PHPSimpleUnitTestsFramework to your directory and start coding ! No PEAR needed, no dependencies.
