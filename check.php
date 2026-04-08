<?php

$file = '/app/data.json';
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$CHATWOOT_API  = "https://chat.kumara.co.id/api/v1";
$ACCOUNT_ID    = "2";

foreach ($data as &$item) {
    if (!$item['replied'] && time() - $item['time'] >= 120) {

        $conversation_id = $item['conversation_id'];

        $url = "$CHATWOOT_API/accounts/$ACCOUNT_ID/conversations/$conversationId/messages";


        $payload = [
            "content" => "Halo! Apakah masih membutuhkan bantuan?",
            "message_type" => "outgoing"
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "api_access_token: 3pPrUBv65AW8SiC5oyT9fWPY"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);

        $item['replied'] = true;
    }
}

file_put_contents($file, json_encode($data));