<?php
     // @example post("/app3/log/3", []);
     function post(string $url, array $data) {
        $es_host = explode("=",trim(shell_exec("env | grep ES_HOST=")))[1];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $es_host . $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
           'Content-Type: application/json',
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
     }
