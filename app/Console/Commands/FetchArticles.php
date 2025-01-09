<?php

namespace App\Console\Commands;

use App\Services\GuardianApiService;
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
    protected $guardianApiService;

    public function __construct(NewsApiService $newsApiService, GuardianApiService $guardianApiService)
    {
        parent::__construct();
        $this->newsApiService = $newsApiService;
        $this->guardianApiService = $guardianApiService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->newsApiService->fetchArticles();
        $this->guardianApiService->fetchArticles();

        $this->info('Articles fetched successfully from all sources.');

    }
}
