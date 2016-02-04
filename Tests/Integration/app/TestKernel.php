<?php

namespace  CodeWave\MysqlDumperCommandBundle\Tests\Integration\app;

use CodeWave\MysqlDumperCommandBundle\CodeWaveMysqlDumperCommandBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;

class TestKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
        new FrameworkBundle(),
        new TwigBundle(),
        new DoctrineBundle(),
        new CodeWaveMysqlDumperCommandBundle(),
    );
    }

    public function getCacheDir()
    {
        return parent::getCacheDir() . '/cache';
    }

    public function getLogDir()
    {
        return parent::getLogDir() . '/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }
}