<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitde2d110af980e5de1635b78ba9f454cf
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sorethea\\Ev\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sorethea\\Ev\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitde2d110af980e5de1635b78ba9f454cf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitde2d110af980e5de1635b78ba9f454cf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitde2d110af980e5de1635b78ba9f454cf::$classMap;

        }, null, ClassLoader::class);
    }
}