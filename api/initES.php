<?php
    include_once __DIR__ . '/lib.php';

    /**
     * @expamle curl -XPUT 'http://geocode1.essch.ru:9200/app/log/1?pretty' -d '{"url": "https://habr.com/post/280488/"}'
     *          curl -XGET 'http://geocode1.essch.ru:9200/app/log'
     */
    echo post("/app5", [
       "mappings" => [
           "log" => [
               "properties" => [
                   "date" => [
                       "type" => "date",
                   ]
               ]
           ]
       ]
    ]);