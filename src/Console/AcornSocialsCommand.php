<?php

namespace Itineris\AcornSocials\Console;

use Roots\Acorn\Console\Commands\Command;
use Itineris\AcornSocials\Facades\AcornSocials;

class AcornSocialsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acorn-socials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'My custom Acorn command.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info(
            AcornSocials::getQuote()
        );
    }
}
