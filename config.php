<?php
/**
 * Config file for Gojek Auto Register
 * Updated 2025
 */

// API Configuration
const API_BASE_URL = 'https://api.gojekapi.com';
const API_TIMEOUT = 30;

// Default Headers
const DEFAULT_HEADERS = [
    'Host: api.gojekapi.com',
    'User-Agent: okhttp/3.12.12',
    'Accept: application/json',
    'Accept-Language: en-ID',
    'Content-Type: application/json; charset=UTF-8',
    'X-AppVersion: 3.48.2',
    'X-User-Locale: en_ID',
    'Connection: keep-alive'
];

// Voucher Codes (Update this with latest promo codes)
const VOUCHER_CODES = [
    'GOFOOD2024DEC' => 'GoFood Discount December',
    'GORIDE2024DEC' => 'GoRide Discount December',
    'GOPAY2024' => 'GoPay Cashback',
    'FRESHFOOD2024' => 'Fresh Food Promo',
    'GOKONSUL2024' => 'GoKonsultasi Promo',
    'COBAINGOJEK' => 'Coba In Gojek',
    'AYOCOBAGOJEK' => 'Ayo Coba Gojek'
];

// Settings
const SETTINGS = [
    'max_attempts' => 3,
    'otp_timeout' => 900,  // 15 minutes in seconds
    'request_delay' => 1,   // delay between requests in seconds
    'log_file' => 'registration_log.txt',
    'debug_file' => 'debug.log',
    'enable_color' => true,
    'enable_logging' => true
];

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
