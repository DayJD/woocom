<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class WooCommerceService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('WOOCOMMERCE_URL'),
            'auth' => [
                env('WOOCOMMERCE_CONSUMER_KEY'),
                env('WOOCOMMERCE_CONSUMER_SECRET'),
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    

    public function getProducts($page = 1, $perPage = 10)
    {
        $response = $this->client->request('GET', '/wp-json/wc/v3/products', [
            'query' => [
                'page' => $page,
                'per_page' => $perPage,
            ]
        ]);

        $products = json_decode($response->getBody()->getContents());

        $totalItems = $response->getHeaderLine('X-WP-Total');
        $totalPages = $response->getHeaderLine('X-WP-TotalPages');

        $paginator = new LengthAwarePaginator(
            $products,
            $totalItems,
            $perPage,
            $page,
            [
                'path' => url()->current(),
                'pageName' => 'page',
            ]
        );
        return $paginator;
    }

    public function getAllUsers()
    {
        $response = $this->client->request('GET', '/wp-json/wc/v3/users');
        $users = json_decode($response->getBody()->getContents(), true);
        return $users;
    }
}
