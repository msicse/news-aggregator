<?php

namespace App\Console\Commands;

use App\Services\GuardianApiService;
use App\Services\NewsApiService;
use App\Services\NewYorkTimesApiService;
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
    protected $description = 'Fetch latest articles from All news sources';

    protected $newsApiService;
    protected $guardianApiService;
    protected $newyorktimesApiService;

    public function __construct(NewsApiService $newsApiService, GuardianApiService $guardianApiService, NewYorkTimesApiService $newyorktimesApiService)
    {
        parent::__construct();
        $this->newsApiService = $newsApiService;
        $this->guardianApiService = $guardianApiService;
        $this->newyorktimesApiService = $newyorktimesApiService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->newsApiService->fetchArticles();
        $this->guardianApiService->fetchArticles();
        $this->newyorktimesApiService->fetchArticles();

        $this->info('Articles fetched successfully from all sources.');

    }
}
