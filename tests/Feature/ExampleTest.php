<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Проверяем, что тестовый файл (test.txt) отрабатывет удачно.
     *
     * @return void
     */
    public function testParseCommand()
    {
        $this->artisan('file:digit-stat')
            ->assertExitCode(0);
    }

    public function testParseIncorectFileCommand()
    {
        $this->artisan('file:digit-stat notFound.file')
            ->assertExitCode(1);
    }

}
