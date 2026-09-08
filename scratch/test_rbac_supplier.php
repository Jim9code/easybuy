<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=======================================================\n";
echo "EASYBUY RBAC & SUPPLIER HUB VISIBILITY TEST\n";
echo "=======================================================\n\n";

$buyer = User::where('email', 'jethwork4@gmail.com')->first();
$supplier = User::where('email', 'rinfwang4@gmail.com')->first();

if (!$buyer || !$supplier) {
    echo "❌ Missing users: buyer or supplier not found in DB\n";
    exit(1);
}

echo "1. Testing Buyer (jethwork4@gmail.com | Role: {$buyer->role})\n";

// A. Test Buyer on /home
Auth::setUser($buyer);
$reqHome = \Illuminate\Http\Request::create('/home', 'GET');
$reqHome->setUserResolver(function() use ($buyer) { return $buyer; });
$resHome = $app->handle($reqHome);
$contentHome = $resHome->getContent();

if (strpos($contentHome, 'Supplier Hub') !== false) {
    echo "❌ Buyer /home contains 'Supplier Hub'!\n";
} else {
    echo "✅ Buyer /home: Clean! No 'Supplier Hub' visible in navigation or sidebar.\n";
}

if (strpos($contentHome, 'Supplier Portal') !== false) {
    echo "❌ Buyer /home contains 'Supplier Portal'!\n";
} else {
    echo "✅ Buyer /home: Clean! No 'Supplier Portal' card visible.\n";
}

// B. Test Buyer requesting /supplier/dashboard
$reqSupDash = \Illuminate\Http\Request::create('/supplier/dashboard', 'GET');
$reqSupDash->setUserResolver(function() use ($buyer) { return $buyer; });
$resSupDash = $app->handle($reqSupDash);

if ($resSupDash->isRedirection()) {
    $target = $resSupDash->headers->get('Location');
    echo "✅ Buyer /supplier/dashboard redirected properly (Status {$resSupDash->getStatusCode()} -> {$target})\n";
} else {
    echo "❌ Buyer /supplier/dashboard was NOT redirected (Status {$resSupDash->getStatusCode()})\n";
}

// C. Test Buyer requesting /supplier/status
$reqSupStatus = \Illuminate\Http\Request::create('/supplier/status', 'GET');
$reqSupStatus->setUserResolver(function() use ($buyer) { return $buyer; });
$resSupStatus = $app->handle($reqSupStatus);

if ($resSupStatus->isRedirection()) {
    $target = $resSupStatus->headers->get('Location');
    echo "✅ Buyer /supplier/status redirected properly (Status {$resSupStatus->getStatusCode()} -> {$target})\n";
} else {
    echo "❌ Buyer /supplier/status was NOT redirected (Status {$resSupStatus->getStatusCode()})\n";
}

echo "\n2. Testing Supplier (rinfwang4@gmail.com | Role: {$supplier->role})\n";

// A. Test Supplier on /home
Auth::setUser($supplier);
$reqSupHome = \Illuminate\Http\Request::create('/home', 'GET');
$reqSupHome->setUserResolver(function() use ($supplier) { return $supplier; });
$resSupHome = $app->handle($reqSupHome);
$contentSupHome = $resSupHome->getContent();

if (strpos($contentSupHome, 'Supplier Hub') !== false) {
    echo "✅ Supplier /home: 'Supplier Hub' properly visible for supplier!\n";
} else {
    echo "❌ Supplier /home: 'Supplier Hub' missing for supplier!\n";
}

// B. Test Supplier on /supplier/dashboard
$reqSupDashAllowed = \Illuminate\Http\Request::create('/supplier/dashboard', 'GET');
$reqSupDashAllowed->setUserResolver(function() use ($supplier) { return $supplier; });
$resSupDashAllowed = $app->handle($reqSupDashAllowed);

if ($resSupDashAllowed->getStatusCode() === 200) {
    echo "✅ Supplier /supplier/dashboard: 200 OK (Full workspace accessible)\n";
} else {
    echo "❌ Supplier /supplier/dashboard returned status {$resSupDashAllowed->getStatusCode()}\n";
}

// C. Test Supplier on /supplier/status
$reqSupStatusAllowed = \Illuminate\Http\Request::create('/supplier/status', 'GET');
$reqSupStatusAllowed->setUserResolver(function() use ($supplier) { return $supplier; });
$resSupStatusAllowed = $app->handle($reqSupStatusAllowed);

if ($resSupStatusAllowed->getStatusCode() === 200) {
    echo "✅ Supplier /supplier/status: 200 OK (Application status accessible)\n";
} else {
    echo "❌ Supplier /supplier/status returned status {$resSupStatusAllowed->getStatusCode()}\n";
}

echo "\n=======================================================\n";
echo "TEST SUITE COMPLETE!\n";
echo "=======================================================\n";
