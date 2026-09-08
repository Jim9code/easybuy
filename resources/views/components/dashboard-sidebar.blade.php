@props(['active' => 'home'])

<!-- ==================== FIXED DASHBOARD SIDEBAR ==================== -->
<aside class="w-full lg:w-64 xl:w-72 bg-[#F2EAE0] border-r border-[#E0D3C1] flex flex-col justify-between p-4 sm:p-5 shrink-0 z-20 h-full overflow-y-auto">
	
	<!-- Top Section: Brand & Navigation -->
	<div class="space-y-6">
		
		<!-- Sidebar Header -->
		<div class="flex items-center justify-between">
			<a href="{{ url('/home') }}" class="flex items-center gap-2.5 group cursor-pointer">
				<span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] font-black text-xs shadow-xs group-hover:scale-105 transition-transform">
					EB
				</span>
				<div>
					<span class="font-heading tracking-tight font-black text-base text-[#191917]">EASYBUY</span>
					<span class="block text-4xs font-bold text-[#7A7365] uppercase tracking-wider">AI Procurement</span>
				</div>
			</a>
		</div>

		<!-- Navigation Links -->
		<nav class="space-y-1" aria-label="Sidebar navigation">
			<!-- 1. Home / Ask Easy -->
			<a href="{{ url('/home') }}" 
				class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-2xl {{ $active === 'home' ? 'bg-[#FFD000] text-[#191917] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<svg class="h-4 w-4 {{ $active === 'home' ? 'text-[#191917]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
				</svg>
				<span>Ask Easy</span>
			</a>

			<!-- 2. Catalog (Dedicated Page) -->
			<a href="{{ url('/catalog') }}" 
				class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-2xl {{ $active === 'catalog' ? 'bg-[#FFD000] text-[#191917] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<svg class="h-4 w-4 {{ $active === 'catalog' ? 'text-[#191917]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
				</svg>
				<span>Catalog</span>
			</a>

			<!-- 3. Cart (Dedicated Page) -->
			<a href="{{ url('/cart') }}" 
				class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ $active === 'cart' ? 'bg-[#FFD000] text-[#191917] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer text-left">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ $active === 'cart' ? 'text-[#191917]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
					</svg>
					<span>Cart</span>
				</div>
				<span id="sidebar-cart-count" class="text-3xs font-bold {{ $active === 'cart' ? 'text-[#191917]' : 'text-[#7A7365]' }}">0</span>
			</a>

			{{-- 4. Supplier Hub / Portal (Application Status & Dashboard Access - Only for Suppliers/Admins) --}}
			@if(Auth::check() && (Auth::user()->isSupplier() || Auth::user()->isAdmin()))
			<a href="{{ url('/supplier/dashboard') }}" 
				class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl {{ str_starts_with($active, 'supplier') ? 'bg-[#191917] text-[#FAF6EE] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer text-left">
				<div class="flex items-center gap-2.5">
					<svg class="h-4 w-4 {{ str_starts_with($active, 'supplier') ? 'text-[#FFD000]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
					</svg>
					<span>Supplier Hub</span>
				</div>
				<span class="text-4xs font-bold px-1.5 py-0.5 rounded-md {{ str_starts_with($active, 'supplier') ? 'bg-[#FFD000] text-[#191917]' : 'bg-[#FFD000]/30 text-[#191917]' }}">
					Portal
				</span>
			</a>
			@endif
		</nav>

	</div>

	<!-- Bottom Section: Supplier Status / Switcher, Profile & Sign Out -->
	<div class="space-y-3 pt-6 border-t border-[#E0D3C1]">
		
		{{-- Supplier Hub Quick-Access Card (Only for Suppliers/Admins) --}}
		@if(Auth::check() && (Auth::user()->isSupplier() || Auth::user()->isAdmin()))
		<div class="rounded-2xl p-3 bg-[#FAF6EE] border border-[#E0D3C1] space-y-2">
			<div class="flex items-center justify-between">
				<h4 class="text-xs font-bold text-[#191917]">Supplier Portal</h4>
				<span class="text-4xs font-bold text-emerald-800 bg-emerald-100 px-1.5 py-0.5 rounded">Active</span>
			</div>
			<p class="text-3xs text-[#7A7365] leading-relaxed">
				Manage factory inventory, fulfill POs, and review payouts.
			</p>
			<a href="{{ url('/supplier/dashboard') }}" 
				class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] py-1.5 rounded-xl text-3xs font-bold flex items-center justify-center gap-1.5 cursor-pointer transition shadow-xs">
				<span>Open Supplier Dashboard</span>
				<span class="text-[#FFD000]">&rarr;</span>
			</a>
		</div>
		@endif

		<!-- User Profile Row -->
		<div class="flex items-center justify-between p-2 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1]">
			<div class="flex items-center gap-2 overflow-hidden">
				<div class="h-7 w-7 rounded-full bg-[#191917] text-[#FAF6EE] flex items-center justify-center font-bold text-2xs shrink-0">
					{{ Auth::check() ? strtoupper(substr(Auth::user()->username, 0, 1)) : 'U' }}
				</div>
				<div class="truncate">
					<h4 class="text-xs font-bold text-[#191917] truncate">{{ Auth::check() ? Auth::user()->username : 'Guest' }}</h4>
				</div>
			</div>

			<!-- Sign Out Button -->
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
