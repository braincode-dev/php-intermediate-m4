<?php
namespace App\Database\config;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;


class EntityManagerBuilder
{
    public static function build(): EntityManager
    {
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;

        $conf = Setup::createAnnotationMetadataConfiguration(
            [dirname(__DIR__, 1) . '/Models'],
            $isDevMode,
            $proxyDir,
            $cache,
            $useSimpleAnnotationReader,
        );

        $connect = [
            'dbname' => "mentoring",
            'user' => "root",
            'password' => "root",
            'host' => "localhost",
            'port' => "3306",
            'driver' => "pdo_mysql",
            'unix_socket' => "/Applications/MAMP/tmp/mysql/mysql.sock",
        ];

        return EntityManager::create($connect, $conf);
    }
}