<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Article;

class NewYorkTimesApiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.newyorktimes.key');
    }

    public function fetchArticles()
    {
        $response = Http::get('https://api.nytimes.com/svc/topstories/v2/technology.json', [
            'api-key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $this->storeArticles($response->json('results'));
        }
    }

    protected function storeArticles(array $articles)
    {
        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['url' => $article['url']],
                [
                    'title' => $article['title'],
                    'description' => $article['abstract'],
                    'content' => $article['body'] ?? null,
                    'url' => $article['url'],
                    'image' => $article['multimedia'][0]['url'] ?? null,
                    'author' => $article['byline'] ?? null,
                    'source' => 'New York Times',
                    'category' => $article['section'],
                    'published_at' => toSqlDate($article['published_date'])
                ]
            );
        }
    }
}

?>
