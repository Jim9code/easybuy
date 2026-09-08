<x-layout title="EasyBuy — Supplier Network Onboarding">
	<!-- Full-Height Dashboard Workspace Layout -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED DASHBOARD SIDEBAR ==================== -->
		<x-dashboard-sidebar active="supplier" />

		<!-- ==================== CENTER SUPPLIER ONBOARDING CANVAS ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-8 lg:p-12 relative">
			
			<div class="max-w-5xl mx-auto space-y-6 sm:space-y-8 animate-fade-in">
				
				<!-- Top Breadcrumbs & Back Navigation -->
				<div class="flex items-center justify-between pb-2 border-b border-[#E0D3C1]/50">
					<a href="{{ url('/home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#5C5549] hover:text-[#191917] transition group">
						<svg class="h-4 w-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
						</svg>
						<span>Back to Ask Easy</span>
					</a>
					<span class="text-4xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-500/10 px-3 py-1 rounded-full">
						Direct Manufacturer & Wholesaler Network
					</span>
				</div>

				<!-- Page Header Title -->
				<div class="space-y-2">
					<h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#191917] font-heading tracking-tight">
						Become a Verified Supplier
					</h1>
					<p class="text-xs sm:text-sm text-[#5C5549] max-w-2xl leading-relaxed">
						Join EasyBuy’s direct wholesale procurement network. Supply verified corporate buyers with guaranteed Net-15 payouts and automated single-invoice dispatch.
					</p>
				</div>

				<!-- Main 2-Column Grid: Value Proposition & Onboarding Form -->
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
					
					<!-- Left Column: Supplier Network Benefits (5 cols) -->
					<div class="lg:col-span-5 space-y-4">
						
						<!-- Benefit 1: Guaranteed Payouts -->
						<div class="clay-card-borderless rounded-3xl p-5 bg-[#F2EAE0] border-0 space-y-2">
							<div class="h-9 w-9 rounded-2xl bg-[#FFD000] text-[#191917] flex items-center justify-center font-bold shadow-2xs">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>
							</div>
							<h3 class="text-xs sm:text-sm font-bold text-[#191917] font-heading">Guaranteed Net-15 Payouts</h3>
							<p class="text-3xs text-[#5C5549] leading-relaxed">
								EasyBuy acts as the merchant of record, guaranteeing automated electronic payouts directly to your bank account every 15 days.
							</p>
						</div>

						<!-- Benefit 2: High-Volume Commercial Demand -->
						<div class="clay-card-borderless rounded-3xl p-5 bg-[#F2EAE0] border-0 space-y-2">
							<div class="h-9 w-9 rounded-2xl bg-[#FAF6EE] text-[#191917] flex items-center justify-center font-bold shadow-2xs">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
								</svg>
							</div>
							<h3 class="text-xs sm:text-sm font-bold text-[#191917] font-heading">High-Volume B2B Demand</h3>
							<p class="text-3xs text-[#5C5549] leading-relaxed">
								Receive bulk purchase orders from funded startups, engineering teams, and corporate facilities managers sourcing complete bills of materials.
							</p>
						</div>

						<!-- Benefit 3: Blind Packing Slips -->
						<div class="clay-card-borderless rounded-3xl p-5 bg-[#F2EAE0] border-0 space-y-2">
							<div class="h-9 w-9 rounded-2xl bg-[#FAF6EE] text-[#191917] flex items-center justify-center font-bold shadow-2xs">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
								</svg>
							</div>
							<h3 class="text-xs sm:text-sm font-bold text-[#191917] font-heading">Unified Logistics & Blind Drops</h3>
							<p class="text-3xs text-[#5C5549] leading-relaxed">
								Print pre-generated EasyBuy packing slips. Our integrated logistics partners coordinate dock pickup directly from your warehouse.
							</p>
						</div>

					</div>

					<!-- Right Column: Application Form (7 cols) -->
					<div class="lg:col-span-7">
						<div class="clay-card-borderless rounded-3xl p-6 sm:p-8 bg-[#F2EAE0] border-0 space-y-5">
							
							<div class="flex items-center justify-between border-b border-[#E0D3C1]/60 pb-3">
								<div>
									<h2 class="text-base sm:text-lg font-bold text-[#191917] font-heading">
										Supplier Application Form
									</h2>
									<p class="text-3xs text-[#7A7365] mt-0.5">
										Complete verification details to join our wholesale directory.
									</p>
								</div>
								<a href="{{ url('/supplier/status') }}" class="text-4xs font-bold text-[#191917] hover:bg-[#FAF6EE] bg-[#FAF6EE] px-2.5 py-1.5 rounded-xl border border-[#D8C9B5] transition shrink-0 flex items-center gap-1">
									<span>Check Status</span>
									<span>&rarr;</span>
								</a>
							</div>

							<form id="standalone-supplier-form" onsubmit="handleStandaloneSupplierSubmit(event)" class="space-y-4">
								
								<!-- Company Name -->
								<div>
									<label class="block text-3xs font-bold uppercase tracking-wider text-[#191917] mb-1.5">
										Company / Legal Entity Name
									</label>
									<input type="text" id="sup-company-input" required placeholder="e.g. Apex Industrial Manufacturing Ltd." 
										class="w-full rounded-2xl bg-[#FAF6EE] border-0 px-4 py-3 text-xs text-[#191917] placeholder:text-[#9C9283] focus:ring-2 focus:ring-[#FFD000] focus:outline-none shadow-inner" />
								</div>

								<!-- Business Type & Primary Category -->
								<div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
									<div>
										<label class="block text-3xs font-bold uppercase tracking-wider text-[#191917] mb-1.5">
											Business Type
										</label>
										<select id="sup-type-input" class="w-full rounded-2xl bg-[#FAF6EE] border-0 px-3.5 py-3 text-xs text-[#191917] focus:ring-2 focus:ring-[#FFD000] focus:outline-none shadow-inner cursor-pointer">
											<option value="Direct Manufacturer">Direct Manufacturer</option>
											<option value="Authorized Wholesaler">Authorized Wholesaler</option>
											<option value="Direct Importer">Direct Importer / Master Distributor</option>
										</select>
									</div>
									<div>
										<label class="block text-3xs font-bold uppercase tracking-wider text-[#191917] mb-1.5">
											Primary Category
										</label>
										<select id="sup-cat-input" class="w-full rounded-2xl bg-[#FAF6EE] border-0 px-3.5 py-3 text-xs text-[#191917] focus:ring-2 focus:ring-[#FFD000] focus:outline-none shadow-inner cursor-pointer">
											<option value="Ergonomics & Workstations">Ergonomics & Workstations</option>
											<option value="IT & Tech Equipment">IT & Tech Equipment</option>
											<option value="Lighting & Facilities">Lighting & Facilities</option>
											<option value="Janitorial & Restocks">Janitorial & Restocks</option>
										</select>
									</div>
								</div>

								<!-- Tax ID & Dispatch Lead Time -->
								<div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
									<div>
										<label class="block text-3xs font-bold uppercase tracking-wider text-[#191917] mb-1.5">
											Tax ID / Business Reg No
										</label>
										<input type="text" id="sup-tax-input" required placeholder="EIN / VAT / RC-109283" 
											class="w-full rounded-2xl bg-[#FAF6EE] border-0 px-4 py-3 text-xs text-[#191917] placeholder:text-[#9C9283] focus:ring-2 focus:ring-[#FFD000] focus:outline-none shadow-inner" />
									</div>
									<div>
										<label class="block text-3xs font-bold uppercase tracking-wider text-[#191917] mb-1.5">
											Dispatch Lead Time (Days)
										</label>
										<input type="number" id="sup-lead-input" min="1" max="30" value="2" 
											class="w-full rounded-2xl bg-[#FAF6EE] border-0 px-4 py-3 text-xs text-[#191917] focus:ring-2 focus:ring-[#FFD000] focus:outline-none shadow-inner" />
									</div>
								</div>

								<!-- Warehouse Pickup Address -->
								<div>
									<label class="block text-3xs font-bold uppercase tracking-wider text-[#191917] mb-1.5">
										Warehouse Pickup Address & City
									</label>
									<input type="text" id="sup-addr-input" required placeholder="Warehouse Bay 4, 102 Logistics Blvd, Chicago, IL" 
										class="w-full rounded-2xl bg-[#FAF6EE] border-0 px-4 py-3 text-xs text-[#191917] placeholder:text-[#9C9283] focus:ring-2 focus:ring-[#FFD000] focus:outline-none shadow-inner" />
								</div>

								<!-- Agreement Checkbox -->
								<div class="flex items-start gap-2.5 p-3.5 rounded-2xl bg-[#FAF6EE] shadow-inner">
									<input type="checkbox" id="sup-terms-input" checked required class="mt-0.5 h-4 w-4 rounded accent-[#FFD000] cursor-pointer" />
									<label for="sup-terms-input" class="text-3xs text-[#5C5549] cursor-pointer leading-relaxed">
										I agree to EasyBuy verified supplier quality standards, blind packing slip protocols, and guaranteed Net-15 supplier payouts.
									</label>
								</div>

								<!-- Submit Button -->
								<div class="pt-2">
									<button type="submit" id="sup-submit-btn" 
										class="w-full clay-btn-yellow py-3.5 px-6 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 cursor-pointer active:scale-95 shadow-sm transition">
										<span id="sup-btn-label">Submit Supplier Application</span>
										<span>&rarr;</span>
									</button>
								</div>

							</form>

						</div>
					</div>

				</div>

			</div>

		</main>

	</div>

	<!-- ==================== SUPPLIER JAVASCRIPT ==================== -->
	<script>
		async function handleStandaloneSupplierSubmit(e) {
			e.preventDefault();
			const company = document.getElementById('sup-company-input').value;
			const type = document.getElementById('sup-type-input').value;
			const category = document.getElementById('sup-cat-input').value;
			const taxId = document.getElementById('sup-tax-input').value;
			const leadTime = document.getElementById('sup-lead-input').value;
			const address = document.getElementById('sup-addr-input').value;

			const btn = document.getElementById('sup-submit-btn');
			const label = document.getElementById('sup-btn-label');

			if (btn && label) {
				btn.disabled = true;
				label.innerText = 'Submitting Application...';
			}

			try {
				const response = await fetch("{{ route('supplier.apply') }}", {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						"Accept": "application/json",
						"X-CSRF-TOKEN": "{{ csrf_token() }}"
					},
					body: JSON.stringify({
						company_name: company,
						business_type: type,
						primary_category: category,
						tax_id_ein: taxId,
						lead_time_days: parseInt(leadTime) || 2,
						warehouse_address: address
					})
				});

				const result = await response.json();

				if (response.ok && result.status === 'success') {
					if (label) label.innerText = 'Application Submitted ✓';
					if (window.EasyBuyCart) {
						window.EasyBuyCart.showToast(result.message, "{{ url('/supplier/status') }}", "View Status");
					}
					setTimeout(() => {
						window.location.href = "{{ url('/supplier/status') }}";
					}, 1200);
				} else {
					if (btn) btn.disabled = false;
					if (label) label.innerText = 'Submit Supplier Application';
					if (window.EasyBuyCart) {
						window.EasyBuyCart.showToast(result.message || 'Error submitting application. Please try again.', null, "");
					}
				}
			} catch (err) {
				if (btn) btn.disabled = false;
				if (label) label.innerText = 'Submit Supplier Application';
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast('Network error submitting application.', null, "");
				}
			}
		}
	</script>
</x-layout>
