<?php

$data = json_decode(file_get_contents("php://input"), true);

// only incoming messages
if (!isset($data['message_type']) || $data['message_type'] !== 'incoming') {
    exit;
}

$file = '/app/data.json';

$stored = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// overwrite if same conversation (reset timer)
$found = false;

foreach ($stored as &$item) {
    if ($item['conversation_id'] == $data['conversation']['id']) {
        $item['time'] = time();
        $item['replied'] = false;
        $found = true;
        break;
    }
}

if (!$found) {
    $stored[] = [
        'conversation_id' => $data['conversation']['id'],
        'time' => time(),
        'replied' => false
    ];
}

file_put_contents($file, json_encode($stored));