<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit67ad9895938f7207dcd2841afe4b6e78
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Paddle' => 
            array (
                0 => __DIR__ . '/..' . '/rayatomsk/paddle-api/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit67ad9895938f7207dcd2841afe4b6e78::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
