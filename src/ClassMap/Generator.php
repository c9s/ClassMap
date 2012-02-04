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
    public $filters = array();
    public $mapFilters = array();
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

    public function addFilter($closure)
    {
        $this->filters[] = $closure;
    }

    public function addMapFilter($cb)
    {
        $this->mapFilters[] = $cb;
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
                try {
                    @require_once $match;
                } 
                catch ( Exception $e ) {
                    echo "$match class load failed.\n";
                }
            }
        }
    }

    public function filterClasses($classes)
    {
        foreach( $this->filters as $f ) {
            $classes = array_filter( $classes , $f );
        }
        return $classes;
    }

    public function getClassFileMap($classes)
    {
        $map = array();
        foreach( $classes as $c ) {
            $ref = new \ReflectionClass($c); 
            if( $path = $ref->getFileName() ) {
                foreach( $this->mapFilters as $filter ) {
                    if( ! call_user_func( $filter, $c , $path ) ) {
                        echo "skip $path\n";
                        continue 2;
                    }
                }

                echo "set $c => $path\n";
                $map[ $c ] = $path;
            }
        }
        return $map;
    }

    public function generate($format = 'php')
    {
        // add extension filter (do not include extension classes )
        $this->addFilter( function($class) { 
            $ref = new \ReflectionClass($class); 
            return $ref->getFileName() ? true : false;
        });


        $classes = get_declared_interfaces();
        $classes = array_merge($classes, get_declared_classes() );
        $classes = $this->filterClasses( $classes );
        $classMap = $this->getClassFileMap( $classes );

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




