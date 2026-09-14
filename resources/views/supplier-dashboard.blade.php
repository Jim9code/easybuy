<x-layout title="EasyBuy — Supplier Fulfillment Dashboard">
	<!-- Full-Height Dashboard Workspace Layout -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED SUPPLIER SIDEBAR ==================== -->
		<x-supplier-sidebar :active="$activeTab ?? 'overview'" />

		<!-- ==================== MAIN SUPPLIER DASHBOARD CANVAS ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-6 lg:p-8 relative">
			
			<div class="max-w-6xl mx-auto space-y-6 sm:space-y-8 animate-fade-in pb-16">
				
				<!-- ==================== 1. TOP HUB HEADER BANNER ==================== -->
				<div class="clay-marshmallow rounded-3xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border border-[#E0D3C1]">
					<div class="flex items-center gap-4">
						<div class="h-13 w-13 rounded-2xl flex items-center justify-center bg-[#191917] text-[#FFD000] font-black text-base shadow-md shrink-0 border border-[#333333]">
							EB
						</div>
						<div>
							<div class="flex items-center gap-2.5 flex-wrap">
								<h1 class="text-lg sm:text-xl font-bold text-[#191917] font-sans">
									Wholesale Supplier Hub
								</h1>
								<span class="bg-[#191917] text-[#FFD000] text-4xs font-black uppercase px-2.5 py-0.5 rounded-md tracking-wider">
									{{ $application['business_type'] ?? 'Direct Manufacturer' }}
								</span>
							</div>
							<p class="text-xs text-[#7A7365] mt-0.5">
								{{ $application['company_name'] ?? 'Apex Industrial Manufacturing Ltd.' }} • {{ $application['warehouse_address'] ?? 'Warehouse Facility' }} • Single-invoice consolidated blind dispatch.
							</p>
						</div>
					</div>

					<!-- Header Badges Group -->
					<div class="flex items-center gap-2.5 shrink-0 flex-wrap">
						<div class="clay-icon-pill px-3.5 py-1.5 rounded-xl text-3xs font-bold text-[#5C5549] flex items-center gap-2">
							<span class="h-2 w-2 rounded-full bg-emerald-500"></span>
							<span>Payouts Active</span>
						</div>
					</div>
				</div>

				@if(($activeTab ?? 'overview') === 'overview')
				<!-- ========================================================================= -->
				<!-- TAB: OVERVIEW HUB (Primary Default View)                                   -->
				<!-- ========================================================================= -->

				<!-- ==================== 2. STATS ROW (4 Rich Colored Clay Cards) ==================== -->
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
					
					<!-- Card 1: Wholesale Revenue (Soft Mint / Sage Clay Body) -->
					<div class="bg-[#E8F6EC] border border-[#C2E7CD] shadow-sm rounded-3xl p-6 flex flex-col justify-between space-y-4 hover:shadow-md transition">
						<div class="flex items-center justify-between">
							<span class="text-3xs font-black uppercase tracking-wider text-[#2D6A4F]">Wholesale Revenue</span>
							<div class="h-9 w-9 rounded-xl flex items-center justify-center bg-[#D3EED8] text-[#134E2E] shadow-2xs shrink-0">
								<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>
							</div>
						</div>
						
						<div>
							<div class="text-2xl sm:text-3xl font-black text-[#134E2E] price-text tracking-tight leading-none">
								₦{{ number_format($metrics['total_revenue'], 2) }}
							</div>
							<p class="text-xs font-bold text-[#2D6A4F] mt-2 flex items-center gap-1">
								<span>{{ $metrics['settled_orders_count'] ?? 0 }} Settled {{ ($metrics['settled_orders_count'] ?? 0) === 1 ? 'Order' : 'Orders' }}</span>
							</p>
						</div>
					</div>

					<!-- Card 2: Active Orders (Warm Honey / Amber Clay Body) -->
					<div class="bg-[#FEF4E4] border border-[#F9DEC0] shadow-sm rounded-3xl p-6 flex flex-col justify-between space-y-4 hover:shadow-md transition">
						<div class="flex items-center justify-between">
							<span class="text-3xs font-black uppercase tracking-wider text-[#9A5B00]">Active Orders</span>
							<div class="h-9 w-9 rounded-xl flex items-center justify-center bg-[#FCE5BF] text-[#6B3E00] shadow-2xs shrink-0">
								<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
								</svg>
							</div>
						</div>

						<div>
							<div class="text-2xl sm:text-3xl font-black text-[#6B3E00] price-text tracking-tight leading-none">
								{{ $metrics['in_fulfillment_count'] ?? $metrics['active_pos'] }} Orders
							</div>
							<p class="text-xs font-bold text-[#9A5B00] mt-2">
								₦{{ number_format($metrics['in_fulfillment_value'] ?? $metrics['in_transit_value'], 2) }} in fulfillment
							</p>
						</div>
					</div>

					<!-- Card 3: Buyer Requests (Soft Lavender / Royal Indigo Clay Body) -->
					<div class="bg-[#EEF1FD] border border-[#D5DDFC] shadow-sm rounded-3xl p-6 flex flex-col justify-between space-y-4 hover:shadow-md transition">
						<div class="flex items-center justify-between">
							<span class="text-3xs font-black uppercase tracking-wider text-[#4338CA]">Buyer Requests</span>
							<div class="h-9 w-9 rounded-xl flex items-center justify-center bg-[#DDE4FC] text-[#282182] shadow-2xs shrink-0">
								<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
								</svg>
							</div>
						</div>

						<div>
							<div class="text-2xl sm:text-3xl font-black text-[#282182] price-text tracking-tight leading-none">
								{{ count($rfqs) }} Requests
							</div>
							<p class="text-xs font-bold text-[#4338CA] mt-2">
								{{ count($rfqs) === 0 ? 'No pending price inquiries' : count($rfqs) . ' custom quotes requested' }}
							</p>
						</div>
					</div>

					<!-- Card 4: Next Payout (Obsidian Black Luxury Card Body) -->
					<div class="bg-[#191917] border border-[#333333] shadow-lg rounded-3xl p-6 flex flex-col justify-between space-y-4 hover:border-[#555555] transition text-[#FAF6EE]">
						<div class="flex items-center justify-between">
							<span class="text-3xs font-black uppercase tracking-wider text-[#A8A296]">Next Payout</span>
							<div class="h-9 w-9 rounded-xl flex items-center justify-center bg-[#282824] text-[#FFD000] border border-[#444444] shadow-xs shrink-0">
								<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6H2.25m0 0v10.5m0-10.5c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v10.5c0 .621-.504 1.125-1.125 1.125H3.375A1.125 1.125 0 012.25 16.5M3.75 4.5h16.5" />
								</svg>
							</div>
						</div>

						<div>
							<div class="text-2xl sm:text-3xl font-black text-[#FFD000] price-text tracking-tight leading-none">
								₦{{ number_format($metrics['next_payout_amount'], 2) }}
							</div>
							<p class="text-xs font-bold text-[#FAF6EE]/90 mt-2">
								{{ $metrics['next_payout_amount'] > 0 ? 'Ready for payout transfer' : 'No pending balance' }}
							</p>
						</div>
					</div>

				</div>

				<!-- ==================== 3. OVERVIEW QUICK ACTIONS & NAVIGATION ==================== -->
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
					
					<!-- Quick Action 1: Add New Product -->
					<div onclick="openAddProductModal()" class="clay-marshmallow rounded-3xl p-5 border border-[#E0D3C1] hover:border-[#191917] transition cursor-pointer group flex items-center justify-between">
						<div class="flex items-center gap-3">
							<div class="h-10 w-10 rounded-2xl bg-[#191917] text-[#FAF6EE] flex items-center justify-center font-bold text-base shadow-xs group-hover:scale-105 transition-transform">
								+
							</div>
							<div>
								<h3 class="text-xs font-bold text-[#191917]">Add Product</h3>
								<p class="text-4xs text-[#7A7365]">Upload SKU & pricing</p>
							</div>
						</div>
						<span class="text-xs text-[#7A7365] group-hover:text-[#191917] transition">↗</span>
					</div>

					<!-- Quick Action 2: View Orders -->
					<a href="{{ url('/supplier/dashboard?tab=orders') }}" class="clay-marshmallow rounded-3xl p-5 border border-[#E0D3C1] hover:border-[#191917] transition cursor-pointer group flex items-center justify-between">
						<div class="flex items-center gap-3">
							<div class="h-10 w-10 rounded-2xl bg-[#FEF4E4] text-[#6B3E00] flex items-center justify-center font-bold text-sm shadow-xs group-hover:scale-105 transition-transform">
								📦
							</div>
							<div>
								<h3 class="text-xs font-bold text-[#191917]">Purchase Orders</h3>
								<p class="text-4xs text-[#7A7365]">{{ count($orders) }} Active orders</p>
							</div>
						</div>
						<span class="text-xs text-[#7A7365] group-hover:text-[#191917] transition">↗</span>
					</a>

					<!-- Quick Action 3: Buyer Requests -->
					<a href="{{ url('/supplier/dashboard?tab=rfqs') }}" class="clay-marshmallow rounded-3xl p-5 border border-[#E0D3C1] hover:border-[#191917] transition cursor-pointer group flex items-center justify-between">
						<div class="flex items-center gap-3">
							<div class="h-10 w-10 rounded-2xl bg-[#EEF1FD] text-[#282182] flex items-center justify-center font-bold text-sm shadow-xs group-hover:scale-105 transition-transform">
								⚡
							</div>
							<div>
								<h3 class="text-xs font-bold text-[#191917]">Buyer Requests</h3>
								<p class="text-4xs text-[#7A7365]">{{ count($rfqs) }} Inquiries</p>
							</div>
						</div>
						<span class="text-xs text-[#7A7365] group-hover:text-[#191917] transition">↗</span>
					</a>

					<!-- Quick Action 4: Payouts -->
					<a href="{{ url('/supplier/dashboard?tab=payouts') }}" class="clay-marshmallow rounded-3xl p-5 border border-[#E0D3C1] hover:border-[#191917] transition cursor-pointer group flex items-center justify-between">
						<div class="flex items-center gap-3">
							<div class="h-10 w-10 rounded-2xl bg-[#E8F6EC] text-[#134E2E] flex items-center justify-center font-bold text-sm shadow-xs group-hover:scale-105 transition-transform">
								💳
							</div>
							<div>
								<h3 class="text-xs font-bold text-[#191917]">Payouts</h3>
								<p class="text-4xs text-[#7A7365]">Escrow & Remittance</p>
							</div>
						</div>
						<span class="text-xs text-[#7A7365] group-hover:text-[#191917] transition">↗</span>
					</a>

				</div>

				<!-- ==================== 4. OVERVIEW RECENT ACTIVITY PREVIEW (2-Column Grid) ==================== -->
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
					
					<!-- Left: Recent Purchase Orders Preview -->
					<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 space-y-5 border border-[#E0D3C1] flex flex-col justify-between">
						<div class="space-y-4">
							<div class="flex items-center justify-between">
								<div class="flex items-center gap-2">
									<h2 class="text-sm sm:text-base font-bold text-[#191917] font-sans">
										Recent Purchase Orders
									</h2>
									<span class="bg-[#191917] text-[#FAF6EE] text-4xs font-bold px-2 py-0.5 rounded-md">
										{{ count($orders) }}
									</span>
								</div>
								<a href="{{ url('/supplier/dashboard?tab=orders') }}" class="text-xs font-bold text-[#191917] hover:underline flex items-center gap-1">
									<span>View All</span>
									<span>&rarr;</span>
								</a>
							</div>

							<!-- Compact Orders List (Top 3) -->
							<div class="space-y-3">
								@forelse(array_slice($orders, 0, 3) as $order)
								<div class="p-3.5 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1] flex items-center justify-between gap-3 hover:border-[#191917] transition">
									<div class="flex items-center gap-3 min-w-0">
										@if(!empty($order['image']))
										<div class="h-11 w-11 rounded-xl overflow-hidden bg-[#FFFFFF] border border-[#E0D3C1] shrink-0 flex items-center justify-center">
											<img src="{{ $order['image'] }}" alt="{{ $order['item'] }}" class="h-full w-full object-cover" />
										</div>
										@endif
										<div class="min-w-0">
											<h4 class="text-xs font-bold text-[#191917] truncate leading-tight">{{ $order['qty'] }}x {{ $order['item'] }}</h4>
											<p class="text-4xs text-[#7A7365] mt-0.5 truncate">{{ $order['buyer'] }} • #{{ $order['id'] }}</p>
										</div>
									</div>

									<div class="text-right shrink-0">
										<span class="block text-xs font-black text-[#191917] price-text">₦{{ number_format($order['total'], 2) }}</span>
										@if($order['status_key'] === 'awaiting-packing')
											<span class="inline-block mt-0.5 bg-[#FEF0D6] text-[#854D0E] text-4xs font-bold px-2 py-0.5 rounded-md">Packing</span>
										@elseif($order['status_key'] === 'dock-pickup')
											<span class="inline-block mt-0.5 bg-[#E0F2FE] text-[#075985] text-4xs font-bold px-2 py-0.5 rounded-md">Dock Ready</span>
										@elseif($order['status_key'] === 'in-transit')
											<span class="inline-block mt-0.5 bg-[#EDE9FE] text-[#5B21B6] text-4xs font-bold px-2 py-0.5 rounded-md">In Transit</span>
										@else
											<span class="inline-block mt-0.5 bg-[#DCFCE7] text-[#166534] text-4xs font-bold px-2 py-0.5 rounded-md">Settled</span>
										@endif
									</div>
								</div>
								@empty
								<div class="p-6 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1] text-center space-y-1">
									<span class="text-xl">📦</span>
									<p class="text-xs font-bold text-[#191917]">No orders yet</p>
									<p class="text-4xs text-[#7A7365]">When wholesale buyers purchase your products, they will appear here.</p>
								</div>
								@endforelse
							</div>
						</div>

						<div class="pt-3 border-t border-[#E0D3C1]">
							<a href="{{ url('/supplier/dashboard?tab=orders') }}" class="w-full clay-marshmallow-subtle hover:bg-[#FAF6EE] text-[#191917] py-2.5 px-4 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 text-center">
								<span>Manage All Purchase Orders</span>
								<span>&rarr;</span>
							</a>
						</div>
					</div>

					<!-- Right: Sourcing Inquiries & Fulfillment Status Overview -->
					<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 space-y-5 border border-[#E0D3C1] flex flex-col justify-between">
						<div class="space-y-4">
							<div class="flex items-center justify-between">
								<div class="flex items-center gap-2">
									<h2 class="text-sm sm:text-base font-bold text-[#191917] font-sans">
										Buyer Requests & Inquiries
									</h2>
									<span class="bg-[#EEF1FD] text-[#4338CA] text-4xs font-bold px-2 py-0.5 rounded-md">
										{{ count($rfqs) }}
									</span>
								</div>
								<a href="{{ url('/supplier/dashboard?tab=rfqs') }}" class="text-xs font-bold text-[#4338CA] hover:underline flex items-center gap-1">
									<span>View All</span>
									<span>&rarr;</span>
								</a>
							</div>

							<!-- RFQ Inquiries or Clean Status -->
							@if(count($rfqs) > 0)
							<div class="space-y-3">
								@foreach(array_slice($rfqs, 0, 2) as $rfq)
								<div class="p-3.5 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1] space-y-2">
									<div class="flex items-center justify-between">
										<span class="text-xs font-bold text-[#191917] truncate">{{ $rfq['qty_needed'] }}x {{ $rfq['item'] }}</span>
										<span class="text-xs font-black text-[#4338CA] price-text">₦{{ number_format($rfq['target_price'], 2) }}/unit</span>
									</div>
									<div class="flex items-center justify-between text-4xs text-[#7A7365]">
										<span>Buyer: {{ $rfq['buyer'] }}</span>
										<a href="{{ url('/supplier/dashboard?tab=rfqs') }}" class="font-bold text-[#191917] hover:underline">Submit Bid &rarr;</a>
									</div>
								</div>
								@endforeach
							</div>
							@else
							<div class="p-5 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1] space-y-2.5">
								<div class="flex items-center gap-2">
									<span class="text-base">⚡</span>
									<h4 class="text-xs font-bold text-[#191917]">Direct Sourcing Inquiries</h4>
								</div>
								<p class="text-3xs text-[#7A7365] leading-relaxed">
									When enterprise buyers submit bulk quote requests matching your catalog categories, you will receive notifications here to submit competitive pricing.
								</p>
								<div class="pt-2 flex items-center gap-2 text-4xs text-[#5C5549]">
									<span class="h-2 w-2 rounded-full bg-emerald-500"></span>
									<span>Catalog auto-matching active</span>
								</div>
							</div>
							@endif

							<!-- Fulfillment Operational Summary -->
							<div class="p-4 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1] space-y-2">
								<h4 class="text-3xs font-bold uppercase tracking-wider text-[#7A7365]">Fulfillment Settings</h4>
								<div class="grid grid-cols-2 gap-2 text-4xs">
									<div>
										<span class="text-[#7A7365]">Standard Lead Time:</span>
										<p class="font-bold text-[#191917] mt-0.5">2 Business Days</p>
									</div>
									<div>
										<span class="text-[#7A7365]">Packing Slip Format:</span>
										<p class="font-bold text-[#191917] mt-0.5">Consolidated Blind Slip</p>
									</div>
								</div>
							</div>
						</div>

						<div class="pt-3 border-t border-[#E0D3C1]">
							<a href="{{ url('/supplier/dashboard?tab=rfqs') }}" class="w-full clay-marshmallow-subtle hover:bg-[#FAF6EE] text-[#191917] py-2.5 px-4 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 text-center">
								<span>Open Buyer Requests Page</span>
								<span>&rarr;</span>
							</a>
						</div>
					</div>

				</div>

				@elseif(($activeTab ?? '') === 'orders')
				<!-- ========================================================================= -->
				<!-- TAB: PURCHASE ORDERS & BLIND DISPATCH                                     -->
				<!-- ========================================================================= -->
				<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 space-y-6 border border-[#E0D3C1]">
					
					<!-- Section Header & Filter Controls -->
					<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
						<div>
							<div class="flex items-center gap-2">
								<h2 class="text-base sm:text-lg font-bold text-[#191917] font-sans">
									Active Purchase Orders & Blind Dispatch
								</h2>
								<span class="bg-[#191917] text-[#FAF6EE] text-4xs font-bold px-2 py-0.5 rounded-md">
									{{ count($orders) }} Orders
								</span>
							</div>
							<p class="text-xs text-[#7A7365] mt-0.5">
								Review incoming wholesale purchase orders, generate EasyBuy blind packing slips, and stage dock pickups.
							</p>
						</div>

						<!-- Search & Filter Input -->
						<div class="flex items-center gap-2.5">
							<div class="clay-input-pill rounded-xl px-3.5 py-2 flex items-center gap-2 w-52 sm:w-64">
								<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
								</svg>
								<input type="text" id="po-search-input" oninput="handleOrderSearch(this.value)" placeholder="Search Orders, Products, Buyers..." class="bg-transparent border-0 text-xs text-[#191917] placeholder:text-[#9C9283] focus:outline-none w-full" />
							</div>
						</div>
					</div>

					<!-- Filter Tabs (Clean Tactile Pills) -->
					<div class="flex items-center gap-2 overflow-x-auto pb-1" id="order-filter-tabs">
						<button onclick="filterOrdersByTab('all', this)" class="order-tab-btn active bg-[#191917] text-[#FAF6EE] px-4 py-2 rounded-xl text-xs font-bold tracking-wide cursor-pointer transition">
							All Orders ({{ count($orders) }})
						</button>
						<button onclick="filterOrdersByTab('awaiting-packing', this)" class="order-tab-btn clay-marshmallow-subtle text-[#5C5549] hover:text-[#191917] px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition cursor-pointer">
							Awaiting Packing
						</button>
						<button onclick="filterOrdersByTab('dock-pickup', this)" class="order-tab-btn clay-marshmallow-subtle text-[#5C5549] hover:text-[#191917] px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition cursor-pointer">
							Dock Pickup
						</button>
						<button onclick="filterOrdersByTab('in-transit', this)" class="order-tab-btn clay-marshmallow-subtle text-[#5C5549] hover:text-[#191917] px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition cursor-pointer">
							In Transit
						</button>
						<button onclick="filterOrdersByTab('settled', this)" class="order-tab-btn clay-marshmallow-subtle text-[#5C5549] hover:text-[#191917] px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition cursor-pointer">
							Settled
						</button>
					</div>

					<!-- 3-Column Card Grid (Orders Only) -->
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="orders-grid-container">
						
						<!-- Dynamic Order Cards Loop -->
						@forelse($orders as $order)
						<div class="order-card clay-marshmallow clay-marshmallow-hover rounded-3xl p-6 flex flex-col justify-between space-y-4 border border-[#E0D3C1] transition"
							data-status="{{ $order['status_key'] }}"
							data-search="{{ strtolower($order['id'] . ' ' . $order['item'] . ' ' . $order['buyer'] . ' ' . $order['sku']) }}">
							
							<div class="space-y-4">
								<!-- Card Header: Buyer Avatar + Status Badge -->
								<div class="flex items-center justify-between gap-2">
									<div class="flex items-center gap-2.5 min-w-0">
										<div class="h-8 w-8 rounded-xl bg-[#191917] text-[#FAF6EE] font-black text-xs flex items-center justify-center shrink-0 shadow-xs">
											{{ substr($order['buyer'], 0, 2) }}
										</div>
										<div class="truncate">
											<span class="block text-xs font-bold text-[#191917] truncate leading-tight">{{ $order['buyer'] }}</span>
											<span class="block text-4xs text-[#7A7365] truncate">{{ $order['destination'] }}</span>
										</div>
									</div>

									<!-- High-Contrast Status Pill -->
									@if($order['status_key'] === 'awaiting-packing')
										<span class="bg-[#FEF0D6] text-[#854D0E] border border-[#FCD34D] text-4xs font-black uppercase tracking-wider px-3 py-1 rounded-xl shrink-0">
											Awaiting Packing
										</span>
									@elseif($order['status_key'] === 'dock-pickup')
										<span class="bg-[#E0F2FE] text-[#075985] border border-[#BAE6FD] text-4xs font-black uppercase tracking-wider px-3 py-1 rounded-xl shrink-0">
											Dock Ready
										</span>
									@elseif($order['status_key'] === 'in-transit')
										<span class="bg-[#EDE9FE] text-[#5B21B6] border border-[#DDD6FE] text-4xs font-black uppercase tracking-wider px-3 py-1 rounded-xl shrink-0">
											In Transit
										</span>
									@else
										<span class="bg-[#DCFCE7] text-[#166534] border border-[#BBF7D0] text-4xs font-black uppercase tracking-wider px-3 py-1 rounded-xl shrink-0">
											Settled
										</span>
									@endif
								</div>

								<!-- Product Details Layout with Image Thumbnail -->
								<div class="flex items-start gap-3.5 pt-1">
									@if(!empty($order['image']))
									<div class="h-14 w-14 rounded-2xl overflow-hidden bg-[#FAF6EE] border border-[#E0D3C1] shrink-0 clay-marshmallow-subtle flex items-center justify-center">
										<img src="{{ $order['image'] }}" alt="{{ $order['item'] }}" class="h-full w-full object-cover" />
									</div>
									@endif
									
									<div class="min-w-0 flex-1">
										<h3 class="text-xs font-bold text-[#191917] product-title leading-snug">
											{{ $order['qty'] }}x {{ $order['item'] }}
										</h3>
										<p class="text-xs text-[#7A7365] mt-1">
											₦{{ number_format($order['unit_price'], 2) }}/unit • <strong class="text-[#191917] font-black price-text">₦{{ number_format($order['total'], 2) }}</strong>
										</p>
									</div>
								</div>

								<!-- Metadata Chips Row -->
								<div class="flex items-center gap-2 flex-wrap text-4xs pt-1">
									<span class="clay-icon-pill px-2.5 py-1 rounded-lg font-mono font-bold text-[#191917]">
										#{{ $order['id'] }}
									</span>
									<span class="clay-icon-pill px-2.5 py-1 rounded-lg font-mono text-[#7A7365]">
										{{ $order['sku'] }}
									</span>
									<span class="clay-icon-pill px-2.5 py-1 rounded-lg text-[#7A7365]">
										Lead: {{ $order['lead_days'] }} Days
									</span>
								</div>
							</div>

							<!-- Bottom Action Bar: Progression Action + Print Blind Slip -->
							<div class="pt-4 border-t border-[#E0D3C1]/80 flex items-center gap-2">
								@if($order['status_key'] === 'awaiting-packing')
								<button type="button" 
									onclick="updateOrderItemStatus({{ $order['order_item_id'] }}, 'packed', '{{ $order['id'] }}')"
									class="flex-1 bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer shadow-xs">
									<span>📦 Mark Packed</span>
									<span>&rarr;</span>
								</button>
								@elseif($order['status_key'] === 'dock-pickup')
								<button type="button" 
									onclick="openDispatchModal({{ $order['order_item_id'] }}, '{{ $order['id'] }}', '{{ addslashes($order['item']) }}', {{ $order['qty'] }})"
									class="flex-1 bg-[#0284C7] hover:bg-[#0369A1] text-[#FAF6EE] py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer shadow-xs">
									<span>🚚 Dispatch</span>
									<span>&rarr;</span>
								</button>
								@elseif($order['status_key'] === 'in-transit')
								<button type="button" 
									onclick="updateOrderItemStatus({{ $order['order_item_id'] }}, 'delivered', '{{ $order['id'] }}')"
									class="flex-1 bg-[#166534] hover:bg-[#14532D] text-[#FAF6EE] py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer shadow-xs">
									<span>✓ Mark Delivered</span>
									<span>&rarr;</span>
								</button>
								@else
								<div class="flex-1 bg-[#DCFCE7] text-[#166534] border border-[#BBF7D0] py-2 px-3 rounded-xl text-xs font-bold flex items-center justify-center gap-1 text-center">
									<span>✓ Settled</span>
								</div>
								@endif

								<button type="button" 
									onclick="openBlindPackingSlip('{{ $order['id'] }}', '{{ $order['buyer'] }}', '{{ $order['item'] }}', {{ $order['qty'] }}, '{{ $order['destination'] }}')"
									title="Print Blind Packing Slip"
									class="clay-marshmallow-subtle hover:bg-[#FAF6EE] text-[#191917] py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center gap-1 cursor-pointer shrink-0 border border-[#E0D3C1]">
									<span>📄 Slip</span>
									<span class="text-3xs">↗</span>
								</button>
							</div>
						</div>
						@empty
						<div class="col-span-full rounded-3xl p-12 bg-[#FAF6EE] border border-[#E0D3C1] text-center space-y-2 flex flex-col items-center justify-center">
							<span class="text-3xl">📦</span>
							<h3 class="text-sm font-bold text-[#191917]">No Active Purchase Orders</h3>
							<p class="text-xs text-[#7A7365] max-w-sm">
								When buyers order your catalog SKUs, they will appear here with instant blind packing slip printouts and dock dispatch controls.
							</p>
						</div>
						@endforelse

					</div>

				</div>

				@elseif(($activeTab ?? '') === 'rfqs')
				<!-- ========================================================================= -->
				<!-- TAB: BUYER REQUESTS & RFQS                                                -->
				<!-- ========================================================================= -->
				<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 space-y-6 border border-[#E0D3C1]">
					
					<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
						<div>
							<div class="flex items-center gap-2">
								<h2 class="text-base sm:text-lg font-bold text-[#191917] font-sans">
									Custom Buyer Requests & Inquiries
								</h2>
								<span class="bg-[#EEF1FD] text-[#4338CA] border border-[#D5DDFC] text-4xs font-bold px-2.5 py-0.5 rounded-md">
									Direct Inquiries
								</span>
							</div>
							<p class="text-xs text-[#7A7365] mt-0.5">
								Direct buyer requests asking for custom bulk quantities, pricing, and factory specifications.
							</p>
						</div>

						<span class="clay-icon-pill px-4 py-2 rounded-xl text-xs font-bold text-[#4338CA] bg-[#EEF1FD] shrink-0">
							{{ count($rfqs) }} Inquiries
						</span>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
						@forelse($rfqs as $rfq)
						<div class="clay-marshmallow clay-marshmallow-hover rounded-3xl p-6 flex flex-col justify-between space-y-4 border border-[#E0D3C1] transition">
							<div class="space-y-3.5">
								<!-- RFQ Header: Reference + Match Score Badge + Due Timer -->
								<div class="flex items-center justify-between gap-2">
									<span class="text-4xs font-mono font-bold text-[#7A7365] bg-[#FAF6EE] px-2.5 py-1 rounded-lg border border-[#E0D3C1]">{{ $rfq['id'] }}</span>
									<div class="flex items-center gap-1.5">
										<span class="bg-[#DCFCE7] text-[#166534] border border-[#BBF7D0] text-4xs font-black px-2.5 py-1 rounded-lg">
											{{ $rfq['match_score'] }}% Match
										</span>
										<span class="bg-[#FEF0D6] text-[#854D0E] border border-[#FCD34D] text-4xs font-bold px-2 py-1 rounded-lg">
											⚡ {{ $rfq['due_in'] }}
										</span>
									</div>
								</div>

								<!-- Product Title with Thumbnail Preview -->
								<div class="flex items-start gap-3 pt-1">
									@if(!empty($rfq['image']))
									<div class="h-12 w-12 rounded-xl overflow-hidden bg-[#FAF6EE] border border-[#E0D3C1] shrink-0 flex items-center justify-center">
										<img src="{{ $rfq['image'] }}" alt="{{ $rfq['item'] }}" class="h-full w-full object-cover" />
									</div>
									@endif
									<div class="min-w-0 flex-1">
										<h3 class="text-xs font-bold text-[#191917] product-title leading-snug">
											{{ $rfq['qty_needed'] }}x {{ $rfq['item'] }}
										</h3>
										<p class="text-3xs text-[#7A7365] mt-0.5">
											Buyer: <strong class="text-[#191917]">{{ $rfq['buyer'] }}</strong> ({{ $rfq['location'] }})
										</p>
									</div>
								</div>

								<!-- Pricing & Target Volume -->
								<div class="p-3 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1] text-xs flex items-center justify-between">
									<span class="text-[#7A7365]">Target Unit Price:</span>
									<span class="font-black text-sm text-[#191917] price-text">₦{{ number_format($rfq['target_price'], 2) }}/unit</span>
								</div>

								<div class="p-3 rounded-2xl bg-[#FAF6EE] text-4xs text-[#7A7365] leading-relaxed border border-[#E0D3C1]/60">
									{{ $rfq['specs'] }}
								</div>
							</div>

							<div class="pt-3 border-t border-[#E0D3C1]/80">
								<button type="button"
									onclick="openBidModal('{{ $rfq['id'] }}', '{{ $rfq['item'] }}', {{ $rfq['qty_needed'] }}, {{ $rfq['target_price'] }})"
									class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] py-2.5 px-4 rounded-xl text-xs font-bold transition flex items-center justify-between cursor-pointer shadow-xs">
									<span>SUBMIT CUSTOM BID</span>
									<span>↗</span>
								</button>
							</div>
						</div>
						@empty
						<div class="col-span-full rounded-3xl p-12 bg-[#FAF6EE] border border-[#E0D3C1] text-center space-y-2 flex flex-col items-center justify-center">
							<span class="text-3xl">📋</span>
							<h3 class="text-sm font-bold text-[#191917]">No Sourcing RFQs Pending</h3>
							<p class="text-xs text-[#7A7365] max-w-sm">Custom volume procurement quotes matching your factory catalog will be displayed here.</p>
						</div>
						@endforelse
					</div>

				</div>

				@elseif(($activeTab ?? '') === 'inventory')
				<!-- ========================================================================= -->
				<!-- TAB: WHOLESALE INVENTORY CATALOG                                          -->
				<!-- ========================================================================= -->
				<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 space-y-6 border border-[#E0D3C1]">
					<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
						<div>
							<h2 class="text-base sm:text-lg font-bold text-[#191917] font-sans">
								My Products & Inventory
							</h2>
							<p class="text-xs text-[#7A7365] mt-0.5">
								Upload product photos, manage warehouse stock, and update wholesale pricing.
							</p>
						</div>

						<button onclick="openAddProductModal()" class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-sm">
							<span>+ Add Product</span>
						</button>
					</div>

					<!-- Inventory Table Grid -->
					<div class="overflow-x-auto">
						<table class="w-full text-left text-xs">
							<thead>
								<tr class="border-b border-[#E0D3C1] text-4xs font-bold uppercase tracking-wider text-[#7A7365]">
									<th class="pb-3">Product Item</th>
									<th class="pb-3">Category</th>
									<th class="pb-3">Stock Available</th>
									<th class="pb-3">Wholesale Price (₦)</th>
									<th class="pb-3">Retail / MSRP (₦)</th>
									<th class="pb-3">Lead Time</th>
									<th class="pb-3 text-right">Actions</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-[#E0D3C1]/50">
								@forelse($inventory as $item)
								<tr class="hover:bg-[#FAF6EE] transition cursor-pointer group" onclick='openProductDetailStudioModal(@json($item))'>
									<td class="py-3.5 pr-3">
										<div class="flex items-center gap-3">
											@if(!empty($item['image']))
											<div class="h-11 w-11 rounded-xl overflow-hidden bg-[#FAF6EE] border border-[#E0D3C1] shrink-0 clay-marshmallow-subtle flex items-center justify-center group-hover:scale-105 transition-transform">
												<img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover" />
											</div>
											@endif
											<div>
												<span class="block font-bold text-[#191917] product-title group-hover:underline">{{ $item['name'] }}</span>
												<span class="font-mono text-4xs text-[#7A7365]">Code: {{ $item['sku'] }} • {{ count($item['images'] ?? []) }} {{ count($item['images'] ?? []) === 1 ? 'photo' : 'photos' }}</span>
											</div>
										</div>
									</td>
									<td class="py-3.5 pr-3 text-3xs text-[#7A7365]">{{ $item['category'] }}</td>
									<td class="py-3.5 pr-3">
										<span class="{{ $item['stock'] < 25 ? 'bg-[#FEF0D6] text-[#854D0E] border-[#FCD34D]' : 'bg-[#DCFCE7] text-[#166534] border-[#BBF7D0]' }} px-2.5 py-1 rounded-lg font-mono font-bold text-4xs border">
											{{ $item['stock'] }} units
										</span>
									</td>
									<td class="py-3.5 pr-3 font-mono font-bold text-emerald-800 price-text">₦{{ number_format($item['tier_2'], 2) }}</td>
									<td class="py-3.5 pr-3 font-mono font-bold text-[#191917] price-text">₦{{ number_format($item['tier_1'], 2) }}</td>
									<td class="py-3.5 pr-3 text-3xs text-[#7A7365]">{{ $item['lead_time'] }}</td>
									<td class="py-3.5 text-right whitespace-nowrap">
										<div class="inline-flex items-center gap-1.5 justify-end">
											<button type="button" 
												onclick='event.stopPropagation(); openProductDetailStudioModal(@json($item))' 
												class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-3 py-1.5 rounded-xl text-3xs font-bold transition inline-flex items-center gap-1 cursor-pointer shadow-xs">
												<span>🔍 View / Edit</span>
											</button>
											<button type="button" 
												onclick="event.stopPropagation(); handleDeleteProduct({{ $item['id'] }}, '{{ addslashes($item['name']) }}')" 
												class="bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 px-2.5 py-1.5 rounded-xl text-3xs font-bold transition inline-flex items-center gap-1 cursor-pointer">
												<span>🗑 Delete</span>
											</button>
										</div>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="7" class="py-12 text-center text-[#7A7365]">
										<div class="flex flex-col items-center justify-center space-y-2">
											<span class="text-3xl">📦</span>
											<p class="font-bold text-sm text-[#191917]">No Products in Catalog</p>
											<p class="text-xs text-[#7A7365] max-w-sm">Click "+ Add Product" to upload your first product with photos, pricing, and stock.</p>
											<button onclick="openAddProductModal()" class="mt-2 bg-[#191917] text-[#FAF6EE] px-4 py-2 rounded-xl text-xs font-bold shadow-sm hover:bg-[#333333] cursor-pointer">
												+ Add First Product
											</button>
										</div>
									</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>

				@elseif(($activeTab ?? '') === 'payouts')
				<!-- ========================================================================= -->
				<!-- TAB: NET-15 PAYOUTS & SETTLEMENTS                                         -->
				<!-- ========================================================================= -->
				<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 space-y-6 border border-[#E0D3C1]">
					<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
						<div>
							<h2 class="text-base sm:text-lg font-bold text-[#191917] font-sans">
								Net-15 Escrow Payouts & Commercial Remittance
							</h2>
							<p class="text-xs text-[#7A7365] mt-0.5">
								Direct ACH deposits for settled purchase orders backed by EasyBuy single-invoice buyer credit.
							</p>
						</div>

						<div class="bg-[#191917] text-[#FAF6EE] px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2">
							<span>🏦</span>
							<span>{{ $metrics['payout_method'] }}</span>
						</div>
					</div>

					<!-- Settlement History Table -->
					<div class="overflow-x-auto">
						<table class="w-full text-left text-xs">
							<thead>
								<tr class="border-b border-[#E0D3C1] text-4xs font-bold uppercase tracking-wider text-[#7A7365]">
									<th class="pb-3">Remittance Ref</th>
									<th class="pb-3">Billing Cycle</th>
									<th class="pb-3">Orders Settled</th>
									<th class="pb-3">Paid Date</th>
									<th class="pb-3">Total Amount</th>
									<th class="pb-3 text-right">Receipt</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-[#E0D3C1]/50">
								@forelse($payoutHistory as $pay)
								<tr class="hover:bg-[#FAF6EE]/50 transition">
									<td class="py-3.5 pr-3 font-mono font-bold text-[#191917]">{{ $pay['ref'] }}</td>
									<td class="py-3.5 pr-3 text-3xs text-[#7A7365]">{{ $pay['period'] }}</td>
									<td class="py-3.5 pr-3 text-3xs font-bold text-[#191917]">{{ $pay['orders_count'] }} orders</td>
									<td class="py-3.5 pr-3 text-3xs text-[#7A7365]">{{ $pay['paid_on'] }}</td>
									<td class="py-3.5 pr-3 font-mono font-black text-emerald-800 price-text text-sm">₦{{ number_format($pay['amount'], 2) }}</td>
									<td class="py-3.5 text-right">
										<button onclick="window.EasyBuyCart.showToast('Downloading remittance PDF {{ $pay['ref'] }}...', null)" class="clay-marshmallow-subtle px-3 py-1.5 rounded-xl text-3xs font-bold text-[#5C5549] hover:text-[#191917] transition cursor-pointer">
											Download PDF ↗
										</button>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="6" class="py-8 text-center text-[#7A7365]">
										<div class="flex flex-col items-center justify-center space-y-1">
											<span class="text-xl">💳</span>
											<p class="font-bold text-xs text-[#191917]">No Settlement Payouts Processed Yet</p>
											<p class="text-3xs text-[#7A7365]">Dispatched and completed purchase orders will generate Net-15 remittance records here.</p>
										</div>
									</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>

				@else
				<!-- Default fallback for unknown tabs -->
				<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 space-y-4 border border-[#E0D3C1] text-center">
					<h2 class="text-base font-bold text-[#191917]">Supplier Workspace</h2>
					<p class="text-xs text-[#7A7365]">Return to the main supplier overview hub to manage your catalog and operations.</p>
					<div class="pt-2">
						<a href="{{ url('/supplier/dashboard?tab=overview') }}" class="bg-[#191917] text-[#FAF6EE] px-4 py-2 rounded-xl text-xs font-bold inline-block">
							Back to Overview Hub
						</a>
					</div>
				</div>
				@endif

			</div>

		</main>

	</div>

	<!-- ==================== MODAL 1: BLIND PACKING SLIP PREVIEW ==================== -->
	<div id="blind-slip-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden animate-fade-in">
		<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 max-w-lg w-full bg-[#FFFFFF] shadow-2xl space-y-6">
			
			<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]">
				<div class="flex items-center gap-2">
					<span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#191917] text-[#FAF6EE] font-black text-xs">
						EB
					</span>
					<div>
						<h3 class="text-sm font-bold text-[#191917] font-sans">EasyBuy Blind Packing Slip</h3>
						<span class="text-4xs text-[#7A7365]">Consolidated B2B Dispatch Document</span>
					</div>
				</div>
				<button onclick="closeBlindPackingSlip()" class="h-8 w-8 rounded-full bg-[#FAF6EE] hover:bg-[#E0D3C1] text-[#191917] flex items-center justify-center font-bold text-xs cursor-pointer">
					✕
				</button>
			</div>

			<!-- Slip Content Preview -->
			<div class="p-5 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1] text-xs space-y-4">
				<div class="flex justify-between items-start">
					<div>
						<span class="block text-4xs font-bold text-[#7A7365] uppercase">Merchant of Record</span>
						<span class="font-bold text-[#191917]">EASYBUY LOGISTICS INC.</span>
						<p class="text-4xs text-[#7A7365]">Single Commercial Tax Invoice Dispatch</p>
					</div>
					<div class="text-right">
						<span class="block text-4xs font-bold text-[#7A7365] uppercase">PO Reference</span>
						<span id="slip-po-num" class="font-mono font-black text-[#191917] text-sm">PO-8821</span>
					</div>
				</div>

				<div class="grid grid-cols-2 gap-3 pt-2 border-t border-dashed border-[#E0D3C1] text-4xs">
					<div>
						<span class="font-bold text-[#7A7365] uppercase">Ship To Destination:</span>
						<p id="slip-dest" class="font-bold text-[#191917] mt-0.5">Austin, TX Corporate Facility</p>
						<p id="slip-buyer" class="text-[#5C5549]">Attn: CloudFlow Inc. Procurement</p>
					</div>
					<div>
						<span class="font-bold text-[#7A7365] uppercase">Dispatch Hub:</span>
						<p class="font-bold text-[#191917] mt-0.5">Warehouse Dock 4 (Chicago, IL)</p>
						<p class="text-[#5C5549]">Carrier: EasyBuy Freight Express</p>
					</div>
				</div>

				<div class="pt-2 border-t border-dashed border-[#E0D3C1]">
					<div class="flex justify-between text-4xs font-bold uppercase text-[#7A7365] mb-1">
						<span>Item Specification</span>
						<span>Qty</span>
					</div>
					<div class="flex justify-between font-bold text-[#191917]">
						<span id="slip-item">Ergonomic Lumbar Mesh Task Chair</span>
						<span id="slip-qty" class="font-mono">40 units</span>
					</div>
				</div>

				<!-- Barcode Simulation -->
				<div class="pt-3 text-center">
					<div class="h-10 bg-repeating-linear-gradient w-48 mx-auto rounded flex items-center justify-center text-4xs font-mono tracking-widest text-[#191917] bg-[#FAF6EE] border border-[#D8C9B5]">
						||| | |||| || | ||| |||| |
					</div>
					<span class="text-4xs font-mono text-[#7A7365] mt-1 block">EB-PKG-8821-CONSOLIDATED</span>
				</div>
			</div>

			<div class="flex gap-3">
				<button onclick="window.EasyBuyCart.showToast('Printing Blind Packing Slip...', null); closeBlindPackingSlip();" 
					class="flex-1 bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-1.5 cursor-pointer shadow-sm transition">
					<span>Print Official Slip</span>
				</button>
				<button onclick="closeBlindPackingSlip()" 
					class="px-4 py-3 rounded-2xl bg-[#FAF6EE] hover:bg-[#EAE0D2] text-xs font-bold text-[#5C5549] transition cursor-pointer">
					Close
				</button>
			</div>

		</div>
	</div>

	<!-- ==================== MODAL 2: ADD PRODUCT ==================== -->
	<div id="add-product-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden animate-fade-in">
		<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-5 bg-[#FAF6EE] border border-[#E0D3C1] max-h-[90vh] overflow-y-auto">
			
			<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]">
				<div>
					<h3 class="text-sm font-bold text-[#191917] font-sans">Add New Product</h3>
					<span class="text-4xs text-[#7A7365]">Upload product photo, set pricing and available warehouse stock</span>
				</div>
				<button onclick="closeAddProductModal()" class="h-8 w-8 rounded-full bg-[#FAF6EE] hover:bg-[#E0D3C1] text-[#191917] flex items-center justify-center font-bold text-xs cursor-pointer">
					✕
				</button>
			</div>

			<form onsubmit="handleAddProductSubmit(event)" class="space-y-3.5 text-xs">
				<!-- Image Upload Zone -->
				<div>
					<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Product Photo</label>
					<div class="flex items-center gap-3 p-3 rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1]">
						<div id="new-product-preview-wrap" class="h-16 w-16 rounded-xl bg-[#FAF6EE] border-2 border-dashed border-[#D8C9B5] flex items-center justify-center overflow-hidden shrink-0">
							<img id="new-product-preview" class="h-full w-full object-cover hidden" alt="Preview" />
							<span id="new-product-preview-icon" class="text-xl text-[#7A7365]">📷</span>
						</div>
						<div class="flex-1 min-w-0">
							<input type="file" id="new-product-file" accept="image/*" onchange="previewSelectedImage(this, 'new-product-preview', 'new-product-preview-icon')" 
								class="w-full text-xs text-[#5C5549] file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-3xs file:font-bold file:bg-[#191917] file:text-[#FAF6EE] hover:file:bg-[#333333] cursor-pointer" />
							<span class="block text-4xs text-[#7A7365] mt-1">PNG, JPG, WEBP up to 5MB (Stored locally in uploads/products)</span>
						</div>
					</div>
				</div>

				<div>
					<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Product Name</label>
					<input type="text" id="new-product-name" required placeholder="e.g. Ergonomic Lumbar Mesh Task Chair" 
						class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
				</div>

				<div class="grid grid-cols-2 gap-3">
					<div>
						<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Category</label>
						<select id="new-product-cat" class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-3 py-2.5 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner">
							<option value="Ergonomics & Workstations">Ergonomics & Workstations</option>
							<option value="IT & Displays">IT & Displays</option>
							<option value="Lighting & Facilities">Lighting & Facilities</option>
							<option value="Janitorial & Restocks">Janitorial & Restocks</option>
							<option value="Commercial Furniture">Commercial Furniture</option>
						</select>
					</div>
					<div>
						<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Available Stock Units</label>
						<input type="number" id="new-product-stock" required min="1" value="50" 
							class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
					</div>
				</div>

				<div class="grid grid-cols-2 gap-3">
					<div>
						<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Wholesale Price (₦)</label>
						<input type="number" step="0.01" id="new-product-price" required placeholder="e.g. 140000" 
							class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs font-mono font-bold text-emerald-800 focus:outline-none shadow-inner" />
					</div>
					<div>
						<label class="block text-4xs font-bold uppercase tracking-wider text-[#7A7365] mb-1">Retail Price / MSRP (₦)</label>
						<input type="number" step="0.01" id="new-product-msrp" placeholder="Optional (+45% auto)" 
							class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs font-mono font-bold text-[#191917] focus:outline-none shadow-inner" />
					</div>
				</div>

				<div>
					<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Product Description (Optional)</label>
					<textarea id="new-product-desc" rows="2" placeholder="Brief product specifications, dimensions, and warranty details..." 
						class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner"></textarea>
				</div>

				<div class="pt-3 flex items-center gap-3">
					<button type="submit" class="flex-1 bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-1.5 shadow-sm cursor-pointer transition">
						<span>Upload & Add Product</span>
						<span>&rarr;</span>
					</button>
					<button type="button" onclick="closeAddProductModal()" class="px-4 py-3 rounded-2xl bg-[#FAF6EE] hover:bg-[#EAE0D2] border border-[#D8C9B5] text-xs font-bold text-[#5C5549] transition cursor-pointer">
						Cancel
					</button>
				</div>
			</form>
		</div>
	</div>

	<!-- ==================== MODAL 4: PRODUCT DETAIL & STUDIO EDITOR ==================== -->
	<div id="product-studio-modal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-3 sm:p-5 hidden animate-fade-in">
		<div class="clay-marshmallow rounded-3xl p-5 sm:p-7 max-w-4xl w-full shadow-2xl space-y-5 bg-[#FAF6EE] border border-[#E0D3C1] max-h-[92vh] flex flex-col justify-between overflow-hidden">
			
			<!-- Studio Header -->
			<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1] shrink-0">
				<div class="flex items-center gap-2.5">
					<span class="flex h-9 w-9 items-center justify-center rounded-2xl bg-[#191917] text-[#FAF6EE] font-black text-xs shadow-xs">
						📦
					</span>
					<div>
						<div class="flex items-center gap-2">
							<h3 id="studio-product-header-name" class="text-sm sm:text-base font-bold text-[#191917] font-sans truncate max-w-xs sm:max-w-md">Product Details & Studio</h3>
							<span id="studio-product-sku-badge" class="bg-[#191917] text-[#FAF6EE] text-4xs font-mono font-bold px-2 py-0.5 rounded-md">EB-SKU-001</span>
						</div>
						<p class="text-4xs text-[#7A7365] mt-0.5">Manage photos, gallery assets, wholesale pricing, and inventory specifications.</p>
					</div>
				</div>
				<button onclick="closeProductStudioModal()" class="h-8 w-8 rounded-full bg-[#FAF6EE] hover:bg-[#E0D3C1] text-[#191917] flex items-center justify-center font-bold text-xs cursor-pointer">
					✕
				</button>
			</div>

			<!-- Main Studio 2-Column Body (Scrollable) -->
			<div class="overflow-y-auto flex-1 pr-1 space-y-5">
				<form id="product-studio-form" onsubmit="handleProductStudioSubmit(event)" class="space-y-5">
					<input type="hidden" id="studio-product-id" />

					<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
						
						<!-- Left Column (5 Cols): Product Photo Gallery Studio -->
						<div class="lg:col-span-5 space-y-3.5">
							<div class="flex items-center justify-between">
								<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917]">Product Gallery Photos</label>
								<span id="studio-image-count-label" class="text-4xs font-bold text-[#7A7365]">1 Photo</span>
							</div>

							<!-- Main Active Photo Preview with Delete / Replace Trigger -->
							<div class="relative w-full h-56 sm:h-64 rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] p-3 flex items-center justify-center overflow-hidden group shadow-inner">
								<img id="studio-active-main-image" class="w-full h-full object-contain mix-blend-multiply transition duration-200" alt="Active Product Photo" />
								
								<!-- Remove Active Photo Overlay Button -->
								<button type="button" onclick="removeActiveStudioImage()" title="Remove this photo from gallery"
									class="absolute top-2.5 right-2.5 h-7 w-7 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 flex items-center justify-center text-xs font-bold transition shadow-xs cursor-pointer">
									🗑
								</button>

								<!-- Primary Badge -->
								<span id="studio-primary-photo-tag" class="absolute bottom-2.5 left-2.5 bg-[#191917]/80 text-[#FAF6EE] backdrop-blur-xs text-4xs font-bold px-2 py-0.5 rounded-md">
									Primary Listing Photo
								</span>
							</div>

							<!-- Thumbnails Filmstrip + Add Photo Button -->
							<div class="space-y-2">
								<div class="flex items-center gap-2 overflow-x-auto pb-1" id="studio-thumbnails-filmstrip">
									<!-- Dynamic Thumbnails Rendered by JS -->
								</div>

								<!-- Upload New Photos Action -->
								<label class="w-full clay-marshmallow-subtle hover:bg-[#FFFFFF] border-2 border-dashed border-[#D8C9B5] hover:border-[#191917] rounded-2xl p-2.5 flex items-center justify-center gap-2 text-xs font-bold text-[#191917] cursor-pointer transition">
									<svg class="h-4 w-4 text-[#5C5549]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
									</svg>
									<span>+ Add Photos (PNG, JPG, WEBP)</span>
									<input type="file" id="studio-new-files-input" multiple accept="image/*" onchange="handleStudioNewFiles(this)" class="hidden" />
								</label>
								<p class="text-4xs text-[#7A7365] text-center">Click any thumbnail to preview or delete • Upload multiple angles</p>
							</div>

						</div>

						<!-- Right Column (7 Cols): Product Fields, Pricing, and Stock -->
						<div class="lg:col-span-7 space-y-3.5 text-xs">
							
							<!-- Title -->
							<div>
								<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Product Title</label>
								<input type="text" id="studio-name" required placeholder="e.g. Ergonomic Lumbar Mesh Task Chair" 
									class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs text-[#191917] font-bold focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
							</div>

							<!-- Category & Lead Time -->
							<div class="grid grid-cols-2 gap-3">
								<div>
									<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Category</label>
									<select id="studio-category" class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-3 py-2.5 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner">
										<option value="Ergonomics & Workstations">Ergonomics & Workstations</option>
										<option value="IT & Infrastructure">IT & Infrastructure</option>
										<option value="Lighting & Facilities">Lighting & Facilities</option>
										<option value="Janitorial & Restocks">Janitorial & Restocks</option>
										<option value="Commercial Furniture">Commercial Furniture</option>
									</select>
								</div>
								<div>
									<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Guaranteed Lead Time</label>
									<input type="text" id="studio-lead-time" placeholder="e.g. 2-3 Business Days" 
										class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
								</div>
							</div>

							<!-- Pricing Breakdown with Live Margin Pill -->
							<div class="p-3.5 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1] space-y-2.5">
								<div class="flex items-center justify-between">
									<span class="text-4xs font-bold uppercase tracking-wider text-[#7A7365]">Commercial Pricing</span>
									<span id="studio-margin-badge" class="bg-[#DCFCE7] text-[#166534] border border-[#BBF7D0] text-4xs font-bold px-2 py-0.5 rounded-md">
										Wholesale Markup: +45%
									</span>
								</div>

								<div class="grid grid-cols-2 gap-3">
									<div>
										<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Wholesale Factory Price (₦)</label>
										<input type="number" step="0.01" id="studio-price" oninput="calculateStudioMargin()" required placeholder="e.g. 140000" 
											class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-3.5 py-2 text-xs font-mono font-bold text-emerald-800 focus:outline-none shadow-inner" />
									</div>
									<div>
										<label class="block text-4xs font-bold uppercase tracking-wider text-[#7A7365] mb-1">Retail / MSRP List Price (₦)</label>
										<input type="number" step="0.01" id="studio-msrp" oninput="calculateStudioMargin()" placeholder="Auto +45%" 
											class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-3.5 py-2 text-xs font-mono font-bold text-[#191917] focus:outline-none shadow-inner" />
									</div>
								</div>
							</div>

							<!-- Stock Units & Warranty -->
							<div class="grid grid-cols-2 gap-3">
								<div>
									<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Warehouse Stock Units</label>
									<input type="number" id="studio-stock" min="0" required 
										class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2 text-xs font-mono font-bold text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
								</div>
								<div>
									<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Warranty Terms</label>
									<input type="text" id="studio-warranty" placeholder="e.g. 3-Year Factory Warranty" 
										class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
								</div>
							</div>

							<!-- Description -->
							<div>
								<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Product Description</label>
								<textarea id="studio-desc" rows="3" placeholder="Specifications, dimensions, commercial materials, and packaging details..." 
									class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner"></textarea>
							</div>

						</div>

					</div>
				</form>
			</div>

			<!-- Studio Footer Action Bar -->
			<div class="pt-3.5 border-t border-[#E0D3C1] flex flex-col sm:flex-row items-center justify-between gap-3 shrink-0">
				<button type="button" onclick="handleStudioDeleteCurrentProduct()" 
					class="w-full sm:w-auto bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 px-3.5 py-2.5 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
					<span>🗑 Delete SKU</span>
				</button>

				<div class="flex items-center gap-2.5 w-full sm:w-auto justify-end">
					<a id="studio-view-storefront-btn" href="#" target="_blank" 
						class="clay-marshmallow-subtle hover:bg-[#FFFFFF] text-[#191917] px-3.5 py-2.5 rounded-xl text-xs font-bold transition inline-flex items-center gap-1 cursor-pointer">
						<span>Live Preview ↗</span>
					</a>
					<button type="button" onclick="closeProductStudioModal()" class="px-4 py-2.5 rounded-xl bg-[#FAF6EE] hover:bg-[#EAE0D2] border border-[#D8C9B5] text-xs font-bold text-[#5C5549] transition cursor-pointer">
						Cancel
					</button>
					<button type="button" onclick="document.getElementById('product-studio-form').requestSubmit()" 
						class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-5 py-2.5 rounded-xl text-xs font-bold shadow-sm flex items-center gap-1.5 transition cursor-pointer">
						<span>💾 Save All Changes</span>
						<span>✓</span>
					</button>
				</div>
			</div>

		</div>
	</div>

	<!-- ==================== MODAL 3: SUBMIT CUSTOM B2B BID ==================== -->
	<div id="bid-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden animate-fade-in">
		<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-5">
			<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]">
				<div>
					<h3 class="text-sm font-bold text-[#191917] font-sans">Submit Wholesale Quote</h3>
					<span id="bid-rfq-ref" class="text-4xs font-mono text-[#7A7365]">RFQ-9041</span>
				</div>
				<button onclick="closeBidModal()" class="h-8 w-8 rounded-full bg-[#FAF6EE] hover:bg-[#E0D3C1] text-[#191917] flex items-center justify-center font-bold text-xs cursor-pointer">
					✕
				</button>
			</div>

			<div class="p-4 rounded-2xl bg-[#FAF6EE] text-xs space-y-1 border border-[#E0D3C1]">
				<h4 id="bid-item-title" class="font-bold text-[#191917]">Ergonomic Task Chairs (60 units)</h4>
				<p class="text-4xs text-[#7A7365]">Buyer Target: <span id="bid-target-price" class="font-bold text-[#191917]">₦118.00/unit</span></p>
			</div>

			<form onsubmit="handleBidSubmit(event)" class="space-y-3 text-xs">
				<div>
					<label class="block text-4xs font-bold uppercase text-[#191917] mb-1">Your Offered Unit Price (₦)</label>
					<input type="number" step="0.01" id="bid-offer-price" required value="115.00" 
						class="w-full rounded-2xl bg-[#FAF6EE] border border-[#D8C9B5] px-4 py-2.5 font-mono font-bold text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
				</div>
				<div>
					<label class="block text-4xs font-bold uppercase text-[#191917] mb-1">Guaranteed Lead Time</label>
					<input type="text" value="2 Business Days (Direct Warehouse Dock Pickup)" readonly 
						class="w-full rounded-2xl bg-[#FAF6EE] border-0 px-4 py-2 text-3xs text-[#7A7365]" />
				</div>
				<button type="submit" class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-1.5 shadow-sm cursor-pointer transition">
					<span>Dispatch Official Quote</span>
					<span>&rarr;</span>
				</button>
			</form>
		</div>
	</div>

	<!-- ==================== MODAL 5: CONFIRM DISPATCH ==================== -->
	<div id="dispatch-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden animate-fade-in">
		<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-5 bg-[#FAF6EE] border border-[#E0D3C1]">
			<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]">
				<div>
					<h3 class="text-sm font-bold text-[#191917] font-sans">Dispatch Order to Dock</h3>
					<span id="dispatch-po-ref" class="text-4xs font-mono text-[#7A7365]">#PO-8821</span>
				</div>
				<button onclick="closeDispatchModal()" class="h-8 w-8 rounded-full bg-[#FAF6EE] hover:bg-[#E0D3C1] text-[#191917] flex items-center justify-center font-bold text-xs cursor-pointer">
					✕
				</button>
			</div>

			<div class="p-4 rounded-2xl bg-[#FFFFFF] text-xs space-y-1.5 border border-[#E0D3C1]">
				<h4 id="dispatch-item-title" class="font-bold text-[#191917]">40x Ergonomic Lumbar Mesh Task Chair</h4>
				<p class="text-3xs text-[#7A7365]">Consolidated Carrier: <strong class="text-[#191917]">EasyBuy Freight Express</strong></p>
			</div>

			<form onsubmit="handleDispatchSubmit(event)" class="space-y-3.5 text-xs">
				<input type="hidden" id="dispatch-order-item-id" />
				<div>
					<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Carrier Waybill / Tracking # (Optional)</label>
					<input type="text" id="dispatch-tracking-number" placeholder="e.g. EB-FRT-992014" 
						class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 font-mono text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
				</div>
				<p class="text-4xs text-[#7A7365] leading-relaxed">
					Confirming dispatch flags this shipment as In Transit and prepares dock pickup verification for the buyer.
				</p>
				<div class="pt-2 flex items-center gap-3">
					<button type="submit" class="flex-1 bg-[#0284C7] hover:bg-[#0369A1] text-[#FAF6EE] py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-1.5 shadow-sm cursor-pointer transition">
						<span>Confirm Dispatch 🚚</span>
						<span>&rarr;</span>
					</button>
					<button type="button" onclick="closeDispatchModal()" class="px-4 py-3 rounded-2xl bg-[#FAF6EE] hover:bg-[#EAE0D2] border border-[#D8C9B5] text-xs font-bold text-[#5C5549] transition cursor-pointer">
						Cancel
					</button>
				</div>
			</form>
		</div>
	</div>

	<!-- ==================== JAVASCRIPT CONTROLLERS ==================== -->
	<script>
		// Order Status Progression Handler (AJAX)
		async function updateOrderItemStatus(orderItemId, nextStatus, poNumber, trackingNumber = null) {
			try {
				const formData = new FormData();
				formData.append('status', nextStatus);
				if (trackingNumber) {
					formData.append('tracking_number', trackingNumber);
				}

				const res = await fetch(`/supplier/order-item/${orderItemId}/status`, {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					},
					body: formData
				});
				const data = await res.json();
				
				const statusNames = {
					'packed': 'Packed & Dock Ready',
					'dispatched': 'In Transit',
					'delivered': 'Delivered & Settled'
				};

				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast(`Order #${poNumber} updated to ${statusNames[nextStatus] || nextStatus}!`, null);
				}
				setTimeout(() => {
					window.location.reload();
				}, 600);
			} catch (err) {
				console.error('Error updating order item status:', err);
				window.location.reload();
			}
		}

		// Dispatch Modal Handlers
		function openDispatchModal(orderItemId, poNumber, itemTitle, qty) {
			document.getElementById('dispatch-order-item-id').value = orderItemId;
			document.getElementById('dispatch-po-ref').innerText = `#${poNumber}`;
			document.getElementById('dispatch-item-title').innerText = `${qty}x ${itemTitle}`;
			document.getElementById('dispatch-tracking-number').value = '';
			document.getElementById('dispatch-modal').classList.remove('hidden');
		}

		function closeDispatchModal() {
			document.getElementById('dispatch-modal').classList.add('hidden');
		}

		function handleDispatchSubmit(e) {
			e.preventDefault();
			const orderItemId = document.getElementById('dispatch-order-item-id').value;
			const poNumber = document.getElementById('dispatch-po-ref').innerText.replace('#', '');
			const tracking = document.getElementById('dispatch-tracking-number').value;
			closeDispatchModal();
			updateOrderItemStatus(orderItemId, 'dispatched', poNumber, tracking);
		}

		// Real-time Order Search Handler
		function handleOrderSearch(query) {
			const q = query.toLowerCase().trim();
			const cards = document.querySelectorAll('.order-card');
			cards.forEach(card => {
				const searchData = card.getAttribute('data-search') || '';
				if (!q || searchData.includes(q)) {
					card.style.display = 'flex';
				} else {
					card.style.display = 'none';
				}
			});
		}

		// Real-time Order Status Filter Handler
		function filterOrdersByTab(statusKey, btnElement) {
			const buttons = document.querySelectorAll('.order-tab-btn');
			buttons.forEach(btn => {
				btn.classList.remove('active', 'bg-[#191917]', 'text-[#FAF6EE]');
				btn.classList.add('clay-marshmallow-subtle', 'text-[#5C5549]');
			});

			if (btnElement) {
				btnElement.classList.remove('clay-marshmallow-subtle', 'text-[#5C5549]');
				btnElement.classList.add('active', 'bg-[#191917]', 'text-[#FAF6EE]');
			}

			const cards = document.querySelectorAll('.order-card');
			cards.forEach(card => {
				const cardStatus = card.getAttribute('data-status');
				if (statusKey === 'all' || cardStatus === statusKey) {
					card.style.display = 'flex';
				} else {
					card.style.display = 'none';
				}
			});
		}

		// Blind Packing Slip Modal Handlers
		function openBlindPackingSlip(poNum, buyer, item, qty, dest) {
			document.getElementById('slip-po-num').innerText = poNum;
			document.getElementById('slip-buyer').innerText = `Attn: ${buyer} Procurement`;
			document.getElementById('slip-item').innerText = item;
			document.getElementById('slip-qty').innerText = `${qty} units`;
			document.getElementById('slip-dest').innerText = dest;
			document.getElementById('blind-slip-modal').classList.remove('hidden');
		}

		function closeBlindPackingSlip() {
			document.getElementById('blind-slip-modal').classList.add('hidden');
		}

		// Live Photo Preview Handler
		function previewSelectedImage(input, imgId, iconId) {
			if (input.files && input.files[0]) {
				const reader = new FileReader();
				reader.onload = function(e) {
					const img = document.getElementById(imgId);
					if (img) {
						img.src = e.target.result;
						img.classList.remove('hidden');
					}
					if (iconId) {
						const icon = document.getElementById(iconId);
						if (icon) icon.classList.add('hidden');
					}
				};
				reader.readAsDataURL(input.files[0]);
			}
		}

		// Add Product Modal Handlers
		function openAddProductModal() {
			document.getElementById('add-product-modal').classList.remove('hidden');
		}

		function closeAddProductModal() {
			document.getElementById('add-product-modal').classList.add('hidden');
		}

		async function handleAddProductSubmit(e) {
			e.preventDefault();
			const formData = new FormData();
			formData.append('name', document.getElementById('new-product-name').value);
			formData.append('category', document.getElementById('new-product-cat').value);
			formData.append('stock', document.getElementById('new-product-stock').value || 0);
			formData.append('price', document.getElementById('new-product-price').value);
			const msrp = document.getElementById('new-product-msrp').value;
			if (msrp) {
				formData.append('msrp', msrp);
			}
			formData.append('description', document.getElementById('new-product-desc').value || '');
			
			const fileInput = document.getElementById('new-product-file');
			if (fileInput && fileInput.files && fileInput.files[0]) {
				formData.append('image_file', fileInput.files[0]);
			}

			try {
				const res = await fetch("{{ route('products.store') }}", {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					},
					body: formData
				});
				const data = await res.json();
				closeAddProductModal();
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast(`Product "${data.product ? data.product.name : 'Item'}" added successfully!`, "{{ url('/supplier/dashboard?tab=inventory') }}", "View &rarr;");
				}
				setTimeout(() => {
					window.location.href = "{{ url('/supplier/dashboard?tab=inventory') }}";
				}, 700);
			} catch (err) {
				console.error('Error creating product:', err);
				closeAddProductModal();
				window.location.href = "{{ url('/supplier/dashboard?tab=inventory') }}";
			}
		}

		// ==================== PRODUCT STUDIO & DETAIL MODAL CONTROLLER ====================
		let studioRetainedImages = [];
		let studioNewFiles = [];
		let studioActiveIndex = 0;

		function openProductDetailStudioModal(product) {
			document.getElementById('studio-product-id').value = product.id;
			document.getElementById('studio-product-header-name').innerText = product.name || 'Product Details';
			document.getElementById('studio-product-sku-badge').innerText = product.sku || ('EB-SKU-' + product.id);
			
			document.getElementById('studio-name').value = product.name || '';
			document.getElementById('studio-category').value = product.category || 'Ergonomics & Workstations';
			document.getElementById('studio-lead-time').value = product.lead_time || '2-3 Business Days';
			document.getElementById('studio-stock').value = product.stock ?? 50;
			document.getElementById('studio-warranty').value = product.warranty || 'Commercial Quality Guarantee';
			document.getElementById('studio-price').value = product.unit_cost || product.tier_2 || product.price || 0;
			document.getElementById('studio-msrp').value = product.tier_1 || product.msrp || 0;
			document.getElementById('studio-desc').value = product.description || '';
			
			// Setup storefront preview link
			document.getElementById('studio-view-storefront-btn').href = `/product/${product.id}`;

			// Setup images
			studioRetainedImages = Array.isArray(product.images) && product.images.length > 0 
				? [...product.images] 
				: (product.image ? [product.image] : ['{{ asset("images/3d-refs/ergo_chair.jpg") }}']);
			studioNewFiles = [];
			studioActiveIndex = 0;

			renderStudioFilmstrip();
			calculateStudioMargin();

			document.getElementById('product-studio-modal').classList.remove('hidden');
		}

		function closeProductStudioModal() {
			document.getElementById('product-studio-modal').classList.add('hidden');
		}

		function renderStudioFilmstrip() {
			const filmstrip = document.getElementById('studio-thumbnails-filmstrip');
			if (!filmstrip) return;
			filmstrip.innerHTML = '';

			const totalImages = studioRetainedImages.length + studioNewFiles.length;
			const countLabel = document.getElementById('studio-image-count-label');
			if (countLabel) {
				countLabel.innerText = `${totalImages} Photo${totalImages === 1 ? '' : 's'}`;
			}

			// Render retained images
			studioRetainedImages.forEach((imgUrl, idx) => {
				const isSelected = (idx === studioActiveIndex);
				const thumb = document.createElement('div');
				thumb.className = `relative h-14 w-14 rounded-xl p-1 shrink-0 cursor-pointer overflow-hidden border transition ${isSelected ? 'border-[#191917] bg-[#FFFFFF] ring-2 ring-[#FFD000]' : 'border-[#E0D3C1] bg-[#FAF6EE] opacity-75 hover:opacity-100'}`;
				thumb.onclick = () => selectStudioImage(idx);

				thumb.innerHTML = `
					<img src="${imgUrl}" class="h-full w-full object-cover rounded-lg mix-blend-multiply" onerror="this.src='{{ asset('images/3d-refs/ergo_chair.jpg') }}'" />
					<button type="button" onclick="event.stopPropagation(); removeStudioRetainedImage(${idx})" title="Remove photo"
						class="absolute top-0.5 right-0.5 h-4 w-4 rounded-full bg-rose-600 text-white flex items-center justify-center text-4xs font-black shadow-xs hover:scale-110 transition">
						✕
					</button>
				`;
				filmstrip.appendChild(thumb);
			});

			// Render newly uploaded files
			studioNewFiles.forEach((fileObj, idx) => {
				const globalIdx = studioRetainedImages.length + idx;
				const isSelected = (globalIdx === studioActiveIndex);
				const thumb = document.createElement('div');
				thumb.className = `relative h-14 w-14 rounded-xl p-1 shrink-0 cursor-pointer overflow-hidden border transition ${isSelected ? 'border-[#191917] bg-[#FFFFFF] ring-2 ring-[#FFD000]' : 'border-[#E0D3C1] bg-[#FAF6EE] opacity-75 hover:opacity-100'}`;
				thumb.onclick = () => selectStudioImage(globalIdx);

				thumb.innerHTML = `
					<img src="${fileObj.previewUrl}" class="h-full w-full object-cover rounded-lg mix-blend-multiply" />
					<span class="absolute bottom-0.5 left-0.5 bg-emerald-700 text-white text-5xs px-1 rounded font-bold">New</span>
					<button type="button" onclick="event.stopPropagation(); removeStudioNewFile(${idx})" title="Remove photo"
						class="absolute top-0.5 right-0.5 h-4 w-4 rounded-full bg-rose-600 text-white flex items-center justify-center text-4xs font-black shadow-xs hover:scale-110 transition">
						✕
					</button>
				`;
				filmstrip.appendChild(thumb);
			});

			// Update main active display
			updateStudioActiveDisplay();
		}

		function selectStudioImage(index) {
			studioActiveIndex = index;
			renderStudioFilmstrip();
		}

		function updateStudioActiveDisplay() {
			const activeImg = document.getElementById('studio-active-main-image');
			const primaryTag = document.getElementById('studio-primary-photo-tag');
			if (!activeImg) return;

			if (studioActiveIndex < studioRetainedImages.length) {
				activeImg.src = studioRetainedImages[studioActiveIndex] || '{{ asset("images/3d-refs/ergo_chair.jpg") }}';
			} else {
				const newIdx = studioActiveIndex - studioRetainedImages.length;
				activeImg.src = studioNewFiles[newIdx] ? studioNewFiles[newIdx].previewUrl : '{{ asset("images/3d-refs/ergo_chair.jpg") }}';
			}

			if (primaryTag) {
				if (studioActiveIndex === 0) {
					primaryTag.innerText = 'Primary Listing Photo';
				} else {
					primaryTag.innerText = `Angle ${studioActiveIndex + 1}`;
				}
			}
		}

		function removeStudioRetainedImage(index) {
			if (studioRetainedImages.length + studioNewFiles.length <= 1) {
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast('Product must have at least one photo. Upload a new photo first.', null);
				} else {
					alert('Product must have at least one photo. Upload a new photo first.');
				}
				return;
			}
			studioRetainedImages.splice(index, 1);
			if (studioActiveIndex >= studioRetainedImages.length + studioNewFiles.length) {
				studioActiveIndex = Math.max(0, studioRetainedImages.length + studioNewFiles.length - 1);
			}
			renderStudioFilmstrip();
		}

		function removeStudioNewFile(index) {
			studioNewFiles.splice(index, 1);
			if (studioActiveIndex >= studioRetainedImages.length + studioNewFiles.length) {
				studioActiveIndex = Math.max(0, studioRetainedImages.length + studioNewFiles.length - 1);
			}
			renderStudioFilmstrip();
		}

		function removeActiveStudioImage() {
			if (studioActiveIndex < studioRetainedImages.length) {
				removeStudioRetainedImage(studioActiveIndex);
			} else {
				removeStudioNewFile(studioActiveIndex - studioRetainedImages.length);
			}
		}

		function handleStudioNewFiles(input) {
			if (input.files && input.files.length > 0) {
				Array.from(input.files).forEach(file => {
					const previewUrl = URL.createObjectURL(file);
					studioNewFiles.push({ file: file, previewUrl: previewUrl });
				});
				studioActiveIndex = studioRetainedImages.length + studioNewFiles.length - 1;
				renderStudioFilmstrip();
			}
		}

		function calculateStudioMargin() {
			const price = parseFloat(document.getElementById('studio-price').value) || 0;
			const msrp = parseFloat(document.getElementById('studio-msrp').value) || 0;
			const badge = document.getElementById('studio-margin-badge');
			if (!badge) return;

			if (price > 0 && msrp > 0) {
				const markup = Math.round(((msrp - price) / price) * 100);
				badge.innerText = `Markup: ${markup >= 0 ? '+' : ''}${markup}% (₦${(msrp - price).toLocaleString(undefined, {minimumFractionDigits: 2})} margin)`;
				badge.className = markup >= 0 
					? 'bg-[#DCFCE7] text-[#166534] border border-[#BBF7D0] text-4xs font-bold px-2 py-0.5 rounded-md'
					: 'bg-rose-50 text-rose-700 border border-rose-200 text-4xs font-bold px-2 py-0.5 rounded-md';
			} else {
				badge.innerText = 'Commercial Pricing';
			}
		}

		async function handleProductStudioSubmit(e) {
			e.preventDefault();
			const id = document.getElementById('studio-product-id').value;
			const formData = new FormData();
			formData.append('_method', 'PUT');
			formData.append('name', document.getElementById('studio-name').value);
			formData.append('category', document.getElementById('studio-category').value);
			formData.append('stock', document.getElementById('studio-stock').value || 0);
			formData.append('price', document.getElementById('studio-price').value);
			const msrp = document.getElementById('studio-msrp').value;
			if (msrp) {
				formData.append('msrp', msrp);
			}
			formData.append('lead_time', document.getElementById('studio-lead-time').value || '2-3 Business Days');
			formData.append('warranty', document.getElementById('studio-warranty').value || 'Commercial Quality Guarantee');
			formData.append('description', document.getElementById('studio-desc').value || '');

			// Send retained images list
			formData.append('images', JSON.stringify(studioRetainedImages));

			// Append new files
			studioNewFiles.forEach(item => {
				formData.append('new_image_files[]', item.file);
			});

			try {
				const res = await fetch(`/products/${id}`, {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					},
					body: formData
				});
				const data = await res.json();
				closeProductStudioModal();
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast(`Product "${data.product ? data.product.name : 'Item'}" updated successfully!`, null);
				}
				setTimeout(() => {
					window.location.href = "{{ url('/supplier/dashboard?tab=inventory') }}";
				}, 600);
			} catch (err) {
				console.error('Error saving product in studio:', err);
				closeProductStudioModal();
				window.location.href = "{{ url('/supplier/dashboard?tab=inventory') }}";
			}
		}

		function handleStudioDeleteCurrentProduct() {
			const id = document.getElementById('studio-product-id').value;
			const name = document.getElementById('studio-name').value;
			closeProductStudioModal();
			handleDeleteProduct(id, name);
		}

		// Delete Product Handler
		async function handleDeleteProduct(id, name) {
			if (!confirm(`Are you sure you want to remove "${name}" from your product catalog?`)) {
				return;
			}

			try {
				const res = await fetch(`/products/${id}`, {
					method: 'DELETE',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					}
				});
				const data = await res.json();
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast(`Product "${name}" deleted from catalog.`, null);
				}
				setTimeout(() => {
					window.location.href = "{{ url('/supplier/dashboard?tab=inventory') }}";
				}, 700);
			} catch (err) {
				console.error('Error deleting product:', err);
				window.location.href = "{{ url('/supplier/dashboard?tab=inventory') }}";
			}
		}

		// RFQ Custom Bid Modal Handlers
		function openBidModal(rfqId, item, qty, target) {
			document.getElementById('bid-rfq-ref').innerText = rfqId;
			document.getElementById('bid-item-title').innerText = `${qty}x ${item}`;
			document.getElementById('bid-target-price').innerText = `₦${target.toFixed(2)}/unit`;
			document.getElementById('bid-offer-price').value = (target * 0.98).toFixed(2);
			document.getElementById('bid-modal').classList.remove('hidden');
		}

		function closeBidModal() {
			document.getElementById('bid-modal').classList.add('hidden');
		}

		function handleBidSubmit(e) {
			e.preventDefault();
			const price = document.getElementById('bid-offer-price').value;
			closeBidModal();
			if (window.EasyBuyCart) {
				window.EasyBuyCart.showToast(`Custom bid (₦${price}/unit) dispatched to buyer!`, null);
			}
		}
	</script>
</x-layout>
