<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Utils\ChromosomeHelper;

class ExecutePythonModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'py:exec';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the python module that lives within this project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $pypath = base_path('python\ltgav1.0.py');
        $arg = 'Erika';
        $process = new Process("python $pypath");
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            $error = $process->getErrorOutput();
            $this->error("Nope, did not work: " . $error);
        }

        $output = $process->getOutput();
        $test = str_replace(['[', ']'], '', $output);
        $this->line($test);
        $chrom = explode(',', $test);
        $answer = ChromosomeHelper::toPosRole($chrom);
        $this->line($answer);
    }
}
