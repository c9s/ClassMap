<?php

class GeneratorTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $g = new ClassMap\Generator;
        $g->addDir( 'src' );
        $g->load();
        $content = $g->generate();

        file_put_contents( 'tests/testmap.php', $content);

        $map = require 'tests/testmap.php';
        ok( isset($map['PHPUnit_Runner_Version']) );
        ok( isset($map['ClassMap\Generator']) );
    }
}

