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
    public $static = true;

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


    // XXX: doesnt work on namespace staff
    public function staticParse($file)
    {
        $source = file_get_contents($file);
        if( preg_match_all( '/(?:abstract\s+class|class|interface)\s+(\w+)/i' ,$source, $matches ) ) {
            var_dump( $matches ); 
        }
    }

    public function load()
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

    public function generate($format = 'php')
    {

        $classMap = array();

        foreach( get_declared_interfaces() as $inf ) {
            $ref = new \ReflectionClass($inf); 
            if( $path = $ref->getFileName() ) {
                $classMap[ $inf ] = $path;
            }
        }

        foreach( get_declared_classes() as $c ) {
            $ref = new \ReflectionClass($c); 
            if( $path = $ref->getFileName() ) {
                $classMap[ $c ] = $path;
            }
        }

        switch($format)
        {
        case 'php':
            return '<?php return ' . var_export( $classMap, true ) . ';';
            break;
        case 'json':
            return json_encode( $classMap );
            break;
        default:
            throw new Exception("Unsupported format: $format");
        }
    }

    public function generateFile($file,$format = 'php')
    {
        $content = $this->generate($format);
        return file_put_contents( $file, $content );
    }


}




