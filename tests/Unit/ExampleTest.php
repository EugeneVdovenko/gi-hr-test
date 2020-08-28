<?php

namespace Tests\Unit;

use App\Services\FileService;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Если файл не существует
     * @throws FileNotFoundException
     */
    public function testFileNotFound()
    {
        $this->expectException(FileNotFoundException::class);
        /** @var FileService $fs */
        $fs = app(FileService::class);
        $fs->setFilename("notFondFile.txt");
        $fs->getLine()->current();

    }

    /**
     * Чтение строки из файла
     * @throws FileNotFoundException
     */
    public function testLineReturn()
    {
        /** @var FileService $fs */
        $fs = app(FileService::class);
        $this->assertIsString($fs->getLine()->current());

    }
}
