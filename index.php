<?php
    // todo: фильрация частых запросов
    // todo: выбрать наиболее подходящие варианты
    // todo: обработка ошибок
    // todo: формат запроса
    /**
     * @example http://geocode.essch.ru/?query=Ивановка
     */
    file_put_contents(__DIR__ . '/log.txt', $_GET["query"] . "\n", FILE_APPEND);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://geocode-maps.yandex.ru/1.x/?format=json&results=6&geocode=" . $_GET["query"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $list = json_decode($output, true)["response"]["GeoObjectCollection"]["featureMember"];
    $list = array_column($list, "GeoObject");
    $list = array_column($list, "metaDataProperty");
    $list = array_column($list, "GeocoderMetaData");
    $list = array_column($list, "text");
    header('Content-Type: application/json');
    echo json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
