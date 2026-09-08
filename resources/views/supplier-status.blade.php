<x-layout title="EasyBuy — Supplier Application Status">
	<!-- Full-Height Dashboard Workspace Layout -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED SUPPLIER / DASHBOARD SIDEBAR ==================== -->
		<x-supplier-sidebar active="status" />

		<!-- ==================== MAIN APPLICATION STATUS CANVAS ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-6 lg:p-10 relative">
			
			<div class="max-w-4xl mx-auto space-y-6 sm:space-y-8 animate-fade-in pb-12">
				
				<!-- Top Breadcrumb & Status Navigation -->
				<div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-[#E0D3C1]">
					<div class="flex items-center gap-3">
						<a href="{{ url('/home') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#5C5549] hover:text-[#191917] transition group">
							<svg class="h-4 w-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
							</svg>
							<span>Buyer Workspace</span>
						</a>
						<span class="text-[#D8C9B5]">/</span>
						<span class="text-xs font-bold text-[#191917]">Supplier Portal</span>
					</div>

					<div class="flex items-center gap-2">
						<span class="text-3xs font-mono font-bold text-[#7A7365] bg-[#F2EAE0] px-3 py-1 rounded-full border border-[#E0D3C1]">
							REF: {{ $application['ref_no'] }}
						</span>
					</div>
				</div>

				<!-- Header Section: Application Status Hero -->
				<div class="clay-card rounded-3xl p-6 sm:p-8 space-y-6 relative overflow-hidden">
					<!-- Ambient Glow -->
					<div class="absolute -right-10 -bottom-10 w-60 h-60 bg-[#FFD000]/20 rounded-full blur-3xl pointer-events-none"></div>

					<div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
						<div class="space-y-2">
							<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#191917] text-[#FAF6EE] text-4xs font-black uppercase tracking-wider">
								<span id="live-status-dot" class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
								<span id="live-status-tag">Application In Review</span>
							</div>
							<h1 class="text-2xl sm:text-3xl font-black text-[#191917] font-heading tracking-tight">
								{{ $application['company_name'] }}
							</h1>
							<p class="text-xs text-[#5C5549] max-w-xl leading-relaxed">
								Your direct wholesale supplier credentials have been received. We are verifying your factory specifications and Net-15 escrow dispatch setup.
							</p>
						</div>

						<!-- Direct CTA to Enter Dashboard -->
						<div class="shrink-0 flex flex-col sm:flex-row md:flex-col gap-2.5">
							<a href="{{ url('/supplier/dashboard') }}" 
								class="clay-btn-yellow px-6 py-3.5 rounded-2xl text-xs font-extrabold flex items-center justify-center gap-2 shadow-sm transition active:scale-95 group">
								<span>Enter Supplier Dashboard</span>
								<span class="group-hover:translate-x-0.5 transition-transform">&rarr;</span>
							</a>
							<a href="{{ url('/supplier') }}" 
								class="text-center px-4 py-2 rounded-xl bg-[#FAF6EE] hover:bg-[#EAE0D2] border border-[#D8C9B5] text-3xs font-bold text-[#5C5549] hover:text-[#191917] transition">
								Edit Application Specs
							</a>
						</div>
					</div>

					<!-- Prototype Status Simulator Switcher Bar -->
					<div class="pt-4 border-t border-[#E0D3C1] flex flex-wrap items-center justify-between gap-3 text-3xs">
						<div class="flex items-center gap-2 text-[#7A7365]">
							<span class="font-bold">Prototype Status Tester:</span>
							<span class="text-4xs opacity-80">(Click to preview different verification stages)</span>
						</div>
						<div class="flex items-center gap-1.5">
							<button onclick="setStatusState('under_review')" id="btn-state-review" class="px-3 py-1.5 rounded-xl bg-[#191917] text-[#FAF6EE] font-bold transition shadow-xs cursor-pointer">
								1. In Review
							</button>
							<button onclick="setStatusState('in_audit')" id="btn-state-audit" class="px-3 py-1.5 rounded-xl bg-[#FAF6EE] hover:bg-[#EAE0D2] text-[#191917] border border-[#D8C9B5] font-bold transition cursor-pointer">
								2. Spec Audit
							</button>
							<button onclick="setStatusState('approved')" id="btn-state-approved" class="px-3 py-1.5 rounded-xl bg-[#FAF6EE] hover:bg-[#EAE0D2] text-emerald-800 border border-[#D8C9B5] font-bold transition cursor-pointer">
								3. Approved ✓
							</button>
						</div>
					</div>
				</div>

				<!-- Verification 4-Stage Stepper -->
				<div class="space-y-4">
					<h3 class="text-sm font-bold uppercase tracking-wider text-[#191917] font-heading flex items-center justify-between">
						<span>Verification Timeline & Milestones</span>
						<span id="stepper-progress-text" class="text-3xs font-mono font-bold text-[#7A7365]">Step 2 of 4 Completed</span>
					</h3>

					<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
						
						<!-- Step 1: Application Submitted -->
						<div id="step-card-1" class="clay-card rounded-2xl p-4.5 bg-[#FAF6EE] border-[#E0D3C1] space-y-3 transition">
							<div class="flex items-center justify-between">
								<span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500 text-white font-bold text-xs shadow-2xs">
									✓
								</span>
								<span class="text-4xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded">Completed</span>
							</div>
							<div>
								<h4 class="text-xs font-bold text-[#191917] font-heading">1. Application Intake</h4>
								<p class="text-4xs text-[#7A7365] mt-1 leading-relaxed">Company details, tax credentials, and warehouse pickup location submitted.</p>
							</div>
							<div class="pt-2 border-t border-[#E0D3C1] text-4xs font-mono text-[#9C9283]">
								Sept 01, 2026
							</div>
						</div>

						<!-- Step 2: KYC & Business Registration -->
						<div id="step-card-2" class="clay-card rounded-2xl p-4.5 bg-[#FAF6EE] border-[#E0D3C1] space-y-3 transition">
							<div class="flex items-center justify-between">
								<span id="step-icon-2" class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500 text-white font-bold text-xs shadow-2xs">
									✓
								</span>
								<span id="step-badge-2" class="text-4xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded">Completed</span>
							</div>
							<div>
								<h4 class="text-xs font-bold text-[#191917] font-heading">2. Tax & KYC Audit</h4>
								<p class="text-4xs text-[#7A7365] mt-1 leading-relaxed">Tax ID (EIN), direct wholesaler registration, and legal entity validation.</p>
							</div>
							<div class="pt-2 border-t border-[#E0D3C1] text-4xs font-mono text-[#9C9283]">
								Sept 03, 2026
							</div>
						</div>

						<!-- Step 3: Factory Spec & Quality Audit -->
						<div id="step-card-3" class="clay-card rounded-2xl p-4.5 bg-[#FAF6EE] border-[#E0D3C1] space-y-3 transition ring-2 ring-[#FFD000]">
							<div class="flex items-center justify-between">
								<span id="step-icon-3" class="flex h-7 w-7 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] font-bold text-xs shadow-2xs animate-pulse">
									3
								</span>
								<span id="step-badge-3" class="text-4xs font-bold text-amber-900 bg-amber-100 px-2 py-0.5 rounded">In Progress</span>
							</div>
							<div>
								<h4 class="text-xs font-bold text-[#191917] font-heading">3. Factory Spec Audit</h4>
								<p class="text-4xs text-[#7A7365] mt-1 leading-relaxed">Batch sample testing, warranty matching, and blind packaging verification.</p>
							</div>
							<div id="step-date-3" class="pt-2 border-t border-[#E0D3C1] text-4xs font-mono text-[#9C9283]">
								Estimated: Today
							</div>
						</div>

						<!-- Step 4: Wholesale Network Approval -->
						<div id="step-card-4" class="clay-card rounded-2xl p-4.5 bg-[#FAF6EE] opacity-70 border-[#E0D3C1] space-y-3 transition">
							<div class="flex items-center justify-between">
								<span id="step-icon-4" class="flex h-7 w-7 items-center justify-center rounded-full bg-[#E0D3C1] text-[#7A7365] font-bold text-xs shadow-2xs">
									4
								</span>
								<span id="step-badge-4" class="text-4xs font-bold text-[#7A7365] bg-[#EAE0D2] px-2 py-0.5 rounded">Pending</span>
							</div>
							<div>
								<h4 class="text-xs font-bold text-[#191917] font-heading">4. Network Activation</h4>
								<p class="text-4xs text-[#7A7365] mt-1 leading-relaxed">Live catalog publishing, Net-15 escrow routing, and automated PO receipt.</p>
							</div>
							<div id="step-date-4" class="pt-2 border-t border-[#E0D3C1] text-4xs font-mono text-[#9C9283]">
								Sept 09, 2026
							</div>
						</div>

					</div>
				</div>

				<!-- Application Details & Assigned Specialist Grid -->
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
					
					<!-- Application Profile Card (7 cols) -->
					<div class="lg:col-span-7 clay-card rounded-3xl p-6 space-y-4">
						<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]">
							<h3 class="text-xs font-bold uppercase tracking-wider text-[#191917] font-heading">
								Submitted Application Record
							</h3>
							<span class="text-3xs font-bold text-emerald-900 bg-emerald-100 border border-emerald-200 px-2.5 py-0.5 rounded-full">
								Direct Manufacturer
							</span>
						</div>

						<div class="grid grid-cols-2 gap-4 text-xs">
							<div class="p-3 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1]">
								<span class="block text-4xs font-bold uppercase text-[#7A7365]">Tax ID / EIN</span>
								<span class="font-mono font-bold text-[#191917]">{{ $application['tax_id'] }}</span>
							</div>
							<div class="p-3 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1]">
								<span class="block text-4xs font-bold uppercase text-[#7A7365]">Primary Category</span>
								<span class="font-bold text-[#191917]">{{ $application['primary_category'] }}</span>
							</div>
							<div class="p-3 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1]">
								<span class="block text-4xs font-bold uppercase text-[#7A7365]">Dispatch Lead Time</span>
								<span class="font-bold text-[#191917]">{{ $application['lead_time'] }}</span>
							</div>
							<div class="p-3 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1]">
								<span class="block text-4xs font-bold uppercase text-[#7A7365]">Payout Settlement</span>
								<span class="font-bold text-emerald-700">Guaranteed Net-15</span>
							</div>
						</div>

						<div class="p-3 rounded-2xl bg-[#FAF6EE] border border-[#E0D3C1]">
							<span class="block text-4xs font-bold uppercase text-[#7A7365] mb-0.5">Warehouse Dispatch Hub</span>
							<p class="text-xs text-[#191917] font-medium leading-relaxed">
								{{ $application['warehouse_address'] }}
							</p>
						</div>
					</div>

					<!-- Specialist Contact & Fast-Track (5 cols) -->
					<div class="lg:col-span-5 space-y-4">
						
						<!-- Assigned Specialist Box -->
						<div class="clay-card rounded-3xl p-5 space-y-3">
							<span class="text-4xs font-bold uppercase tracking-wider text-[#7A7365]">Assigned Specialist</span>
							<div class="flex items-center gap-3">
								<img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&auto=format&fit=crop&q=80" 
									alt="Marcus Vance" class="h-10 w-10 rounded-full object-cover border border-[#D8C9B5] shadow-xs">
								<div>
									<h4 class="text-xs font-bold text-[#191917]">Marcus Vance</h4>
									<p class="text-3xs text-[#7A7365]">Senior Procurement Specialist</p>
								</div>
							</div>
							<p class="text-3xs text-[#5C5549] leading-relaxed">
								“I am reviewing your Chicago warehouse dock capacity and batch specs. Your application is in priority queue.”
							</p>
							<button onclick="window.EasyBuyCart.showToast('Message dispatched to Marcus Vance. Response time: < 2 hours.', null)" 
								class="w-full py-2 px-3 rounded-xl bg-[#FAF6EE] hover:bg-[#EAE0D2] border border-[#D8C9B5] text-3xs font-bold text-[#191917] transition cursor-pointer">
								Send Message to Specialist
							</button>
						</div>

						<!-- Direct Dashboard Launch Card -->
						<div class="rounded-3xl p-5 bg-[#191917] text-[#FAF6EE] space-y-3 shadow-md">
							<div class="flex items-center gap-2">
								<span class="h-2 w-2 rounded-full bg-[#FFD000]"></span>
								<h4 class="text-xs font-bold font-heading text-[#FAF6EE]">Instant Dashboard Access</h4>
							</div>
							<p class="text-3xs text-[#9C9283] leading-relaxed">
								Explore the wholesale inventory manager, active purchase order queue, and B2B RFQs right now.
							</p>
							<a href="{{ url('/supplier/dashboard') }}" 
								class="w-full clay-btn-yellow py-2.5 px-4 rounded-xl text-xs font-bold flex items-center justify-center gap-1.5 transition active:scale-95 shadow-sm">
								<span>Launch Supplier Workspace</span>
								<span>&rarr;</span>
							</a>
						</div>

					</div>

				</div>

			</div>

		</main>

	</div>

	<!-- ==================== JAVASCRIPT STATUS CONTROLLER ==================== -->
	<script>
		function setStatusState(state) {
			const tag = document.getElementById('live-status-tag');
			const dot = document.getElementById('live-status-dot');
			const progressText = document.getElementById('stepper-progress-text');
			
			const btnReview = document.getElementById('btn-state-review');
			const btnAudit = document.getElementById('btn-state-audit');
			const btnApproved = document.getElementById('btn-state-approved');

			const step3 = document.getElementById('step-card-3');
			const step4 = document.getElementById('step-card-4');
			const stepIcon3 = document.getElementById('step-icon-3');
			const stepBadge3 = document.getElementById('step-badge-3');
			const stepIcon4 = document.getElementById('step-icon-4');
			const stepBadge4 = document.getElementById('step-badge-4');

			// Reset buttons
			[btnReview, btnAudit, btnApproved].forEach(b => {
				b.className = "px-3 py-1.5 rounded-xl bg-[#FAF6EE] hover:bg-[#EAE0D2] text-[#191917] border border-[#D8C9B5] font-bold transition cursor-pointer";
			});

			if (state === 'under_review') {
				btnReview.className = "px-3 py-1.5 rounded-xl bg-[#191917] text-[#FAF6EE] font-bold transition shadow-xs cursor-pointer";
				tag.innerText = "Application In Review";
				dot.className = "h-1.5 w-1.5 rounded-full bg-amber-400 animate-pulse";
				progressText.innerText = "Step 2 of 4 Completed";

				step3.className = "clay-card rounded-2xl p-4.5 bg-[#FAF6EE] border-[#E0D3C1] space-y-3 transition ring-2 ring-[#FFD000]";
				stepIcon3.className = "flex h-7 w-7 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] font-bold text-xs shadow-2xs animate-pulse";
				stepIcon3.innerText = "3";
				stepBadge3.className = "text-4xs font-bold text-amber-900 bg-amber-100 px-2 py-0.5 rounded";
				stepBadge3.innerText = "In Progress";

				step4.className = "clay-card rounded-2xl p-4.5 bg-[#FAF6EE] opacity-70 border-[#E0D3C1] space-y-3 transition";
				stepIcon4.className = "flex h-7 w-7 items-center justify-center rounded-full bg-[#E0D3C1] text-[#7A7365] font-bold text-xs shadow-2xs";
				stepIcon4.innerText = "4";
				stepBadge4.className = "text-4xs font-bold text-[#7A7365] bg-[#EAE0D2] px-2 py-0.5 rounded";
				stepBadge4.innerText = "Pending";
			} else if (state === 'in_audit') {
				btnAudit.className = "px-3 py-1.5 rounded-xl bg-[#191917] text-[#FAF6EE] font-bold transition shadow-xs cursor-pointer";
				tag.innerText = "Factory Spec Audit In Progress";
				dot.className = "h-1.5 w-1.5 rounded-full bg-blue-400 animate-pulse";
				progressText.innerText = "Step 3 of 4 In Progress";

				step3.className = "clay-card rounded-2xl p-4.5 bg-[#FAF6EE] border-[#E0D3C1] space-y-3 transition ring-2 ring-blue-500";
				stepIcon3.className = "flex h-7 w-7 items-center justify-center rounded-full bg-blue-500 text-white font-bold text-xs shadow-2xs animate-pulse";
				stepIcon3.innerText = "⚡";
				stepBadge3.className = "text-4xs font-bold text-blue-900 bg-blue-100 px-2 py-0.5 rounded";
				stepBadge3.innerText = "Active Audit";

				step4.className = "clay-card rounded-2xl p-4.5 bg-[#FAF6EE] opacity-70 border-[#E0D3C1] space-y-3 transition";
				stepIcon4.className = "flex h-7 w-7 items-center justify-center rounded-full bg-[#E0D3C1] text-[#7A7365] font-bold text-xs shadow-2xs";
				stepIcon4.innerText = "4";
				stepBadge4.className = "text-4xs font-bold text-[#7A7365] bg-[#EAE0D2] px-2 py-0.5 rounded";
				stepBadge4.innerText = "Next Up";
			} else if (state === 'approved') {
				btnApproved.className = "px-3 py-1.5 rounded-xl bg-emerald-600 text-white font-bold transition shadow-xs cursor-pointer";
				tag.innerText = "Application Approved ✓ Tier 1 Active";
				dot.className = "h-1.5 w-1.5 rounded-full bg-emerald-400";
				progressText.innerText = "All 4 Steps Complete (100%)";

				step3.className = "clay-card rounded-2xl p-4.5 bg-[#FAF6EE] border-[#E0D3C1] space-y-3 transition";
				stepIcon3.className = "flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500 text-white font-bold text-xs shadow-2xs";
				stepIcon3.innerText = "✓";
				stepBadge3.className = "text-4xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded";
				stepBadge3.innerText = "Approved";

				step4.className = "clay-card rounded-2xl p-4.5 bg-[#FAF6EE] border-[#E0D3C1] space-y-3 transition ring-2 ring-emerald-500";
				stepIcon4.className = "flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500 text-white font-bold text-xs shadow-2xs";
				stepIcon4.innerText = "✓";
				stepBadge4.className = "text-4xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded";
				stepBadge4.innerText = "Active";

				if (window.confetti) {
					confetti({ particleCount: 50, spread: 60, origin: { y: 0.6 } });
				}
			}
		}
	</script>
</x-layout>
