<x-layout>
	<!-- Full-Height Modern Dashboard Workspace with Locked Static Sidebar & Scrollable Canvas -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED DASHBOARD SIDEBAR (NEVER MOVES ON SCROLL) ==================== -->
		<x-dashboard-sidebar active="home" />

		<!-- ==================== CENTER AI AGENT CANVAS ("ASK EASY") ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-8 lg:p-12 relative flex flex-col items-center">
			
			<!-- Centered Container (Spacious Layout for Grid Rows & Columns) -->
			<div class="w-full max-w-3xl lg:max-w-4xl xl:max-w-5xl mx-auto space-y-6 sm:space-y-7 my-auto transition-all duration-300">
				
				<!-- Clean Minimal Header (No loud tags) -->
				<div class="text-center space-y-2">
					<h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#191917] font-heading tracking-tight">
						Ask Easy
					</h1>
					<p class="text-xs sm:text-sm text-[#5C5549] max-w-md mx-auto leading-relaxed">
						What would you like to procure today? Paste a raw list, bill of materials, or describe what your business needs.
					</p>
				</div>

				<!-- Sleek & Minimal Elevated Claymorphic Prompt Box (Lifting off the background clay) -->
				<div class="clay-marshmallow rounded-3xl p-5 sm:p-6 transition-all duration-300 shadow-[0_20px_45px_-8px_rgba(110,85,55,0.12),0_6px_16px_rgba(0,0,0,0.02)] focus-within:shadow-[0_26px_55px_-10px_rgba(110,85,55,0.16)] focus-within:-translate-y-0.5 space-y-3.5">
					
					<!-- Textarea (Sunken cavity pressed into the clay) -->
					<div class="relative">
						<textarea id="easy-prompt" 
							rows="3"
							oninput="autoExpandPrompt()"
							placeholder="Ask Easy anything... e.g. Source 10 ergonomic mesh chairs and 20x 4K USB-C monitors under $5,000 with unified delivery"
							class="w-full rounded-2xl clay-input-pill p-4 sm:p-5 text-xs sm:text-sm text-[#191917] placeholder:text-[#9C9283] border border-[#D8C9B5]/70 focus:outline-none focus:border-[#C4B29B] transition leading-relaxed overflow-hidden min-h-[105px] resize-none"></textarea>
					</div>

					<!-- Minimal Bottom Toolbar -->
					<div class="flex items-center justify-between pt-1">
						<button onclick="clearEasyPrompt()" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3.5 py-1.5 rounded-xl text-3xs font-bold text-[#7A7365] hover:text-[#191917] transition cursor-pointer">
							Clear
						</button>
						<button id="easy-submit-btn" onclick="executeEasyPrompt()" 
							class="clay-btn-yellow text-[#191917] px-6 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 cursor-pointer transition active:scale-95 shadow-sm">
							<span id="easy-btn-text">Ask Easy</span>
							<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
							</svg>
						</button>
					</div>

				</div>

				<!-- Clean Minimal Claymorphic Suggestions Grid -->
				<div id="easy-suggestions-grid" class="grid gap-3.5 sm:grid-cols-2 transition-all duration-300">
					
					<!-- Suggestion 1: Dev Workstation -->
					<div onclick="applySuggestion('dev_setup')" 
						class="clay-marshmallow clay-marshmallow-hover p-4.5 rounded-2xl cursor-pointer text-left group">
						<div class="flex items-center justify-between mb-1.5">
							<div class="flex items-center gap-2">
								<div class="clay-icon-pill h-7 w-7 rounded-lg flex items-center justify-center text-[#5C5549] group-hover:text-[#191917] transition">
									<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
									</svg>
								</div>
								<h4 class="text-xs font-bold text-[#191917]">Dev Workstation Pack</h4>
							</div>
							<span class="text-3xs text-[#9C9283] group-hover:translate-x-0.5 transition-transform">↗</span>
						</div>
						<p class="text-3xs text-[#5C5549] leading-relaxed line-clamp-2">
							5x Ergonomic mesh task chairs, 10x 27-inch 4K USB-C monitors, and 5x standing desks.
						</p>
					</div>

					<!-- Suggestion 2: Office Restock -->
					<div onclick="applySuggestion('office_restock')" 
						class="clay-marshmallow clay-marshmallow-hover p-4.5 rounded-2xl cursor-pointer text-left group">
						<div class="flex items-center justify-between mb-1.5">
							<div class="flex items-center gap-2">
								<div class="clay-icon-pill h-7 w-7 rounded-lg flex items-center justify-center text-[#5C5549] group-hover:text-[#191917] transition">
									<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
									</svg>
								</div>
								<h4 class="text-xs font-bold text-[#191917]">Monthly Office Restock</h4>
							</div>
							<span class="text-3xs text-[#9C9283] group-hover:translate-x-0.5 transition-transform">↗</span>
						</div>
						<p class="text-3xs text-[#5C5549] leading-relaxed line-clamp-2">
							24 rolls 2-ply recycled tissue, 12x multi-surface sanitizers, 500 compostable cups, 4kg espresso.
						</p>
					</div>

					<!-- Suggestion 3: Studio Gear -->
					<div onclick="applySuggestion('studio_gear')" 
						class="clay-marshmallow clay-marshmallow-hover p-4.5 rounded-2xl cursor-pointer text-left group">
						<div class="flex items-center justify-between mb-1.5">
							<div class="flex items-center gap-2">
								<div class="clay-icon-pill h-7 w-7 rounded-lg flex items-center justify-center text-[#5C5549] group-hover:text-[#191917] transition">
									<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4 5 5 0 013-4.5V5a2 2 0 012-2h6a2 2 0 012 2v7.5A5 5 0 0119 17a4 4 0 01-4 4H7z" />
									</svg>
								</div>
								<h4 class="text-xs font-bold text-[#191917]">Creative Studio Setup</h4>
							</div>
							<span class="text-3xs text-[#9C9283] group-hover:translate-x-0.5 transition-transform">↗</span>
						</div>
						<p class="text-3xs text-[#5C5549] leading-relaxed line-clamp-2">
							4x Curved terracotta arch LED lamps, 4x desktop charging hubs, and 6x acoustic felt dividers.
						</p>
					</div>

					<!-- Suggestion 4: Raw Spreadsheet -->
					<div onclick="applySuggestion('spreadsheet_list')" 
						class="clay-marshmallow clay-marshmallow-hover p-4.5 rounded-2xl cursor-pointer text-left group">
						<div class="flex items-center justify-between mb-1.5">
							<div class="flex items-center gap-2">
								<div class="clay-icon-pill h-7 w-7 rounded-lg flex items-center justify-center text-[#5C5549] group-hover:text-[#191917] transition">
									<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
									</svg>
								</div>
								<h4 class="text-xs font-bold text-[#191917]">Paste Bulk Spreadsheet</h4>
							</div>
							<span class="text-3xs text-[#9C9283] group-hover:translate-x-0.5 transition-transform">↗</span>
						</div>
						<p class="text-3xs text-[#5C5549] leading-relaxed line-clamp-2">
							Parse a multi-row equipment BOM or raw Slack shopping list with instant factory price-matching.
						</p>
					</div>

				</div>

				<!-- ==================== ANIMATED BAG LOADING STATE (NO TEXT, NO BORDER) ==================== -->
				<div id="easy-loading-state" class="hidden rounded-3xl p-6 sm:p-8 bg-[#FAF6EE] shadow-sm flex flex-col items-center justify-center text-center animate-fade-in relative overflow-hidden border-0">
					<!-- Soft Warm Ambient Radial Glow -->
					<div class="absolute inset-0 bg-[#FFD000]/15 rounded-full blur-3xl transform scale-90 pointer-events-none"></div>

					<!-- 3D Bag Unboxing/Boxing Animation Canvas (Auto Opening & Closing Loop) -->
					<div class="relative w-40 sm:w-48 md:w-56 aspect-square flex items-center justify-center select-none">
						<canvas id="easy-loading-canvas" width="960" height="960" class="w-full h-full object-contain pointer-events-none select-none drop-shadow-sm"></canvas>
					</div>
				</div>

				<!-- AI Agent Result Response Container (Unified Claymorphic Conversational Canvas) -->
				<div id="easy-response-card" class="hidden clay-marshmallow rounded-3xl p-6 sm:p-8 animate-fade-in space-y-6">
					
					<!-- AI Agent Header (Single Unified Conversational Header) -->
					<div class="flex items-center justify-between border-b border-[#E0D3C1]/50 pb-4">
						<div class="flex items-center gap-3">
							<div class="h-9 w-9 rounded-2xl bg-[#FFD000] text-[#191917] flex items-center justify-center font-black text-sm shadow-xs shrink-0">
								✨
							</div>
							<div>
								<div class="flex items-center gap-2">
									<span class="text-sm sm:text-base font-bold text-[#191917]">Ask Easy Sourcing Analysis</span>
									<span id="easy-ai-badge" class="text-4xs px-2 py-0.5 rounded-full bg-[#E8DEC8] text-[#5C5549] font-mono font-medium">NVIDIA NIM AI</span>
								</div>
								<p class="text-3xs text-[#7A7365]">Consolidated B2B Wholesale Sourcing Engine</p>
							</div>
						</div>
						<div class="flex items-center gap-2">
							<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200/60 text-4xs font-semibold">
								<span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
								<span>Live Factory Direct</span>
							</span>
						</div>
					</div>

					<!-- Conversational AI Sourcing Narrative Box with Animated Stream -->
					<div class="space-y-3.5">
						<div id="easy-ai-commentary" class="text-xs sm:text-sm text-[#2E2922] leading-relaxed font-sans min-h-[48px]">
							<!-- Populated dynamically with animated typewriter text -->
						</div>

						<!-- Smart Requisition Tags -->
						<div id="easy-ai-tags" class="flex flex-wrap items-center gap-2 pt-2 border-t border-[#E0D3C1]/40 opacity-0 transition-opacity duration-500">
							<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-[#FAF6EE] border border-[#E0D3C1] text-3xs font-medium text-[#5C5549]">
								<svg class="h-3 w-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
								<span>Verified Factory Direct</span>
							</span>
							<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-[#FAF6EE] border border-[#E0D3C1] text-3xs font-medium text-[#5C5549]">
								<svg class="h-3 w-3 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
								<span>Single Consolidated PO</span>
							</span>
							<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-[#FAF6EE] border border-[#E0D3C1] text-3xs font-medium text-[#5C5549]">
								<svg class="h-3 w-3 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
								<span id="easy-commentary-savings-tag">Wholesale Discount Applied</span>
							</span>
							<!-- Dynamic Smart Cadence Badge (Strictly hidden for one-time orders) -->
							<span id="easy-cadence-badge" style="display: none;" class="items-center gap-1.5 px-3 py-1 rounded-xl bg-purple-50 text-purple-900 border border-purple-200 text-3xs font-bold">
								<span>🔄 Monthly Auto-Dispatch Cadence Active</span>
							</span>
						</div>

						<!-- Smart Standing Schedule Banner (Strictly hidden for one-time orders) -->
						<div id="easy-schedule-banner" style="display: none;" class="rounded-2xl bg-[#FFFBF0] border border-[#FFD000]/50 p-3.5 flex-col sm:flex-row sm:items-center justify-between gap-2.5 animate-fade-in shadow-2xs">
							<div class="flex items-center gap-2.5">
								<div class="h-7 w-7 rounded-xl bg-[#191917] text-[#FFD000] flex items-center justify-center font-bold text-3xs shrink-0">📅</div>
								<div>
									<p class="font-bold text-3xs sm:text-xs text-[#191917]">Standing Order Cadence: Scheduled on the 1st of Every Month</p>
									<p class="text-4xs text-[#7A7365]">Managed independently from your one-time cart • Pause or cancel anytime</p>
								</div>
							</div>
							<span class="text-4xs font-bold text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-full self-start sm:self-auto">+5% Standing Order Wholesale Perk</span>
						</div>
					</div>

					<!-- Sourced Line Items Header & Cascading Products Grid -->
					<div class="space-y-3 pt-2">
						<div class="flex items-center justify-between text-3xs text-[#7A7365] font-semibold uppercase tracking-wider">
							<span id="easy-matched-count-label">Matched Direct Factory Line Items</span>
							<span id="easy-delivery-label">1 Consolidated Delivery</span>
						</div>
						
						<!-- Products Grid (Cards cascade in one by one via JS animation) -->
						<div id="easy-response-items" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
							<!-- Dynamically populated with cascading cards -->
						</div>
					</div>

					<!-- Bottom 1-Click PO Checkout Footer -->
					<div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-[#E0D3C1]/50">
						<div class="text-left w-full sm:w-auto">
							<span id="easy-total-footer-label" class="text-4xs text-[#7A7365] uppercase tracking-wider block">Consolidated Total (Single PO & Delivery)</span>
							<div class="flex items-baseline gap-2 mt-0.5">
								<div id="easy-response-total" class="text-2xl sm:text-3xl font-black text-[#191917] price-text tracking-tight">$0.00</div>
								<span id="easy-footer-savings-badge" class="text-4xs text-emerald-800 font-bold bg-emerald-100 px-2.5 py-1 rounded-md">Wholesale Discount Applied</span>
							</div>
						</div>
						<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 w-full sm:w-auto">
							<button id="easy-action-standing-btn" style="display: none;" onclick="setupMonthlyStandingOrder(true)" class="clay-btn-yellow px-6 py-3.5 rounded-2xl text-xs font-bold items-center justify-center gap-2 cursor-pointer active:scale-95 shadow-sm transition">
								<span>🗓️ Start Monthly PO & Pay Month 1</span>
								<span>&rarr;</span>
							</button>
							<button id="easy-action-cart-btn" onclick="addEasyResultToCart()" class="clay-btn-yellow px-6 py-3.5 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 cursor-pointer active:scale-95 shadow-sm transition">
								<span id="easy-cart-btn-label">+ Add All Items to Cart</span>
								<span>&rarr;</span>
							</button>
						</div>
					</div>
				</div>

				<!-- ==================== PERSISTENT STANDING ORDERS & RECURRING RESTOCK SCHEDULES ==================== -->
				<div id="standing-orders-section" class="hidden clay-marshmallow rounded-3xl p-6 sm:p-8 animate-fade-in space-y-5">
					<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-[#E0D3C1]/50">
						<div class="flex items-center gap-3">
							<div class="h-9 w-9 rounded-2xl bg-[#191917] text-[#FFD000] flex items-center justify-center font-black text-sm shadow-xs shrink-0">
								🔄
							</div>
							<div>
								<h3 class="text-sm sm:text-base font-bold text-[#191917]">Active Monthly Standing Orders</h3>
								<p class="text-3xs text-[#7A7365]">Automated recurring requisitions • Stays active even when shopping cart is cleared</p>
							</div>
						</div>
						<span id="standing-orders-count-badge" class="text-3xs font-bold text-purple-900 bg-purple-100 border border-purple-200 px-3 py-1 rounded-full self-start sm:self-auto">
							0 Scheduled Deliveries
						</span>
					</div>

					<!-- Active Schedules List -->
					<div id="standing-orders-list" class="space-y-3">
						<!-- Rendered dynamically via JavaScript -->
					</div>
				</div>

			</div>
		</main>

	</div>

	<!-- ==================== JAVASCRIPT LOGIC ==================== -->
	<script>
		// Auto-expanding textarea function: expands to fit entire content in one view
		function autoExpandPrompt() {
			const prompt = document.getElementById('easy-prompt');
			if (!prompt) return;
			prompt.style.height = 'auto';
			prompt.style.height = (prompt.scrollHeight + 2) + 'px';
		}

		// Suggestions Dictionary
		const EASY_SUGGESTIONS = {
			dev_setup: "Onboard 5 Developers:\n- 5x Ergonomic mesh task chairs\n- 10x 27-inch 4K USB-C monitors\n- 5x Heavy-duty dual monitor arms\n- 5x Wireless mechanical keyboard combos\nBudget target: $6,500.",
			office_restock: "Monthly Office Restock:\n- 24 rolls 2-ply recycled tissue\n- 12x multi-surface disinfectant sprays\n- 500x compostable hot coffee cups\n- 4kg organic whole bean dark roast espresso",
			studio_gear: "Design Studio Fit-out:\n- 4x Curved terracotta arch LED lamps\n- 4x Smart wireless charging desktop hubs\n- 6x Acoustic felt desktop divider panels",
			spreadsheet_list: "Item Code | Item Name | Quantity | Target Max\nSKU-ERG-01 | Ergonomic Mesh Chairs | 8 | $150\nSKU-MON-4K | 27-inch 4K Monitors | 16 | $220\nSKU-DSK-STD | Dual Motor Standing Desks | 8 | $320"
		};

		// Detailed Factory Sourcing Datasets (Aligned with databaseplan.md schema)
		const SOURCED_DATASETS = {
			dev_setup: {
				savings: "Saved $1,340.00 (32.1% Wholesale)",
				total: "$5,160.00",
				summary: "I've analyzed your engineering workstation requisition and cross-referenced with our Tier-1 manufacturers. Matched 5x Ergonomic Lumbar Mesh Task Chairs (ANSI/BIFMA certified), 10x 27-inch 4K UHD IPS USB-C Displays, and 5x Dual-Motor Standing Desks.\n\nAll items meet commercial durability standards with multi-year factory warranties. Sourced at 32.1% below retail MSRP, consolidated into 1 single Purchase Order and unified dock delivery.",
				items: [
					{
						id: "res-erg-1",
						name: "Ergonomic Lumbar Mesh Task Chair",
						sku: "EB-ERG-904",
						category: "Ergonomics",
						image: "{{ asset('images/3d-refs/ergo_chair.jpg') }}",
						qty: 5,
						unitPrice: 140.00,
						msrp: 220.00,
						leadTime: "2-3 Days Dispatch",
						warranty: "3-Year Direct Replacement",
						stock: "120 Units Available",
						confidence: "99% Exact Match",
						specs: {
							"Material": "High-density breathable Korean mesh",
							"Base": "Reinforced aluminum alloy 5-star base",
							"Weight Capacity": "330 lbs (150 kg)",
							"Certifications": "ANSI / BIFMA X5.1 Compliant",
							"Adjustability": "3D Padded Arms, Synchron-Tilt 135°"
						},
						description: "Commercial-grade ergonomic mesh task chair featuring adaptive lumbar spine curvature, self-weight synchro-tilt mechanism, and breathable reinforced mesh."
					},
					{
						id: "res-disp-2",
						name: "27-inch 4K UHD IPS USB-C Business Display",
						sku: "EB-DISP-4K",
						category: "IT & Tech",
						image: "{{ asset('images/3d-refs/4k_display.jpg') }}",
						qty: 10,
						unitPrice: 220.00,
						msrp: 320.00,
						leadTime: "24h Express Dispatch",
						warranty: "3-Year Zero-Dead-Pixel",
						stock: "65 Units Available",
						confidence: "98% Exact Match",
						specs: {
							"Resolution": "3840 x 2160 UHD IPS Anti-Glare",
							"Power Delivery": "90W USB-C Single-Cable Hub",
							"Color Accuracy": "99% sRGB Factory Calibrated",
							"Ports": "USB-C PD, HDMI 2.1, DP 1.4, RJ45 Gigabit",
							"Mounting": "VESA 100x100mm Quick-Release"
						},
						description: "Factory-calibrated 4K productivity monitor with integrated 90W USB-C docking hub, Ethernet passthrough, and full ergonomic height/swivel pivot."
					},
					{
						id: "res-dsk-3",
						name: "Dual-Motor Electric Standing Desk (60x30\")",
						sku: "EB-DSK-STD",
						category: "Ergonomics",
						image: "{{ asset('images/3d-refs/standing_desk.jpg') }}",
						qty: 5,
						unitPrice: 290.00,
						msrp: 450.00,
						leadTime: "3 Days Dispatch",
						warranty: "5-Year Motor Warranty",
						stock: "40 Units Available",
						confidence: "96% High Match",
						specs: {
							"Motors": "Dual synchronized ultra-quiet motors (<45dB)",
							"Height Range": "25.2\" – 50.8\" (64cm – 129cm)",
							"Desktop Material": "FSC-certified solid oak laminate",
							"Control": "4 Memory Presets + Anti-Collision Sensor",
							"Max Load": "275 lbs (125 kg)"
						},
						description: "Heavy-duty electric height-adjustable desk designed for commercial open-plan offices with solid anti-scratch desktop and digital memory keypad."
					}
				]
			},
			office_restock: {
				savings: "Saved $240.00 (38.1% Wholesale)",
				total: "$390.00",
				summary: "I've matched your monthly facility restock requisition with our certified commercial wholesale suppliers. Sourced 2x 24-roll cases of 2-ply recycled commercial bath tissue (48 rolls total), 12x EPA-certified hospital-grade disinfectant sprays, and 2x 4kg whole bean dark roast espresso bags.\n\nAll items feature bulk wholesale tier discounts saving 38.1% vs retail pricing. Consolidated into 1 unified logistics drop for single-invoice Net terms.",
				items: [
					{
						id: "res-jan-1",
						name: "2-Ply Recycled Commercial Toilet Paper (Case of 24)",
						sku: "EB-JAN-PPR",
						category: "Janitorial & Restocks",
						image: "{{ asset('images/3d-refs/smart_hub.jpg') }}",
						qty: 2,
						unitPrice: 32.00,
						msrp: 52.00,
						leadTime: "Same Day Dispatch",
						warranty: "100% Quality Guaranteed",
						stock: "350 Cases in Stock",
						confidence: "100% Exact Match",
						specs: {
							"Material": "100% Post-Consumer Recycled Fiber",
							"Sheet Count": "450 Sheets per roll (2-Ply Embossed)",
							"Certifications": "FSC Certified / Elemental Chlorine-Free",
							"Dispersibility": "Rapid-flush septic safe"
						},
						description: "Commercial soft embossed 2-ply bath tissue rolls engineered for high-traffic corporate offices and hospitality facilities."
					},
					{
						id: "res-jan-2",
						name: "Hospital-Grade Multi-Surface Disinfectant (Case of 12)",
						sku: "EB-JAN-SAN",
						category: "Janitorial & Restocks",
						image: "{{ asset('images/3d-refs/modern_lamp.jpg') }}",
						qty: 1,
						unitPrice: 48.00,
						msrp: 75.00,
						leadTime: "24h Dispatch",
						warranty: "EPA Certified",
						stock: "180 Cases in Stock",
						confidence: "100% Exact Match",
						specs: {
							"Bottle Volume": "32 oz (946ml) Trigger Sprays x 12",
							"Efficacy": "Kills 99.99% bacteria & viruses in 60 seconds",
							"Fragrance": "Natural citrus (Bleach-free, Non-toxic)",
							"Surfaces": "Glass, stainless steel, laminate, tiles"
						},
						description: "Ready-to-use commercial surface disinfectant spray for high-touch office areas, conference tables, and breakrooms."
					},
					{
						id: "res-pan-3",
						name: "Organic Whole Bean Dark Roast Espresso (4kg Bag)",
						sku: "EB-PAN-COF",
						category: "Janitorial & Restocks",
						image: "{{ asset('images/3d-refs/smart_hub.jpg') }}",
						qty: 2,
						unitPrice: 58.00,
						msrp: 95.00,
						leadTime: "Fresh Batch Roasted Weekly",
						warranty: "Direct Farm Traceability",
						stock: "90 Bags in Stock",
						confidence: "99% Exact Match",
						specs: {
							"Bean Origin": "100% Organic Arabica (Guatemala & Colombia)",
							"Roast Profile": "Dark Italian Roast",
							"Tasting Notes": "Dark chocolate, toasted hazelnut, caramel",
							"Package": "Degassing aroma valve resealable bag"
						},
						description: "Direct-trade certified whole espresso beans freshly roasted for commercial bean-to-cup office espresso machines."
					}
				]
			},
			studio_gear: {
				savings: "Saved $580.00 (34.9% Wholesale)",
				total: "$1,080.00",
				summary: "I've cross-referenced your creative studio fit-out list with our architectural workspace manufacturers. Sourced 4x curved terracotta arch LED lamps (95+ CRI color accuracy with stepless touch dimming), 4x CNC-aluminum wireless charging desktop hubs, and 6x acoustic PET felt privacy screens.\n\nAll items are factory-vetted and packaged together under 1 consolidated commercial invoice with 34.9% wholesale savings.",
				items: [
					{
						id: "res-st-1",
						name: "Curved Terracotta Arch LED Task Lamp",
						sku: "EB-LMP-ARC",
						category: "Lighting & Facilities",
						image: "{{ asset('images/3d-refs/modern_lamp.jpg') }}",
						qty: 4,
						unitPrice: 95.00,
						msrp: 155.00,
						leadTime: "2 Days Dispatch",
						warranty: "3-Year LED Module Warranty",
						stock: "55 Units in Stock",
						confidence: "99% Exact Match",
						specs: {
							"Color Temperature": "2700K – 5000K Stepless Touch Dimming",
							"Color Rendering": "95+ CRI True-Color Accuracy",
							"Material": "Anodized aluminum with matte terracotta finish",
							"Power": "15W USB-C Powered, Zero Strobe"
						},
						description: "Architectural curved LED desk lamp designed for creative design studios, providing glare-free even diffusion and high-CRI color precision."
					},
					{
						id: "res-st-2",
						name: "Smart Wireless Multi-Device Charging Desktop Hub",
						sku: "EB-HUB-SMT",
						category: "IT & Tech",
						image: "{{ asset('images/3d-refs/smart_hub.jpg') }}",
						qty: 4,
						unitPrice: 75.00,
						msrp: 120.00,
						leadTime: "24h Dispatch",
						warranty: "2-Year Direct Replacement",
						stock: "75 Units in Stock",
						confidence: "98% Exact Match",
						specs: {
							"Wireless Charging": "Dual 15W Qi Fast Magnetic Pads",
							"Wired Ports": "2x 65W USB-C PD, 2x USB-A 3.1",
							"Protection": "Overvoltage & foreign object detection",
							"Casing": "Weighted CNC aluminum base"
						},
						description: "Compact desktop power workstation bundling dual fast wireless charging pads with high-wattage USB-C power delivery."
					},
					{
						id: "res-st-3",
						name: "Acoustic Recycled Felt Desktop Privacy Divider (6-Pack)",
						sku: "EB-FAC-DIV",
						category: "Facilities",
						image: "{{ asset('images/3d-refs/ergo_chair.jpg') }}",
						qty: 1,
						unitPrice: 280.00,
						msrp: 420.00,
						leadTime: "3 Days Dispatch",
						warranty: "Commercial Grade",
						stock: "30 Packs in Stock",
						confidence: "97% High Match",
						specs: {
							"Acoustic Rating": "0.85 NRC Sound Absorption Rating",
							"Material": "100% Recycled PET Felt (Non-Toxic, Odorless)",
							"Dimensions": "48\" x 18\" with heavy-duty clamp brackets",
							"Mounting": "Clamp-on desk edge (No drilling required)"
						},
						description: "Sound-dampening acoustic desk screens providing acoustic privacy and visual division in open-plan creative studio workspaces."
					}
				]
			},
			spreadsheet_list: {
				savings: "Saved $780.00 (31.2% Wholesale)",
				total: "$1,720.00",
				summary: "Parsed your tabular Bill of Materials (BOM) spreadsheet and resolved all item codes against live factory production batches. Matched 8x ANSI/BIFMA mesh task chairs, 16x 4K UHD monitors, and 8x dual-motor standing desks with guaranteed volume pricing.\n\nEverything is grouped under 1 consolidated Purchase Order saving $780.00 (31.2% wholesale) compared to split retail suppliers.",
				items: [
					{
						id: "res-sp-1",
						name: "Ergonomic Lumbar Task Chair",
						sku: "SKU-ERG-01",
						category: "Ergonomics",
						image: "{{ asset('images/3d-refs/ergo_chair.jpg') }}",
						qty: 8,
						unitPrice: 140.00,
						msrp: 200.00,
						leadTime: "2 Days Dispatch",
						warranty: "3-Year Direct Warranty",
						stock: "120 Units Available",
						confidence: "100% Exact Match",
						specs: {
							"Material": "Reinforced Korean Mesh & Aluminum Base",
							"Load Capacity": "330 lbs (150 kg)",
							"Certifications": "ANSI / BIFMA Certified"
						},
						description: "Commercial task chair meeting ANSI/BIFMA standards with adjustable lumbar support."
					},
					{
						id: "res-sp-2",
						name: "27-inch 4K Business Display",
						sku: "SKU-MON-4K",
						category: "IT & Tech",
						image: "{{ asset('images/3d-refs/4k_display.jpg') }}",
						qty: 16,
						unitPrice: 195.00,
						msrp: 290.00,
						leadTime: "24h Dispatch",
						warranty: "3-Year Zero-Dead-Pixel",
						stock: "80 Units Available",
						confidence: "100% Exact Match",
						specs: {
							"Resolution": "3840x2160 UHD IPS Anti-Glare",
							"Ports": "USB-C 90W PD, HDMI 2.1, DisplayPort 1.4",
							"Stand": "Full Ergonomic Pivot, Tilt, Swivel"
						},
						description: "Factory calibrated 4K business monitors with USB-C single cable daisy-chain support."
					}
				]
			}
		};

		let currentActiveDataset = null;

		function detectPromptDataset(promptText) {
			const lower = promptText.toLowerCase();
			if (lower.includes('restock') || lower.includes('tissue') || lower.includes('janitorial') || lower.includes('coffee') || lower.includes('espresso') || lower.includes('sanitizer')) {
				return 'office_restock';
			}
			if (lower.includes('studio') || lower.includes('lamp') || lower.includes('terracotta') || lower.includes('hub') || lower.includes('acoustic') || lower.includes('divider')) {
				return 'studio_gear';
			}
			if (lower.includes('sku') || lower.includes('spreadsheet') || lower.includes('bom') || lower.includes('|')) {
				return 'spreadsheet_list';
			}
			return 'dev_setup';
		}

		// 3D Packaging Bag Animation Setup (Landing Page Frame-Player)
		const TOTAL_BAG_FRAMES = 121;
		const bagImages = [];
		let bagFramesLoadedCount = 0;
		let bagAnimId = null;
		let currentBagFrame = 1;
		let bagDirection = 1;
		let isEasySourcing = false;

		function preloadBagFrames() {
			const basePath = "{{ asset('images/bag-frames') }}";
			for (let i = 1; i <= TOTAL_BAG_FRAMES; i++) {
				const img = new Image();
				const padIndex = String(i).padStart(3, '0');
				img.src = `${basePath}/frame_${padIndex}.png`;
				img.onload = () => {
					bagFramesLoadedCount++;
					if (i === 1) {
						drawBagFrame(1);
					}
				};
				bagImages.push(img);
			}
		}

		function drawBagFrame(frameNumber) {
			const canvas = document.getElementById('easy-loading-canvas');
			if (!canvas) return;
			const ctx = canvas.getContext('2d');
			const clampedIndex = Math.min(Math.max(Math.round(frameNumber), 1), TOTAL_BAG_FRAMES) - 1;
			const img = bagImages[clampedIndex];
			if (!img || !img.complete || img.naturalWidth === 0) return;

			ctx.clearRect(0, 0, canvas.width, canvas.height);
			ctx.save();

			const t = clampedIndex / (TOTAL_BAG_FRAMES - 1);
			const counterScale = 0.98 - (t * 0.18);
			const drawW = canvas.width * counterScale;
			const drawH = canvas.height * counterScale;
			const drawX = (canvas.width - drawW) / 2;
			const drawY = (canvas.height - drawH) / 2 + (t * 14);

			ctx.globalAlpha = 1.0;
			ctx.drawImage(img, drawX, drawY, drawW, drawH);
			ctx.restore();
		}

		function startBagAnimationLoop() {
			if (bagAnimId) cancelAnimationFrame(bagAnimId);
			let lastTime = performance.now();
			const targetFps = 45;
			const interval = 1000 / targetFps;

			function render(now) {
				if (!isEasySourcing) return;
				const elapsed = now - lastTime;
				if (elapsed >= interval) {
					lastTime = now - (elapsed % interval);

					currentBagFrame += bagDirection * 1.5;
					if (currentBagFrame >= TOTAL_BAG_FRAMES) {
						currentBagFrame = TOTAL_BAG_FRAMES;
						bagDirection = -1;
					} else if (currentBagFrame <= 1) {
						currentBagFrame = 1;
						bagDirection = 1;
					}

					drawBagFrame(currentBagFrame);
				}
				bagAnimId = requestAnimationFrame(render);
			}
			bagAnimId = requestAnimationFrame(render);
		}

		function stopBagAnimationLoop() {
			isEasySourcing = false;
			if (bagAnimId) {
				cancelAnimationFrame(bagAnimId);
				bagAnimId = null;
			}
		}

		function applySuggestion(key) {
			const prompt = document.getElementById('easy-prompt');
			prompt.value = EASY_SUGGESTIONS[key];
			autoExpandPrompt();
			executeEasyPrompt();
		}

		function clearEasyPrompt() {
			const prompt = document.getElementById('easy-prompt');
			prompt.value = '';
			autoExpandPrompt();
			document.getElementById('easy-response-card').classList.add('hidden');
			document.getElementById('easy-loading-state').classList.add('hidden');
			const suggestionsGrid = document.getElementById('easy-suggestions-grid');
			if (suggestionsGrid) suggestionsGrid.classList.remove('hidden');
			stopBagAnimationLoop();
		}

		let currentConversationId = null;
		let activeStreamSessionId = 0;

		/**
		 * Organic Line-by-Line & Word-by-Word Streaming Typewriter
		 */
		function typewriterStream(element, text, onComplete) {
			const sessionId = ++activeStreamSessionId;
			element.innerHTML = '';

			const cursor = document.createElement('span');
			cursor.className = 'inline-block w-1.5 h-3.5 ml-1 bg-[#191917] rounded-2xs animate-pulse align-middle';

			const paragraphs = text.split('\n\n');
			let pIndex = 0;
			let wordIndex = 0;
			let words = paragraphs[pIndex] ? paragraphs[pIndex].split(' ') : [];
			let currentP = document.createElement('p');
			currentP.className = 'leading-relaxed mb-2.5';
			element.appendChild(currentP);
			currentP.appendChild(cursor);

			function typeNextWord() {
				if (sessionId !== activeStreamSessionId) return; // Discard stale stream

				if (wordIndex < words.length) {
					const wordText = (wordIndex > 0 ? ' ' : '') + words[wordIndex];
					const textNode = document.createTextNode(wordText);
					currentP.insertBefore(textNode, cursor);
					wordIndex++;

					// Variable natural typing cadence
					const delay = Math.floor(Math.random() * 15) + 16;
					setTimeout(typeNextWord, delay);
				} else {
					pIndex++;
					if (pIndex < paragraphs.length) {
						words = paragraphs[pIndex].split(' ');
						wordIndex = 0;
						currentP = document.createElement('p');
						currentP.className = 'leading-relaxed mb-2.5';
						element.appendChild(currentP);
						currentP.appendChild(cursor);
						setTimeout(typeNextWord, 100);
					} else {
						// Stream completed
						setTimeout(() => {
							if (cursor.parentNode) cursor.parentNode.removeChild(cursor);
							if (typeof onComplete === 'function') onComplete();
						}, 250);
					}
				}
			}

			typeNextWord();
		}

		/**
		 * Cascading Sequential Product Card Reveal
		 */
		function cascadeProductCards(container, items) {
			container.innerHTML = '';
			const createdCards = [];

			items.forEach((item, index) => {
				const lineTotal = (item.unitPrice * item.qty).toFixed(2);
				const productUrl = "{{ url('/home/product') }}/" + item.id;

				const card = document.createElement('a');
				card.href = productUrl;
				card.className = "clay-marshmallow clay-marshmallow-hover rounded-3xl p-3.5 sm:p-4 flex flex-col justify-between select-none cursor-pointer group block opacity-0 translate-y-6 scale-[0.97] transition-all duration-500 ease-out";
				
				card.innerHTML = `
					<div>
						<!-- Product Image Box -->
						<div class="w-full h-48 sm:h-52 rounded-2xl overflow-hidden clay-marshmallow-subtle relative mb-3 group-hover:shadow-xs transition">
							<img src="${item.image}" alt="${item.name}" 
								class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
								onerror="this.src='{{ asset('images/3d-refs/ergo_chair.jpg') }}'" />
						</div>

						<!-- Product Title -->
						<h4 class="text-xs sm:text-sm font-bold text-[#191917] leading-snug line-clamp-2 hover:text-[#5C5549] transition px-1 product-title">${item.name}</h4>
					</div>

					<!-- Price & Quantity Breakdown -->
					<div class="mt-3 pt-2.5 border-t border-[#E0D3C1]/50 flex items-center justify-between px-1">
						<span class="text-3xs text-[#7A7365] font-medium price-text">${item.qty} × $${item.unitPrice.toFixed(2)}</span>
						<span class="text-sm sm:text-base font-bold text-[#191917] price-text">$${lineTotal}</span>
					</div>
				`;

				container.appendChild(card);
				createdCards.push(card);
			});

			// Progressively reveal cards one by one
			createdCards.forEach((card, i) => {
				setTimeout(() => {
					card.classList.remove('opacity-0', 'translate-y-6', 'scale-[0.97]');
					card.classList.add('opacity-100', 'translate-y-0', 'scale-100');
				}, i * 130 + 50);
			});
		}

		async function executeEasyPrompt() {
			const prompt = document.getElementById('easy-prompt');
			if (!prompt.value.trim()) {
				prompt.value = EASY_SUGGESTIONS.dev_setup;
				autoExpandPrompt();
			}

			const promptValue = prompt.value.trim();
			const datasetKey = detectPromptDataset(promptValue);
			const localFallbackDataset = SOURCED_DATASETS[datasetKey] || SOURCED_DATASETS.dev_setup;
			currentActiveDataset = localFallbackDataset;

			const btn = document.getElementById('easy-submit-btn');
			const btnText = document.getElementById('easy-btn-text');
			const loadingState = document.getElementById('easy-loading-state');
			const responseCard = document.getElementById('easy-response-card');
			const suggestionsGrid = document.getElementById('easy-suggestions-grid');

			// Hide suggestions immediately so loading & result stay directly under prompt box
			if (suggestionsGrid) suggestionsGrid.classList.add('hidden');
			btnText.innerText = "Sourcing AI...";
			btn.disabled = true;
			btn.classList.add('opacity-75', 'cursor-not-allowed');
			responseCard.classList.add('hidden');
			loadingState.classList.remove('hidden');

			isEasySourcing = true;
			startBagAnimationLoop();
			loadingState.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

			window.LAST_AI_RESPONSE = null;

			try {
				const response = await fetch("{{ route('ai.chat') }}", {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					},
					body: JSON.stringify({
						message: promptValue,
						conversation_id: currentConversationId
					})
				});

				const result = await response.json();
				if (result.status === 'success' && result.structured_data) {
					window.LAST_AI_RESPONSE = result;
					currentConversationId = result.conversation_id;
					const data = result.structured_data;
					currentActiveDataset = {
						savings: `Saved $${parseFloat(data.savings || 0).toLocaleString('en-US', {minimumFractionDigits: 2})} (${data.savings_percent || '32%'} Wholesale)`,
						total: `$${parseFloat(data.wholesale_total || 0).toLocaleString('en-US', {minimumFractionDigits: 2})}`,
						summary: result.assistant_message || data.summary || null,
						items: data.line_items.map(item => ({
							id: item.id || item.sku,
							name: item.name,
							sku: item.sku || ('EB-' + item.id),
							category: item.category || 'Wholesale',
							image: item.image || "{{ asset('images/3d-refs/ergo_chair.jpg') }}",
							qty: item.qty || 1,
							unitPrice: parseFloat(item.unit_price),
							msrp: parseFloat(item.msrp || (item.unit_price * 1.45)),
							leadTime: item.lead_time || '2-3 Days Dispatch',
							warranty: item.warranty || 'Commercial Guarantee',
							stock: 'In Stock',
							confidence: item.confidence || '99% Exact Match'
						}))
					};
				}
			} catch (e) {
				console.warn('AI API fallback to local dataset:', e);
				window.LAST_AI_RESPONSE = null;
			}

			// Smooth transition to animated streaming response
			setTimeout(() => {
				stopBagAnimationLoop();
				loadingState.classList.add('hidden');
				responseCard.classList.remove('hidden');

				btnText.innerText = "Ask Easy";
				btn.disabled = false;
				btn.classList.remove('opacity-75', 'cursor-not-allowed');

				const dataset = currentActiveDataset;

				// Update Total and Savings
				document.getElementById('easy-response-total').innerText = dataset.total;
				const footerSavings = document.getElementById('easy-footer-savings-badge');
				if (footerSavings) footerSavings.innerText = dataset.savings;

				// Update Model Badge
				const badgeEl = document.getElementById('easy-ai-badge');
				if (badgeEl) {
					if (window.LAST_AI_RESPONSE && window.LAST_AI_RESPONSE.structured_data && window.LAST_AI_RESPONSE.structured_data.source === 'nvidia_nim') {
						badgeEl.innerText = "NVIDIA NIM Llama-3.3";
					} else {
						badgeEl.innerText = "Ask Easy AI Engine";
					}
				}

				// Check if prompt requires recurring monthly cadence
				const recurring = isRecurringCadence(promptValue);
				const cadenceBadge = document.getElementById('easy-cadence-badge');
				const scheduleBanner = document.getElementById('easy-schedule-banner');
				const standingBtn = document.getElementById('easy-action-standing-btn');
				const totalFooterLabel = document.getElementById('easy-total-footer-label');
				const cartBtnLabel = document.getElementById('easy-cart-btn-label');

				if (cadenceBadge) {
					cadenceBadge.style.display = recurring ? 'inline-flex' : 'none';
				}

				if (scheduleBanner) {
					scheduleBanner.style.display = recurring ? 'flex' : 'none';
				}

				if (standingBtn) {
					standingBtn.style.display = recurring ? 'inline-flex' : 'none';
				}

				if (totalFooterLabel) {
					totalFooterLabel.innerText = recurring 
						? "Consolidated Monthly Total (Every 30 Days)" 
						: "Consolidated Total (Single PO & Delivery)";
				}

				if (cartBtnLabel) {
					cartBtnLabel.innerText = recurring ? "+ One-Time Purchase Only" : "+ Add All Items to Cart";
				}

				// Update Matched Count Label
				const countLabelEl = document.getElementById('easy-matched-count-label');
				if (countLabelEl) {
					const count = dataset.items ? dataset.items.length : 0;
					countLabelEl.innerText = `${count} Matched Direct Factory Line ${count === 1 ? 'Item' : 'Items'}`;
				}

				// Reset tags opacity
				const tagsEl = document.getElementById('easy-ai-tags');
				if (tagsEl) {
					tagsEl.classList.remove('opacity-100');
					tagsEl.classList.add('opacity-0');
				}

				// Start Animated Streaming AI Narrative
				const commentaryEl = document.getElementById('easy-ai-commentary');
				const itemsContainer = document.getElementById('easy-response-items');
				itemsContainer.innerHTML = '';

				if (commentaryEl) {
					const aiText = (window.LAST_AI_RESPONSE && window.LAST_AI_RESPONSE.assistant_message)
						? window.LAST_AI_RESPONSE.assistant_message
						: ((window.LAST_AI_RESPONSE && window.LAST_AI_RESPONSE.structured_data && window.LAST_AI_RESPONSE.structured_data.summary)
							? window.LAST_AI_RESPONSE.structured_data.summary
							: (dataset.summary || "I've analyzed your procurement requisition and cross-referenced with our verified direct manufacturer lines. All matched items are consolidated into a single PO and delivery."));
					
					typewriterStream(commentaryEl, aiText, () => {
						// On narrative completion: reveal tags and cascade product cards
						if (tagsEl) {
							tagsEl.classList.remove('opacity-0');
							tagsEl.classList.add('opacity-100');
						}
						cascadeProductCards(itemsContainer, dataset.items);
					});
				} else {
					cascadeProductCards(itemsContainer, dataset.items);
				}

				responseCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
			}, 1200);
		}

		function isRecurringCadence(promptText) {
			if (!promptText) return false;
			const lower = promptText.toLowerCase();
			return /\b(monthly|every\s+month|weekly|recurring|standing\s+order|subscription|cadence|auto-restock)\b/i.test(lower);
		}

		function renderStandingOrders() {
			const section = document.getElementById('standing-orders-section');
			const list = document.getElementById('standing-orders-list');
			const countBadge = document.getElementById('standing-orders-count-badge');
			if (!section || !list || !window.EasyBuyStandingOrders) return;

			const orders = window.EasyBuyStandingOrders.getAll();
			if (orders.length === 0) {
				section.classList.add('hidden');
				return;
			}

			section.classList.remove('hidden');
			if (countBadge) {
				countBadge.innerText = `${orders.length} Active ${orders.length === 1 ? 'Schedule' : 'Schedules'}`;
			}

			list.innerHTML = orders.map(ord => {
				const isPaused = ord.status === 'Paused';
				const statusPill = isPaused 
					? `<span class="px-2.5 py-0.5 rounded-full text-4xs font-bold bg-amber-100 text-amber-800">Paused</span>`
					: `<span class="px-2.5 py-0.5 rounded-full text-4xs font-bold bg-emerald-100 text-emerald-800 flex items-center gap-1"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Active Auto-Dispatch</span>`;

				const itemPills = (ord.items || []).map(it => 
					`<span class="clay-icon-pill px-2.5 py-1 rounded-lg text-4xs font-medium text-[#5C5549]">${it.qty}× ${it.name}</span>`
				).join(' ');

				return `
					<div class="rounded-2xl bg-[#FFFDF9] border border-[#E0D3C1] p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-2xs select-none transition">
						<div class="space-y-2 flex-1 min-w-0">
							<div class="flex items-center gap-2 flex-wrap">
								<h4 class="text-xs sm:text-sm font-bold text-[#191917]">${ord.title}</h4>
								${statusPill}
								<span class="text-4xs font-mono text-[#7A7365]">${ord.id}</span>
							</div>

							<div class="flex items-center gap-2 text-3xs text-[#7A7365] flex-wrap">
								<span class="font-medium text-[#191917]">📅 Next Sourcing Drop: <strong class="text-emerald-800">${ord.nextDelivery}</strong></span>
								<span>•</span>
								<span>Cadence: <strong>${ord.frequency}</strong></span>
							</div>

							<div class="flex flex-wrap items-center gap-1.5 pt-1">
								${itemPills}
							</div>
						</div>

						<div class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-3 w-full sm:w-auto pt-3 sm:pt-0 border-t sm:border-t-0 border-[#E0D3C1]/50">
							<div class="text-left sm:text-right">
								<span class="text-xs sm:text-sm font-black text-[#191917] price-text">${ord.total}</span>
								<span class="text-4xs text-emerald-800 font-bold block">/month (Wholesale)</span>
							</div>

							<div class="flex items-center gap-2">
								<button onclick="toggleStandingOrderPause('${ord.id}')" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3 py-1.5 rounded-xl text-3xs font-bold text-[#5C5549] hover:text-[#191917] transition cursor-pointer">
									${isPaused ? 'Resume Schedule' : 'Pause Month'}
								</button>
								<button onclick="cancelStandingOrder('${ord.id}')" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-2.5 py-1.5 rounded-xl text-3xs font-bold text-red-600 transition cursor-pointer" title="Cancel schedule">
									✕
								</button>
							</div>
						</div>
					</div>
				`;
			}).join('');
		}

		function toggleStandingOrderPause(id) {
			if (window.EasyBuyStandingOrders) {
				window.EasyBuyStandingOrders.togglePause(id);
				renderStandingOrders();
			}
		}

		function cancelStandingOrder(id) {
			if (confirm('Cancel this monthly recurring standing order?')) {
				if (window.EasyBuyStandingOrders) {
					window.EasyBuyStandingOrders.cancel(id);
					renderStandingOrders();
				}
			}
		}

		async function setupMonthlyStandingOrder(andProceedToCart = true) {
			if (!currentActiveDataset || !currentActiveDataset.items || currentActiveDataset.items.length === 0) return;

			const prompt = document.getElementById('easy-prompt');
			const titleText = prompt && prompt.value.trim() ? prompt.value.trim().split('\n')[0] : 'Monthly Office Sourcing Schedule';
			const shortTitle = titleText.length > 40 ? titleText.substring(0, 40) + '...' : titleText;

			// 1. Create persistent standing order
			const newOrder = window.EasyBuyStandingOrders.add({
				title: shortTitle,
				frequency: 'Monthly (Every 30 Days)',
				total: currentActiveDataset.total,
				savings: currentActiveDataset.savings,
				items: currentActiveDataset.items
			});

			// 2. Add Month 1 Initial Drop items to shopping cart
			const itemsToSync = currentActiveDataset.items.map(item => ({
				id: item.id,
				name: item.name,
				price: item.unitPrice,
				qty: item.qty,
				category: item.category,
				image: item.image,
				recurring: true,
				standingOrderId: newOrder.id,
				frequency: 'Monthly (Every 30 Days)'
			}));

			if (window.EasyBuyCart) {
				itemsToSync.forEach(item => {
					window.EasyBuyCart.addItem(item);
				});

				// Server sync
				try {
					for (const item of itemsToSync) {
						await fetch("{{ route('cart.add') }}", {
							method: 'POST',
							headers: {
								'Content-Type': 'application/json',
								'X-CSRF-TOKEN': '{{ csrf_token() }}',
								'Accept': 'application/json'
							},
							body: JSON.stringify({
								product_id: item.id,
								quantity: item.qty,
								custom_notes: `Standing Order ${newOrder.id} (Month 1 Initial Drop)`
							})
						});
					}
				} catch (e) {
					console.error('Server cart sync error:', e);
				}
			}

			renderStandingOrders();

			if (andProceedToCart) {
				window.location.href = "{{ url('/cart') }}";
			} else {
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast(`🗓️ Standing Order ${newOrder.id} Activated! Month 1 added to cart.`, "{{ url('/cart') }}", "Pay Month 1 &rarr;");
				}
				const section = document.getElementById('standing-orders-section');
				if (section) {
					section.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
				}
			}
		}

		async function addEasyResultToCart() {
			const btn = document.getElementById('easy-action-cart-btn');
			const label = document.getElementById('easy-cart-btn-label');
			if (btn) {
				btn.disabled = true;
				btn.classList.add('opacity-75', 'cursor-not-allowed');
			}
			if (label) {
				label.innerText = 'Adding to Cart...';
			}

			try {
				if (currentActiveDataset && currentActiveDataset.items && currentActiveDataset.items.length > 0) {
					const itemsToSync = currentActiveDataset.items.map(item => ({
						id: item.id,
						name: item.name,
						price: item.unitPrice,
						qty: item.qty || 1,
						category: item.category || 'Wholesale',
						image: item.image || null
					}));

					// Add all items to local shopping cart
					itemsToSync.forEach(item => {
						window.EasyBuyCart.addItem(item);
					});

					// Sync with server cart table
					for (const item of itemsToSync) {
						try {
							await fetch("{{ route('cart.add') }}", {
								method: 'POST',
								headers: {
									'Content-Type': 'application/json',
									'X-CSRF-TOKEN': '{{ csrf_token() }}',
									'Accept': 'application/json'
								},
								body: JSON.stringify({
									product_id: item.id,
									quantity: item.qty
								})
							});
						} catch (e) {
							console.error('Server cart sync error:', e);
						}
					}
				}
			} catch (e) {
				console.error('Add to cart error:', e);
			}

			window.location.href = "{{ url('/cart') }}";
		}

		// Modals and Drawers
		function toggleCatalogModal(open) {
			window.location.href = "{{ url('/catalog') }}";
		}

		function toggleModal(id, show) {
			const el = document.getElementById(id);
			if (el) {
				if (show) el.classList.remove('hidden');
				else el.classList.add('hidden');
			}
		}

		function openEditModal(id, name, category, price, description) {
			document.getElementById('edit-name').value = name;
			document.getElementById('edit-category').value = category;
			document.getElementById('edit-price').value = price;
			document.getElementById('edit-description').value = description;
			document.getElementById('edit-product-form').action = "{{ url('/products') }}/" + id;
			toggleModal('edit-product-modal', true);
		}

		// Preload frames and initialize prompt height on DOM ready
		document.addEventListener('DOMContentLoaded', () => {
			preloadBagFrames();
			autoExpandPrompt();
			renderStandingOrders();

			const badge = document.getElementById('sidebar-cart-count');
			if (badge && window.EasyBuyCart) {
				badge.innerText = window.EasyBuyCart.getCount();
			}

			// Add keyboard listener: Enter to submit (Shift+Enter for newline)
			const prompt = document.getElementById('easy-prompt');
			if (prompt) {
				prompt.addEventListener('keydown', (e) => {
					if (e.key === 'Enter' && !e.shiftKey) {
						e.preventDefault();
						executeEasyPrompt();
					}
				});
				window.addEventListener('resize', autoExpandPrompt);
			}

			// Check for incoming prompt from Landing Page Hero Box or Registration/Login redirect
			const urlParams = new URLSearchParams(window.location.search);
			const incomingPrompt = urlParams.get('prompt') || sessionStorage.getItem('pending_easybuy_prompt');

			if (incomingPrompt && incomingPrompt.trim()) {
				if (prompt) {
					prompt.value = incomingPrompt.trim();
					autoExpandPrompt();
					try {
						sessionStorage.removeItem('pending_easybuy_prompt');
					} catch(e) {}

					// Clean query param from URL without reload so refresh doesn't re-trigger unexpectedly
					const cleanUrl = window.location.pathname + (urlParams.get('username') ? '?username=' + urlParams.get('username') : '');
					window.history.replaceState({}, document.title, cleanUrl);

					// Auto-execute AI sourcing
					setTimeout(() => {
						executeEasyPrompt();
					}, 350);
				}
			}
		});
	</script>
</x-layout>
