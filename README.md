# PHPUnit ToDo Markdown Printer

Print your failed tests as a to do list in Markdown format

## Status

[![latest tag](https://img.shields.io/github/v/tag/open-southeners/phpunit-todo-markdown-printer?label=latest&sort=semver)](https://github.com/open-southeners/phpunit-todo-markdown-printer/releases/latest) [![packagist version](https://img.shields.io/packagist/v/open-southeners/phpunit-todo-markdown-printer)](https://packagist.org/packages/open-southeners/phpunit-todo-markdown-printer) [![required php version](https://img.shields.io/packagist/php-v/open-southeners/phpunit-todo-markdown-printer)](https://www.php.net/supported-versions.php) [![phpstan](https://github.com/open-southeners/phpunit-todo-markdown-printer/actions/workflows/phpstan.yml/badge.svg)](https://github.com/open-southeners/phpunit-todo-markdown-printer/actions/workflows/phpstan.yml) [![Laravel Pint](https://img.shields.io/badge/code%20style-pint-orange?logo=laravel)](https://github.com/open-southeners/phpunit-todo-markdown-printer/actions/workflows/pint.yml) [![Codacy Badge](https://app.codacy.com/project/badge/Grade/ef6857df707f469ca808719b833ebe74)](https://www.codacy.com/gh/open-southeners/phpunit-todo-markdown-printer/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=open-southeners/phpunit-todo-markdown-printer&amp;utm_campaign=Badge_Grade) [![Edit on VSCode online](https://img.shields.io/badge/vscode-edit%20online-blue?logo=visualstudiocode)](https://vscode.dev/github/open-southeners/phpunit-todo-markdown-printer)

## Getting started

```bash
composer require open-southeners/phpunit-todo-markdown-printer
```

### Configuration

Add the following to your `phpunit.xml`:

```xml
  <listeners>
    <listener class="OpenSoutheners\PHPUnitTodoMarkdownPrinter\Printer">
      <arguments>
        <string name="out">todo_failed_tests.md</string>
        <boolean name="reportRiskyTests">true</boolean>
        <boolean name="reportIncompleteTests">true</boolean>
        <boolean name="reportSkippedTests">true</boolean>
      </arguments>
    </listener>
  </listeners>
```

And that's all you need to do, from now on your `todo_failed_tests.md` will have the markdown similar as the one below.

## Example output

### Code

````markdown
# Failed tests

A summary of tests that failed. **Total of 1 failed within 1 files**.

## CommentControllerTest

- [ ] test_that_fails_mostly

```
Call to a member function getKey() on null

at /Users/my_user/Projects/my_project/app/Notifications/Notification.php:34
----------
#0 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/Framework/TestCase.php(904): PHPUnit\Framework\TestResult->run(Object(Tests\Integration\Http\Controllers\Api\CommentControllerTest))
#1 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/Framework/TestSuite.php(675): PHPUnit\Framework\TestCase->run(Object(PHPUnit\Framework\TestResult))
#2 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/Framework/TestSuite.php(675): PHPUnit\Framework\TestSuite->run(Object(PHPUnit\Framework\TestResult))
#3 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/Framework/TestSuite.php(675): PHPUnit\Framework\TestSuite->run(Object(PHPUnit\Framework\TestResult))
#4 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/TextUI/TestRunner.php(661): PHPUnit\Framework\TestSuite->run(Object(PHPUnit\Framework\TestResult))
#5 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/TextUI/Command.php(144): PHPUnit\TextUI\TestRunner->run(Object(PHPUnit\Framework\TestSuite), Array, Array, true)
#6 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/TextUI/Command.php(97): PHPUnit\TextUI\Command->run(Array, true)
#7 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/phpunit(98): PHPUnit\TextUI\Command::main()
#8 {main}
```
````

### Preview

# Failed tests

A summary of tests that failed. **Total of 1 failed within 1 files**.

## CommentControllerTest

- [ ] test_that_fails_mostly

```
Call to a member function getKey() on null

at /Users/my_user/Projects/my_project/app/Notifications/Notification.php:34
----------
#0 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/Framework/TestCase.php(904): PHPUnit\Framework\TestResult->run(Object(Tests\Integration\Http\Controllers\Api\CommentControllerTest))
#1 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/Framework/TestSuite.php(675): PHPUnit\Framework\TestCase->run(Object(PHPUnit\Framework\TestResult))
#2 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/Framework/TestSuite.php(675): PHPUnit\Framework\TestSuite->run(Object(PHPUnit\Framework\TestResult))
#3 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/Framework/TestSuite.php(675): PHPUnit\Framework\TestSuite->run(Object(PHPUnit\Framework\TestResult))
#4 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/TextUI/TestRunner.php(661): PHPUnit\Framework\TestSuite->run(Object(PHPUnit\Framework\TestResult))
#5 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/TextUI/Command.php(144): PHPUnit\TextUI\TestRunner->run(Object(PHPUnit\Framework\TestSuite), Array, Array, true)
#6 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/src/TextUI/Command.php(97): PHPUnit\TextUI\Command->run(Array, true)
#7 /Users/my_user/Projects/my_project/vendor/phpunit/phpunit/phpunit(98): PHPUnit\TextUI\Command::main()
#8 {main}
```


