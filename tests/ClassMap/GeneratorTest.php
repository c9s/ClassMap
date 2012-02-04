<?php

class GeneratorTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $g = new ClassMap\Generator;
        $g->addDir( 'src' );
        $g->scan();
        $g->generate( 'pure.php' );
    }
}

