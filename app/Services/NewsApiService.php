<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Article;

class NewsApiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.newsapi.key');
    }

    public function fetchArticles()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => $this->apiKey,
            'country' => 'us',
            'category' => 'technology'
        ]);

        if ($response->successful()) {
            $this->storeArticles($response->json('articles'));
        }
    }

    protected function storeArticles(array $articles)
    {
        foreach ($articles as $article) {

            $dateTime = new \DateTime($article['publishedAt']);

            $mysqlDate = $dateTime->format('Y-m-d H:i:s');

            Article::updateOrCreate(
                ['url' => $article['url']],
                [
                    'title' => $article['title'],
                    'description' => $article['description'],
                    'content' => $article['content'],
                    'url' => $article['url'],
                    'image' => $article['urlToImage'],
                    'author' => $article['author'],
                    'source' => $article['source']['name'],
                    'category' => 'technology',
                    'published_at' => toSqlDate($article['publishedAt'])
                ]
            );

        }
    }
}

?>
