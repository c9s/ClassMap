ClassMap Generator
===================
ClassMap file is a dictionary for searching class, to improve classloader performance.

## Synopsis

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
