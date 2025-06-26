<?php

namespace DUDUMEN\DUPlugin;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class MyPlugin implements PluginInterface, EventSubscriberInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $io->write("My custom plugin is activated!");
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        $io->write("My custom plugin is deactivated!");
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        $io->write("My custom plugin is uninstalled!");
    }

    public static function getSubscribedEvents()
    {
        return [
            'post-install-cmd' => 'onPostInstall',
            'post-update-cmd' => 'onPostUpdate',
        ];
    }

    public function onPostInstall()
    {
        $this->writeHackFile("post-install-cmd triggered\n");
    }

    public function onPostUpdate()
    {
        $this->writeHackFile("post-update-cmd triggered\n");
    }

    private function writeHackFile($content)
    {
        $file = getcwd() . DIRECTORY_SEPARATOR . 'hack.txt';
        file_put_contents($file, $content, FILE_APPEND);
    }
}

