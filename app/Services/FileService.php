<?php

namespace App\Services;

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
     * @throws \Exception
     */
    protected function getFile()
    {
        if (!is_resource($this->file)) {
            if (!is_file($this->filename) || !is_readable($this->filename)) {
                throw new \Exception(sprintf('File %s not found', $this->filename));
            }

            $this->file = fopen($this->filename, 'rb');
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
     * @throws \Exception
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
