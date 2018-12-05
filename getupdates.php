<?php

const TOKEN = '756593978:AAESkHJUvXWfM74tl-EIHnCU2H_n4DyjvPk';
const BASE_URL = 'https://api.telegram.org/bot' . TOKEN . '/';

$method = 'getUpdates';


function sendRequest ($method, $params = [])
{
    if(!empty($params)) {
        $url = BASE_URL . $method . '?' . http_build_query($params);
    } else {
        $url = BASE_URL . $method;
    }
    return json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
}

$updates = sendRequest ('getUpdates', []);
$time = date('H:m:s');

foreach ($updates['result'] as $update) {
    $chat_id = $update['message']['chat']['id'];
    // sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => '..Ответ пользователю...']);
    sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => $time]);
}


// $response = file_get_contents($url);
// Параметры запроса : offset - id обновления с которого начинать получать обновления
//      limit - кол-во обновлений для получения за 1 раз (max=100)


