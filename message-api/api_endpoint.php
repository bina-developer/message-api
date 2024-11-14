<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // cheack for data exist
    if (isset($input['message']) && !empty($input['message'])) {
        $message = $input['message'];
        // random 1 between 10
        $randomNumber = rand(1, 10);
        $response = [
            'status' => 'success',
            'input_message' => $message,
            'random_number' => $randomNumber
        ];
    }else{
        $response = [
            'status' => 'error',
            'message' => 'لطفاً یک پیام ارسال کنید'
        ];
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}else{
    echo json_encode([
        'status' => 'error',
        'message' => 'فقط درخواست‌های POST پذیرفته می‌شوند'
    ], JSON_UNESCAPED_UNICODE);
}