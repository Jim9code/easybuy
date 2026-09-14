@props(['active' => 'overview', 'pendingCount' => 0])

<!-- ==================== FIXED ADMIN DASHBOARD SIDEBAR ==================== -->
<aside class="w-full lg:w-64 xl:w-72 bg-[#F2EAE0] border-r border-[#E0D3C1] flex flex-col justify-between p-4 sm:p-5 shrink-0 z-20 h-full overflow-y-auto">
	
	<!-- Top Section: Brand & Navigation -->
	<div class="space-y-6">
		
		<!-- Sidebar Header: SuperAdmin Hub Branding -->
		<div class="space-y-2">
			<a href="{{ url('/admin') }}" class="flex items-center gap-2.5 group cursor-pointer">
				<span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#191917] text-[#FFD000] font-black text-xs shadow-xs group-hover:scale-105 transition-transform">
					HQ
				</span>
				<div>
					<span class="font-heading tracking-tight font-black text-base text-[#191917]">EASYBUY</span>
					<span class="block text-4xs font-bold text-[#7A7365] uppercase tracking-wider">Admin Console</span>
				</div>
			</a>
		</div>

		<!-- Admin Navigation Links -->
		<nav class="space-y-1" aria-label="Admin sidebar navigation">
			
			<!-- 1. Overview / Metrics -->
			<a href="{{ url('/admin?tab=overview') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'overview' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'overview' ? 'text-[#FFD000]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
					</svg>
					<span>Platform Overview</span>
				</div>
			</a>

			<!-- 2. Supplier Applications (Pending Approvals) -->
			<a href="{{ url('/admin?tab=applications') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'applications' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'applications' ? 'text-[#FFD000]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
					</svg>
					<span>Supplier Applications</span>
				</div>
				@if($pendingCount > 0)
				<span class="text-4xs font-bold px-2 py-0.5 rounded-full bg-amber-400 text-[#191917] animate-pulse">
					{{ $pendingCount }} New
				</span>
				@endif
			</a>

			<!-- 3. Verified Suppliers -->
			<a href="{{ url('/admin?tab=suppliers') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'suppliers' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'suppliers' ? 'text-[#FFD000]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
					</svg>
					<span>Verified Suppliers</span>
				</div>
			</a>

			<!-- 4. Platform Orders -->
			<a href="{{ url('/admin?tab=orders') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'orders' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'orders' ? 'text-[#FFD000]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
					</svg>
					<span>Platform Orders</span>
				</div>
			</a>

			<!-- 5. Catalog Oversight -->
			<a href="{{ url('/admin?tab=catalog') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'catalog' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'catalog' ? 'text-[#FFD000]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
					</svg>
					<span>Catalog SKUs</span>
				</div>
			</a>

			<!-- 6. User Accounts -->
			<a href="{{ url('/admin?tab=users') }}" 
				class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'users' ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'users' ? 'text-[#FFD000]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
					</svg>
					<span>User Accounts</span>
				</div>
			</a>

		</nav>

	</div>

	<!-- Bottom Section: Admin User Row & Logout -->
	<div class="space-y-3 pt-6 border-t border-[#E0D3C1]">
		
		<!-- Admin Profile Row -->
		<div class="flex items-center justify-between p-2 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1]">
			<div class="flex items-center gap-2 overflow-hidden">
				<div class="h-8 w-8 rounded-full bg-[#191917] text-[#FFD000] flex items-center justify-center font-black text-xs shrink-0 shadow-xs">
					{{ Auth::check() ? strtoupper(substr(Auth::user()->username, 0, 1)) : 'A' }}
				</div>
				<div class="truncate">
					<h4 class="text-xs font-bold text-[#191917] truncate">{{ Auth::check() ? Auth::user()->username : 'Admin' }}</h4>
					<p class="text-4xs text-[#7A7365] truncate">{{ Auth::check() ? Auth::user()->email : 'admin@easybuy.com' }}</p>
				</div>
			</div>

			<!-- Sign Out Button -->
			<form action="{{ url('/logout') }}" method="POST" class="inline shrink-0">
				@csrf
				<button type="submit" title="Sign Out" 
					class="p-1.5 rounded-lg text-[#9C9283] hover:text-red-600 transition cursor-pointer">
					<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
					</svg>
				</button>
			</form>
		</div>

	</div>
</aside>
