<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait DataSourceApis
{

  public function apiRequest($requestUrl, $method, $headers = [], $queryParams = [], $data = [])
  {

    $client = new Client([
      'base_uri' => $requestUrl,
      'verify' => false,
    ]);

    $headers = [
      'cache-control' => 'no-cache',
      'content-type'  => 'application/json',
    ];

    if (method_exists($this, 'required_authorization')) {
      $this->required_authorization($headers);
    }

    $response = $client->request($method, $requestUrl, [
      'query' => $queryParams,
      'json' => $data,
      'headers' => $headers,
    ]);

    $response = json_decode($response->getBody()->getContents());

    if (isset($response->error)) {
      throw new \Exception("Failed: {$response->error}");
    }

    return $response;
  }

  public function required_authorization(&$headers)
  {
    $accessToken = $this->access_token();
    if ($accessToken)
      $headers['Authorization'] = 'Basic ' . base64_encode(":" . $accessToken);
  }

  public function access_token()
  {
    return "";
  }
}
