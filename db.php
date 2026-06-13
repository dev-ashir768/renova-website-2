<?php
$envFile = dirname(__FILE__) . '/.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) continue;
        list($key, $val) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($val);
    }
}

$host = isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : 'localhost';
$name = isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : '';
$user = isset($_ENV['DB_USER']) ? $_ENV['DB_USER'] : '';
$pass = isset($_ENV['DB_PASS']) ? $_ENV['DB_PASS'] : '';

$pdo = new PDO(
    'mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8mb4',
    $user,
    $pass,
    array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    )
);
