<?php

namespace App\Console\Commands;

use App\Services\NewsApiService;
use Illuminate\Console\Command;

class FetchArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch latest articles from NewsAPI news sources';

    protected $newsApiService;

    public function __construct(NewsApiService $newsApiService)
    {
        parent::__construct();
        $this->newsApiService = $newsApiService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->newsApiService->fetchArticles();

        $this->info('Articles fetched successfully from all sources.');

    }
}
