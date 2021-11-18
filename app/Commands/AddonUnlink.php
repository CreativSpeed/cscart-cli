<?php

namespace App\Commands;

use App\Commands\Helpers\Cart;
use App\Commands\Helpers\Addon;
use App\Commands\Helpers\SymlinkFile;
use Illuminate\Filesystem\Filesystem;

class AddonUnlink extends SymlinkFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'addon:unlink
							{ addon : path to Add-on directory },
							{ cart : path to Cs-cart/multivendor installation directory },
                            { --t|templates : take the add-on templates from "var/themes_repository"}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'delete symbolik linking cs-cart Add-on tfrom cs-cart installation';

    protected Addon $addon;

    protected Cart $cart;

    protected Filesystem $filesystem;

    public function Linking()
    {
        foreach ($this->paths as $path) {
            $link = $path['link'];
            $link_type = $this->addon->path_type($link);
            if ($link_type == 'link') {
                unlink($link);
                $this->newLine();
                $this->info(sprintf('<fg=green>link removed from %s... OK</>',  $link));
            }
        }
    }
}
