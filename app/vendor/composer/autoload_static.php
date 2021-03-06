<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit262e146758aa35c11d37e252662c17c2
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPJasper\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPJasper\\' => 
        array (
            0 => __DIR__ . '/..' . '/geekcom/phpjasper/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit262e146758aa35c11d37e252662c17c2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit262e146758aa35c11d37e252662c17c2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit262e146758aa35c11d37e252662c17c2::$classMap;

        }, null, ClassLoader::class);
    }
}
