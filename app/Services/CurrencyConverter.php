<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apiKey;

    protected $baseUrl = 'https://api.freecurrencyapi.com/v1/';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function convert(string $from, string $to, float $amount = 1): float
    {
        $q = "{$from}_{$to}";
        $response = Http::baseUrl($this->baseUrl)
            ->get('/convert', [
                'q' => $q,
                'compact' => 'y',
                'apiKey' => $this->apiKey,
            ]);

        $result = $response->json();
//dd($result);
        return $result[$q]['val'] * $amount;
    }
}