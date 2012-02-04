<?php
namespace ClassMap;
use Universal\ClassLoader\UniversalClassLoader;

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
            require $path;
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




