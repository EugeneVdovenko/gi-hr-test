<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ParseService
{
    /** @var FileService */
    protected $fileService;

    /**
     * ParseService constructor.
     */
    public function __construct()
    {
        $this->fileService = app(FileService::class);
    }

    /**
     * Извлекаем из файла целые положительные числа и считаем количество повторений
     * @return array
     * @throws \Exception
     */
    public function getDigitStat()
    {
        $result = new Collection();

        foreach ($this->fileService->getLine() as $line) {
            preg_match_all('/-?\d+/', $line, $matches);
            foreach (Arr::get($matches, 0, []) as $key) {
                $idx = intval($key);
                if ($idx >= 0) {
                    $result->put($idx, ($result->get($idx, 0) + 1));
                }

            }
        }

        return $result->sortDesc()->toArray();
    }
}
