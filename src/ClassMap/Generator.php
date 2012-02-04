<?php
namespace ClassMap;
use Universal\ClassLoader\BasePathClassLoader;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use RecursiveRegexIterator;

/**
 * ClassMap Generator
 *
 */

class Generator
{

    public $paths = array();
    public $autoloader;

    public function __construct()
    {
    }

    public function addDir($dir)
    {
        $this->paths[] = $dir;
    }


    public function addFile($file)
    {
        $this->paths[] = $file;
    }


    public function scan()
    {
        $loader = new BasePathClassLoader( $this->paths );
        $loader->useEnvPhpLib();
        $loader->register();
        foreach( $this->paths as $path ) {
            $di = new RecursiveDirectoryIterator($path);
            $ita = new RecursiveIteratorIterator($di);
            $regex = new RegexIterator($ita, '/^.+\.php$/i', 
                RecursiveRegexIterator::GET_MATCH);

            foreach( $regex as $matches ) foreach( $matches as $match ) {
                    require_once $match;
            }

        }
    }

    public function generate($file,$format = 'php')
    {
        switch($format)
        {
        case 'php':
            break;
        }
    }

}




