<?php

namespace App\Http\Integrations\Marketstack;

use GuzzleHttp\Client;

/**
 * Marketstack connector
 *
 * @filesource
 */
final readonly class MarketstackConnector
{
    /**
     * @var client
     */
    private Client $client;

    /**
     * @var endpointAllowedList
     */
    private array $endpointAllowedList;

    /**
     * Instantiate a new MarketstackConnector instance.
     *
     * @param Client $client Client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->endpointAllowedList = ['currencies', 'eod', 'exchanges', 'intraday', 'tickers', 'timezones'];
    }

    /**
     * Get query string.
     *
     * @param array $queryStringAry Query string array
     *
     * @return array query string array
     */
    private function getQueryString(array $queryStringAry = []): array
    {
        return array_merge($queryStringAry, [
            'access_key'  => config('services.marketstack.api_access_key'),
        ]);
    }

    /**
     * Make Http Request
     *
     * @param array $queryStringAry Query string array
     *
     * @return mixed
     */
    public function makeHttpRequest(string $endpoint, array $queryStringAry = [])
    {
        if (!in_array($endpoint, $this->endpointAllowedList)) {
            return false;
        }
        $response = $this->client->request('GET', config('services.marketstack.base_url') . $endpoint, [
            'query' => $this->getQueryString($queryStringAry),
            'curl' => [
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS      => 3,
                CURLOPT_POSTREDIR      => 3,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSLVERSION     => CURL_SSLVERSION_TLSv1_2,
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }
}
