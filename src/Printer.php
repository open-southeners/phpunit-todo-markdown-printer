<?php

namespace OpenSoutheners\PHPUnitTodoMarkdownPrinter;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\Framework\Test;
use ReflectionClass;
use Throwable;

final class Printer extends \PHPUnit\Util\Printer implements TestListener
{
    /**
     * @var array
     */
    protected $failedTests = [];

    /**
     * @var boolean
     */
    protected $reportRiskyTests;

    /**
     * @var boolean
     */
    protected $reportIncompleteTests;

    /**
     * @param null|mixed $out
     * @param boolean $reportRiskyTests
     * @param boolean $reportIncompleteTests
     */
    public function __construct($out = null, bool $reportRiskyTests = false, bool $reportIncompleteTests = true)
    {
        parent::__construct($out);

        $this->reportRiskyTests = $reportRiskyTests;
        $this->reportIncompleteTests = $reportIncompleteTests;
    }

    public function flush(): void
    {
        $textContent = "**A summary of tests that failed:**\n\n";

        foreach ($this->failedTests as $failedTest) {
            // TODO: Need relative paths...
            // $textContent .= "- [ ] {$failedTest['test']} at {$failedTest['filePath']}\n\n";
            $textContent .= "- [ ] {$failedTest['test']}\n\n";

            $textContent .= "```\n".trim($failedTest['message'])."\n```\n\n";
        }

        $this->write($textContent);
    }
    
    /**
     * Add details of failure, error or incompletion to array of failed tests.
     *
     * @param string $test
     * @param string $message
     * @param string $testClass
     */
    protected function addTestToFailed(string $test, string $message, string $testClass): void
    {
        $reflector = new ReflectionClass($testClass);

        $filePath = $reflector->getFileName();

        $this->failedTests[] = compact('test', 'message', 'filePath');
    }

    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param Throwable $t
     * @param float $time
     */
    public function addError(Test $test, Throwable $t, float $time): void
    {
        $this->addTestToFailed($test->getName(), $t->getMessage(), get_class($test));
    }

    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param \PHPUnit\Framework\Warning $e
     * @param float $time
     */
    public function addWarning(Test $test, Warning $e, float $time): void
    {
        $this->addTestToFailed($test->getName(), $e->getMessage(), get_class($test));
    }

    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param \PHPUnit\Framework\AssertionFailedError $e
     * @param float $time
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
    {
        $this->addTestToFailed($test->getName(), $e->getMessage(), get_class($test));
    }

    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param \Throwable $t
     * @param float $time
     */
    public function addRiskyTest(Test $test, Throwable $t, float $time): void
    {
        if (! $this->reportRiskyTests) {
            return;
        }

        $this->addTestToFailed($test->getName(), $t->getMessage(), get_class($test));
    }

    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param \Throwable $t
     * @param float $time
     */
    public function addIncompleteTest(Test $test, Throwable $t, float $time): void
    {
        if (! $this->reportIncompleteTests) {
            return;
        }

        $this->addTestToFailed($test->getName(), $t->getMessage(), get_class($test));
    }
    
    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param \Throwable $t
     * @param float $time
     */
    public function addSkippedTest(Test $test, Throwable $t, float $time): void
    {
    }
    
    /**
     * @param \PHPUnit\Framework\TestSuite $suite
     */
    public function startTestSuite(TestSuite $suite): void
    {
    }
    
    /**
     * @param \PHPUnit\Framework\TestSuite $suite
     */
    public function endTestSuite(TestSuite $suite): void
    {
    }
    
    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param float $time
     */
    public function startTest(Test $test): void
    {
    }
    
    /**
     * @param \PHPUnit\Framework\Test $test
     * @param float $time
     */
    public function endTest(Test $test, float $time): void
    {
    }
}