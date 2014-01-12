<?php

/**
 * Simple unit tests framework, easy to use, easy to deploy (copy / paste).
 * @author martial@braux.net
 * See LICENSE file for legal details.
 */
class PHPSimpleUnitTestsFramework {
    
    public $passedAssertions = 0;
    public $failedAssertions = 0;
    public $testsRan = 0;

    /**
     * Logs a message in the tests output.
     * @param string the message to log.
     */
    function logTest($message) {
        echo '<p class="testLog" style="font-family:monospace;padding:0;margin:0.3em;">UnitTests &gt; ' . $message . '</p>';
    }

    /**
     * Logs a test run.
     * @param string the message to log (optional).
     */
    function logRun($testName) {
        $this->testsRan++;
        $this->logTest('<span style="color:#000000;font-weight:bold;">Testing '.$testName.'.</span>');
    }

    /**
     * Logs a successful test.
     * @param string the message to log (optional).
     */
    function logSuccess($message = 'Test OK.') {
        $this->passedAssertions++;
        $this->logTest('<span style="color:#51A845;font-weight:bold;">SUCCESS</span> &gt; ' . $message);
    }

    /**
     * Logs a failed test.
     * @param string the message to log.
     */
    function logFailure($message) {
        $this->failedAssertions++;
        $this->logTest('<span style="color:#D62424;font-weight:bold;">FAILURE</span> &gt; ' . $message);
    }

    /**
     * Asserts that a variable is set.
     * @param string the message to log if the test fails.
     * @param mixed the variable to test.
     */
    function assertIsset($message = '', $var) {
        if (isset($var)) {
            $this->logSuccess();
        } else {
            $this->logFailure('Test assertIsset failed : ' . $message);
        }
    }

    /**
     * Asserts that a variable is not set.
     * @param string the message to log if the test fails.
     * @param mixed the variable to test.
     */
    function assertNotIsset($message = '', $var) {
        if (!isset($var)) {
            $this->logSuccess();
        } else {
            $this->logFailure('Test assertNotIsset failed : ' . $message);
        }
    }

    /**
     * Asserts that a variable is not null.
     * @param string the message to log if the test fails.
     * @param mixed the variable to test.
     */
    function assertNotNull($message = '', $var) {
        if ($var != null) {
            $this->logSuccess();
        } else {
            $this->logFailure('Test assertNotNull failed : ' . $message);
        }
    }

    /**
     * Asserts that a variable is null.
     * @param string the message to log if the test fails.
     * @param mixed the variable to test.
     */
    function assertNull($message = '', $var) {
        if ($var == null) {
            $this->logSuccess();
        } else {
            $this->logFailure('Test assertNull failed : ' . $message);
        }
    }

    /**
     * Asserts that a variable is an array.
     * @param string the message to log if the test fails.
     * @param mixed the variable to test.
     */
     function assertIsArray($message = '', $var) {
        if (is_array($var)) {
            $this->logSuccess();
        } else {
            $this->logFailure('Test assertIsArray failed : ' . $message);
        }
    }

    /**
     * Asserts that a variable is not an array.
     * @param string the message to log if the test fails.
     * @param mixed the variable to test.
     */
    function assertNotIsArray($message = '', $var) {
        if (!is_array($var)) {
            $this->logSuccess();
        } else {
            $this->logFailure('Test assertNotIsArray failed : ' . $message);
        }
    }

    /**
     * Asserts that a variable equals an expected value.
     * @param string the message to log if the test fails.
     * @param mixed the expected value.
     * @param mixed the variable to test.
     */
    function assertEquals($message = '', $expected, $var) {
        if ($var == $expected) {
            $this->logSuccess();
        } else {
            $this->logFailure('Test assertEquals failed : ' . $message);
        }
    }

    /**
     * Asserts that a variable does not equal an expected value.
     * @param string the message to log if the test fails.
     * @param mixed the expected value.
     * @param mixed the variable to test.
     */
    function assertNotEquals($message = '', $expected, $var) {
        if ($var == $expected) {
            $this->logSuccess();
        } else {
            $this->logFailure('Test assertNotEquals failed : ' . $message);
        }
    }

    /**
     * Logs the resume of the tests.
     */    
    function resume() {
        $this->logTest('<span style="font-weight:bold;">Tests methods = '.$this->testsRan.' | Tests SUCCESSFUL = '.$this->passedAssertions.' | Tests FAIL = '.$this->failedAssertions.'.</span>');
    }
    
    /**
     * Override this function to do the init stuff.
     */
    function init() {}
    
    /**
     * Override this function to do the post stuff (at the end of the tests).
     */
    function post() {}
    
    /**
     * Call this function, but do not override it unless you know what you're doing.
     */
    function run() {
        $obj = new ReflectionObject($this);
        $this->startPage($obj->name);
        $this->init();
        $clazz = new ReflectionClass($obj->name);
        $methods = $clazz->getMethods();
        foreach ($methods as $method) {
            $start = substr($method->name, 0, 4);
            if ($start=='test') {    
                $this->logRun($method->name);
                $method->invoke($this);
            }
        }
        $this->post();
        $this->resume();
        $this->endPage();
    }
    
    /**
     * Starts the display page. 
     */
    function startPage($testName) {
        echo '<html><head><title>'.$testName.'</title></head><body><h1 style="font-weight:bold;font-size:2em;">'.$testName.'</h1><div style="border:1px solid #000000;padding:1em;background-color:#eeeeee;">';
    }
    
    /**
     * Ends the display page.
     */
    function endPage() {
        echo '</div></body></html>';
    }

}
?>