<?php
# require 'tests/bootstrap.php';
use GetOptionKit\GetOptionKit;

$opt = new GetOptionKit;
$opt->add( 'f|format:' , 'format' );
$opt->add( 'file:' , 'output file' );
$opt->add( 'h|help' , 'help' );

try {
    $result = $opt->parse( $argv );

    if( $result->help ) {
        $opt->specs->printOptions();
    }
    else {
        $g = new ClassMap\Generator;
        $args = $result->arguments;
        $format = $result->format ? $result->format->value : 'php';
        array_shift( $args );

        if( file_exists('src') )
            $g->addDir('src');

        foreach( $args as $arg ) {
            $g->addDir( (string) $arg );
        }


        if( $result->file ) {
            $g->generateFile( $result->file->value , $format );
            echo "Done\n";
        }
        else {
            echo $g->generate($format);
        }
    }

} catch( Exception $e ) {
    echo $e->getMessage();
}


