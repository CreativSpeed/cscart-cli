<?php

namespace App\Commands\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use LaravelZero\Framework\Commands\Command;

abstract class CopyFile extends Command
{
    protected $filesystem;

    abstract public function getFilename();

    abstract public function getSource();

    abstract public function getPath();

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $this->copyFile();
    }

    protected function copyFile()
    {
        $this->makeDir();

        File::copy(($this->getSource() . DIRECTORY_SEPARATOR . $this->getFilename()),
            $this->getPath() . DIRECTORY_SEPARATOR . $this->getFilename()
        );
    }

    protected function makeDir()
    {
        if (!$this->filesystem->isDirectory($this->getPath())) {
            return $this->filesystem->makeDirectory($this->getPath(), 0755, true);
        }
    }
}
