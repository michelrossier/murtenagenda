<?php

namespace App\Console\Commands;

use App\Services\EventScraperService;
use Illuminate\Console\Command;

class ScrapeEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape events from configured websites';

    /**
     * Execute the console command.
     */
    public function handle(EventScraperService $scraper)
    {
        $this->info('Starting event scraping...');
        $scraper->scrapeMurtenEvents();
        $this->info('Event scraping completed!');
    }
} 