<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=======================================================\n";
echo "   Testing EasyBuy Route Security & Auth Protection    \n";
echo "=======================================================\n\n";

$protectedRoutes = [
    '/home',
    '/catalog',
    '/home/product/1',
    '/cart',
    '/checkout',
    '/order/invoice/EB-PO-6A9FD80576',
    '/supplier/status',
    '/supplier/dashboard',
];

echo "--- 1. Testing Unauthenticated (Guest) Access to Protected Routes ---\n";
Auth::logout();

foreach ($protectedRoutes as $route) {
    $request = Request::create($route, 'GET');
    $response = $kernel->handle($request);
    $status = $response->getStatusCode();
    $target = $response->headers->get('Location') ?? 'No redirect';
    
    if ($status === 302 && str_contains($target, 'login')) {
        echo "[GUEST BLOCKED] {$route} -> Status {$status} Redirects to Login ✓\n";
    } elseif ($status === 200) {
        echo "[WARNING: PUBLIC] {$route} -> Status 200 (Accessible without login!)\n";
    } else {
        echo "[INFO] {$route} -> Status {$status} Target: {$target}\n";
    }
}

echo "\n--- 2. Testing Authenticated User Access to Protected Routes ---\n";
$buyer = User::where('email', 'buyer@cloudflow.io')->first() ?: User::first();
Auth::login($buyer);

foreach ($protectedRoutes as $route) {
    $request = Request::create($route, 'GET');
    $response = $kernel->handle($request);
    $status = $response->getStatusCode();
    
    if ($status === 200) {
        echo "[AUTH GRANTED] {$route} -> Status 200 OK ✓\n";
    } else {
        echo "[AUTH FAILED] {$route} -> Status {$status}\n";
    }
}

echo "\n=======================================================\n";
