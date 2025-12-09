<?php

namespace App\Services\Tripay;

use Illuminate\Support\Facades\Http;

class TripayClient
{
    protected string $baseUrl;
    protected string $merchantCode;
    protected string $apiKey;
    protected string $privateKey;

    public function __construct(
        string $baseUrl,
        string $merchantCode,
        string $apiKey,
        string $privateKey
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->merchantCode = $merchantCode;
        $this->apiKey = $apiKey;
        $this->privateKey = $privateKey;
    }

    /**
     * Make a request to Tripay API with a POST method
     */
    public function post(string $endpoint, array $payload): array
    {
        $payload['merchant_code'] = $this->merchantCode; // Include merchantCode in payload

        $response = Http::withToken($this->apiKey)
            ->asForm()
            ->post("{$this->baseUrl}{$endpoint}", $payload);

        return $response->json();
    }

    /**
     * Make a request to Tripay API with a GET method
     */
    public function get(string $endpoint, array $queryParams): array
    {
        $queryParams['merchant_code'] = $this->merchantCode; // Include merchantCode in queryParams

        $response = Http::withToken($this->apiKey)
            ->get("{$this->baseUrl}{$endpoint}", $queryParams);

        return $response->json();
    }

    public function getMerchantCode(): string
    {
        return $this->merchantCode;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }
}
