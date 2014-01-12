<?php
require_once 'PHPSimpleUnitTestsFramework.php';
/**
 * Sample test for PHPSimpleUnitTestsFramework.
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