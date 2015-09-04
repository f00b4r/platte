# Platte

[![Phalconist](https://phalconist.com/phalette/platte/default.svg)](https://phalconist.com/phalette/platte)
[![Build Status](https://img.shields.io/travis/phalette/platte.svg?style=flat-square)](https://travis-ci.org/phalette/platte)
[![Code coverage](https://img.shields.io/coveralls/phalette/platte.svg?style=flat-square)](https://coveralls.io/r/phalette/platte)
[![Downloads this Month](https://img.shields.io/packagist/dt/phalette/platte.svg?style=flat-square)](https://packagist.org/packages/phalette/platte)
[![Latest stable](https://img.shields.io/packagist/v/phalette/platte.svg?style=flat-square)](https://packagist.org/packages/phalette/platte)
[![HHVM Status](https://img.shields.io/hhvm/phalette/platte.svg?style=flat-square)](http://hhvm.h4cc.de/package/phalette/platte)

Combination of one of the best template engine Latte and pretty fast framework Phalcon.

## Install

```sh
$ composer require phalette/platte:dev-master
```

### Dependencies

* **PHP >= 5.6.0**
* [Latte >= 2.3.0](https://github.com/nette/latte)
* [Phalcon >= 2.0.0](https://github.com/phalcon/cphalcon/)

## Configuration

Register Platte as your next `template engine`.

```php
use Phalette\Platte\Latte\LatteFactory;
use Phalette\Platte\LatteTemplateAdapter;

$di->set('view', function () {
    $view = new View();
    
    $view->registerEngines([
        ".latte" => function ($view, $di) {
            $factory = new LatteFactory();
            $factory->setTempDir(__DIR__ . '/cache');
            return new LatteTemplateAdapter($view, $di, $factory);
        },
    ]);
    return $view;
});
```

## Features from Nette

You can use all the great features from the Latte.

### Latte Template Engine

See more on [official documentation](https://doc.nette.org/en/2.3/templating).

You can use **macros** and **filters**.

#### Macros 

Classic macros

```latte
<ul>
    {foreach $users as $user}
        <li>{$user->name}</li>
    {/foreach}
</ul>
```

N-macros

```latte
<ul n:foreach="$users as $user">
    <li>{$user->name}</li>
</ul>
```

#### Filters

```latte
{var $time => time()}
It's {$time|date:'d.m.Y'} at {$time|date:'H:i:s'}
```


### Latte Macros

See more on [official documentation](https://doc.nette.org/en/2.3/default-macros).

| Variable and expression printing                                  |                                                      |
|-------------------------------------------------------------------|------------------------------------------------------|
| `{$variable}`                                                     | prints an escaped variable                           |
| `{$variable|noescape}`                                            | prints a variable without escaping                   |
| `{expression}`                                                    | prints an escaped expression                         |
| `{expression|noescape}`                                           | prints an expression without escaping                |

| Conditions                                                        |                                                      |
|-------------------------------------------------------------------|------------------------------------------------------|
| `{if $cond} … {elseif $cond} … {else} … {/if}`                  | if condition                                         |
| `{ifset $var} … {elseifset $var} … {/ifset}`                     | if (isset()) condition                               |

| Loops                                                             |                                                      |
|-------------------------------------------------------------------|------------------------------------------------------|
| `{foreach $arr as $item} … {/foreach}`                            | foreach loop                                         |
| `{for expr; expr; expr} … {/for}`                                 | for loop                                             |
| `{while expr} … {/while}`                                         | while loop                                           |
| `{continueIf $cond}`                                               | conditional jump to the next iteration               |
| `{breakIf $cond}`                                                  | conditional loop break                               |
| `{first} … {/first}`                                              | prints if first iteration                            |
| `{last} … {/last}`                                                | prints if last iteration                             |
| `{sep} … {/sep}`                                                  | separator                                            |

| Variables                                                         |                                                      |
|-------------------------------------------------------------------|------------------------------------------------------|
| `{var $foo = value}`                                              | variable creation                                    |
| `{default $foo = value}`                                          | default value when variable isn't declared           |
| `{capture $var} … {/capture}`                                    | captures a section to a variable                     |

| Engine                                                            |                                                      |
|-------------------------------------------------------------------|------------------------------------------------------|
| `{include 'file.latte'}`                                          | includes a template from other file                  |
| `{cache $key} … {/cache}`                                        | caches a template section                            |
| `{php expression}`                                                | evaluates an expression without printing it          |
| `{* comment text *}`                                              | a comment (removed from evaluation)                  |
| `{syntax mode}`                                                   | switches the syntax at runtime                       |
| `{use Class}`                                                     | loads new user-defined macros                        |
| `{l} or {r}`                                                      | prints { and } characters, respectively              |
| `{contentType $type}`                                             | switches the escaping mode and sends HTTP header     |
| `{status $code}`                                                  | sets an HTTP status code                             |

| HTML tag attributes                                               |                                                      |
|-------------------------------------------------------------------|------------------------------------------------------|
| `n:class`                                                         | smart class attribute                                |
| `n:attr`                                                          | smart HTML attributes                                |
| `n:ifcontent`                                                     | Omit empty HTML tag                                  |
| `n:tag-if`                                                        | Omit HTML tag if condition is FALSE                  |

| Translations                                                      |                                                      |
|-------------------------------------------------------------------|------------------------------------------------------|
| `{_}Text{/_}`                                                     | translates a text                                    |
| `{_expression}`                                                   | translates an expression and prints it with escaping |

| Blocks, layouts, template inheritance                             |                                                      |
|-------------------------------------------------------------------|------------------------------------------------------|
| `{block block}`                                                   | block definition and immediate print out             |
| `{define block}`                                                  | block defintion for future use                       |
| `{include block}`                                                 | inserts a block                                      |
| `{include mytemplate.latte}`                                      | inserts a template                                   |
| `{includeblock 'file.latte'}`                                     | loads blocks from external template                  |
| `{layout 'file.latte'}`                                           | specifies a layout file                              |
| `{extends 'file.latte'}`                                          | alias for {layout}                                   |
| `{ifset #block} … {/ifset}`                                      | condition if block is defined                        |

### Latte Filters

See more on [official documentation](https://doc.nette.org/en/2.3/default-filters).

| String modification                           |                                                                                |
|-----------------------------------------------|--------------------------------------------------------------------------------|
| `truncate (length, append = '..')`            | shortens the length preserving whole words                                     |
| `substr (offset [, length])`                  | returns part of the string                                                     |
| `trim (charset = whitespace)`                 | strips whitespace or other characters from the beginning and end of the string |
| `striptags`                                   | removes HTML tags                                                              |
| `strip`                                       | removes whitespace                                                             |
| `webalize (charlist = '...', lower = TRUE)`   | returns string in cool URL form                                                |
| `toAscii`                                     | removes accents                                                                |
| `indent (level = 1, char = "\t"")"`           | indents the text from left with number of tabs                                 |
| `replace (search, replace = '')`              | replaces all occurrences of the search string with the replacement             |
| `replaceRE (pattern, replace = '')`           | replaces all occurrences according to regular expression                       |
| `padLeft (length, pad = ' ')`                 | completes the string to given length from left                                 |
| `padRight (length, pad = ' ')`                | completes the string to given length from right                                |
| `repeat (count)`                              | repeats the string                                                             |
| `implode (glue = '')`                         | joins an array to a string                                                     |
| `nl2br`                                       | new lines with <br>                                                            |

| Letter casing                            |                                                                                |
|------------------------------------------|--------------------------------------------------------------------------------|
| `lower`                                  | makes a string lower case                                                      |
| `upper`                                  | makes a string upper case                                                      |
| `firstUpper`                             | makes the first letter upper case                                              |
| `capitalize`                             | lower case, the first letter of each word upper case                           |

| Formatting                               |                                                                                |
|------------------------------------------|--------------------------------------------------------------------------------|
| `date (format)`                          | formats date                                                                   |
| `number (decimals = 0, decPoint = '.')`  | format number                                                                  |
| `bytes (precision = 2)`                  | formats size in bytes                                                          |

| Other                                    |                                                                                |
|------------------------------------------|--------------------------------------------------------------------------------|
| `noescape`                               | prints a variable without escaping                                             |
| `dataStream (mimetype = detect)`         | Data URI protocol conversion                                                   |
| `escapeurl`                              | escapes parameter in URL                                                       |
| `length`                                 | returns length of a string                                                     |
| `null`                                   | flushes the input, returns nothing                                             |

## Features from Phalcon

You can access variables in templates.

| Variables    |                                                                                    |
|--------------|------------------------------------------------------------------------------------|
| `$_view`     | [Phalcon\Mvc\View](https//docs.phalconphp.com/en/latest/api/Phalcon_Mvc_View.html) |
| `$_tag`      | [Phalcon\Tag](https//docs.phalconphp.com/en/latest/api/Phalcon_Tag.html)           |
| `$_url`      | [Phalcon\Mvc\Url](https//docs.phalconphp.com/en/latest/api/Phalcon_Mvc_Url.html)   |
| `$_security` | [Phalcon\Security](https//docs.phalconphp.com/en/latest/api/Phalcon_Security.html) |

In extreme cases you can access **$_di**. But I really not recommend it.

### Macros

| Files & contents |                            |
|------------------|----------------------------|
| content          | `$_view->getContent()`     |
| partial          | `$_view->getPartial($path)`|

| Links & urls     |                            |
|------------------|----------------------------|
| linkTo           | `$_tag->linkTo($args...)`  |
| url              | `$_url->get($uri)`         |

| Forms         |                                   |
|---------------|-----------------------------------|
| textField     | `$_tag->textField($args)`         |
| passwordField | `$_tag->passwordField($args)`     |
| hiddenField   | `$_tag->hiddenField($args)`       |
| fileField     | `$_tag->fileField($args)`         |
| radioField    | `$_tag->radioField($args)`        |
| submitButton  | `$_tag->submitButton($args)`      |
| selectStatic  | `$_tag->selectStatic($args...)`   |
| select        | `$_tag->select($args...)`         |
| textArea      | `$_tag->textArea($args)`          |
| form          | `$_tag->form($args)`              |
| endForm       | `$_tag->endForm()`                |

| Other         |                                  |
|---------------|----------------------------------|
| title         | `$_tag->getTitle()`              |
| friendlyTitle | `$_tag->friendlyTitle($args...)` |
| doctype       | `$_tag->getDocType()`            |

| Assets            |                                      |
|-------------------|--------------------------------------|
| stylesheetLink    | `$_tag->stylesheetLink($args...)`    |
| css               | `$_tag->javascriptInclude($args...)` |
| javascriptInclude | `$_tag->javascriptInclude($args...)` |
| js                | `$_tag->javascriptInclude($args...)` |
| image             | `$_tag->image($args)`                |

| Security          |                                    |
|-------------------|------------------------------------|
| securityToken     | `$_security->getToken()`           |
| securityTokenKey  | `$_security->getTokenKey()`        |

## Features from your own

### Writing macros

1) Define macros

```php
use Latte\Compiler;
use Latte\Macros\MacroSet;
use Phalette\Platte\Latte\MacroInstaller;

final class MyUltraMacros extends MacroSet implements MacroInstaller
{
    public static function install(Compiler $compiler)
    {
        $me = new static($compiler);
        
        $me->addMacro(...);
    }
}
```

2) Register to `LatteFatory`

```php
$factory = new LatteFactory();
$factory->addMacro(new MyUltraMacros);
```

### Writing filters

1) Define filters

```php
final class MyUltraFilters
{
    public static function hi($name) 
    {
        return "Hi $name";
    }
}
```

2) Register to `LatteFatory`

```php
$factory = new LatteFactory();
$factory->addFilter('sayhi', ['MyUltraFilters', 'hi']);
```