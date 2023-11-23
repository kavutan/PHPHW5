<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['url'])) {
        require 'vendor/autoload.php';

        $client = new Client();
        $url = $_POST['url'];

        try {
            $response = $client->get($url);
            $html = $response->getBody()->getContents();
            echo $html;
        } catch (ClientException $e) {
            
            $statusCode = $e->getResponse()->getStatusCode();
            if ($statusCode === 403) {
                echo "Неможливо виконати запит. Сервер відмовив у доступі (403 Forbidden).";
            } else {
                echo "Неможливо виконати запит. Помилка: " . $e->getMessage();
            }
        }
    } else {
        echo "Введіть URL-адресу!";
    }
}
?>

