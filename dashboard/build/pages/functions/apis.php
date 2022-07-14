<?php

$url = 'https://newsapi.org/v2/everything?q=tesla&from=2022-06-09&sortBy=publishedAt&apiKey=1ccfeaffc3364ac2bbcaa2022bf1c96e';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
$result = curl_exec($ch);

print_r($result);
curl_close($ch);