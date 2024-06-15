<?php
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, 'https://thaibestfood.com/wp-json/wc/v3/users'); // URL ที่ต้องการใช้งาน
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // ตั้งค่าให้ cURL คืนค่าผลลัพธ์เป็น string แทนการปริ้นออกหน้าจอ

// Execute cURL session
$response = curl_exec($ch);

// Check for cURL errors
if(curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Handle $response as needed
var_dump($response);
