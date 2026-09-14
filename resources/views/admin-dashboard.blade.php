<x-layout title="EasyBuy — Admin Central Operations Panel">
	<!-- Full-Height Admin Dashboard Layout -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED ADMIN SIDEBAR ==================== -->
		<x-admin-sidebar :active="$activeTab" :pendingCount="$metrics['pending_applications']" />

		<!-- ==================== CENTER ADMIN CONTENT CANVAS ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-6 lg:p-8 relative">
			
			<div class="max-w-7xl mx-auto space-y-6 animate-fade-in pb-12">
				
				<!-- Top Header & Subtitle -->
				<div class="pb-4 border-b border-[#E0D3C1]/60">
					<h1 class="text-xl sm:text-2xl font-bold text-[#191917] font-sans tracking-tight">
						@if($activeTab === 'applications')
							Supplier Applications
						@elseif($activeTab === 'suppliers')
							Verified Suppliers Directory
						@elseif($activeTab === 'orders')
							Platform Purchase Orders
						@elseif($activeTab === 'catalog')
							Wholesale Catalog Oversight
						@elseif($activeTab === 'users')
							User Accounts & Access
						@else
							Platform Overview
						@endif
					</h1>
					<p class="text-xs text-[#7A7365] mt-1">
						@if($activeTab === 'applications')
							Review and verify factory supplier credentials and tax documents.
						@elseif($activeTab === 'suppliers')
							Manage active manufacturers, tier accreditation, and supplier profiles.
						@elseif($activeTab === 'orders')
							Track customer purchase orders and fulfillment statuses across the platform.
						@elseif($activeTab === 'catalog')
							Oversee wholesale SKU listings, pricing, and stock inventory.
						@elseif($activeTab === 'users')
							Manage registered buyer and supplier accounts.
						@else
							Live summary of sales volume, supplier approvals, and customer orders.
						@endif
					</p>
				</div>

				<!-- ========================================== -->
				<!-- TAB 1: OVERVIEW METRICS                    -->
				<!-- ========================================== -->
				@if($activeTab === 'overview')
				<div class="space-y-6 animate-fade-in">
					
					<!-- 4 Key Stat Cards (Clean, Human-Understandable & Rich Aesthetics) -->
					<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
						
						<!-- Card 1: Total Sales Revenue -->
						<div class="bg-[#E8F6EC] border border-[#C2E7CD] shadow-xs rounded-3xl p-5 flex flex-col justify-between space-y-3 hover:shadow-md transition">
							<div class="flex items-center justify-between">
								<span class="text-3xs font-black uppercase tracking-wider text-[#2D6A4F]">Total Sales</span>
								<div class="h-8 w-8 rounded-xl bg-[#D3EED8] text-[#134E2E] flex items-center justify-center font-bold text-xs shrink-0">
									₦
								</div>
							</div>
							<div>
								<div class="text-2xl sm:text-3xl font-black text-[#134E2E] font-price tracking-tight">
									₦{{ number_format($metrics['total_volume'], 2) }}
								</div>
								<p class="text-xs font-bold text-[#2D6A4F] mt-1.5">
									{{ $metrics['total_orders'] }} Completed {{ $metrics['total_orders'] === 1 ? 'Order' : 'Orders' }}
								</p>
							</div>
						</div>

						<!-- Card 2: Pending Approvals -->
						<div class="bg-[#FEF4E4] border border-[#F9DEC0] shadow-xs rounded-3xl p-5 flex flex-col justify-between space-y-3 hover:shadow-md transition {{ $metrics['pending_applications'] > 0 ? 'ring-2 ring-amber-400' : '' }}">
							<div class="flex items-center justify-between">
								<span class="text-3xs font-black uppercase tracking-wider text-[#9A5B00]">Pending Approvals</span>
								<div class="h-8 w-8 rounded-xl bg-[#FCE5BF] text-[#6B3E00] flex items-center justify-center text-xs shrink-0">
									📋
								</div>
							</div>
							<div>
								<div class="text-2xl sm:text-3xl font-black text-[#6B3E00] font-price tracking-tight">
									{{ $metrics['pending_applications'] }}
								</div>
								@if($metrics['pending_applications'] > 0)
								<a href="{{ url('/admin?tab=applications') }}" class="text-xs font-bold text-[#6B3E00] hover:underline flex items-center gap-1 mt-1.5">
									<span>Needs Review &rarr;</span>
								</a>
								@else
								<p class="text-xs font-bold text-[#9A5B00] mt-1.5">All applications vetted</p>
								@endif
							</div>
						</div>

						<!-- Card 3: Active Suppliers -->
						<div class="bg-[#EEF1FD] border border-[#D5DDFC] shadow-xs rounded-3xl p-5 flex flex-col justify-between space-y-3 hover:shadow-md transition">
							<div class="flex items-center justify-between">
								<span class="text-3xs font-black uppercase tracking-wider text-[#4338CA]">Active Suppliers</span>
								<div class="h-8 w-8 rounded-xl bg-[#DDE4FC] text-[#282182] flex items-center justify-center text-xs shrink-0">
									🏭
								</div>
							</div>
							<div>
								<div class="text-2xl sm:text-3xl font-black text-[#282182] font-price tracking-tight">
									{{ $metrics['verified_suppliers'] }}
								</div>
								<p class="text-xs font-bold text-[#4338CA] mt-1.5">
									{{ $metrics['verified_suppliers'] === 1 ? '1 Verified seller' : $metrics['verified_suppliers'] . ' Verified sellers' }}
								</p>
							</div>
						</div>

						<!-- Card 4: Customer Orders & Items -->
						<div class="bg-[#F4EFEA] border border-[#E0D3C1] shadow-xs rounded-3xl p-5 flex flex-col justify-between space-y-3 hover:shadow-md transition">
							<div class="flex items-center justify-between">
								<span class="text-3xs font-black uppercase tracking-wider text-[#5C5549]">Customer Orders</span>
								<div class="h-8 w-8 rounded-xl bg-[#E8DECF] text-[#191917] flex items-center justify-center text-xs shrink-0">
									📦
								</div>
							</div>
							<div>
								<div class="text-2xl sm:text-3xl font-black text-[#191917] font-price tracking-tight">
									{{ $metrics['total_orders'] }} {{ $metrics['total_orders'] === 1 ? 'Order' : 'Orders' }}
								</div>
								<p class="text-xs font-bold text-[#7A7365] mt-1.5">
									{{ $metrics['total_order_items'] ?? 5 }} items across {{ $metrics['total_orders'] }} consolidated invoices
								</p>
							</div>
						</div>

					</div>

					<!-- Pending Applications Quick Alert Banner -->
					@if($metrics['pending_applications'] > 0)
					<div class="clay-card rounded-3xl p-6 bg-gradient-to-r from-amber-50 via-[#FAF6EE] to-[#F2EAE0] border-amber-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
						<div class="flex items-center gap-3.5">
							<div class="h-11 w-11 rounded-2xl bg-amber-400 text-[#191917] flex items-center justify-center text-lg font-black shrink-0 shadow-xs">
								⚠️
							</div>
							<div>
								<h3 class="text-sm font-bold text-[#191917] font-heading">
									{{ $metrics['pending_applications'] }} Supplier Applications Awaiting Your Sign-Off
								</h3>
								<p class="text-3xs text-[#5C5549]">
									New direct factory manufacturers have submitted tax documents and warehouse dispatch addresses.
								</p>
							</div>
						</div>
						<a href="{{ url('/admin?tab=applications') }}" 
							class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-4 py-2.5 rounded-xl text-xs font-bold transition flex items-center gap-2 shrink-0 shadow-xs">
							<span>Review & Approve Applications</span>
							<span class="text-[#FFD000]">&rarr;</span>
						</a>
					</div>
					@endif

					<!-- Dual Section: Recent Orders & Latest Applications -->
					<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
						
						<!-- Left: Latest Supplier Applications (6 cols) -->
						<div class="lg:col-span-6 space-y-3">
							<div class="flex items-center justify-between">
								<h3 class="text-sm font-bold text-[#191917] font-sans">Recent Supplier Applications</h3>
								<a href="{{ url('/admin?tab=applications') }}" class="text-3xs font-bold text-[#5C5549] hover:text-[#191917]">View All &rarr;</a>
							</div>

							<div class="space-y-2.5">
								@forelse($allApplications->take(3) as $app)
								<div class="clay-card rounded-2xl p-4 bg-[#F2EAE0] border-0 flex items-center justify-between gap-3">
									<div class="flex items-center gap-3 overflow-hidden">
										<div class="h-9 w-9 rounded-xl bg-[#FAF6EE] text-[#191917] flex items-center justify-center font-black text-xs shrink-0 shadow-2xs">
											{{ strtoupper(substr($app->company_name, 0, 2)) }}
										</div>
										<div class="truncate">
											<h4 class="text-xs font-bold text-[#191917] truncate">{{ $app->company_name }}</h4>
											<p class="text-4xs text-[#7A7365] truncate">{{ $app->primary_category }} • {{ $app->business_type }}</p>
										</div>
									</div>
									<div class="shrink-0 flex items-center gap-2">
										<span class="text-4xs font-bold px-2 py-0.5 rounded-md {{ $app->verification_status === 'approved' ? 'bg-emerald-100 text-emerald-800' : ($app->verification_status === 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-900') }}">
											{{ ucwords(str_replace('_', ' ', $app->verification_status)) }}
										</span>
										<a href="{{ url('/admin?tab=applications') }}" class="text-4xs font-bold text-[#191917] bg-[#FAF6EE] px-2 py-1 rounded-lg border border-[#D8C9B5] hover:bg-[#E8DECF] transition">
											Manage
										</a>
									</div>
								</div>
								@empty
								<p class="text-xs text-[#7A7365] p-4 bg-[#F2EAE0] rounded-2xl">No applications recorded.</p>
								@endforelse
							</div>
						</div>

						<!-- Right: Recent Platform Orders (6 cols) -->
						<div class="lg:col-span-6 space-y-3">
							<div class="flex items-center justify-between">
								<h3 class="text-sm font-bold text-[#191917] font-sans">Recent Customer Orders</h3>
								<a href="{{ url('/admin?tab=orders') }}" class="text-3xs font-bold text-[#5C5549] hover:text-[#191917]">View All &rarr;</a>
							</div>

							<div class="space-y-2.5">
								@forelse($orders->take(3) as $ord)
								<div class="clay-card rounded-2xl p-4 bg-[#F2EAE0] border-0 flex items-center justify-between gap-3">
									<div>
										<div class="flex items-center gap-2">
											<span class="text-xs font-bold text-[#191917] font-price">{{ $ord->order_number }}</span>
											<span class="text-4xs font-bold px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800">
												{{ strtoupper($ord->payment_status) }}
											</span>
										</div>
										<p class="text-4xs text-[#7A7365]">Buyer: {{ $ord->user ? $ord->user->username : 'Buyer' }} • {{ $ord->created_at->diffForHumans() }}</p>
									</div>
									<div class="text-right shrink-0">
										<span class="text-xs font-black text-[#191917] font-price">₦{{ number_format($ord->total_amount, 2) }}</span>
										<a href="{{ url('/order/invoice/' . $ord->order_number) }}" target="_blank" class="block text-4xs font-bold text-blue-800 hover:underline">
											Single Invoice &rarr;
										</a>
									</div>
								</div>
								@empty
								<p class="text-xs text-[#7A7365] p-4 bg-[#F2EAE0] rounded-2xl">No orders recorded yet.</p>
								@endforelse
							</div>
						</div>

					</div>

				</div>
				@endif

				<!-- ==================================================== -->
				<!-- TAB 2: SUPPLIER APPLICATIONS (APPROVE / REJECT PIPELINE) -->
				<!-- ==================================================== -->
				@if($activeTab === 'applications')
				<div class="space-y-6 animate-fade-in">
					
					<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
						<p class="text-xs text-[#5C5549] max-w-2xl">
							Review submitted factory documentation, tax EIN credentials, and assign tier accreditation levels for wholesale catalog listing.
						</p>
						<span class="text-4xs font-bold uppercase tracking-wider text-[#7A7365] bg-[#E8DECF] px-3 py-1.5 rounded-xl self-start sm:self-auto">
							{{ $allApplications->count() }} Total Applications
						</span>
					</div>

					<!-- Applications Pipeline Grid -->
					<div class="grid grid-cols-1 gap-4">
						@forelse($allApplications as $app)
						<div class="clay-card rounded-3xl p-5 sm:p-6 bg-[#F2EAE0] border-0 space-y-4 transition hover:shadow-md" id="app-card-{{ $app->id }}">
							
							<!-- Top Meta Header -->
							<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-[#E0D3C1]/60">
								<div class="flex items-center gap-3">
									<div class="h-10 w-10 rounded-2xl bg-[#191917] text-[#FFD000] flex items-center justify-center font-black text-sm shrink-0 shadow-xs">
										{{ strtoupper(substr($app->company_name, 0, 2)) }}
									</div>
									<div>
										<div class="flex items-center gap-2">
											<h3 class="text-sm sm:text-base font-bold text-[#191917] font-sans">
												{{ $app->company_name }}
											</h3>
											<span class="text-4xs font-mono text-[#7A7365]">Ref: {{ $app->ref_no }}</span>
										</div>
										<p class="text-3xs text-[#5C5549]">
											Applicant Account: <strong class="text-[#191917]">{{ $app->user ? $app->user->email : 'N/A' }}</strong> 
											({{ $app->user ? $app->user->username : 'User' }}) • Submitted {{ $app->created_at->format('M d, Y') }}
										</p>
									</div>
								</div>

								<!-- Status Badge -->
								<div>
									<span id="app-status-badge-{{ $app->id }}" class="text-3xs font-bold px-3 py-1 rounded-full uppercase tracking-wider {{ $app->verification_status === 'approved' ? 'bg-emerald-100 text-emerald-900 border border-emerald-300' : ($app->verification_status === 'rejected' ? 'bg-rose-100 text-rose-900 border border-rose-300' : 'bg-amber-100 text-amber-900 border border-amber-300 animate-pulse') }}">
										{{ ucwords(str_replace('_', ' ', $app->verification_status)) }}
									</span>
								</div>
							</div>

							<!-- Application Details Grid -->
							<div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-[#FAF6EE] p-3.5 rounded-2xl shadow-inner text-xs">
								<div>
									<span class="block text-4xs font-bold uppercase text-[#7A7365]">Business Entity Type</span>
									<span class="font-bold text-[#191917]">{{ $app->business_type }}</span>
								</div>
								<div>
									<span class="block text-4xs font-bold uppercase text-[#7A7365]">Primary Category</span>
									<span class="font-bold text-[#191917]">{{ $app->primary_category }}</span>
								</div>
								<div>
									<span class="block text-4xs font-bold uppercase text-[#7A7365]">Tax ID / EIN</span>
									<span class="font-mono font-bold text-[#191917]">{{ $app->tax_id_ein ?: 'US-EIN-Pending' }}</span>
								</div>
								<div>
									<span class="block text-4xs font-bold uppercase text-[#7A7365]">Dispatch Lead Time</span>
									<span class="font-bold text-[#191917]">{{ $app->lead_time_days }} Business Days</span>
								</div>
							</div>

							<!-- Warehouse Pickup Address -->
							<div class="text-xs text-[#5C5549] flex items-start gap-2 bg-[#FAF6EE] px-3.5 py-2.5 rounded-xl">
								<svg class="h-4 w-4 text-[#7A7365] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
								</svg>
								<span><strong>Warehouse Pickup Dock:</strong> {{ $app->warehouse_address ?: 'Warehouse Bay 4, Logistics Blvd' }}</span>
							</div>

							<!-- Admin Action Bar -->
							<div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 pt-2">
								<div class="flex items-center gap-2">
									<label for="tier-select-{{ $app->id }}" class="text-3xs font-bold uppercase text-[#7A7365]">Accreditation Tier:</label>
									<select id="tier-select-{{ $app->id }}" class="bg-[#FAF6EE] border border-[#D8C9B5] text-xs font-bold rounded-xl px-2.5 py-1 text-[#191917] focus:outline-none focus:ring-1 focus:ring-[#FFD000]">
										<option value="Tier 1 Verified Manufacturer" {{ $app->tier_level === 'Tier 1 Verified Manufacturer' ? 'selected' : '' }}>Tier 1 Verified Manufacturer</option>
										<option value="Tier 2 Authorized Wholesaler" {{ $app->tier_level === 'Tier 2 Authorized Wholesaler' ? 'selected' : '' }}>Tier 2 Authorized Wholesaler</option>
										<option value="Standard Supplier" {{ $app->tier_level === 'Standard Supplier' ? 'selected' : '' }}>Standard Supplier</option>
									</select>
								</div>

								<div class="flex items-center gap-2 justify-end">
									<!-- Reject Action -->
									<form action="{{ route('admin.applications.reject', $app->id) }}" method="POST" onsubmit="handleApplicationAction(event, '{{ $app->id }}', 'reject')">
										@csrf
										<button type="submit" class="px-3.5 py-2 rounded-xl text-xs font-bold text-rose-700 hover:bg-rose-100 border border-rose-200 transition cursor-pointer">
											Reject
										</button>
									</form>

									<!-- Approve Action -->
									<form action="{{ route('admin.applications.approve', $app->id) }}" method="POST" onsubmit="handleApplicationAction(event, '{{ $app->id }}', 'approve')">
										@csrf
										<input type="hidden" name="tier_level" id="form-tier-{{ $app->id }}" value="Tier 1 Verified Manufacturer">
										<button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#FFD000] text-[#191917] hover:bg-[#F2C200] transition flex items-center gap-1.5 shadow-xs cursor-pointer">
											<span>Approve Supplier</span>
											<span>✓</span>
										</button>
									</form>
								</div>
							</div>

						</div>
						@empty
						<div class="clay-card rounded-3xl p-12 bg-[#F2EAE0] text-center space-y-2">
							<span class="text-3xl">🎉</span>
							<h3 class="text-base font-bold text-[#191917]">No Pending Supplier Applications</h3>
							<p class="text-xs text-[#7A7365]">All incoming factory applications have been processed.</p>
						</div>
						@endforelse
					</div>

				</div>
				@endif

				<!-- ========================================== -->
				<!-- TAB 3: VERIFIED SUPPLIERS DIRECTORY        -->
				<!-- ========================================== -->
				@if($activeTab === 'suppliers')
				<div class="space-y-6 animate-fade-in">
					<div class="flex items-center justify-between">
						<p class="text-xs text-[#5C5549]">Active direct manufacturers with published wholesale products and Net-15 escrow settlements.</p>
						<span class="text-4xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-3 py-1 rounded-full">
							{{ $verifiedSuppliers->count() }} Active Factories
						</span>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
						@forelse($verifiedSuppliers as $sup)
						<div class="clay-card rounded-3xl p-5 bg-[#F2EAE0] border-0 space-y-3">
							<div class="flex items-center justify-between">
								<div class="h-9 w-9 rounded-xl bg-[#191917] text-[#FFD000] flex items-center justify-center font-black text-xs shadow-xs">
									{{ strtoupper(substr($sup->company_name, 0, 2)) }}
								</div>
								<span class="text-4xs font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
									Active Supplier
								</span>
							</div>

							<div>
								<h3 class="text-sm font-bold text-[#191917] font-sans">{{ $sup->company_name }}</h3>
								<p class="text-3xs text-[#7A7365]">{{ $sup->user ? $sup->user->email : 'Email' }}</p>
							</div>

							<div class="p-2.5 rounded-xl bg-[#FAF6EE] shadow-inner space-y-1 text-3xs">
								<div class="flex justify-between">
									<span class="text-[#7A7365]">Accreditation:</span>
									<span class="font-bold text-[#191917]">{{ $sup->tier_level }}</span>
								</div>
								<div class="flex justify-between">
									<span class="text-[#7A7365]">Assigned SKUs:</span>
									<span class="font-bold text-[#191917]">{{ $sup->products->count() }} Products</span>
								</div>
								<div class="flex justify-between">
									<span class="text-[#7A7365]">Total Settled:</span>
									<span class="font-bold text-[#191917] font-price">₦{{ number_format($sup->total_revenue, 2) }}</span>
								</div>
							</div>

							<form action="{{ route('admin.supplier.tier', $sup->id) }}" method="POST" class="pt-1 flex items-center gap-1.5">
								@csrf
								<select name="tier_level" class="flex-1 bg-[#FAF6EE] border border-[#D8C9B5] text-3xs font-bold rounded-xl px-2 py-1.5 text-[#191917] focus:outline-none">
									<option value="Tier 1 Verified Manufacturer" {{ $sup->tier_level === 'Tier 1 Verified Manufacturer' ? 'selected' : '' }}>Tier 1 Verified</option>
									<option value="Tier 2 Authorized Wholesaler" {{ $sup->tier_level === 'Tier 2 Authorized Wholesaler' ? 'selected' : '' }}>Tier 2 Authorized</option>
									<option value="Standard Supplier" {{ $sup->tier_level === 'Standard Supplier' ? 'selected' : '' }}>Standard</option>
								</select>
								<button type="submit" class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-2.5 py-1.5 rounded-xl text-3xs font-bold cursor-pointer transition">
									Update
								</button>
							</form>
						</div>
						@empty
						<p class="text-xs text-[#7A7365]">No verified suppliers found.</p>
						@endforelse
					</div>
				</div>
				@endif

				<!-- ========================================== -->
				<!-- TAB 4: PLATFORM ORDERS                     -->
				<!-- ========================================== -->
				@if($activeTab === 'orders')
				<div class="space-y-4 animate-fade-in">
					<p class="text-xs text-[#5C5549]">Consolidated single-invoice purchase orders processed across all buyer accounts.</p>
					
					<div class="clay-card rounded-3xl overflow-hidden bg-[#F2EAE0] border-0">
						<div class="overflow-x-auto">
							<table class="w-full text-left text-xs">
								<thead class="bg-[#E8DECF] text-[#7A7365] text-4xs uppercase tracking-wider font-bold">
									<tr>
										<th class="p-3.5">PO Number</th>
										<th class="p-3.5">Buyer</th>
										<th class="p-3.5">Items</th>
										<th class="p-3.5">Total (₦)</th>
										<th class="p-3.5">Payment</th>
										<th class="p-3.5">Fulfillment</th>
										<th class="p-3.5">Action</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-[#E0D3C1]/50 text-[#191917]">
									@forelse($orders as $ord)
									<tr class="hover:bg-[#FAF6EE]/60 transition">
										<td class="p-3.5 font-mono font-bold">{{ $ord->order_number }}</td>
										<td class="p-3.5">
											<span class="font-bold">{{ $ord->user ? $ord->user->username : 'Buyer' }}</span>
											<span class="block text-4xs text-[#7A7365]">{{ $ord->user ? $ord->user->email : '' }}</span>
										</td>
										<td class="p-3.5">{{ $ord->items->count() }} Line Items</td>
										<td class="p-3.5 font-bold font-price">₦{{ number_format($ord->total_amount, 2) }}</td>
										<td class="p-3.5">
											<span class="text-4xs font-bold px-2 py-0.5 rounded-full {{ $ord->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-900' }}">
												{{ strtoupper($ord->payment_status) }}
											</span>
										</td>
										<td class="p-3.5">
											<span class="text-4xs font-bold px-2 py-0.5 rounded-full bg-[#FAF6EE] border border-[#D8C9B5]">
												{{ ucwords($ord->fulfillment_status) }}
											</span>
										</td>
										<td class="p-3.5">
											<a href="{{ url('/order/invoice/' . $ord->order_number) }}" target="_blank" class="text-3xs font-bold text-[#191917] bg-[#FAF6EE] px-2.5 py-1 rounded-lg border border-[#D8C9B5] hover:bg-[#E8DECF] transition inline-block">
												View Invoice &rarr;
											</a>
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="7" class="p-6 text-center text-[#7A7365]">No platform orders recorded.</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
				</div>
				@endif

				<!-- ========================================== -->
				<!-- TAB 5: CATALOG & SKU OVERSIGHT             -->
				<!-- ========================================== -->
				@if($activeTab === 'catalog')
				<div class="space-y-4 animate-fade-in">
					<div class="flex items-center justify-between">
						<p class="text-xs text-[#5C5549]">Monitor all wholesale SKUs listed on the platform and manage manufacturer assignments.</p>
						<span class="text-4xs font-bold uppercase text-[#7A7365] bg-[#E8DECF] px-3 py-1.5 rounded-xl">
							{{ $products->count() }} SKUs
						</span>
					</div>

					<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
						@foreach($products as $prod)
						<div class="clay-card rounded-3xl p-4 bg-[#F2EAE0] border-0 space-y-3 flex flex-col justify-between">
							<div class="space-y-2">
								<div class="h-36 rounded-2xl bg-[#FAF6EE] overflow-hidden flex items-center justify-center relative p-2 shadow-inner">
									<img src="{{ $prod->primary_image }}" alt="{{ $prod->name }}" class="h-full w-full object-contain">
									<span class="absolute top-2 right-2 text-4xs font-bold px-2 py-0.5 rounded-md bg-[#191917] text-[#FFD000]">
										{{ $prod->category }}
									</span>
								</div>
								<h4 class="text-xs font-bold text-[#191917] line-clamp-1">{{ $prod->name }}</h4>
								<div class="flex items-center justify-between text-xs">
									<span class="font-bold text-[#191917] font-price">₦{{ number_format($prod->price, 2) }}</span>
									<span class="text-3xs text-[#7A7365]">Stock: {{ $prod->stock }} units</span>
								</div>
								<p class="text-4xs text-[#7A7365] truncate">
									Supplier: <strong class="text-[#191917]">{{ $prod->supplier ? $prod->supplier->company_name : 'Direct Mfr' }}</strong>
								</p>
							</div>

							<div class="pt-2 border-t border-[#E0D3C1]/60 flex items-center justify-between gap-2">
								<a href="{{ url('/home/product/' . $prod->id) }}" target="_blank" class="text-3xs font-bold text-[#5C5549] hover:text-[#191917]">
									Preview &rarr;
								</a>
								<form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" onsubmit="return confirm('Delist this product SKU from catalog?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="text-3xs font-bold text-rose-700 hover:bg-rose-100 px-2 py-1 rounded-lg border border-rose-200 transition cursor-pointer">
										Delist SKU
									</button>
								</form>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				@endif

				<!-- ========================================== -->
				<!-- TAB 6: USER MANAGEMENT & ROLE RBAC         -->
				<!-- ========================================== -->
				@if($activeTab === 'users')
				<div class="space-y-5 animate-fade-in">
					
					<!-- Top Summary & Filter Bar -->
					<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
						<div>
							<p class="text-xs text-[#5C5549]">
								SuperAdmin user account governance, role assignments (RBAC), and compliance moderation (suspend/ban/reactivate).
							</p>
						</div>
						<div class="flex items-center gap-2 flex-wrap">
							<span class="text-4xs font-bold uppercase text-[#191917] bg-[#E8DECF] px-3 py-1.5 rounded-xl shadow-2xs">
								{{ $users->count() }} Total Users
							</span>
							<span class="text-4xs font-bold uppercase text-emerald-800 bg-emerald-100 px-3 py-1.5 rounded-xl shadow-2xs">
								{{ $users->where('account_status', '!=', 'suspended')->where('account_status', '!=', 'banned')->count() }} Active
							</span>
							@if($users->whereIn('account_status', ['suspended', 'banned'])->count() > 0)
							<span class="text-4xs font-bold uppercase text-rose-800 bg-rose-100 px-3 py-1.5 rounded-xl shadow-2xs animate-pulse">
								{{ $users->whereIn('account_status', ['suspended', 'banned'])->count() }} Restricted
							</span>
							@endif
						</div>
					</div>

					<!-- User Table Card -->
					<div class="clay-card rounded-3xl overflow-hidden bg-[#F2EAE0] border-0 shadow-sm">
						<div class="overflow-x-auto">
							<table class="w-full text-left text-xs">
								<thead class="bg-[#E8DECF] text-[#7A7365] text-4xs uppercase tracking-wider font-bold">
									<tr>
										<th class="p-3.5">User</th>
										<th class="p-3.5">Email & Entity</th>
										<th class="p-3.5">Role</th>
										<th class="p-3.5">Account Status</th>
										<th class="p-3.5">Joined</th>
										<th class="p-3.5 text-right">Moderation Actions</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-[#E0D3C1]/50 text-[#191917]">
									@foreach($users as $u)
									<tr class="hover:bg-[#FAF6EE]/70 transition {{ $u->isBanned() ? 'bg-rose-50/30' : ($u->isSuspended() ? 'bg-amber-50/30' : '') }}">
										
										<!-- Column 1: User Profile -->
										<td class="p-3.5 font-bold">
											<div class="flex items-center gap-2.5">
												<div class="h-8 w-8 rounded-xl {{ $u->isAdmin() ? 'bg-[#191917] text-[#FFD000]' : ($u->isSupplier() ? 'bg-[#134E2E] text-[#FAF6EE]' : 'bg-[#282182] text-[#FAF6EE]') }} font-black text-2xs flex items-center justify-center shrink-0 shadow-2xs">
													{{ strtoupper(substr($u->username, 0, 1)) }}
												</div>
												<div>
													<span class="text-xs font-bold text-[#191917]">{{ $u->username }}</span>
													<span class="block text-4xs font-mono text-[#7A7365]">ID: #{{ $u->id }}</span>
												</div>
											</div>
										</td>

										<!-- Column 2: Email & Entity -->
										<td class="p-3.5">
											<div class="font-mono text-3xs text-[#191917] font-semibold">{{ $u->email }}</div>
											<div class="text-4xs text-[#7A7365] mt-0.5">{{ $u->company_name ?: 'Individual Buyer' }}</div>
										</td>

										<!-- Column 3: Role Switcher -->
										<td class="p-3.5">
											<form action="{{ route('admin.users.role', $u->id) }}" method="POST" class="inline-flex items-center gap-1.5">
												@csrf
												<select name="role" onchange="this.form.submit()" 
													class="bg-[#FAF6EE] border border-[#D8C9B5] text-3xs font-bold rounded-xl px-2.5 py-1 text-[#191917] focus:outline-none focus:ring-1 focus:ring-[#FFD000] cursor-pointer">
													<option value="buyer" {{ $u->role === 'buyer' ? 'selected' : '' }}>Buyer</option>
													<option value="supplier" {{ $u->role === 'supplier' ? 'selected' : '' }}>Supplier</option>
													<option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
												</select>
											</form>
										</td>

										<!-- Column 4: Account Status Badge -->
										<td class="p-3.5">
											@if($u->isBanned())
												<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-4xs font-bold uppercase tracking-wider bg-rose-100 text-rose-900 border border-rose-300">
													<span>⛔ Banned</span>
												</span>
												@if($u->status_reason)
												<span class="block text-4xs text-rose-700 italic mt-0.5 truncate max-w-[140px]" title="{{ $u->status_reason }}">
													{{ $u->status_reason }}
												</span>
												@endif
											@elseif($u->isSuspended())
												<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-4xs font-bold uppercase tracking-wider bg-amber-100 text-amber-900 border border-amber-300 animate-pulse">
													<span>⏸ Suspended</span>
												</span>
												@if($u->status_reason)
												<span class="block text-4xs text-amber-800 italic mt-0.5 truncate max-w-[140px]" title="{{ $u->status_reason }}">
													{{ $u->status_reason }}
												</span>
												@endif
											@else
												<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-4xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-900 border border-emerald-300">
													<span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
													<span>Active</span>
												</span>
											@endif
										</td>

										<!-- Column 5: Joined Date -->
										<td class="p-3.5 text-3xs text-[#7A7365]">
											{{ $u->created_at->format('M d, Y') }}
										</td>

										<!-- Column 6: Moderation Action Buttons -->
										<td class="p-3.5 text-right">
											@if(Auth::id() === $u->id)
												<span class="text-4xs font-bold text-[#7A7365] bg-[#FAF6EE] px-2.5 py-1 rounded-lg border border-[#D8C9B5] inline-block">
													Active Session (You)
												</span>
											@else
												<div class="flex items-center justify-end gap-1.5">
													
													<!-- Action 1: Suspend / Reactivate Toggle -->
													@if($u->isSuspended())
														<form action="{{ route('admin.users.status', $u->id) }}" method="POST" class="inline">
															@csrf
															<input type="hidden" name="account_status" value="active">
															<button type="submit" title="Reactivate user access"
																class="bg-emerald-700 hover:bg-emerald-800 text-[#FAF6EE] px-2.5 py-1 rounded-lg text-3xs font-bold transition cursor-pointer shadow-xs active:scale-95">
																✓ Unsuspend
															</button>
														</form>
													@else
														<button type="button" onclick="openSuspendModal('{{ $u->id }}', '{{ addslashes($u->email) }}')"
															title="Temporarily suspend user"
															class="clay-marshmallow-subtle hover:bg-amber-100 text-amber-900 border border-amber-300 px-2 py-1 rounded-lg text-3xs font-bold transition cursor-pointer active:scale-95">
															⏸ Suspend
														</button>
													@endif

													<!-- Action 2: Ban / Unban Toggle -->
													@if($u->isBanned())
														<form action="{{ route('admin.users.status', $u->id) }}" method="POST" class="inline">
															@csrf
															<input type="hidden" name="account_status" value="active">
															<button type="submit" title="Unban user"
																class="bg-emerald-700 hover:bg-emerald-800 text-[#FAF6EE] px-2.5 py-1 rounded-lg text-3xs font-bold transition cursor-pointer shadow-xs active:scale-95">
																🔓 Unban
															</button>
														</form>
													@else
														<button type="button" onclick="openBanModal('{{ $u->id }}', '{{ addslashes($u->email) }}')"
															title="Permanently ban user"
															class="bg-rose-700 hover:bg-rose-800 text-[#FAF6EE] px-2 py-1 rounded-lg text-3xs font-bold transition cursor-pointer shadow-xs active:scale-95">
															⛔ Ban
														</button>
													@endif

													<!-- Action 3: Reset Password Button -->
													<button type="button" onclick="openResetPasswordModal('{{ $u->id }}', '{{ addslashes($u->email) }}')"
														title="Direct admin password reset"
														class="clay-marshmallow-subtle hover:bg-[#FAF6EE] text-[#5C5549] hover:text-[#191917] p-1.5 rounded-lg text-3xs font-bold transition cursor-pointer">
														🔑
													</button>

													<!-- Action 4: Delete User Account -->
													<form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline"
														onsubmit="return confirm('WARNING: Are you sure you want to PERMANENTLY delete user {{ addslashes($u->email) }}? This cannot be undone.')">
														@csrf
														@method('DELETE')
														<button type="submit" title="Delete user account"
															class="text-rose-700 hover:text-rose-900 hover:bg-rose-100 p-1.5 rounded-lg text-3xs transition cursor-pointer">
															🗑️
														</button>
													</form>

												</div>
											@endif
										</td>

									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

				</div>

				<!-- ==================== MODALS FOR USER MODERATION ==================== -->

				<!-- 1. Suspend User Modal -->
				<div id="suspend-user-modal" class="fixed inset-0 z-50 bg-[#191917]/60 backdrop-blur-xs flex items-center justify-center p-4 hidden animate-fade-in">
					<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 max-w-md w-full bg-[#FAF6EE] border border-[#E0D3C1] shadow-2xl space-y-4">
						<div class="flex items-center justify-between">
							<div class="flex items-center gap-2.5">
								<span class="h-9 w-9 rounded-xl bg-amber-100 text-amber-900 flex items-center justify-center font-black text-sm">
									⏸
								</span>
								<div>
									<h3 class="text-sm font-bold text-[#191917]">Suspend User Account</h3>
									<p id="suspend-user-email-label" class="text-4xs font-mono text-[#7A7365]">user@example.com</p>
								</div>
							</div>
							<button type="button" onclick="closeSuspendModal()" class="text-[#7A7365] hover:text-[#191917] text-lg cursor-pointer">&times;</button>
						</div>

						<form id="suspend-user-form" action="" method="POST" class="space-y-4">
							@csrf
							<input type="hidden" name="account_status" value="suspended">
							
							<div>
								<label for="suspend-reason-input" class="block text-3xs font-bold uppercase text-[#7A7365] mb-1">Reason for Suspension</label>
								<input type="text" id="suspend-reason-input" name="status_reason" placeholder="e.g. KYC audit pending, suspected payment anomaly..." required
									class="w-full bg-[#FAF6EE] border border-[#D8C9B5] rounded-xl px-3 py-2 text-xs text-[#191917] focus:outline-none focus:ring-1 focus:ring-amber-500">
							</div>

							<div class="flex items-center justify-end gap-2 pt-2">
								<button type="button" onclick="closeSuspendModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-[#5C5549] hover:bg-[#E8DECF] transition cursor-pointer">
									Cancel
								</button>
								<button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-amber-500 hover:bg-amber-600 text-[#191917] transition shadow-xs cursor-pointer">
									Confirm Suspension
								</button>
							</div>
						</form>
					</div>
				</div>

				<!-- 2. Ban User Modal -->
				<div id="ban-user-modal" class="fixed inset-0 z-50 bg-[#191917]/60 backdrop-blur-xs flex items-center justify-center p-4 hidden animate-fade-in">
					<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 max-w-md w-full bg-[#FAF6EE] border border-rose-200 shadow-2xl space-y-4">
						<div class="flex items-center justify-between">
							<div class="flex items-center gap-2.5">
								<span class="h-9 w-9 rounded-xl bg-rose-100 text-rose-900 flex items-center justify-center font-black text-sm">
									⛔
								</span>
								<div>
									<h3 class="text-sm font-bold text-rose-900">Ban User Account</h3>
									<p id="ban-user-email-label" class="text-4xs font-mono text-[#7A7365]">user@example.com</p>
								</div>
							</div>
							<button type="button" onclick="closeBanModal()" class="text-[#7A7365] hover:text-[#191917] text-lg cursor-pointer">&times;</button>
						</div>

						<form id="ban-user-form" action="" method="POST" class="space-y-4">
							@csrf
							<input type="hidden" name="account_status" value="banned">
							
							<div>
								<label for="ban-reason-input" class="block text-3xs font-bold uppercase text-[#7A7365] mb-1">Reason for Permanent Ban</label>
								<input type="text" id="ban-reason-input" name="status_reason" placeholder="e.g. Fraudulent activity, chargeback violation..." required
									class="w-full bg-[#FAF6EE] border border-rose-300 rounded-xl px-3 py-2 text-xs text-[#191917] focus:outline-none focus:ring-1 focus:ring-rose-500">
							</div>

							<div class="flex items-center justify-end gap-2 pt-2">
								<button type="button" onclick="closeBanModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-[#5C5549] hover:bg-[#E8DECF] transition cursor-pointer">
									Cancel
								</button>
								<button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-700 hover:bg-rose-800 text-[#FAF6EE] transition shadow-xs cursor-pointer">
									Enforce Permanent Ban
								</button>
							</div>
						</form>
					</div>
				</div>

				<!-- 3. Admin Reset Password Modal -->
				<div id="reset-password-modal" class="fixed inset-0 z-50 bg-[#191917]/60 backdrop-blur-xs flex items-center justify-center p-4 hidden animate-fade-in">
					<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 max-w-md w-full bg-[#FAF6EE] border border-[#E0D3C1] shadow-2xl space-y-4">
						<div class="flex items-center justify-between">
							<div class="flex items-center gap-2.5">
								<span class="h-9 w-9 rounded-xl bg-[#191917] text-[#FFD000] flex items-center justify-center font-black text-sm">
									🔑
								</span>
								<div>
									<h3 class="text-sm font-bold text-[#191917]">Direct Password Reset</h3>
									<p id="reset-pwd-email-label" class="text-4xs font-mono text-[#7A7365]">user@example.com</p>
								</div>
							</div>
							<button type="button" onclick="closeResetPasswordModal()" class="text-[#7A7365] hover:text-[#191917] text-lg cursor-pointer">&times;</button>
						</div>

						<form id="reset-password-form" action="" method="POST" class="space-y-3.5">
							@csrf
							<div>
								<label for="new-admin-password-input" class="block text-3xs font-bold uppercase text-[#7A7365] mb-1">New Password (min 8 chars)</label>
								<input type="password" id="new-admin-password-input" name="password" minlength="8" required
									class="w-full bg-[#FAF6EE] border border-[#D8C9B5] rounded-xl px-3 py-2 text-xs text-[#191917] focus:outline-none focus:ring-1 focus:ring-[#FFD000]">
							</div>

							<div>
								<label for="confirm-admin-password-input" class="block text-3xs font-bold uppercase text-[#7A7365] mb-1">Confirm New Password</label>
								<input type="password" id="confirm-admin-password-input" name="password_confirmation" minlength="8" required
									class="w-full bg-[#FAF6EE] border border-[#D8C9B5] rounded-xl px-3 py-2 text-xs text-[#191917] focus:outline-none focus:ring-1 focus:ring-[#FFD000]">
							</div>

							<div class="flex items-center justify-end gap-2 pt-2">
								<button type="button" onclick="closeResetPasswordModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-[#5C5549] hover:bg-[#E8DECF] transition cursor-pointer">
									Cancel
								</button>
								<button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#191917] hover:bg-[#333333] text-[#FFD000] transition shadow-xs cursor-pointer">
									Update Password
								</button>
							</div>
						</form>
					</div>
				</div>

				@endif

			</div>

		</main>

	</div>

	<!-- ==================== ADMIN JAVASCRIPT ==================== -->
	<script>
		function handleApplicationAction(event, appId, action) {
			const select = document.getElementById(`tier-select-${appId}`);
			const formTier = document.getElementById(`form-tier-${appId}`);
			if (select && formTier) {
				formTier.value = select.value;
			}
		}

		// Suspend Modal Controllers
		function openSuspendModal(userId, userEmail) {
			document.getElementById('suspend-user-form').action = `/admin/users/${userId}/status`;
			document.getElementById('suspend-user-email-label').innerText = userEmail;
			document.getElementById('suspend-reason-input').value = '';
			document.getElementById('suspend-user-modal').classList.remove('hidden');
		}

		function closeSuspendModal() {
			document.getElementById('suspend-user-modal').classList.add('hidden');
		}

		// Ban Modal Controllers
		function openBanModal(userId, userEmail) {
			document.getElementById('ban-user-form').action = `/admin/users/${userId}/status`;
			document.getElementById('ban-user-email-label').innerText = userEmail;
			document.getElementById('ban-reason-input').value = '';
			document.getElementById('ban-user-modal').classList.remove('hidden');
		}

		function closeBanModal() {
			document.getElementById('ban-user-modal').classList.add('hidden');
		}

		// Reset Password Modal Controllers
		function openResetPasswordModal(userId, userEmail) {
			document.getElementById('reset-password-form').action = `/admin/users/${userId}/reset-password`;
			document.getElementById('reset-pwd-email-label').innerText = userEmail;
			document.getElementById('new-admin-password-input').value = '';
			document.getElementById('confirm-admin-password-input').value = '';
			document.getElementById('reset-password-modal').classList.remove('hidden');
		}

		function closeResetPasswordModal() {
			document.getElementById('reset-password-modal').classList.add('hidden');
		}
	</script>
</x-layout>
