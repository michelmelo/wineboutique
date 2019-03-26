<?php

return [
    'nuvei' => [
        'gateway' => env('NUVEI_GATEWAY'),	
        'terminalId' => env('NUVEI_TERMINAL_ID'),
        'currency' => env('NUVEI_CURRENCY'),
        'secret' => env('NUVEI_SECRET'),
        'testAccount' => env('NUVEI_TEST_ACCOUNT') == "true",
        'receiptPageURL' => env('NUVEI_RECEIPT_PAGE_URL')
    ]
];