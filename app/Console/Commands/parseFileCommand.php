<?php

namespace App\Console\Commands;

use App\Services\FileService;
use App\Services\ParseService;
use Illuminate\Console\Command;

class parseFileCommand extends Command
{
    /**
     * @var ParseService
     */
    protected $service;

    /** @var FileService */
    protected $fileService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:digit-stat {filename? : Имя файла для разбора}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Подсчет количества цифр в содержимом файла';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->service = app(ParseService::class);
        $this->fileService = app(FileService::class);
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        try {
            $filename = $this->argument('filename');
            if ($filename) {
                $this->fileService->setFilename($filename);
            }

            $stat = $this->service->getDigitStat();
            if (empty($stat)) {
                $this->line("Файл не содержит чисел");
            } else {
                foreach ($stat as $digit => $count) {
                    $this->line(sprintf("%d\t%d", $digit, $count));
                }
            }

            return 0;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }
}
