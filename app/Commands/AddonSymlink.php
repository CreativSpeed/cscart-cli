<?php

namespace App\Commands;

use App\Commands\Helpers\Cart;
use App\Commands\Helpers\Addon;
use App\Commands\Helpers\SymlinkFile;
use Illuminate\Filesystem\Filesystem;

class AddonSymlink extends SymlinkFile
{
	/**
	 * The signature of the command.
	 *
	 * @var string
	 */ protected $signature = 'addon:link
							{ addon : path to Add-on directory },
							{ cart : path to Cs-cart/multivendor installation directory },
							{ --t|templates : take the add-on templates from "var/themes_repository"}';

	/**
	 * The description of the command.
	 *
	 * @var string
	 */
	protected $description = 'symbolik linking cs-cart Add-on to cs-cart installation for better and easy development';

	protected Addon $addon;

	protected Cart $cart;

	protected Filesystem $filesystem;

	public function Linking()
	{
		foreach ($this->paths as $path) {
			($this->paths);
			$target = $path['target'];
			$link = $path['link'];
			$link_type = $this->addon->path_type($link);

			if ($link_type == 'file' || $link_type == 'directory') {
				$override = $this->confirm(sprintf('<fg=red>%s "%s" already exists. Overwrite?</> ', ucwords($link_type), $link), false);
				if (!$override) {
					continue;
				}
				if ($link_type == 'directory') {
					$this->filesystem->deleteDirectory($link);
				} else {
					$this->filesystem->delete($link);
				}
			} else {
				$this->filesystem->delete($link);
			}
			$this->filesystem->delete($link);
			$this->filesystem->link($target, $link);
			$this->newLine();
			$this->info(sprintf('<fg=green>Creating symlink for %s... OK</>',  $target));
		}
	}
}
