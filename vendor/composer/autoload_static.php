<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite2b81a18c98f4e3c9023ba91ce7947d0
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite2b81a18c98f4e3c9023ba91ce7947d0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite2b81a18c98f4e3c9023ba91ce7947d0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite2b81a18c98f4e3c9023ba91ce7947d0::$classMap;

        }, null, ClassLoader::class);
    }
}
