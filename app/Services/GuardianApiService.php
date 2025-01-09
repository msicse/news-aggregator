<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Article;

class GuardianApiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.guardianapi.key');
    }

    public function fetchArticles()
    {
        $response = Http::get('https://content.guardianapis.com/search', [
            'api-key' => $this->apiKey,
            'section' => 'technology',
            'show-fields' => 'all'
        ]);

        if ($response->successful()) {
            $this->storeArticles($response->json('response')['results']);
        }
    }

    protected function storeArticles(array $articles)
    {
        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['url' => $article['webUrl']],
                [
                    'title' => $article['webTitle'],
                    'description' => $article['fields']['trailText'] ?? null,
                    'content' => $article['fields']['body'] ?? null,
                    'url' => $article['webUrl'],
                    'image' => $article['fields']['thumbnail'] ?? null,
                    'author' => $article['fields']['byline'] ?? null,
                    'source' => 'The Guardian',
                    'category' => 'technology',
                    'published_at' => toSqlDate($article['webPublicationDate'])
                ]
            );
        }
    }
}
?>