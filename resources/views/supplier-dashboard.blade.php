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
						<div class="clay-icon-pill px-3.5 py-1.5 rounded-xl text-3xs font-bold text-[#191917] flex items-center gap-2">
							<span class="h-2 w-2 rounded-full bg-emerald-500"></span>
							<span>{{ $metrics['tier_status'] ?? 'Tier 1 Verified Factory' }}</span>
						</div>
						<div class="clay-icon-pill px-3.5 py-1.5 rounded-xl text-3xs font-bold text-[#5C5549] flex items-center gap-2">
							<span class="h-2 w-2 rounded-full bg-[#191917]"></span>
							<span>Net-15 Payouts Active</span>
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
								<span>{{ $metrics['active_pos'] }} Settled Orders</span>
							</p>
						</div>

						<div class="pt-3 border-t border-[#C2E7CD]/80 text-4xs font-medium text-[#2D6A4F]/80">
							Escrow ACH Settled • Single Invoice
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
								{{ $metrics['active_pos'] }} Orders
							</div>
							<p class="text-xs font-bold text-[#9A5B00] mt-2">
								₦{{ number_format($metrics['in_transit_value'], 2) }} in fulfillment
							</p>
						</div>

						<div class="pt-3 border-t border-[#F9DEC0]/80 text-4xs font-medium text-[#9A5B00]/80">
							{{ $metrics['active_pos'] }} Scheduled for Dock Dispatch
						</div>
					</div>

					<!-- Card 3: Incoming RFQs (Soft Lavender / Royal Indigo Clay Body) -->
					<div class="bg-[#EEF1FD] border border-[#D5DDFC] shadow-sm rounded-3xl p-6 flex flex-col justify-between space-y-4 hover:shadow-md transition">
						<div class="flex items-center justify-between">
							<span class="text-3xs font-black uppercase tracking-wider text-[#4338CA]">Incoming RFQ Bids</span>
							<div class="h-9 w-9 rounded-xl flex items-center justify-center bg-[#DDE4FC] text-[#282182] shadow-2xs shrink-0">
								<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
								</svg>
							</div>
						</div>

						<div>
							<div class="text-2xl sm:text-3xl font-black text-[#282182] price-text tracking-tight leading-none">
								{{ count($rfqs) }} Quotes
							</div>
							<p class="text-xs font-bold text-[#4338CA] mt-2">
								{{ count($rfqs) }} Requests awaiting quote
							</p>
						</div>

						<div class="pt-3 border-t border-[#D5DDFC]/80 text-4xs font-medium text-[#4338CA]/80">
							Live verified sourcing requests
						</div>
					</div>

					<!-- Card 4: Guaranteed Payout (Obsidian Black Luxury Card Body) -->
					<div class="bg-[#191917] border border-[#333333] shadow-lg rounded-3xl p-6 flex flex-col justify-between space-y-4 hover:border-[#555555] transition text-[#FAF6EE]">
						<div class="flex items-center justify-between">
							<span class="text-3xs font-black uppercase tracking-wider text-[#A8A296]">Guaranteed Payout</span>
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
								Net-15 Settlement: {{ $metrics['next_payout_date'] }}
							</p>
						</div>

						<div class="pt-3 border-t border-[#333333] text-4xs font-medium text-[#A8A296] truncate">
							{{ $metrics['payout_method'] }}
						</div>
					</div>

				</div>

				<!-- ==================== 3. SECTION: ACTIVE PURCHASE ORDERS (Clean Clay Grid) ==================== -->
				<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 space-y-6 border border-[#E0D3C1]">
					
					<!-- Section Header & Filter Controls -->
					<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
						<div>
							<div class="flex items-center gap-2">
								<h2 class="text-base sm:text-lg font-bold text-[#191917] font-sans">
									Active Purchase Orders & Blind Dispatch
								</h2>
								<span class="bg-[#191917] text-[#FAF6EE] text-4xs font-bold px-2 py-0.5 rounded-md">
									{{ count($orders) }} Active Orders
								</span>
							</div>
							<p class="text-xs text-[#7A7365] mt-0.5">
								Review incoming wholesale purchase orders, generate EasyBuy blind packing slips, and stage dock pickups.
							</p>
						</div>

						<!-- Search & Action -->
						<div class="flex items-center gap-2.5">
							<div class="clay-input-pill rounded-xl px-3.5 py-2 flex items-center gap-2 w-52 sm:w-64">
								<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
								</svg>
								<input type="text" id="po-search-input" oninput="handleOrderSearch(this.value)" placeholder="Search Orders, Products, Buyers..." class="bg-transparent border-0 text-xs text-[#191917] placeholder:text-[#9C9283] focus:outline-none w-full" />
							</div>

							<button onclick="openAddProductModal()" class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shrink-0 shadow-sm">
								<span>+ Add Product</span>
							</button>
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

					<!-- 3-Column Card Grid -->
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="orders-grid-container">
						
						<!-- Action Card 1: Add New Product (Mint Clay Card) -->
						<div class="bg-[#E8F6EC] border-2 border-dashed border-[#8FD6A3] rounded-3xl p-6 flex flex-col justify-between space-y-4 hover:border-[#2D6A4F] hover:shadow-md transition cursor-pointer group" onclick="openAddProductModal()">
							<div class="space-y-3">
								<div class="flex items-center justify-between">
									<div class="h-10 w-10 rounded-2xl flex items-center justify-center bg-[#2D6A4F] text-[#FAF6EE] font-black text-lg shadow-sm">
										+
									</div>
									<span class="bg-[#D3EED8] text-[#134E2E] text-4xs font-black uppercase tracking-wider px-3 py-1 rounded-lg">
										ADD PRODUCT
									</span>
								</div>

								<div class="space-y-1.5">
									<h3 class="text-sm font-bold text-[#134E2E] font-sans">
										+ Add New Product
									</h3>
									<p class="text-xs text-[#2D6A4F]/80 leading-relaxed">
										Upload product photos, set wholesale and retail prices, and manage available inventory units.
									</p>
								</div>
							</div>

							<div class="pt-3 border-t border-[#C2E7CD] flex items-center justify-between text-xs font-bold text-[#134E2E] group-hover:underline">
								<span>ADD PRODUCT</span>
								<span>↗</span>
							</div>
						</div>

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

							<!-- Bottom Action Button -->
							<div class="pt-4 border-t border-[#E0D3C1]/80">
								@if($order['blind_slip_ready'])
								<button type="button" 
									onclick="openBlindPackingSlip('{{ $order['id'] }}', '{{ $order['buyer'] }}', '{{ $order['item'] }}', {{ $order['qty'] }}, '{{ $order['destination'] }}')"
									class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] py-2.5 px-4 rounded-xl text-xs font-bold transition flex items-center justify-between cursor-pointer shadow-xs">
									<span>PRINT BLIND SLIP</span>
									<span>↗</span>
								</button>
								@else
								<button type="button"
									onclick="window.EasyBuyCart.showToast('Escrow settlement invoice generated for {{ $order['id'] }}', null)"
									class="w-full clay-marshmallow-subtle hover:bg-[#FAF6EE] text-[#191917] py-2.5 px-4 rounded-xl text-xs font-bold transition flex items-center justify-between cursor-pointer">
									<span>SETTLEMENT RECEIPT</span>
									<span>✓</span>
								</button>
								@endif
							</div>
						</div>
						@empty
						<div class="col-span-1 md:col-span-2 rounded-3xl p-8 bg-[#FAF6EE] border border-[#E0D3C1] text-center space-y-2 flex flex-col items-center justify-center">
							<span class="text-2xl">📦</span>
							<h3 class="text-xs font-bold text-[#191917]">No Active Orders Assigned</h3>
							<p class="text-3xs text-[#7A7365] max-w-sm">
								When buyers order your catalog SKUs, they will appear here with instant blind packing slip printouts.
							</p>
						</div>
						@endforelse

					</div>

					<!-- Show More Button -->
					<div class="text-center pt-2">
						<a href="{{ url('/supplier/dashboard?tab=orders') }}" class="clay-marshmallow-subtle px-6 py-3 rounded-2xl text-xs font-bold text-[#5C5549] hover:text-[#191917] transition inline-flex items-center gap-2 cursor-pointer">
							<span>Show All Purchase Orders ({{ count($orders) }})</span>
							<span class="text-3xs">▼</span>
						</a>
					</div>

				</div>

				<!-- ==================== 4. SECTION: INCOMING B2B RFQS & SOURCING BIDS ==================== -->
				<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 space-y-6 border border-[#E0D3C1]">
					
					<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
						<div>
							<div class="flex items-center gap-2">
								<h2 class="text-base sm:text-lg font-bold text-[#191917] font-sans">
									Incoming B2B Sourcing Requests
								</h2>
								<span class="bg-[#EEF1FD] text-[#4338CA] border border-[#D5DDFC] text-4xs font-bold px-2.5 py-0.5 rounded-md">
									AI Pre-Matched
								</span>
							</div>
							<p class="text-xs text-[#7A7365] mt-0.5">
								Direct enterprise procurement RFQs looking for custom volume batches with guaranteed Net-15 escrow.
							</p>
						</div>

						<span class="clay-icon-pill px-4 py-2 rounded-xl text-xs font-bold text-[#4338CA] bg-[#EEF1FD] shrink-0">
							{{ count($rfqs) }} Matched Requests
						</span>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
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
						<div class="col-span-full rounded-3xl p-8 bg-[#FAF6EE] border border-[#E0D3C1] text-center space-y-2">
							<span class="text-xl">📋</span>
							<h3 class="text-xs font-bold text-[#191917]">No Sourcing RFQs Pending</h3>
							<p class="text-3xs text-[#7A7365]">Custom volume procurement quotes matching your factory catalog will be displayed here.</p>
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
								<tr class="hover:bg-[#FAF6EE]/50 transition">
									<td class="py-3.5 pr-3">
										<div class="flex items-center gap-3">
											@if(!empty($item['image']))
											<img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-10 w-10 rounded-xl object-cover bg-[#FAF6EE] border border-[#E0D3C1] shrink-0" />
											@endif
											<div>
												<span class="block font-bold text-[#191917] product-title">{{ $item['name'] }}</span>
												<span class="font-mono text-4xs text-[#7A7365]">Code: {{ $item['sku'] }}</span>
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
												onclick='openEditProductModal(@json($item))' 
												class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-3 py-1.5 rounded-xl text-3xs font-bold transition inline-flex items-center gap-1 cursor-pointer shadow-xs">
												<span>✏️ Edit</span>
											</button>
											<button type="button" 
												onclick="handleDeleteProduct({{ $item['id'] }}, '{{ addslashes($item['name']) }}')" 
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
				<!-- Default fallback for other tabs -->
				<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 space-y-4 border border-[#E0D3C1] text-center">
					<h2 class="text-base font-bold text-[#191917]">Wholesale Purchase Orders Board</h2>
					<p class="text-xs text-[#7A7365]">Managing all {{ count($orders) }} wholesale orders with blind packing slips.</p>
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

	<!-- ==================== MODAL 4: EDIT PRODUCT ==================== -->
	<div id="edit-product-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden animate-fade-in">
		<div class="clay-marshmallow rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-5 bg-[#FAF6EE] border border-[#E0D3C1] max-h-[90vh] overflow-y-auto">
			
			<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]">
				<div>
					<h3 class="text-sm font-bold text-[#191917] font-sans">Edit Product</h3>
					<span id="edit-product-code" class="text-4xs font-mono text-[#7A7365]">EB-PRD-001</span>
				</div>
				<button onclick="closeEditProductModal()" class="h-8 w-8 rounded-full bg-[#FAF6EE] hover:bg-[#E0D3C1] text-[#191917] flex items-center justify-center font-bold text-xs cursor-pointer">
					✕
				</button>
			</div>

			<form onsubmit="handleEditProductSubmit(event)" class="space-y-3.5 text-xs">
				<input type="hidden" id="edit-product-id" />

				<!-- Current Photo Preview & Replacement File Picker -->
				<div>
					<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Product Photo</label>
					<div class="flex items-center gap-3 p-3 rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1]">
						<div id="edit-product-preview-wrap" class="h-16 w-16 rounded-xl bg-[#FAF6EE] border border-[#D8C9B5] flex items-center justify-center overflow-hidden shrink-0">
							<img id="edit-product-preview" class="h-full w-full object-cover" alt="Current Photo" />
						</div>
						<div class="flex-1 min-w-0">
							<input type="file" id="edit-product-file" accept="image/*" onchange="previewSelectedImage(this, 'edit-product-preview', null)" 
								class="w-full text-xs text-[#5C5549] file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-3xs file:font-bold file:bg-[#191917] file:text-[#FAF6EE] hover:file:bg-[#333333] cursor-pointer" />
							<span class="block text-4xs text-[#7A7365] mt-1">Select a new image file to replace current photo</span>
						</div>
					</div>
				</div>

				<div>
					<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Product Name</label>
					<input type="text" id="edit-product-name" required 
						class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
				</div>

				<div class="grid grid-cols-2 gap-3">
					<div>
						<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Category</label>
						<select id="edit-product-cat" class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-3 py-2.5 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner">
							<option value="Ergonomics & Workstations">Ergonomics & Workstations</option>
							<option value="IT & Displays">IT & Displays</option>
							<option value="Lighting & Facilities">Lighting & Facilities</option>
							<option value="Janitorial & Restocks">Janitorial & Restocks</option>
							<option value="Commercial Furniture">Commercial Furniture</option>
						</select>
					</div>
					<div>
						<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Available Stock Units</label>
						<input type="number" id="edit-product-stock" required min="0" 
							class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner" />
					</div>
				</div>

				<div class="grid grid-cols-2 gap-3">
					<div>
						<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Wholesale Price (₦)</label>
						<input type="number" step="0.01" id="edit-product-price" required 
							class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs font-mono font-bold text-emerald-800 focus:outline-none shadow-inner" />
					</div>
					<div>
						<label class="block text-4xs font-bold uppercase tracking-wider text-[#7A7365] mb-1">Retail Price / MSRP (₦)</label>
						<input type="number" step="0.01" id="edit-product-msrp" 
							class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2.5 text-xs font-mono font-bold text-[#191917] focus:outline-none shadow-inner" />
					</div>
				</div>

				<div>
					<label class="block text-4xs font-bold uppercase tracking-wider text-[#191917] mb-1">Description</label>
					<textarea id="edit-product-desc" rows="2" 
						class="w-full rounded-2xl bg-[#FFFFFF] border border-[#E0D3C1] px-4 py-2 text-xs text-[#191917] focus:ring-2 focus:ring-[#191917] focus:outline-none shadow-inner"></textarea>
				</div>

				<div class="pt-3 flex items-center gap-3">
					<button type="submit" class="flex-1 bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-1.5 shadow-sm cursor-pointer transition">
						<span>Save Changes</span>
						<span>✓</span>
					</button>
					<button type="button" onclick="closeEditProductModal()" class="px-4 py-3 rounded-2xl bg-[#FAF6EE] hover:bg-[#EAE0D2] border border-[#D8C9B5] text-xs font-bold text-[#5C5549] transition cursor-pointer">
						Cancel
					</button>
				</div>
			</form>
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

	<!-- ==================== JAVASCRIPT CONTROLLERS ==================== -->
	<script>
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

		// Edit Product Modal Handlers
		function openEditProductModal(product) {
			document.getElementById('edit-product-id').value = product.id;
			document.getElementById('edit-product-code').innerText = product.sku || ('EB-PRD-' + product.id);
			document.getElementById('edit-product-name').value = product.name || '';
			document.getElementById('edit-product-cat').value = product.category || 'Ergonomics & Workstations';
			document.getElementById('edit-product-stock').value = product.stock || 0;
			document.getElementById('edit-product-price').value = product.unit_cost || product.tier_2 || 0;
			document.getElementById('edit-product-msrp').value = product.tier_1 || 0;
			document.getElementById('edit-product-desc').value = product.description || '';
			
			const preview = document.getElementById('edit-product-preview');
			if (product.image) {
				preview.src = product.image;
				preview.classList.remove('hidden');
			}
			document.getElementById('edit-product-file').value = '';
			document.getElementById('edit-product-modal').classList.remove('hidden');
		}

		function closeEditProductModal() {
			document.getElementById('edit-product-modal').classList.add('hidden');
		}

		async function handleEditProductSubmit(e) {
			e.preventDefault();
			const id = document.getElementById('edit-product-id').value;
			const formData = new FormData();
			formData.append('_method', 'PUT');
			formData.append('name', document.getElementById('edit-product-name').value);
			formData.append('category', document.getElementById('edit-product-cat').value);
			formData.append('stock', document.getElementById('edit-product-stock').value || 0);
			formData.append('price', document.getElementById('edit-product-price').value);
			const msrp = document.getElementById('edit-product-msrp').value;
			if (msrp) {
				formData.append('msrp', msrp);
			}
			formData.append('description', document.getElementById('edit-product-desc').value || '');
			
			const fileInput = document.getElementById('edit-product-file');
			if (fileInput && fileInput.files && fileInput.files[0]) {
				formData.append('image_file', fileInput.files[0]);
			}

			try {
				const res = await fetch(`/products/${id}`, {
					method: 'POST', // POST with _method=PUT to support multipart file upload
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					},
					body: formData
				});
				const data = await res.json();
				closeEditProductModal();
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast(`Product "${data.product ? data.product.name : 'Item'}" updated successfully!`, null);
				}
				setTimeout(() => {
					window.location.href = "{{ url('/supplier/dashboard?tab=inventory') }}";
				}, 700);
			} catch (err) {
				console.error('Error updating product:', err);
				closeEditProductModal();
				window.location.href = "{{ url('/supplier/dashboard?tab=inventory') }}";
			}
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
