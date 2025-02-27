<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1717e95e67f0d3ffd4d1654439ac3b93
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1717e95e67f0d3ffd4d1654439ac3b93::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1717e95e67f0d3ffd4d1654439ac3b93::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1717e95e67f0d3ffd4d1654439ac3b93::$classMap;

        }, null, ClassLoader::class);
    }
}
