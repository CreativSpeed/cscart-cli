<?php

namespace App\Commands\Helpers;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class Addon
{
    private $id;

    private $path;

    private $filesystem;

    private $paths;

    public function __construct($path)
    {
        $this->path = $path;

        $this->id = $this->getAddonId();

        $this->filesystem = new Filesystem();
    }

    public function getPathRelative()
    {
        return $this->path;
    }

    public function getPath($path = DIRECTORY_SEPARATOR)
    {
        return realpath($this->path) . $path;
    }

    public function getId()
    {
        return $this->id;
    }

    public function validatePath()
    {
        return $this->filesystem->exists(
            join(DIRECTORY_SEPARATOR, [$this->getPath(), 'app', 'addons', $this->id, 'addon.xml'])
        );
    }

    public function structure()
    {
        $addon_structure = [
            // General files
            "app/addons/{$this->id}",
            "var/langs/**/addons/{$this->id}.po",
            "js/addons/{$this->id}",

            // Backend templates
            "design/backend/css/addons/{$this->id}",
            "design/backend/mail/templates/addons/{$this->id}",
            "design/backend/media/images/addons/{$this->id}",
            "design/backend/media/fonts/addons/{$this->id}",
            "design/backend/templates/addons/{$this->id}",

            // Theme Templates
            "var/themes_repository/**/css/addons/{$this->id}",
            "var/themes_repository/**/templates/addons/{$this->id}",
            "var/themes_repository/**/layouts/addons/{$this->id}",
            "var/themes_repository/**/mail/templates/addons/{$this->id}",
            "var/themes_repository/**/media/images/addons/{$this->id}",
            "var/themes_repository/**/media/images/logos/addons/{$this->id}",
        ];

        return $addon_structure;
    }

    public function files_match()
    {
        $paths_list = [];
        foreach ($this->structure() as $location) {
            $structure_path = $this->getPath() . $location;

            foreach (glob($structure_path) as $path) {
                $paths_list[] = substr_replace($path, '', 0, mb_strlen($this->getPath()));
            }
        }
        $this->paths = $paths_list;
    }

    public function getPathsToLink($cartPath, $isTemplate = false)
    {
        $paths_arr = [];
        foreach ($this->paths as $path) {
            if ($isTemplate && Str::contains($path, 'var/themes_repository/')) {
                $link_path = $cartPath . 'design/themes/' . mb_substr($path, mb_strlen('var/themes_repository/'));
            } else {
                $link_path = $cartPath . $path;
            }
        }
        return $paths_arr;
    }

    public function symlink($cartPath, $isTemplate = false)
    {
        chdir($this->path);
        $paths_arr = [];
        foreach ($this->paths as $path) {
            if ($isTemplate && Str::contains($path, 'var/themes_repository/')) {
                $link_path = $cartPath . 'design/themes/' . mb_substr($path, mb_strlen('var/themes_repository/'));
            } else {
                $link_path = $cartPath . $path;
            }
            array_push($paths_arr, ['target' => realpath($path), 'link' => $link_path]);
        }
        return $paths_arr;
    }

    public function path_type($path)
    {
        if (is_link($path)) {
            return 'link';
        } else if ($this->filesystem->isFile($path)) {
            return 'file';
        } else if ($this->filesystem->isDirectory($path)) {
            return 'directory';
        }
        return null;
    }

    private function getAddonId()
    {
        $schemeXml = glob("$this->path/*/*/*/addon.xml");
        if (is_array($schemeXml) && isset($schemeXml[0])) {
            $schemeXml = $schemeXml[0];
            $xmlString = file_get_contents($schemeXml);
            $xmlObject = simplexml_load_string($xmlString);
            $json = json_encode($xmlObject);
            $phpArray = json_decode($json, true);
            return $phpArray['id'];
        }
    }
}
