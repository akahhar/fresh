<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitab9b4005f899852457ae530687ea1c17
{
    public static $prefixLengthsPsr4 = array(
        'S' =>
            array(
                'Stripe\\' => 7,
            ),
    );

    public static $prefixDirsPsr4 = array(
        'Stripe\\' =>
            array(
                0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
            ),
    );

    public static $classMap = array(
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitab9b4005f899852457ae530687ea1c17::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitab9b4005f899852457ae530687ea1c17::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitab9b4005f899852457ae530687ea1c17::$classMap;

        }, null, ClassLoader::class);
    }
}
