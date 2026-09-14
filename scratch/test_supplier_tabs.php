<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Get a supplier user or create temporary auth context
$user = User::where('role', 'supplier')->first() ?? User::where('role', 'admin')->first();
if (!$user) {
    echo "No supplier/admin user found in DB\n";
    exit(1);
}

Auth::login($user);

$tabs = ['overview', 'orders', 'inventory', 'rfqs', 'payouts'];
$controller = app(\App\Http\Controllers\SupplierController::class);

foreach ($tabs as $tab) {
    $request = \Illuminate\Http\Request::create('/supplier/dashboard', 'GET', ['tab' => $tab]);
    try {
        $response = $controller->dashboard($request);
        $content = $response->render();
        echo "✓ Tab '{$tab}' rendered successfully (" . strlen($content) . " bytes)\n";
    } catch (\Throwable $e) {
        echo "✗ Error rendering tab '{$tab}': " . $e->getMessage() . " on line " . $e->getLine() . "\n";
    }
}
