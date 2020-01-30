<?php

return [
    'commission' => [
        'minimum_cash_out_legal_person' => 0.50,
        'max_cash_in' => 5.00,
        'commission_fees_percentage' => [
            'cash_in' => 0.03,
            'cash_out' => 0.30,
        ]
    ],
    'forex' => [
        'default_currency' => 'EUR',
        'EUR' => [
            'USD' => 1.1497,
            'JPY' => 129.53,
        ]
        ]
];
