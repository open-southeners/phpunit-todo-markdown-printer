<?php

namespace OpenSoutheners\PHPUnitTodoMarkdownPrinter;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\Framework\Test;
use Throwable;

final class Printer extends \PHPUnit\Util\Printer implements TestListener
{
    /**
     * @var int
     */
    protected $failedCount = 0;

    /**
     * @var array
     */
    protected $failed = [];

    /**
     * @var boolean
     */
    protected $reportRiskyTests;

    /**
     * @var boolean
     */
    protected $reportIncompleteTests;

    /**
     * @var boolean
     */
    protected $reportSkippedTests;

    /**
     * @param null|mixed $out
     * @param boolean $reportRiskyTests
     * @param boolean $reportIncompleteTests
     * @param boolean $reportSkippedTests
     */
    public function __construct(
        $out = null,
        bool $reportRiskyTests = false,
        bool $reportIncompleteTests = true,
        bool $reportSkippedTests = false
    ) {
        parent::__construct($out);

        $this->reportRiskyTests = $reportRiskyTests;
        $this->reportIncompleteTests = $reportIncompleteTests;
        $this->reportSkippedTests = $reportSkippedTests;
    }

    public function flush(): void
    {
        $textContent = "# Failed tests\n\n";
        $textContent .= "A summary of tests that failed. **Total of {$this->failedCount} failed within ".count($this->failed)." files**.\n\n";

        foreach ($this->failed as $file => $failedTests) {
            $fileClass = explode('::', $file);
            $fileClass = reset($fileClass);
            $fileClass = explode('\\', $fileClass);
            $fileClass = end($fileClass);
            $textContent .= "## {$fileClass}\n\n";

            foreach ($failedTests as $failedTest) {
                $textContent .= "- [ ] {$failedTest['test']}\n\n";

                $textContent .= "```\n".trim($failedTest['message'])."\n\n";
                $textContent .= "at {$failedTest['failureAt']}\n";
                $textContent .= "----------\n";
                $textContent .= "{$failedTest['failureDetails']}\n```\n\n";
            }
        }

        $this->write($textContent);
    }
    
    /**
     * Add details of failure, error or incompletion to array of failed tests.
     *
     * @param string $file
     * @param string $test
     * @param \Throwable $exception
     */
    protected function addTestToFailed(string $file, string $test, Throwable $exception): void
    {
        $message = $exception->getMessage();
        $failureAt = "{$exception->getFile()}:{$exception->getLine()}";
        $failureDetails = $exception->getTraceAsString();

        $this->failedCount++;
        $this->failed[$file][] = compact('test', 'message', 'failureDetails', 'failureAt');
    }

    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param Throwable $t
     * @param float $time
     */
    public function addError(Test $test, Throwable $t, float $time): void
    {
        $this->addTestToFailed($test->toString(), $test->getName(), $t);
    }

    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param \PHPUnit\Framework\Warning $e
     * @param float $time
     */
    public function addWarning(Test $test, Warning $e, float $time): void
    {
        $this->addTestToFailed($test->toString(), $test->getName(), $e);
    }

    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param \PHPUnit\Framework\AssertionFailedError $e
     * @param float $time
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
    {
        $this->addTestToFailed($test->toString(), $test->getName(), $e);
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

        $this->addTestToFailed($test->toString(), $test->getName(), $t);
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

        $this->addTestToFailed($test->toString(), $test->getName(), $t);
    }
    
    /**
     * @param \PHPUnit\Framework\TestCase|\PHPUnit\Framework\Test $test
     * @param \Throwable $t
     * @param float $time
     */
    public function addSkippedTest(Test $test, Throwable $t, float $time): void
    {
        if (! $this->reportSkippedTests) {
            return;
        }

        $this->addTestToFailed($test->toString(), $test->getName(), $t);
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