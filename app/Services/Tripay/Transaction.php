<?php

namespace App\Services\Tripay;

class Transaction
{
    protected TripayClient $tripayClient;

    public function __construct(TripayClient $tripayClient)
    {
        $this->tripayClient = $tripayClient;
    }

    /**
     * Create a transaction with given payload
     */
    public function create(array $payload): array
    {
        $payload['signature'] = $this->generateSignature(
            $payload['merchant_ref'],
            $payload['amount']
        );

        return $this->tripayClient->post('/transaction/create', $payload);
    }

    /**
     * Check transaction status by reference
     */
    public function checkStatus(string $reference): array
    {
        return $this->tripayClient->get('/transaction/check-status', [
            'reference' => $reference,
        ]);
    }

    /**
     * Get transaction details by reference
     */
    public function getDetails(string $reference): array
    {
        return $this->tripayClient->get('/transaction/detail', [
            'reference' => $reference,
        ]);
    }

    /**
     * Generate HMAC SHA-256 signature
     */
    protected function generateSignature(string $merchantRef, float|int $amount): string
    {
        $merchantCode = $this->tripayClient->getMerchantCode();
        $privateKey = $this->tripayClient->getPrivateKey();

        return hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey);
    }
}
