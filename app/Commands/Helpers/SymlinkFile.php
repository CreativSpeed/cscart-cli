<?php

namespace App\Commands\Helpers;

use Illuminate\Filesystem\Filesystem;
use LaravelZero\Framework\Commands\Command;

abstract class SymlinkFile extends Command
{
    abstract public function Linking();

    protected Addon $addon;

    protected Cart $cart;

    protected Filesystem $filesystem;

    protected $paths;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }


    public function handle()
    {
        $this->task('<fg=green>Setting up paths and files locations</>', function () {

            // Addon init & validateion
            $this->initAddon();

            // Cart init & validateion
            $this->initCart();
        });

        $this->task(sprintf('<fg=blue>Add-on [%s] links to "%s"</>', $this->addon->getId(), $this->cart->getPath('')), function () {

            // matching addon files
            $this->addon->files_match();

            // get Cart absolute path
            $cart_path = $this->cart->getPath();

            // get addon [target, link] array paths
            $this->paths = $this->addon->symlink($cart_path, $this->option('templates'));

            $this->Linking();
        });
    }

    protected function initAddon()
    {
        $this->addon = new Addon($this->argument('addon'));
        if (!$this->addon->validatePath()) {
            $this->info('<fg=red>please check your addon path & files location</>');
            return false;
        }
    }

    protected function initCart()
    {
        $this->cart = new Cart($this->argument('cart'));
        if (!$this->cart->validatePath()) {
            $this->info('<fg=red>please check your CsCart Installation path & files locations</>');
            return false;
        }
    }
}
