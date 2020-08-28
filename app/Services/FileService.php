<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /** @var string */
    protected $filename = "test.txt";

    /** @var resource */
    protected $file;

    /**
     * Если нуно сменить файл
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Пробуем открыть файл
     * @return resource
     * @throws FileNotFoundException
     */
    protected function getFile()
    {
        if (!is_resource($this->file)) {
            $this->file = Storage::disk('local')->readStream($this->filename);
        }

        return $this->file;
    }

    /**
     * Закрытие файла
     */
    protected function closeFile()
    {
        if (is_resource($this->file)) {
            fclose($this->file);
        }
    }

    /**
     * Чтение файла построчно
     * @return bool|\Generator
     * @throws FileNotFoundException
     */
    public function getLine()
    {
        while (!feof($this->getFile())) {
            yield  fgets($this->file);
        }

        $this->closeFile();
        return false;
    }
}
