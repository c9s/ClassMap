ClassMap Generator
===================
ClassMap file is a dictionary for searching class, to improve classloader performance.


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
    $mapGen->addDir( );
    $mapGen->addFile( );
    $mapGen->addClass( $class, $file );
    $mapGen->generate( 'class_map.php', 'php' );

## ClassMap File

    <?php
    return array(
        'class' => 'path/to/file.php',
    );
