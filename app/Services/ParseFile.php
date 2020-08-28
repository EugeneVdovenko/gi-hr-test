<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ParseFile
{
    /**
     * @param string $filename
     * @return resource
     * @throws \Exception
     */
    protected function getFile($filename = 'test.txt')
    {
        if (! $file = fopen($filename, 'rb')) {
           throw new \Exception(sprintf('File %s not found', $filename));
        }
        return $file;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getDigitStat()
    {
        $result = new Collection();

        $file = $this->getFile();
        while ($line = fgets($file)) {
            preg_match_all('/-?\d+/', $line, $matches);
            foreach (Arr::get($matches, 0, []) as $key) {
                $idx = intval($key);
                $result->put($idx, ($result->get($idx, 0) + 1));
            }
        }

        return $result->sortKeys()->toArray();
    }
}
