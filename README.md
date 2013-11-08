ClassMap Generator
===================

ClassMap generator generates classmap hash to improve class loading performance.

Normally, SplClassLoader uses PSR-0 class naming rule and PEAR class naming
rule to inspect the class path to autoload class, but this costs a lot when requiring a huge amount of classes.

ClassMap generator generates class file mapping into a pure PHP array file, you can simply require it to find class files.

```php
$classMap = require 'class_map.php';
$path = $classMap['PHPUnit'];   // returns path to PHPUnit classfile.
```

We decide to use PHP format as our class map file is that it's pretty easy to include from PHP,
and the compiled class map file can be cached by APC.


## Requirements

* PHP5.3
* Reflection extension.

## Install By Composer

    $ composer require corneltek/classmap

## Install By PEAR

    $ sudo pear install pear.corneltek.com/ClassMap

## Synopsis

    $ ./classmap.phar src

Which compiles a hash map file like below:

```php
<?php return array (
    'Universal\\ClassLoader\\SplClassLoader' => 'phar:///Users/c9s/git/Work/ClassMap/classmap.phar/Universal/ClassLoader/SplClassLoader.php',
    'GetOptionKit\\GetOptionKit' => 'phar:///Users/c9s/git/Work/ClassMap/classmap.phar/GetOptionKit/GetOptionKit.php',
    'GetOptionKit\\OptionSpecCollection' => 'phar:///Users/c9s/git/Work/ClassMap/classmap.phar/GetOptionKit/OptionSpecCollection.php',
    'GetOptionKit\\OptionParser' => 'phar:///Users/c9s/git/Work/ClassMap/classmap.phar/GetOptionKit/OptionParser.php',
    'GetOptionKit\\OptionSpec' => 'phar:///Users/c9s/git/Work/ClassMap/classmap.phar/GetOptionKit/OptionSpec.php',
    'GetOptionKit\\OptionResult' => 'phar:///Users/c9s/git/Work/ClassMap/classmap.phar/GetOptionKit/OptionResult.php',
    'GetOptionKit\\Argument' => 'phar:///Users/c9s/git/Work/ClassMap/classmap.phar/GetOptionKit/Argument.php',
    'ClassMap\\Generator' => 'phar:///Users/c9s/git/Work/ClassMap/classmap.phar/ClassMap/Generator.php',
);
```

So you may require this class map file from your PHP application:

```php
$map = require 'classmap.php';
```



## API Synopsis


```php
    <?php
    $mapGen = new ClassMap\Generator();
    $mapGen->addDir( 'path/to/library' );
    $mapGen->addFile( $file );
    $mapGen->addClass( $class, $file );
    $mapGen->generateFile( 'class_map.php', 'php' );

    $mapGen->autoload = true or false;  // turn on autoloader
```

To generate json format dictionary:

```
$mapGen->generate( 'class_map.php', 'json' );
```

## ClassMap File Format

```php
return array(
    'class' => 'path/to/file.php',
);
```

## Author

Yo-An Lin <cornelius.howl@gmail.com>
