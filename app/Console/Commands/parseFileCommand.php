<?php

namespace App\Console\Commands;

use App\Services\ParseFile;
use Illuminate\Console\Command;

class parseFileCommand extends Command
{
    /**
     * @var ParseFile
     */
    protected $service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:digit-stat';

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
        $this->service = app(ParseFile::class);
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        $stat = $this->service->getDigitStat();
        if (empty($stat)) {
            print "Файл не содержит чисел\n";
        } else {
            foreach ($stat as $digit => $count) {
                printf("%d\t%d\n", $digit, $count);
            }
        }

        return 0;
    }
}
