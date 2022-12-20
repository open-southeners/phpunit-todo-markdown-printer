# PHPUnit ToDo Markdown Printer

Print your failed tests as a to do list in Markdown format

## Status

[![latest tag](https://img.shields.io/github/v/tag/open-southeners/phpunit-todo-markdown-printer?label=latest&sort=semver)](https://github.com/open-southeners/phpunit-todo-markdown-printer/releases/latest) [![packagist version](https://img.shields.io/packagist/v/open-southeners/phpunit-todo-markdown-printer)](https://packagist.org/packages/open-southeners/phpunit-todo-markdown-printer) [![required php version](https://img.shields.io/packagist/php-v/open-southeners/phpunit-todo-markdown-printer)](https://www.php.net/supported-versions.php) [![run-tests](https://github.com/open-southeners/phpunit-todo-markdown-printer/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/open-southeners/phpunit-todo-markdown-printer/actions/workflows/tests.yml) [![phpstan](https://github.com/open-southeners/phpunit-todo-markdown-printer/actions/workflows/phpstan.yml/badge.svg)](https://github.com/open-southeners/phpunit-todo-markdown-printer/actions/workflows/phpstan.yml) [![Laravel Pint](https://img.shields.io/badge/code%20style-pint-orange?logo=laravel)](https://github.com/open-southeners/phpunit-todo-markdown-printer/actions/workflows/pint.yml) [![Codacy Badge](https://app.codacy.com/project/badge/Grade/ef6857df707f469ca808719b833ebe74)](https://www.codacy.com/gh/open-southeners/phpunit-todo-markdown-printer/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=open-southeners/phpunit-todo-markdown-printer&amp;utm_campaign=Badge_Grade) [![Codacy Badge](https://app.codacy.com/project/badge/Coverage/ef6857df707f469ca808719b833ebe74)](https://www.codacy.com/gh/open-southeners/phpunit-todo-markdown-printer/dashboard?utm_source=github.com&utm_medium=referral&utm_content=open-southeners/phpunit-todo-markdown-printer&utm_campaign=Badge_Coverage) [![Edit on VSCode online](https://img.shields.io/badge/vscode-edit%20online-blue?logo=visualstudiocode)](https://vscode.dev/github/open-southeners/phpunit-todo-markdown-printer)

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
      </arguments>
    </listener>
  </listeners>
```

And that's all you need to do, from now on your `todo_failed_tests.md` will have the markdown similar as the one below.

## Example output

````markdown
**A summary of tests that failed:**

- [ ] test_workspace_editor_creates_approval

```
No query results for model [App\Models\User].
```

- [ ] test_approval_can_be_confirmed

```
No query results for model [App\Models\User].
```
````
