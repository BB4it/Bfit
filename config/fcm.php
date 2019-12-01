<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAc_IxNb0:APA91bGvwlH-VMer-hO1wCZKjEXpYzKKSfd-uPGYuozuSqVNda5Y6BWJb4pHgm7Q0ekv8FP3bSLZ_Zdj_52aD3f319OwA44DJTk0S2xinabyQYOdnK5mCPKVlLWv6TrZGfAq3zllLA4x'),
        'sender_id' => env('FCM_SENDER_ID', '497984550333'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
