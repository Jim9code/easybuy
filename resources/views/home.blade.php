<x-layout>
	<div class="py-8 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
		<!-- Welcome Header -->
		<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-[#e8dfd3] pb-6 mb-8">
			<div>
				<span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#1f5fd8]">Customer Dashboard</span>
				<h1 class="text-3xl font-extrabold tracking-tight text-[#1b1b18] mt-1">
					Welcome back, <span class="bg-gradient-to-r from-[#1f5fd8] to-[#4f8eff] bg-clip-text text-transparent">{{ request('username', 'Guest User') }}</span>!
				</h1>
			</div>
			<div>
				
				<div>
    <!-- Sign Out / Logout Form -->
    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50/50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50 hover:border-red-300 hover:text-red-700 cursor-pointer">
            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span>Sign Out</span>
        </button>
    </form>
</div>

			</div>
		</div>

		<!-- Stats Grid -->
		<div class="grid gap-6 sm:grid-cols-3 mb-8">
			<div class="rounded-2xl border border-[#eadfce] bg-white p-6 shadow-sm">
				<div class="flex items-center justify-between">
					<span class="text-xs font-semibold uppercase tracking-wider text-[#666666]">Active Orders</span>
					<span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-[#1f5fd8] font-bold text-sm">1</span>
				</div>
				<p class="text-3xl font-extrabold text-[#1b1b18] mt-4">1 Order</p>
				<p class="text-xs text-[#888888] mt-1">Estimated delivery: Tomorrow</p>
			</div>

			<div class="rounded-2xl border border-[#eadfce] bg-white p-6 shadow-sm">
				<div class="flex items-center justify-between">
					<span class="text-xs font-semibold uppercase tracking-wider text-[#666666]">Saved Items</span>
					<span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500 font-bold text-sm">4</span>
				</div>
				<p class="text-3xl font-extrabold text-[#1b1b18] mt-4">4 Items</p>
				<p class="text-xs text-[#888888] mt-1">2 items currently on sale</p>
			</div>

			<div class="rounded-2xl border border-[#eadfce] bg-white p-6 shadow-sm">
				<div class="flex items-center justify-between">
					<span class="text-xs font-semibold uppercase tracking-wider text-[#666666]">EasyBuy Wallet</span>
					<span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 font-bold text-sm">$</span>
				</div>
				<p class="text-3xl font-extrabold text-[#1b1b18] mt-4">$25.50</p>
				<p class="text-xs text-[#888888] mt-1">100 loyalty points available</p>
			</div>
		</div>

		<!-- Dashboard Content Panels -->
		<div class="grid gap-8 lg:grid-cols-3">
			<!-- Recent Orders -->
			<div class="lg:col-span-2 space-y-6">
				<div class="rounded-3xl border border-[#eadfce] bg-white p-6 shadow-sm">
					<h3 class="text-lg font-bold text-[#1b1b18] mb-4">Recent Deliveries</h3>
					
					<div class="divide-y divide-[#f4eee6]">
						<!-- Order 1 -->
						<div class="py-4 flex items-center justify-between first:pt-0 last:pb-0">
							<div class="flex items-center gap-3">
								<div class="h-12 w-12 rounded-xl bg-gradient-to-br from-[#dfe9ff] to-[#f7d9b8] flex items-center justify-center text-xs font-bold text-neutral-800">
									SH
								</div>
								<div>
									<h4 class="text-sm font-semibold text-[#1b1b18]">Smart Home Hub</h4>
									<p class="text-xs text-[#888888]">Delivered Aug 21, 2026 • Order #EB-92841</p>
								</div>
							</div>
							<div class="text-right">
								<span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 border border-emerald-100">
									Delivered
								</span>
								<p class="text-xs font-semibold text-[#1b1b18] mt-1">$149.25</p>
							</div>
						</div>

						<!-- Order 2 -->
						<div class="py-4 flex items-center justify-between first:pt-0 last:pb-0">
							<div class="flex items-center gap-3">
								<div class="h-12 w-12 rounded-xl bg-gradient-to-br from-[#d8f0df] to-[#e5eae4] flex items-center justify-center text-xs font-bold text-neutral-800">
									EP
								</div>
								<div>
									<h4 class="text-sm font-semibold text-[#1b1b18]">Everyday Commuter Pack</h4>
									<p class="text-xs text-[#888888]">Delivered Aug 15, 2026 • Order #EB-89104</p>
								</div>
							</div>
							<div class="text-right">
								<span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 border border-emerald-100">
									Delivered
								</span>
								<p class="text-xs font-semibold text-[#1b1b18] mt-1">$79.99</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Quick Actions / Sidebar -->
			<div class="space-y-6">
				<div class="rounded-3xl border border-[#eadfce] bg-white p-6 shadow-sm">
					<h3 class="text-lg font-bold text-[#1b1b18] mb-4">Quick Settings</h3>
					<div class="space-y-3">
						<a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-[#faf8f5] transition group text-sm text-[#4b4b4b] font-medium">
							<span>Manage Profile</span>
							<span class="text-neutral-400 group-hover:translate-x-0.5 transition-transform">&rarr;</span>
						</a>
						<a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-[#faf8f5] transition group text-sm text-[#4b4b4b] font-medium">
							<span>Payment Methods</span>
							<span class="text-neutral-400 group-hover:translate-x-0.5 transition-transform">&rarr;</span>
						</a>
						<a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-[#faf8f5] transition group text-sm text-[#4b4b4b] font-medium">
							<span>Shipping Addresses</span>
							<span class="text-neutral-400 group-hover:translate-x-0.5 transition-transform">&rarr;</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-layout>
