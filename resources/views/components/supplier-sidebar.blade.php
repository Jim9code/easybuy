@props(['active' => 'overview'])

@php
	$user = Auth::user();
	$profile = $user ? $user->supplierProfile : null;
	$companyName = $profile ? $profile->company_name : ($user ? ($user->company_name ?: $user->username) : 'Direct Supplier');
	$initials = strtoupper(substr($companyName, 0, 2));
	$tier = $profile ? $profile->tier_level : 'Tier 1 Direct Manufacturer';
	$refNo = $profile ? $profile->ref_no : ('EB-SUP-' . ($user ? $user->id : '0000'));
	$taxId = $profile && $profile->tax_id_ein ? ('EIN: ' . $profile->tax_id_ein) : 'Direct Mfr';
	$activeOrdersCount = $user ? \App\Models\OrderItem::where('supplier_id', $user->id)->count() : 0;
@endphp

<!-- ==================== FIXED SUPPLIER DASHBOARD SIDEBAR ==================== -->
<aside class="w-full lg:w-64 xl:w-72 bg-[#F2EAE0] border-r border-[#E0D3C1] flex flex-col justify-between p-4 sm:p-5 shrink-0 z-20 h-full overflow-y-auto">
	
	<!-- Top Section: Brand & Supplier Navigation -->
	<div class="space-y-6">
		
		<!-- Sidebar Header: Supplier Hub Branding -->
		<div>
			<a href="{{ url('/supplier/dashboard') }}" class="flex items-center gap-2.5 group cursor-pointer">
				<span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#191917] text-[#FFD000] font-black text-xs shadow-xs group-hover:scale-105 transition-transform">
					EB
				</span>
				<div>
					<span class="font-heading tracking-tight font-black text-base text-[#191917]">EASYBUY</span>
					<span class="block text-4xs font-bold text-[#7A7365] uppercase tracking-wider">Supplier Hub</span>
				</div>
			</a>
		</div>

		<!-- Supplier Navigation Links -->
		<nav class="space-y-1" aria-label="Supplier sidebar navigation">
			
			<!-- 1. Overview / Dashboard -->
			<a href="{{ url('/supplier/dashboard?tab=overview') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'overview' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'overview' ? 'text-[#FAF6EE]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
					</svg>
					<span>Overview</span>
				</div>
			</a>

			<!-- 2. Purchase Orders (POs) -->
			<a href="{{ url('/supplier/dashboard?tab=orders') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'orders' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'orders' ? 'text-[#FAF6EE]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
					</svg>
					<span>Purchase Orders</span>
				</div>
				@if($activeOrdersCount > 0)
				<span class="text-4xs font-bold px-1.5 py-0.5 rounded-md {{ $active === 'orders' ? 'bg-[#FAF6EE] text-[#191917]' : 'clay-marshmallow-subtle text-[#7A7365]' }}">
					{{ $activeOrdersCount }}
				</span>
				@endif
			</a>

			<!-- 3. My Products & Inventory -->
			<a href="{{ url('/supplier/dashboard?tab=inventory') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'inventory' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'inventory' ? 'text-[#FAF6EE]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
					</svg>
					<span>My Products</span>
				</div>
			</a>

			<!-- 4. Buyer Requests & Custom Quotes -->
			<a href="{{ url('/supplier/dashboard?tab=rfqs') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'rfqs' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'rfqs' ? 'text-[#FAF6EE]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
					</svg>
					<span>Buyer Requests</span>
				</div>
			</a>

			<!-- 5. Payouts & Earnings -->
			<a href="{{ url('/supplier/dashboard?tab=payouts') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'payouts' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'payouts' ? 'text-[#FAF6EE]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6H2.25m0 0v10.5m0-10.5c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v10.5c0 .621-.504 1.125-1.125 1.125H3.375A1.125 1.125 0 012.25 16.5M3.75 4.5h16.5" />
					</svg>
					<span>Payouts & Earnings</span>
				</div>
			</a>

			<!-- 6. Application & Audit Status -->
			<a href="{{ url('/supplier/status') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'status' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'status' ? 'text-[#FAF6EE]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
					</svg>
					<span>Application Status</span>
				</div>
			</a>

		</nav>

	</div>

	<!-- Bottom Section: Switch to Buyer Workspace & Company Card -->
	<div class="space-y-3 pt-6 border-t border-[#E0D3C1]">
		
		<!-- Switch to Buyer Workspace Switcher Card -->
		<a href="{{ url('/home') }}" 
			class="w-full flex items-center justify-between p-3 rounded-2xl clay-marshmallow hover:bg-[#FAF6EE] text-[#191917] transition group cursor-pointer">
			<div class="flex items-center gap-2">
				<svg class="h-4 w-4 text-[#5C5549]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
				</svg>
				<span class="text-xs font-bold text-[#191917]">Buyer Workspace</span>
			</div>
			<span class="clay-icon-pill h-5 w-5 rounded-full flex items-center justify-center text-3xs font-bold group-hover:translate-x-0.5 transition-transform">
				&rarr;
			</span>
		</a>

		<!-- Supplier Entity Profile Card -->
		<div class="flex items-center justify-between p-2.5 rounded-2xl clay-marshmallow-subtle">
			<div class="flex items-center gap-2 overflow-hidden">
				<div class="h-8 w-8 rounded-xl bg-[#191917] text-[#FAF6EE] flex items-center justify-center font-bold text-2xs shrink-0">
					{{ $initials }}
				</div>
				<div class="truncate">
					<h4 class="text-xs font-bold text-[#191917] truncate">{{ $companyName }}</h4>
					<p class="text-4xs text-[#7A7365] truncate">{{ $taxId }}</p>
				</div>
			</div>

			<!-- Sign Out -->
			<form action="{{ url('/logout') }}" method="POST" class="inline shrink-0">
				@csrf
				<button type="submit" title="Sign Out" 
					class="p-1.5 rounded-lg text-[#9C9283] hover:text-[#191917] transition cursor-pointer">
					<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
					</svg>
				</button>
			</form>
		</div>

	</div>
</aside>
