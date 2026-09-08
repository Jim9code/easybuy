<x-layout title="EasyBuy — Admin Central Operations Panel">
	<!-- Full-Height Admin Dashboard Layout -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED ADMIN SIDEBAR ==================== -->
		<x-admin-sidebar :active="$activeTab" :pendingCount="$metrics['pending_applications']" />

		<!-- ==================== CENTER ADMIN CONTENT CANVAS ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-6 lg:p-8 relative">
			
			<div class="max-w-7xl mx-auto space-y-6 animate-fade-in pb-12">
				
				<!-- Top Header & Breadcrumbs -->
				<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#E0D3C1]/60">
					<div class="space-y-1">
						<div class="flex items-center gap-2">
							<span class="h-2 w-2 rounded-full bg-[#FFD000]"></span>
							<span class="text-4xs font-black uppercase tracking-wider text-[#7A7365]">SuperAdmin Central Panel</span>
						</div>
						<h1 class="text-xl sm:text-2xl lg:text-3xl font-black text-[#191917] font-heading tracking-tight">
							@if($activeTab === 'applications')
								Supplier Verification Pipeline
							@elseif($activeTab === 'suppliers')
								Verified Factory Suppliers Directory
							@elseif($activeTab === 'orders')
								Consolidated Platform Orders & POs
							@elseif($activeTab === 'catalog')
								Wholesale Catalog & SKU Oversight
							@elseif($activeTab === 'users')
								Platform User Accounts & Role RBAC
							@else
								Platform Overview & Operations
							@endif
						</h1>
					</div>

					<!-- Navigation Tab Pills -->
					<div class="flex items-center gap-1.5 p-1 rounded-2xl bg-[#E8DECF] text-xs font-bold overflow-x-auto shadow-inner">
						<a href="{{ url('/admin?tab=overview') }}" 
							class="px-3 py-1.5 rounded-xl transition whitespace-nowrap {{ $activeTab === 'overview' ? 'bg-[#191917] text-[#FAF6EE] shadow-xs' : 'text-[#5C5549] hover:text-[#191917]' }}">
							Overview
						</a>
						<a href="{{ url('/admin?tab=applications') }}" 
							class="px-3 py-1.5 rounded-xl transition whitespace-nowrap flex items-center gap-1.5 {{ $activeTab === 'applications' ? 'bg-[#191917] text-[#FAF6EE] shadow-xs' : 'text-[#5C5549] hover:text-[#191917]' }}">
							<span>Applications</span>
							@if($metrics['pending_applications'] > 0)
							<span class="h-4 w-4 rounded-full bg-[#FFD000] text-[#191917] text-4xs font-black flex items-center justify-center">
								{{ $metrics['pending_applications'] }}
							</span>
							@endif
						</a>
						<a href="{{ url('/admin?tab=suppliers') }}" 
							class="px-3 py-1.5 rounded-xl transition whitespace-nowrap {{ $activeTab === 'suppliers' ? 'bg-[#191917] text-[#FAF6EE] shadow-xs' : 'text-[#5C5549] hover:text-[#191917]' }}">
							Suppliers
						</a>
						<a href="{{ url('/admin?tab=orders') }}" 
							class="px-3 py-1.5 rounded-xl transition whitespace-nowrap {{ $activeTab === 'orders' ? 'bg-[#191917] text-[#FAF6EE] shadow-xs' : 'text-[#5C5549] hover:text-[#191917]' }}">
							Orders
						</a>
						<a href="{{ url('/admin?tab=catalog') }}" 
							class="px-3 py-1.5 rounded-xl transition whitespace-nowrap {{ $activeTab === 'catalog' ? 'bg-[#191917] text-[#FAF6EE] shadow-xs' : 'text-[#5C5549] hover:text-[#191917]' }}">
							Catalog
						</a>
						<a href="{{ url('/admin?tab=users') }}" 
							class="px-3 py-1.5 rounded-xl transition whitespace-nowrap {{ $activeTab === 'users' ? 'bg-[#191917] text-[#FAF6EE] shadow-xs' : 'text-[#5C5549] hover:text-[#191917]' }}">
							Users
						</a>
					</div>
				</div>

				<!-- ========================================== -->
				<!-- TAB 1: OVERVIEW METRICS                    -->
				<!-- ========================================== -->
				@if($activeTab === 'overview')
				<div class="space-y-6 animate-fade-in">
					
					<!-- 4 Key Stat Cards -->
					<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
						
						<!-- Metric 1: Platform Sourcing Volume -->
						<div class="clay-card rounded-3xl p-5 bg-[#F2EAE0] border-0 space-y-2">
							<div class="flex items-center justify-between">
								<span class="text-3xs font-bold text-[#7A7365] uppercase tracking-wider">Gross Sourcing Volume</span>
								<span class="h-7 w-7 rounded-xl bg-emerald-500/10 text-emerald-800 flex items-center justify-center font-bold text-xs">
									₦
								</span>
							</div>
							<h3 class="text-xl sm:text-2xl font-black text-[#191917] font-price">
								₦{{ number_format($metrics['total_volume'], 2) }}
							</h3>
							<p class="text-4xs text-emerald-800 font-bold flex items-center gap-1">
								<span>&uarr; +28.4%</span>
								<span class="text-[#7A7365] font-normal">vs last month</span>
							</p>
						</div>

						<!-- Metric 2: Pending Applications (Action Required) -->
						<div class="clay-card rounded-3xl p-5 bg-[#F2EAE0] border-0 space-y-2 {{ $metrics['pending_applications'] > 0 ? 'ring-2 ring-amber-400' : '' }}">
							<div class="flex items-center justify-between">
								<span class="text-3xs font-bold text-[#7A7365] uppercase tracking-wider">Pending Applications</span>
								<span class="h-7 w-7 rounded-xl bg-amber-500/20 text-amber-900 flex items-center justify-center font-bold text-xs">
									📋
								</span>
							</div>
							<h3 class="text-xl sm:text-2xl font-black text-[#191917] font-price">
								{{ $metrics['pending_applications'] }}
							</h3>
							@if($metrics['pending_applications'] > 0)
							<a href="{{ url('/admin?tab=applications') }}" class="text-4xs font-bold text-amber-900 hover:underline flex items-center gap-1">
								<span>Requires KYC Approval</span>
								<span>&rarr;</span>
							</a>
							@else
							<p class="text-4xs text-[#7A7365]">All applicants vetted</p>
							@endif
						</div>

						<!-- Metric 3: Verified Suppliers -->
						<div class="clay-card rounded-3xl p-5 bg-[#F2EAE0] border-0 space-y-2">
							<div class="flex items-center justify-between">
								<span class="text-3xs font-bold text-[#7A7365] uppercase tracking-wider">Verified Suppliers</span>
								<span class="h-7 w-7 rounded-xl bg-[#191917] text-[#FFD000] flex items-center justify-center font-bold text-xs">
									🏭
								</span>
							</div>
							<h3 class="text-xl sm:text-2xl font-black text-[#191917] font-price">
								{{ $metrics['verified_suppliers'] }}
							</h3>
							<p class="text-4xs text-[#7A7365]">Tier-1 direct manufacturers</p>
						</div>

						<!-- Metric 4: Platform Orders -->
						<div class="clay-card rounded-3xl p-5 bg-[#F2EAE0] border-0 space-y-2">
							<div class="flex items-center justify-between">
								<span class="text-3xs font-bold text-[#7A7365] uppercase tracking-wider">Total Consolidated Orders</span>
								<span class="h-7 w-7 rounded-xl bg-blue-500/10 text-blue-900 flex items-center justify-center font-bold text-xs">
									📦
								</span>
							</div>
							<h3 class="text-xl sm:text-2xl font-black text-[#191917] font-price">
								{{ $metrics['total_orders'] }}
							</h3>
							<p class="text-4xs text-[#7A7365]">{{ $metrics['total_products'] }} Active SKUs in Catalog</p>
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
								<h3 class="text-sm font-bold text-[#191917] font-heading">Latest Supplier Inquiries</h3>
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
								<h3 class="text-sm font-bold text-[#191917] font-heading">Recent Platform Settlements</h3>
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
											<h3 class="text-sm sm:text-base font-black text-[#191917] font-heading">
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
								<h3 class="text-sm font-bold text-[#191917] font-heading">{{ $sup->company_name }}</h3>
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
				<div class="space-y-4 animate-fade-in">
					<p class="text-xs text-[#5C5549]">SuperAdmin account management and role-based access control (RBAC).</p>

					<div class="clay-card rounded-3xl overflow-hidden bg-[#F2EAE0] border-0">
						<div class="overflow-x-auto">
							<table class="w-full text-left text-xs">
								<thead class="bg-[#E8DECF] text-[#7A7365] text-4xs uppercase tracking-wider font-bold">
									<tr>
										<th class="p-3.5">User</th>
										<th class="p-3.5">Email</th>
										<th class="p-3.5">Role</th>
										<th class="p-3.5">Company Entity</th>
										<th class="p-3.5">Joined</th>
										<th class="p-3.5 text-right">Change Role</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-[#E0D3C1]/50 text-[#191917]">
									@foreach($users as $u)
									<tr class="hover:bg-[#FAF6EE]/60 transition">
										<td class="p-3.5 font-bold flex items-center gap-2">
											<span class="h-6 w-6 rounded-full bg-[#191917] text-[#FFD000] text-4xs font-bold flex items-center justify-center">
												{{ strtoupper(substr($u->username, 0, 1)) }}
											</span>
											<span>{{ $u->username }}</span>
										</td>
										<td class="p-3.5 font-mono text-3xs">{{ $u->email }}</td>
										<td class="p-3.5">
											<span class="text-4xs font-bold px-2 py-0.5 rounded-full {{ $u->isAdmin() ? 'bg-[#191917] text-[#FFD000]' : ($u->isSupplier() ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-900') }}">
												{{ strtoupper($u->role) }}
											</span>
										</td>
										<td class="p-3.5 text-3xs text-[#7A7365]">{{ $u->company_name ?: 'Individual Buyer' }}</td>
										<td class="p-3.5 text-3xs text-[#7A7365]">{{ $u->created_at->format('M d, Y') }}</td>
										<td class="p-3.5 text-right">
											<form action="{{ route('admin.users.role', $u->id) }}" method="POST" class="inline-flex items-center gap-1">
												@csrf
												<select name="role" class="bg-[#FAF6EE] border border-[#D8C9B5] text-3xs font-bold rounded-xl px-2 py-1 text-[#191917] focus:outline-none">
													<option value="buyer" {{ $u->role === 'buyer' ? 'selected' : '' }}>Buyer</option>
													<option value="supplier" {{ $u->role === 'supplier' ? 'selected' : '' }}>Supplier</option>
													<option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
												</select>
												<button type="submit" class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-2 py-1 rounded-lg text-3xs font-bold transition cursor-pointer">
													Save
												</button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
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
	</script>
</x-layout>
