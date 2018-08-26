<?php
    include_once __DIR__ . '/lib.php';

    /**
     * @expamle curl -XPUT 'http://geocode1.essch.ru:9200/app/log/1?pretty' -d '{"url": "https://habr.com/post/280488/"}'
                curl -XGET 'http://geocode1.essch.ru:9200/app/log'
     */
//     echo post("/app5", [
//        "mappings" => [
//            "log" => [
//                "properties" => [
//                    "date" => [
//                        "type" => "date",
//                    ]
//                ]
//            ]
//        ]
//     ]);

    // show http://geocode1.essch.ru:9200/app5/log/_search?pretty
     echo post("/app5/log/" .  mktime(), [
        "query" => $_GET["query"],
        "date" => date("Y-m-d"),
     ]);

    // todo: фильрация частых запросов
    // todo: обработка ошибок
    /**
     * @example http://geocode.essch.ru/?query=Ивановка
     */
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
