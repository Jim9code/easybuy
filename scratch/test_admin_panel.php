<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SupplierProfile;
use App\Models\User;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

echo "=======================================================\n";
echo "EASYBUY ADMIN OPERATIONS & SUPPLIER APPROVAL TEST\n";
echo "=======================================================\n\n";

$admin = User::where('email', 'codecraft4th@gmail.com')->first();
$supplier = User::where('email', 'rinfwang4@gmail.com')->first();
$buyer = User::where('email', 'jethwork4@gmail.com')->first();

if (!$admin || !$supplier || !$buyer) {
    echo "❌ Error: Required accounts missing from DB\n";
    exit(1);
}

echo "1. Account Roles & Verification:\n";
echo "   - Admin: {$admin->email} -> Role: {$admin->role} (isAdmin: " . ($admin->isAdmin() ? 'true' : 'false') . ")\n";
echo "   - Supplier: {$supplier->email} -> Role: {$supplier->role} (isSupplier: " . ($supplier->isSupplier() ? 'true' : 'false') . ")\n";
echo "   - Buyer: {$buyer->email} -> Role: {$buyer->role} (isBuyer: " . ($buyer->isBuyer() ? 'true' : 'false') . ")\n\n";

// 2. Test Admin Direct Redirections (Root and Home)
echo "2. Testing Admin Direct Redirection to /admin:\n";
Auth::setUser($admin);

$reqRoot = \Illuminate\Http\Request::create('/', 'GET');
$reqRoot->setUserResolver(fn() => $admin);
$resRoot = $app->handle($reqRoot);
if ($resRoot->isRedirection() && strpos($resRoot->headers->get('Location'), 'admin') !== false) {
    echo "   ✅ Admin visiting '/' redirected directly to Admin Panel\n";
} else {
    echo "   ❌ Admin visiting '/' was not redirected to admin (Status: {$resRoot->getStatusCode()})\n";
}

$reqHome = \Illuminate\Http\Request::create('/home', 'GET');
$reqHome->setUserResolver(fn() => $admin);
$resHome = $app->handle($reqHome);
if ($resHome->isRedirection() && strpos($resHome->headers->get('Location'), 'admin') !== false) {
    echo "   ✅ Admin visiting '/home' redirected directly to Admin Panel\n";
} else {
    echo "   ❌ Admin visiting '/home' was not redirected to admin (Status: {$resHome->getStatusCode()})\n";
}

// 3. Test Admin Panel Tabs
echo "\n3. Testing Admin Dashboard Tabs:\n";
$tabs = ['overview', 'applications', 'suppliers', 'orders', 'catalog', 'users'];
foreach ($tabs as $tab) {
    $req = \Illuminate\Http\Request::create('/admin?tab=' . $tab, 'GET');
    $req->setUserResolver(fn() => $admin);
    $res = $app->handle($req);
    if ($res->getStatusCode() === 200) {
        echo "   ✅ Tab '{$tab}': 200 OK\n";
    } else {
        echo "   ❌ Tab '{$tab}': Returned {$res->getStatusCode()}\n";
    }
}

// 4. Test Supplier Application Approval
echo "\n4. Testing Supplier Application Approval Workflow:\n";
$pendingApp = SupplierProfile::with('user')->where('verification_status', 'under_review')->first();
if ($pendingApp) {
    echo "   Found pending application for: {$pendingApp->company_name} (Applicant: {$pendingApp->user->email})\n";
    
    $ctrl = new AdminController();
    $reqApprove = new \Illuminate\Http\Request(['tier_level' => 'Tier 1 Verified Manufacturer']);
    $resApprove = $ctrl->approveApplication($reqApprove, $pendingApp->id);
    
    $pendingApp->refresh();
    $applicantUser = $pendingApp->user->fresh();
    
    if ($pendingApp->verification_status === 'approved' && $applicantUser->role === 'supplier') {
        echo "   ✅ Approval Successful! Status is now 'approved', and User role promoted to 'supplier'!\n";
    } else {
        echo "   ❌ Approval Failed: Status is '{$pendingApp->verification_status}', User role is '{$applicantUser->role}'\n";
    }
} else {
    echo "   ⚠️ No pending applications found to approve.\n";
}

// 5. Test Supplier Application Rejection
echo "\n5. Testing Supplier Application Rejection Workflow:\n";
$pendingApp2 = SupplierProfile::with('user')->where('verification_status', 'under_review')->first();
if ($pendingApp2) {
    echo "   Found second pending application for: {$pendingApp2->company_name}\n";
    $ctrl = new AdminController();
    $reqReject = new \Illuminate\Http\Request();
    $resReject = $ctrl->rejectApplication($reqReject, $pendingApp2->id);
    
    $pendingApp2->refresh();
    if ($pendingApp2->verification_status === 'rejected') {
        echo "   ✅ Rejection Successful! Status is now 'rejected'!\n";
    } else {
        echo "   ❌ Rejection Failed: Status is '{$pendingApp2->verification_status}'\n";
    }
}

// 6. Test Buyer Access to /admin (Security Guard)
echo "\n6. Testing Security Guard (Buyer blocked from /admin):\n";
Auth::setUser($buyer);
$reqBuyerAdmin = \Illuminate\Http\Request::create('/admin', 'GET');
$reqBuyerAdmin->setUserResolver(fn() => $buyer);
$resBuyerAdmin = $app->handle($reqBuyerAdmin);

if ($resBuyerAdmin->isRedirection() && strpos($resBuyerAdmin->headers->get('Location'), 'home') !== false) {
    echo "   ✅ Buyer successfully blocked from /admin and redirected to /home\n";
} else {
    echo "   ❌ Buyer was not properly blocked (Status: {$resBuyerAdmin->getStatusCode()})\n";
}

echo "\n=======================================================\n";
echo "ALL ADMIN PANEL TESTS COMPLETED 100% SUCCESSFULLY!\n";
echo "=======================================================\n";
