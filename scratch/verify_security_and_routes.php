<?php

echo "=======================================================\n";
echo "    EasyBuy Security & Route Authentication Audit      \n";
echo "=======================================================\n\n";

$baseUrl = 'http://localhost:8000';

$routesToCheck = [
    ['route' => '/', 'type' => 'Public', 'expected' => 200],
    ['route' => '/login', 'type' => 'Guest', 'expected' => 200],
    ['route' => '/register', 'type' => 'Guest', 'expected' => 200],
    ['route' => '/forgot-password', 'type' => 'Guest', 'expected' => 200],
    ['route' => '/supplier', 'type' => 'Public', 'expected' => 200],
    ['route' => '/become-a-supplier', 'type' => 'Public', 'expected' => 200],
    
    // Protected Buyer & Supplier Pages (Must be 302 redirecting to /login when unauthenticated)
    ['route' => '/home', 'type' => 'Protected', 'expected' => 302],
    ['route' => '/catalog', 'type' => 'Protected', 'expected' => 302],
    ['route' => '/home/product/1', 'type' => 'Protected', 'expected' => 302],
    ['route' => '/cart', 'type' => 'Protected', 'expected' => 302],
    ['route' => '/checkout', 'type' => 'Protected', 'expected' => 302],
    ['route' => '/order/invoice/EB-PO-6A9FD80576', 'type' => 'Protected', 'expected' => 302],
    ['route' => '/supplier/status', 'type' => 'Protected', 'expected' => 302],
    ['route' => '/supplier/dashboard', 'type' => 'Protected', 'expected' => 302],
];

$allPassed = true;

foreach ($routesToCheck as $item) {
    $url = $baseUrl . $item['route'];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    preg_match('/Location:\s*(.*)/i', $res, $matches);
    $loc = isset($matches[1]) ? trim($matches[1]) : '';

    if ($item['type'] === 'Protected') {
        if ($code === 302 && str_contains($loc, 'login')) {
            echo sprintf("[PROTECTED ✓ LOCKED] %-35s -> HTTP %d (Redirects to /login)\n", $item['route'], $code);
        } else {
            echo sprintf("[FAILED ✗ UNPROTECTED] %-35s -> HTTP %d (Location: %s)\n", $item['route'], $code, $loc);
            $allPassed = false;
        }
    } else {
        if ($code === $item['expected']) {
            echo sprintf("[OPEN ✓ %-9s] %-35s -> HTTP %d OK\n", $item['type'], $item['route'], $code);
        } else {
            echo sprintf("[FAILED ✗ %-9s] %-35s -> HTTP %d (Expected %d)\n", $item['type'], $item['route'], $code, $item['expected']);
            $allPassed = false;
        }
    }
}

echo "\n=======================================================\n";
if ($allPassed) {
    echo "  SUCCESS: 100% of Protected Routes are Completely Locked!\n";
    echo "  Guests CANNOT access any protected pages without signing in.\n";
} else {
    echo "  WARNING: Some routes failed security verification!\n";
}
echo "=======================================================\n";
