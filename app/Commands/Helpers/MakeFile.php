<?php

namespace App\Commands\Helpers;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use LaravelZero\Framework\Commands\Command;

abstract class MakeFile extends Command
{
    abstract public function getStub();

    abstract public function getFilename();

    abstract public function getPath();

    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }


    public function handle()
    {
        $this->makeFile();
    }

    protected function makeFile()
    {
        $this->makeDir();

        return $this->filesystem->put($this->getPath() . '/' . $this->getFilename(), $this->getReplaceContent());
    }

    protected function makeDir()
    {
        if (!$this->filesystem->isDirectory($this->getPath())) {
            return $this->filesystem->makeDirectory($this->getPath(), 0755, true);
        }
    }

    protected function getContent()
    {
        return $this->filesystem->get($this->getStub());
    }

    protected function getReplaceContent()
    {
        $content = $this->getContent();
        $content = str_replace(
            $this->stringsToReplace(),
            $this->replaceContent(),
            $content
        );
        return $content;
    }

    protected function stringsToReplace()
    {
        return [
            'LowerCaseAddonName',
            'StudlyAddonName',
            'AddonDescription',
            'LanguageCode',
            'LanguageName',
            'LangaugeLocalName',
        ];
    }

    protected function replaceContent()
    {
        $addonName = cache('addon_name');
        $addonDescription = cache('addon_description');
        $local = cache('lang_code') ? cache('lang_code') : 'en';
        $langCode = app('data')->getCode($local);
        $langName = app('data')->getLangName($local);
        $langLocalName = app('data')->getLangLocal($local);

        return [
            strtolower($addonName),
            Str::studly($addonName),
            $addonDescription,
            $langCode,
            $langName,
            $langLocalName,
        ];
    }
}
