<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit28fde60db77ea46ec3cdfc763852f0fb
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit28fde60db77ea46ec3cdfc763852f0fb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit28fde60db77ea46ec3cdfc763852f0fb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit28fde60db77ea46ec3cdfc763852f0fb::$classMap;

        }, null, ClassLoader::class);
    }
}