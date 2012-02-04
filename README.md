ClassMap Generator
===================

ClassMap generator generates classmap hash to improve class loading performance.

Normally, SplClassLoader uses PSR-0 class naming rule and PEAR class naming
rule to inspect the class path to autoload class, but this costs a lot when requiring a huge amount of classes.

ClassMap generator generates class file mapping into a pure PHP array file, you can simply require it to find class files.

    $classMap = require 'class_map.php';
    $path = $classMap['PHPUnit'];   // returns path to PHPUnit classfile.

## Requirements

* PHP5.3
* Reflection extension.

## Synopsis

    $ ./classmap.phar src

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

## API Synopsis

    $mapGen = new ClassMap\Generator
    $mapGen->addDir( 'path/to/library' );
    $mapGen->addFile( );
    $mapGen->addClass( $class, $file );
    $mapGen->generate( 'class_map.php', 'php' );

    $mapGen->autoload = true or false;  // turn on autoloader

To generate json format dictionary:

    $mapGen->generate( 'class_map.php', 'json' );

## ClassMap File Format

    <?php
    return array(
        'class' => 'path/to/file.php',
    );

