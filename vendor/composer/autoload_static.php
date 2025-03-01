<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit90de56e5e5046cbc641391894bd8760c
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ricardo\\Blksolucoes\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ricardo\\Blksolucoes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit90de56e5e5046cbc641391894bd8760c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit90de56e5e5046cbc641391894bd8760c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit90de56e5e5046cbc641391894bd8760c::$classMap;

        }, null, ClassLoader::class);
    }
}
