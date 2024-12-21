<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit272549cc0a7c6636f33d51652960e746
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fakerphp/faker/src',
        ),
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit272549cc0a7c6636f33d51652960e746::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit272549cc0a7c6636f33d51652960e746::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit272549cc0a7c6636f33d51652960e746::$classMap;

        }, null, ClassLoader::class);
    }
}