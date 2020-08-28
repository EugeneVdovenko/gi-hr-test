<?php

namespace Tests\Unit;

use App\Services\FileService;
use Exception;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Если файл не существует
     * @throws Exception
     */
    public function testFileNotFound()
    {
        $this->expectException(Exception::class);
        /** @var FileService $fs */
        $fs = app(FileService::class);
        $fs->setFilename("notFondFile.txt");
        $fs->getLine()->current();

    }

    /**
     * Чтение строки из файла
     * @throws Exception
     */
    public function testLineReturn()
    {
        /** @var FileService $fs */
        $fs = app(FileService::class);
        $this->assertIsString($fs->getLine()->current());

    }
}
