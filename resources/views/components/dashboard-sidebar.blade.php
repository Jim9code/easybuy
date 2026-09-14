@props(['active' => 'home'])

<!-- ==================== FIXED DASHBOARD SIDEBAR (DESKTOP) ==================== -->
<aside id="buyer-dashboard-sidebar" class="hidden lg:flex lg:w-64 xl:w-72 bg-[#F2EAE0] border-r border-[#E0D3C1] flex-col justify-between p-4 sm:p-5 shrink-0 z-30 h-full overflow-y-auto transition-all duration-300 ease-in-out">
	
	<!-- Top Section: Brand & Navigation -->
	<div class="space-y-6">
		
		<!-- Sidebar Header with Collapse Toggle Button -->
		<div class="flex items-center justify-between">
			<a href="{{ url('/catalog') }}" class="flex items-center gap-2.5 group cursor-pointer">
				<img src="{{ asset('images/easybuy-logo.png') }}" alt="EasyBuy" class="h-9 w-9 object-contain drop-shadow-xs group-hover:scale-105 transition-transform">
				<div>
					<span class="font-heading tracking-tight font-black text-base text-[#191917]">EASYBUY</span>
					<span class="block text-4xs font-bold text-[#7A7365] uppercase tracking-wider">AI Procurement</span>
				</div>
			</a>

			<!-- Sidebar Collapse / Hide Button -->
			<button type="button" onclick="toggleDashboardSidebar()" title="Hide Sidebar (Expand Canvas)"
				class="hidden lg:flex h-8 w-8 rounded-xl clay-marshmallow-subtle items-center justify-center text-[#7A7365] hover:text-[#191917] hover:border-[#191917] transition cursor-pointer shrink-0 active:scale-95 group"
				aria-label="Hide sidebar">
				<svg class="h-4 w-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
				</svg>
			</button>
		</div>

		<!-- Navigation Links (Order: 1. Catalog, 2. Cart, 3. Ask Easy) -->
		<nav class="space-y-1.5" aria-label="Sidebar navigation">
			<!-- 1. Catalog (Dedicated Page) -->
			<a href="{{ url('/catalog') }}" 
				class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-2xl {{ $active === 'catalog' ? 'bg-[#FFD000] text-[#191917] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<svg class="h-4 w-4 {{ $active === 'catalog' ? 'text-[#191917]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
				</svg>
				<span>Catalog</span>
			</a>

			<!-- 2. Cart (Dedicated Page) -->
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

			<!-- 3. Ask Easy (AI Sourcing Engine) -->
			<a href="{{ url('/home') }}" 
				class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-2xl {{ $active === 'home' ? 'bg-[#FFD000] text-[#191917] font-bold shadow-xs' : 'text-[#5C5549] hover:text-[#191917] hover:bg-[#FAF6EE] font-medium' }} text-xs transition cursor-pointer">
				<svg class="h-4 w-4 {{ $active === 'home' ? 'text-[#191917]' : 'text-[#5C5549]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
				</svg>
				<span>Ask Easy</span>
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

<!-- ==================== MOBILE BOTTOM APP NAVIGATION BAR (VISIBLE ON MOBILE / TABLET < LG) ==================== -->
<nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#FAF6EE]/95 backdrop-blur-md border-t border-[#E0D3C1] px-3 py-1.5 flex items-center justify-around shadow-[0_-4px_20px_rgba(0,0,0,0.06)]" aria-label="Mobile Bottom Navigation">
	
	<!-- 1. Catalog Tab -->
	<a href="{{ url('/catalog') }}" 
		class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-2xl transition active:scale-95 {{ $active === 'catalog' ? 'text-[#191917]' : 'text-[#7A7365]' }}">
		<span class="flex h-8 w-8 items-center justify-center rounded-xl {{ $active === 'catalog' ? 'bg-[#FFD000] text-[#191917] shadow-xs font-black' : 'bg-transparent text-[#7A7365]' }}">
			<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
			</svg>
		</span>
		<span class="text-4xs font-bold uppercase tracking-wider {{ $active === 'catalog' ? 'text-[#191917]' : 'text-[#7A7365]' }}">Catalog</span>
	</a>

	<!-- 2. Cart Tab -->
	<a href="{{ url('/cart') }}" 
		class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-2xl transition active:scale-95 relative {{ $active === 'cart' ? 'text-[#191917]' : 'text-[#7A7365]' }}">
		<span class="flex h-8 w-8 items-center justify-center rounded-xl relative {{ $active === 'cart' ? 'bg-[#FFD000] text-[#191917] shadow-xs font-black' : 'bg-transparent text-[#7A7365]' }}">
			<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
			</svg>
			<span id="mobile-bar-cart-count" class="absolute -top-1 -right-1.5 h-4 w-4 rounded-full bg-[#191917] text-[#FFD000] text-5xs font-black flex items-center justify-center">0</span>
		</span>
		<span class="text-4xs font-bold uppercase tracking-wider {{ $active === 'cart' ? 'text-[#191917]' : 'text-[#7A7365]' }}">Cart</span>
	</a>

	<!-- 3. Ask Easy Tab -->
	<a href="{{ url('/home') }}" 
		class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-2xl transition active:scale-95 {{ $active === 'home' ? 'text-[#191917]' : 'text-[#7A7365]' }}">
		<span class="flex h-8 w-8 items-center justify-center rounded-xl {{ $active === 'home' ? 'bg-[#FFD000] text-[#191917] shadow-xs font-black' : 'bg-transparent text-[#7A7365]' }}">
			<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
			</svg>
		</span>
		<span class="text-4xs font-bold uppercase tracking-wider {{ $active === 'home' ? 'text-[#191917]' : 'text-[#7A7365]' }}">Ask Easy</span>
	</a>

	@if(Auth::check() && (Auth::user()->isSupplier() || Auth::user()->isAdmin()))
	<!-- 4. Supplier Hub Tab (For Suppliers/Admins) -->
	<a href="{{ url('/supplier/dashboard') }}" 
		class="flex flex-col items-center gap-0.5 py-1 px-3 rounded-2xl transition active:scale-95 {{ str_starts_with($active, 'supplier') ? 'text-[#191917]' : 'text-[#7A7365]' }}">
		<span class="flex h-8 w-8 items-center justify-center rounded-xl {{ str_starts_with($active, 'supplier') ? 'bg-[#191917] text-[#FFD000] shadow-xs font-black' : 'bg-transparent text-[#7A7365]' }}">
			<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
			</svg>
		</span>
		<span class="text-4xs font-bold uppercase tracking-wider {{ str_starts_with($active, 'supplier') ? 'text-[#191917]' : 'text-[#7A7365]' }}">Supplier</span>
	</a>
	@endif

</nav>

<!-- Floating Sidebar Expand Pill (Visible when sidebar is collapsed on desktop) -->
<div id="buyer-sidebar-expand-pill" class="fixed top-20 left-3 z-40 hidden animate-fade-in">
	<button type="button" onclick="toggleDashboardSidebar()" title="Expand Sidebar Navigation"
		class="clay-marshmallow shadow-md hover:shadow-lg border border-[#E0D3C1] hover:border-[#191917] px-3.5 py-2 rounded-2xl flex items-center gap-2 text-xs font-bold text-[#191917] hover:scale-105 active:scale-95 transition cursor-pointer">
		<span class="flex h-5 w-5 items-center justify-center rounded-lg bg-[#FFD000] text-[#191917] font-black text-3xs shadow-xs">
			EB
		</span>
		<svg class="h-3.5 w-3.5 text-[#5C5549]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
			<path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
		</svg>
		<span class="text-3xs font-black uppercase tracking-wider text-[#5C5549]">Navigation</span>
	</button>
</div>

<script>
	(function() {
		window.toggleDashboardSidebar = function() {
			const sidebar = document.getElementById('buyer-dashboard-sidebar');
			if (!sidebar) return;

			const isCurrentlyCollapsed = sidebar.classList.contains('sidebar-collapsed-mode');
			const newCollapsedState = !isCurrentlyCollapsed;

			applySidebarState(newCollapsedState);
			localStorage.setItem('easybuy_sidebar_collapsed', newCollapsedState ? 'true' : 'false');
		};

		window.applySidebarState = function(isCollapsed) {
			const sidebar = document.getElementById('buyer-dashboard-sidebar');
			const expandPill = document.getElementById('buyer-sidebar-expand-pill');
			const inlineToggleBtns = document.querySelectorAll('.sidebar-toggle-inline-btn');

			if (!sidebar) return;

			if (isCollapsed) {
				sidebar.classList.add('sidebar-collapsed-mode', 'lg:!w-0', '!p-0', '!border-0', 'opacity-0', 'invisible', '!overflow-hidden');
				sidebar.classList.remove('opacity-100', 'visible');
				if (expandPill) {
					expandPill.classList.remove('hidden');
				}
				inlineToggleBtns.forEach(btn => {
					btn.classList.add('bg-[#FFD000]', 'text-[#191917]', 'border-[#191917]');
					btn.classList.remove('clay-marshmallow-subtle', 'text-[#5C5549]');
					const textSpan = btn.querySelector('.btn-label');
					if (textSpan) textSpan.innerText = 'Show Sidebar';
				});
			} else {
				sidebar.classList.remove('sidebar-collapsed-mode', 'lg:!w-0', '!p-0', '!border-0', 'opacity-0', 'invisible', '!overflow-hidden');
				sidebar.classList.add('opacity-100', 'visible');
				if (expandPill) {
					expandPill.classList.add('hidden');
				}
				inlineToggleBtns.forEach(btn => {
					btn.classList.remove('bg-[#FFD000]', 'text-[#191917]', 'border-[#191917]');
					btn.classList.add('clay-marshmallow-subtle', 'text-[#5C5549]');
					const textSpan = btn.querySelector('.btn-label');
					if (textSpan) textSpan.innerText = 'Hide Sidebar';
				});
			}
		};

		// Instant init on DOM load without layout flash
		if (localStorage.getItem('easybuy_sidebar_collapsed') === 'true') {
			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', () => window.applySidebarState(true));
			} else {
				window.applySidebarState(true);
			}
		}
	})();
</script>
