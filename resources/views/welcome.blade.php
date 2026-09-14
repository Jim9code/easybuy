<x-layout>
	<style>
		/* Hardware-accelerated Smooth Scroll Reveal System */
		.scroll-reveal {
			opacity: 0;
			transform: translateY(30px);
			transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
			will-change: opacity, transform;
		}

		.scroll-reveal-left {
			opacity: 0;
			transform: translateX(-36px);
			transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
			will-change: opacity, transform;
		}

		.scroll-reveal-right {
			opacity: 0;
			transform: translateX(36px);
			transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
			will-change: opacity, transform;
		}

		.scroll-reveal-scale {
			opacity: 0;
			transform: scale(0.92);
			transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
			will-change: opacity, transform;
		}

		.scroll-reveal-pop {
			opacity: 0;
			transform: scale(0.85) translateY(20px);
			transition: opacity 0.65s cubic-bezier(0.34, 1.56, 0.64, 1), transform 0.65s cubic-bezier(0.34, 1.56, 0.64, 1);
			will-change: opacity, transform;
		}

		/* Active Revealed States */
		.scroll-reveal.revealed,
		.scroll-reveal-left.revealed,
		.scroll-reveal-right.revealed,
		.scroll-reveal-scale.revealed,
		.scroll-reveal-pop.revealed {
			opacity: 1 !important;
			transform: translate(0, 0) scale(1) !important;
		}

		/* Stagger Delays */
		.delay-75 { transition-delay: 75ms; }
		.delay-100 { transition-delay: 100ms; }
		.delay-150 { transition-delay: 150ms; }
		.delay-200 { transition-delay: 200ms; }
		.delay-250 { transition-delay: 250ms; }
		.delay-300 { transition-delay: 300ms; }
		.delay-350 { transition-delay: 350ms; }
		.delay-400 { transition-delay: 400ms; }
		.delay-450 { transition-delay: 450ms; }
		.delay-500 { transition-delay: 500ms; }

		/* Hidden Scrollbars Utility */
		.no-scrollbar::-webkit-scrollbar {
			display: none;
		}
		.no-scrollbar {
			-ms-overflow-style: none;
			scrollbar-width: none;
		}

		/* Subtle Floating Micro Animation */
		@keyframes subtle-float {
			0%, 100% { transform: translateY(0px); }
			50% { transform: translateY(-6px); }
		}
		.animate-subtle-float {
			animation: subtle-float 5s ease-in-out infinite;
		}
	</style>

	<!-- Hero Section Inspired by herodesign.png -->
	<section id="simulator" class="relative overflow-hidden py-6 sm:py-8 lg:py-10 bg-[#FAF6EE] lg:min-h-[calc(100vh-4rem)] lg:max-h-[860px] flex items-center">
		
		<!-- Giant Cannaray Sun Yellow Backdrop (Centered on mobile, crest at 51% on desktop) -->
		<div id="hero-sun-backdrop" class="pointer-events-none absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 lg:left-[51%] xl:left-[52%] lg:translate-x-0 w-[360px] sm:w-[540px] lg:w-[940px] xl:w-[1020px] aspect-square rounded-full bg-[#FFD000] z-0 transition-transform duration-700 ease-out"></div>

		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 w-full relative z-10">
			<div class="grid lg:grid-cols-12 gap-8 lg:gap-8 items-center">
				
				<!-- Left Column: Headline, CTA, Minimal Sourcing Bar & Carousel Ticks -->
				<div class="lg:col-span-6 flex flex-col justify-center space-y-4 lg:space-y-5 scroll-reveal">
					
					<!-- Hero Editorial Headline (Clean, Bold, Responsive typography) -->
					<div class="space-y-2 sm:space-y-2.5">
						<h1 class="text-2xl sm:text-4xl lg:text-[2.85rem] xl:text-[3.1rem] font-bold tracking-tight text-[#191917] leading-[1.12] sm:leading-[1.08] font-heading">
							Smarter Wholesale Procurement. <br class="hidden sm:inline">
							<span>One Single Invoice.</span>
						</h1>
						<p class="text-xs sm:text-sm text-[#5C5549] max-w-md leading-relaxed font-normal">
							Source business equipment, inventory, and office supplies at factory direct prices with consolidated single-invoice delivery.
						</p>
					</div>

					<!-- Primary CTA Button (Cannaray Yellow Style) -->
					<div class="flex flex-wrap items-center gap-2.5 sm:gap-3 pt-0.5">
						<a href="#catalog" class="bg-[#FFD000] hover:bg-[#F2C200] text-[#191917] px-6 sm:px-7 py-2.5 sm:py-3 rounded-xl text-xs sm:text-sm font-black uppercase tracking-wider flex items-center gap-2 transition duration-200 shadow-sm hover:shadow-md cursor-pointer active:scale-95">
							<span>Shop Bestsellers</span>
							<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
								<path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
							</svg>
						</a>
						<a href="#how-it-works" class="px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#5C5549] hover:text-[#191917] transition hover:bg-[#F2EAE0]">
							How It Works &rarr;
						</a>
					</div>

					<!-- Minimal & Professional Procurement Intake Text Box (Comfortable size with clear clearance from sun circle) -->
					<div class="pt-3.5 sm:pt-4 max-w-lg lg:max-w-[495px] xl:max-w-[530px]">
						<div class="clay-card rounded-2xl p-3.5 sm:p-4 border border-[#D8C9B5] shadow-xs bg-[#F2EAE0]">
							
							<!-- Multi-line Requisition Text Box -->
							<div class="relative">
								<textarea id="prompt-input" rows="3" 
									placeholder="Paste your requisition list, bulk items with quantities, or describe what you need to procure...&#10;e.g. 5x mesh ergonomic chairs, 10x 4K monitors, 20x surge protectors"
									class="w-full rounded-xl bg-[#FAF6EE] p-3 text-xs text-[#191917] placeholder:text-[#9C9283] border border-[#D8C9B5] focus:outline-none focus:ring-2 focus:ring-[#FFD000] transition resize-none font-mono leading-relaxed shadow-inner min-h-[78px] max-h-[92px]">We are onboarding 5 software developers. I need: 5 ergonomic mesh chairs, 5 electric standing desks, 10 4K 27-inch monitors with USB-C, and 5 mechanical keyboard combos. Budget cap: ₦6,500,000.</textarea>
							</div>

							<!-- Bottom Action Toolbar inside Box -->
							<div class="mt-2.5 flex flex-col sm:flex-row sm:items-center justify-between gap-2 pt-0.5">
								<!-- Quick Sample List Presets -->
								<div class="flex items-center gap-1.5 text-3xs text-[#7A7365] overflow-x-auto pb-0.5 max-w-full no-scrollbar">
									<span class="font-bold text-[#9C9283] uppercase tracking-wider whitespace-nowrap text-4xs">Sample:</span>
									<button onclick="loadPresetPrompt('dev_workstation')" class="px-2 py-1 rounded-md bg-[#FAF6EE] border border-[#D8C9B5] hover:text-[#191917] hover:border-[#191917] transition cursor-pointer whitespace-nowrap font-medium flex items-center gap-1 text-3xs">
										<svg class="h-3 w-3 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
											<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
										</svg>
										<span>Dev Setup</span>
									</button>
									<button onclick="loadPresetPrompt('janitorial')" class="px-2 py-1 rounded-md bg-[#FAF6EE] border border-[#D8C9B5] hover:text-[#191917] hover:border-[#191917] transition cursor-pointer whitespace-nowrap font-medium flex items-center gap-1 text-3xs">
										<svg class="h-3 w-3 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
											<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
										</svg>
										<span>Restock</span>
									</button>
									<button onclick="loadPresetPrompt('design_studio')" class="px-2 py-1 rounded-md bg-[#FAF6EE] border border-[#D8C9B5] hover:text-[#191917] hover:border-[#191917] transition cursor-pointer whitespace-nowrap font-medium flex items-center gap-1 text-3xs">
										<svg class="h-3 w-3 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
											<path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4 5 5 0 013-4.5V5a2 2 0 012-2h6a2 2 0 012 2v7.5A5 5 0 0119 17a4 4 0 01-4 4H7z" />
										</svg>
										<span>Studio</span>
									</button>
								</div>

								<!-- Procurement Action CTA Button -->
								<button id="simulate-btn" onclick="startSourcingSimulation()" 
									class="w-full sm:w-auto bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-4 py-2 rounded-xl text-xs font-bold flex items-center justify-center gap-1.5 cursor-pointer transition active:scale-95 shadow-xs whitespace-nowrap shrink-0">
									<svg class="h-3.5 w-3.5 text-[#FFD000]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
										<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
									</svg>
									<span id="btn-text">Source with Easy AI</span>
									<span class="text-[#FFD000]">&rarr;</span>
								</button>
							</div>

							<!-- Simulation Result Toast / Quote Summary -->
							<div id="consolidated-box-result" class="hidden mt-2.5 p-2.5 bg-[#FAF6EE] rounded-xl border border-[#FFD000] shadow-sm animate-fade-in">
								<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
									<div class="flex items-center gap-2">
										<span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-[#FFD000] text-[#191917]">
											<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
												<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
											</svg>
										</span>
										<div>
											<h4 class="text-3xs font-bold text-[#191917]">Unified Quote Ready • Connecting to Ask Easy</h4>
											<p class="text-4xs text-[#5C5549]">Single Consolidated Invoice Delivery.</p>
										</div>
									</div>
									<div class="flex items-center gap-1.5 w-full sm:w-auto justify-end">
										<button onclick="startSourcingSimulation()" class="bg-[#FFD000] text-[#191917] px-2.5 py-1 rounded-lg text-4xs font-extrabold shadow-xs hover:bg-[#F2C200] whitespace-nowrap cursor-pointer w-full sm:w-auto text-center">
											Continue &rarr;
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>



				</div>

				<!-- Right Column: Curated EasyBuy Product Haul Floating Over Sun Backdrop -->
				<div class="lg:col-span-6 relative flex items-center justify-center min-h-[280px] sm:min-h-[380px] lg:min-h-[520px] scroll-reveal-scale delay-150">
					
					<!-- Focal Curated Product Collection Haul (Kept Large & Impactful as requested) -->
					<div class="relative w-full max-w-[340px] sm:max-w-[480px] lg:max-w-[650px] xl:max-w-[700px]">
						<img src="{{ asset('images/hero-collection.jpg') }}" 
							alt="Curated EasyBuy Procurement Haul with Branded Bags and Boxes" 
							class="w-full h-auto object-contain select-none pointer-events-none drop-shadow-md blend-multiply-clean" />
					</div>

					<!-- Floating Micro Trust Badges (Tightly tucked in with mobile-safe positioning) -->
					<div class="absolute top-1 sm:top-4 right-0 sm:right-4 clay-card rounded-xl px-2 sm:px-2.5 py-1 sm:py-1.5 shadow-xs border border-[#E0D3C1] flex items-center gap-1.5 bg-[#FAF6EE]/95 backdrop-blur-xs scroll-reveal delay-300">
						<span class="flex h-4 w-4 sm:h-5 sm:w-5 items-center justify-center rounded-lg bg-[#E7EFE6] text-emerald-600 text-3xs font-bold">
							<svg class="h-2.5 w-2.5 sm:h-3 sm:w-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
								<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
							</svg>
						</span>
						<div>
							<p class="text-4xs sm:text-3xs font-extrabold text-[#191917]">1,400+ Verified Suppliers</p>
							<p class="text-4xs sm:text-3xs text-[#5C5549]">Guaranteed Factory Direct</p>
						</div>
					</div>

					<div class="absolute bottom-1 sm:bottom-2 left-0 sm:left-2 clay-card rounded-xl px-2 sm:px-2.5 py-1 sm:py-1.5 shadow-xs border border-[#E0D3C1] flex items-center gap-1.5 bg-[#FAF6EE]/95 backdrop-blur-xs scroll-reveal delay-400">
						<span class="flex h-4 w-4 sm:h-5 sm:w-5 items-center justify-center rounded-lg bg-[#FFD000] text-[#191917] text-3xs font-black shadow-2xs">
							<svg class="h-2.5 w-2.5 sm:h-3 sm:w-3 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
							</svg>
						</span>
						<div>
							<p class="text-4xs sm:text-3xs font-extrabold text-[#191917]">Average 34% Savings</p>
							<p class="text-4xs sm:text-3xs text-[#5C5549]">Consolidated in 1 Invoice</p>
						</div>
					</div>

				</div>

			</div>
		</div>
	</section>

	<!-- Floating Interactive Packaging Video Seam Bridge -->
	<div id="seam-video-container" class="relative w-full z-20 pointer-events-none -my-8 sm:-my-14 lg:-my-20 flex justify-center items-center">
		<div class="pointer-events-auto relative flex flex-col items-center group cursor-pointer transition-transform duration-300 hover:scale-105">
			<!-- Ambient Soft Warm Glow -->
			<div class="absolute inset-0 bg-[#FFD000]/15 rounded-full blur-3xl transform scale-90 transition group-hover:scale-110 pointer-events-none"></div>
			
			<!-- Canvas Frame with Pure Alpha Background -->
			<div class="relative w-36 sm:w-52 md:w-64 lg:w-72 aspect-square flex items-center justify-center select-none">
				<canvas id="seam-bag-canvas" width="960" height="960" class="w-full h-full object-contain pointer-events-none select-none drop-shadow-md"></canvas>
			</div>
		</div>
	</div>

	<!-- Section 2: Visual Storytelling — How EasyBuy Works -->
	<section id="how-it-works" class="py-12 sm:py-16 lg:py-20 border-t border-[#E0D3C1]/80 bg-[#F2EAE0]/40 overflow-hidden">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			
			<!-- Dynamic Composition: Product Haul (Left/Center) + Orbiting Step Cards (Right) -->
			<div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
				
				<!-- Left & Center Column: Wide Product Haul Image + Bottom Left Thinking Bubble -->
				<div class="lg:col-span-7 flex flex-col items-center lg:items-start relative scroll-reveal-left">
					
					<!-- Soft Ambient Glow behind Product Haul -->
					<div class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 w-4/5 aspect-square bg-[#FFD000]/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

					<!-- Wide Product Haul Image (Clean, No Floating Badges) -->
					<div class="relative w-full max-w-[640px] group transition-transform duration-500 hover:scale-[1.01]">
						<img src="{{ asset('images/hero-collection-wide-removebg-preview.png') }}" 
							alt="Curated EasyBuy Multi-Category Wholesale Procurement Haul" 
							class="w-full h-auto object-contain select-none pointer-events-none drop-shadow-lg" />
					</div>

					<!-- Bottom-Left Thinking Bubble Card (Seamless Blend, No Borders, No Noise) -->
					<div class="w-full max-w-xl mt-4 lg:-mt-4 relative z-10">
						
						<!-- Thinking Bubble Card Container (Borderless, Blends with BG) -->
						<div class="rounded-[32px] p-6 sm:p-8 bg-[#FAF6EE]/90 shadow-sm relative hover:shadow-md transition duration-300">
							
							<!-- High-Visibility Thought Bubble Trail Leading Directly Towards Right Step Cards -->
							<div class="hidden lg:flex absolute -right-12 -top-6 items-end gap-3 pointer-events-none z-30 select-none">
								<!-- Bubble 1: Small origin at card edge -->
								<span class="h-3.5 w-3.5 rounded-full bg-[#FFD000] shadow-sm mb-1"></span>
								
								<!-- Bubble 2: Medium rising bubble -->
								<span class="h-5 w-5 rounded-full bg-[#FAF6EE] border border-[#D8C9B5] shadow-sm mb-3.5 flex items-center justify-center">
									<span class="h-1.5 w-1.5 rounded-full bg-[#FFD000]"></span>
								</span>
								
								<!-- Bubble 3: Larger expanding bubble -->
								<span class="h-7 w-7 rounded-full bg-[#FAF6EE] border border-[#D8C9B5] shadow-md mb-6 flex items-center justify-center">
									<span class="h-2.5 w-2.5 rounded-full bg-[#FFD000]"></span>
								</span>
								
								<!-- Bubble 4: Large sunny pointer bubble clearly pointing right at the cards -->
								<div class="h-10 w-10 rounded-full bg-[#FFD000] text-[#191917] shadow-lg mb-9 flex items-center justify-center border border-[#E0D3C1]">
									<svg class="h-5 w-5 text-[#191917] transform translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
										<path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
									</svg>
								</div>
							</div>

							<!-- Clean Pill Badge -->
							<div class="mb-3">
								<span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#FFD000] text-[#191917] text-3xs font-black uppercase tracking-wider">
									<svg class="h-3 w-3 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
										<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
									</svg>
									<span>The Procurement Revolution</span>
								</span>
							</div>

							<!-- Main Headline inside Thinking Bubble -->
							<h2 class="text-2xl sm:text-3xl lg:text-[2.15rem] font-extrabold text-[#191917] font-heading tracking-tight leading-[1.12]">
								How EasyBuy Eliminates Sourcing Chaos
							</h2>

							<!-- Narrative Description -->
							<p class="mt-3 text-xs sm:text-sm text-[#5C5549] leading-relaxed">
								From raw requisition to consolidated delivery — see how EasyBuy bundles your equipment, supplies, and hardware into <strong class="text-[#191917]">one single invoice</strong>.
							</p>

						</div>
					</div>

				</div>

				<!-- Right Column: 3 Orbiting Step Cards (Borderless, Clean & Blending Seamlessly) -->
				<div class="lg:col-span-5 flex flex-col space-y-4 sm:space-y-5">
					
					<!-- Card 1: Top Right -->
					<div class="rounded-3xl p-6 sm:p-7 hover:translate-x-1.5 transition duration-300 bg-[#FAF6EE]/80 hover:bg-[#FAF6EE] shadow-xs hover:shadow-sm relative group scroll-reveal-right delay-100">
						<div class="flex items-start gap-4">
							<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#FFD000] text-[#191917] font-black text-lg shadow-xs group-hover:scale-105 transition">
								01
							</div>
							<div class="space-y-1">
								<h3 class="text-base sm:text-lg font-bold text-[#191917] font-heading">
									Paste Any List or Request
								</h3>
								<p class="text-xs sm:text-sm text-[#5C5549] leading-relaxed">
									No need to browse dozens of complex catalogs. Paste your Excel spreadsheet, bulleted shopping list, or describe your requirements in plain English.
								</p>
							</div>
						</div>
					</div>

					<!-- Card 2: Angled Mid-Right (Subtly Stepped) -->
					<div class="rounded-3xl p-6 sm:p-7 lg:translate-x-3 hover:translate-x-4 transition duration-300 bg-[#FAF6EE]/90 hover:bg-[#FAF6EE] shadow-xs hover:shadow-sm relative group scroll-reveal-right delay-200">
						<div class="flex items-start gap-4">
							<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#191917] text-[#FFD000] font-black text-lg shadow-xs group-hover:scale-105 transition">
								02
							</div>
							<div class="space-y-1">
								<h3 class="text-base sm:text-lg font-bold text-[#191917] font-heading">
									Smart Factory Matching
								</h3>
								<p class="text-xs sm:text-sm text-[#5C5549] leading-relaxed">
									Our AI parses your bill of materials and instantly pairs each line item with verified direct manufacturers at wholesale tiered pricing.
								</p>
							</div>
						</div>
					</div>

					<!-- Card 3: Lower-Right -->
					<div class="rounded-3xl p-6 sm:p-7 hover:translate-x-1.5 transition duration-300 bg-[#FAF6EE]/80 hover:bg-[#FAF6EE] shadow-xs hover:shadow-sm relative group scroll-reveal-right delay-300">
						<div class="flex items-start gap-4">
							<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#191917] text-[#FAF6EE] font-black text-lg shadow-xs group-hover:scale-105 transition">
								03
							</div>
							<div class="space-y-1">
								<h3 class="text-base sm:text-lg font-bold text-[#191917] font-heading">
									1 Consolidated Invoice & Delivery
								</h3>
								<p class="text-xs sm:text-sm text-[#5C5549] leading-relaxed">
									Approve your consolidated purchase order with Net-30/60 terms. We coordinate freight drops, blind-pack boxes, and send 1 clear tax invoice.
								</p>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</section>

	<!-- Section 3: Dual-Discovery Sourcing (Interactive Catalog Preview) -->
	<section id="catalog" class="py-16 sm:py-24 border-t border-[#E0D3C1] bg-[#FAF6EE] relative overflow-hidden">
		
		<!-- Ambient Radial Background Glows -->
		<div class="catalog-bg-glow absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-[#FFD000]/10 rounded-full blur-3xl pointer-events-none -z-10 transition-transform duration-700"></div>

		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			
			<!-- Section Header -->
			<div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16 scroll-reveal">
				<div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#FFD000] text-[#191917] text-3xs font-black uppercase tracking-wider shadow-2xs">
					<svg class="h-3 w-3 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
					</svg>
					<span>DUAL-DISCOVERY PROCUREMENT</span>
					<span>•</span>
					<span>TOP CATEGORIES</span>
				</div>
				<h2 class="mt-3 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold text-[#191917] font-heading tracking-tight leading-tight">
					Verified Factory Direct Catalog
				</h2>
				<p class="mt-2 text-xs sm:text-sm text-[#5C5549] max-w-lg mx-auto leading-relaxed">
					Browse high-demand corporate essentials or let EasyBuy source custom bills of materials directly from verified manufacturers.
				</p>
			</div>

			<!-- 4 Category Cards -->
			<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
				
				<!-- Category 1 -->
				<div class="group clay-card rounded-2xl p-4 sm:p-5 hover:translate-y-[-4px] transition duration-300 flex flex-col justify-between cursor-pointer scroll-reveal-scale delay-100">
					<div>
						<div class="h-44 sm:h-48 w-full rounded-xl overflow-hidden border border-[#E0D3C1] relative mb-4 bg-[#FAF6EE]">
							<img src="{{ asset('images/3d-refs/ergo_chair.jpg') }}" 
								alt="Ergonomic Chairs" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
							<span class="absolute top-2.5 right-2.5 text-4xs font-bold px-2 py-0.5 rounded-md bg-[#FFD000] text-[#191917] shadow-xs">Avg 38% Off</span>
						</div>
						<span class="inline-block px-2 py-0.5 rounded-md bg-[#FAF6EE] text-[#191917] text-3xs font-black uppercase tracking-wider border border-[#E0D3C1]">Ergonomics</span>
						<h4 class="text-base font-bold text-[#191917] font-heading mt-2">Workstation & Seating</h4>
						<p class="text-xs text-[#5C5549] mt-1.5 leading-relaxed">Mesh task chairs, dual-motor standing desks, ergonomic arms.</p>
					</div>
					<div class="mt-4 pt-3 border-t border-[#E0D3C1] flex items-center justify-between text-xs font-semibold text-[#191917]">
						<span>B2B Minimum: 5 Units</span>
						<span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] text-2xs font-extrabold group-hover:scale-110 transition">&rarr;</span>
					</div>
				</div>

				<!-- Category 2 -->
				<div class="group clay-card rounded-2xl p-4 sm:p-5 hover:translate-y-[-4px] transition duration-300 flex flex-col justify-between cursor-pointer scroll-reveal-scale delay-200">
					<div>
						<div class="h-44 sm:h-48 w-full rounded-xl overflow-hidden border border-[#E0D3C1] relative mb-4 bg-[#FAF6EE]">
							<img src="{{ asset('images/3d-refs/4k_display.jpg') }}" 
								alt="IT Monitors" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
							<span class="absolute top-2.5 right-2.5 text-4xs font-bold px-2 py-0.5 rounded-md bg-[#FFD000] text-[#191917] shadow-xs">3-Yr Warranty</span>
						</div>
						<span class="inline-block px-2 py-0.5 rounded-md bg-[#FAF6EE] text-[#191917] text-3xs font-black uppercase tracking-wider border border-[#E0D3C1]">IT & Infrastructure</span>
						<h4 class="text-base font-bold text-[#191917] font-heading mt-2">Displays & Peripherals</h4>
						<p class="text-xs text-[#5C5549] mt-1.5 leading-relaxed">4K USB-C business displays, docks, surge arrays, peripherals.</p>
					</div>
					<div class="mt-4 pt-3 border-t border-[#E0D3C1] flex items-center justify-between text-xs font-semibold text-[#191917]">
						<span>B2B Minimum: 10 Units</span>
						<span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] text-2xs font-extrabold group-hover:scale-110 transition">&rarr;</span>
					</div>
				</div>

				<!-- Category 3 -->
				<div class="group clay-card rounded-2xl p-4 sm:p-5 hover:translate-y-[-4px] transition duration-300 flex flex-col justify-between cursor-pointer scroll-reveal-scale delay-300">
					<div>
						<div class="h-44 sm:h-48 w-full rounded-xl overflow-hidden border border-[#E0D3C1] relative mb-4 bg-[#FAF6EE]">
							<img src="{{ asset('images/3d-refs/modern_lamp.jpg') }}" 
								alt="Lighting" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
							<span class="absolute top-2.5 right-2.5 text-4xs font-bold px-2 py-0.5 rounded-md bg-[#FFD000] text-[#191917] shadow-xs">Commercial Spec</span>
						</div>
						<span class="inline-block px-2 py-0.5 rounded-md bg-[#FAF6EE] text-[#191917] text-3xs font-black uppercase tracking-wider border border-[#E0D3C1]">Facilities</span>
						<h4 class="text-base font-bold text-[#191917] font-heading mt-2">Lighting & Architecture</h4>
						<p class="text-xs text-[#5C5549] mt-1.5 leading-relaxed">Curved LED task lamps, acoustic baffles, modular charging bars.</p>
					</div>
					<div class="mt-4 pt-3 border-t border-[#E0D3C1] flex items-center justify-between text-xs font-semibold text-[#191917]">
						<span>B2B Minimum: 8 Units</span>
						<span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] text-2xs font-extrabold group-hover:scale-110 transition">&rarr;</span>
					</div>
				</div>

				<!-- Category 4 -->
				<div class="group clay-card rounded-2xl p-4 sm:p-5 hover:translate-y-[-4px] transition duration-300 flex flex-col justify-between cursor-pointer scroll-reveal-scale delay-400">
					<div>
						<div class="h-44 sm:h-48 w-full rounded-xl overflow-hidden border border-[#E0D3C1] relative mb-4 bg-[#FAF6EE]">
							<img src="{{ asset('images/3d-refs/smart_hub.jpg') }}" 
								alt="Smart Hubs & Power" class="h-full w-full object-cover group-hover:scale-105 transition duration-500"
								onerror="this.src='{{ asset('images/3d-refs/standing_desk.jpg') }}'" />
							<span class="absolute top-2.5 right-2.5 text-4xs font-bold px-2 py-0.5 rounded-md bg-[#FFD000] text-[#191917] shadow-xs">Smart Auto-Reorder</span>
						</div>
						<span class="inline-block px-2 py-0.5 rounded-md bg-[#FFD000] text-[#191917] text-3xs font-black uppercase tracking-wider">Smart Tech</span>
						<h4 class="text-base font-bold text-[#191917] font-heading mt-2">Hubs & Automation</h4>
						<p class="text-xs text-[#5C5549] mt-1.5 leading-relaxed">Wireless desktop docks, sensor arrays, automatic procurement.</p>
					</div>
					<div class="mt-4 pt-3 border-t border-[#E0D3C1] flex items-center justify-between text-xs font-semibold text-[#191917]">
						<span>Price-Drop Protection</span>
						<span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] text-2xs font-extrabold group-hover:scale-110 transition">&rarr;</span>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Section 4: Scattered Wall of Trust (Artistic Organic Review Collage) -->
	<section id="reviews" class="py-16 sm:py-24 border-t border-[#E0D3C1]/80 bg-[#FAF6EE] relative overflow-hidden">
		
		<!-- Ambient Background Radial Glows -->
		<div class="absolute top-1/3 left-1/4 w-80 h-80 bg-[#FFD000]/10 rounded-full blur-3xl pointer-events-none"></div>
		<div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-[#FFD000]/10 rounded-full blur-3xl pointer-events-none"></div>

		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
			
			<!-- Section Header -->
			<div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16 scroll-reveal">
				<div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#FFD000] text-[#191917] text-3xs font-black uppercase tracking-wider shadow-2xs">
					<svg class="h-3 w-3 text-[#191917] fill-current" viewBox="0 0 20 20">
						<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
					</svg>
					<span>WALL OF TRUST</span>
					<span>•</span>
					<span>4.9 / 5 RATING (820+ BUSINESSES & AGENTS)</span>
				</div>
				<h2 class="mt-3 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold text-[#191917] font-heading tracking-tight leading-tight">
					Trusted by Businesses & Sourcing Agents
				</h2>
				<p class="mt-2 text-xs sm:text-sm text-[#5C5549] max-w-lg mx-auto leading-relaxed">
					Real notes from procurement directors, commercial sourcing agents, and operations leads who eliminated sourcing friction and bulk buying markups.
				</p>
			</div>

			<!-- Truly Scattered Organic Collage Wall -->
			<div class="relative max-w-6xl mx-auto flex flex-wrap justify-center items-start gap-4 sm:gap-6 lg:gap-7 pt-4 pb-8">
				
				<!-- Note 1: Sand Post-It (-3 deg on desktop, flat on mobile) -->
				<div class="scroll-reveal-pop delay-100 w-full sm:w-auto">
					<div class="group relative w-full sm:w-[270px] rounded-2xl p-4 sm:p-4.5 bg-[#F2EAE0] shadow-xs hover:shadow-2xl transition-all duration-300 transform sm:-rotate-3 sm:hover:rotate-0 hover:scale-105 sm:hover:scale-110 hover:z-30 cursor-pointer select-none">
						<!-- Pin -->
						<div class="absolute -top-2 left-6 select-none">
							<span class="flex h-3.5 w-3.5 items-center justify-center rounded-full bg-[#FF5A36] shadow-xs border border-[#FAF6EE]">
								<span class="h-1 w-1 rounded-full bg-white"></span>
							</span>
						</div>
						<div class="flex items-center gap-0.5 text-[#FFD000] text-xs mb-2">★★★★★</div>
						<p class="text-xs font-bold text-[#191917] leading-snug mb-1.5">
							“Cut 14 vendor POs into 1 consolidated delivery. Sourcing overhead dropped 70%.”
						</p>
						<p class="text-3xs text-[#7A7365] leading-relaxed mb-3">
							Unified line-item tracking and zero supplier billing clutter. Our accounting team is thrilled.
						</p>
						<div class="pt-2.5 border-t border-[#E0D3C1] flex items-center justify-between">
							<div class="flex items-center gap-2">
								<img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&auto=format&fit=crop&q=80" 
									alt="Sarah Jenkins" class="h-7 w-7 rounded-full object-cover border border-[#D8C9B5]">
								<div>
									<h4 class="text-3xs font-bold text-[#191917]">Sarah Jenkins</h4>
									<p class="text-4xs text-[#9C9283]">Senior Sourcing Agent @ Apex Logistics</p>
								</div>
							</div>
							<span class="text-4xs font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded">✓ Verified Agent</span>
						</div>
					</div>
				</div>

				<!-- Sticker 1: Mini Trust Badge (Rotated +6 deg) -->
				<div class="scroll-reveal-pop delay-150 hidden sm:block">
					<div class="hidden sm:flex flex-col items-center justify-center w-28 h-28 rounded-full bg-[#FFD000] text-[#191917] p-2 text-center shadow-sm transform rotate-6 hover:rotate-0 hover:scale-115 hover:z-30 transition cursor-pointer select-none -mt-4">
						<svg class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
						</svg>
						<span class="text-3xs font-black uppercase tracking-tight leading-tight">34% AVG</span>
						<span class="text-4xs font-bold opacity-80">Saved Per PO</span>
					</div>
				</div>

				<!-- Note 2: Golden Sticky Note (+4 deg on desktop, flat on mobile) -->
				<div class="scroll-reveal-pop delay-200 w-full sm:w-auto">
					<div class="group relative w-full sm:w-[280px] rounded-2xl p-4 sm:p-4.5 bg-[#FFD000]/25 border border-[#FFD000]/50 shadow-xs hover:shadow-2xl transition-all duration-300 transform sm:rotate-4 sm:hover:rotate-0 hover:scale-105 sm:hover:scale-110 hover:z-30 cursor-pointer select-none sm:translate-y-4">
						<!-- Tape -->
						<div class="absolute -top-3 left-1/2 -translate-x-1/2 w-12 h-4 bg-[#FAF6EE]/80 backdrop-blur-xs rounded-xs border border-[#E0D3C1] shadow-2xs rotate-2"></div>
						<div class="flex items-center gap-0.5 text-[#191917] text-xs mb-2 font-black">★★★★★</div>
						<p class="text-xs font-bold text-[#191917] leading-snug mb-1.5">
							“Sourced 40 workstations across 3 regional branches in under 48 hours.”
						</p>
						<p class="text-3xs text-[#191917]/75 leading-relaxed mb-3">
							Pasted our multi-branch spec sheet and locked in Tier 1 factory pricing with scheduled drops.
						</p>
						<div class="pt-2.5 border-t border-[#FFD000]/60 flex items-center justify-between">
							<div class="flex items-center gap-2">
								<img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&auto=format&fit=crop&q=80" 
									alt="Marcus Vance" class="h-7 w-7 rounded-full object-cover border border-[#D8C9B5]">
								<div>
									<h4 class="text-3xs font-bold text-[#191917]">Marcus Vance</h4>
									<p class="text-4xs text-[#191917]/70">VP Procurement @ CloudFlow</p>
								</div>
							</div>
							<span class="text-4xs font-black bg-[#191917] text-[#FAF6EE] px-1.5 py-0.5 rounded">Bulk Order</span>
						</div>
					</div>
				</div>

				<!-- Note 3: Clean Cream Note (-2 deg on desktop, flat on mobile) -->
				<div class="scroll-reveal-pop delay-250 w-full sm:w-auto">
					<div class="group relative w-full sm:w-[260px] rounded-2xl p-4 sm:p-4.5 bg-[#FAF6EE] border border-[#E0D3C1]/90 shadow-xs hover:shadow-2xl transition-all duration-300 transform sm:-rotate-2 sm:hover:rotate-0 hover:scale-105 sm:hover:scale-110 hover:z-30 cursor-pointer select-none sm:-translate-y-2">
						<!-- Pin -->
						<div class="absolute -top-2 right-6 select-none">
							<span class="flex h-3.5 w-3.5 items-center justify-center rounded-full bg-[#191917] shadow-xs border border-[#FAF6EE]">
								<span class="h-1 w-1 rounded-full bg-white"></span>
							</span>
						</div>
						<div class="flex items-center gap-0.5 text-[#FFD000] text-xs mb-2">★★★★★</div>
						<p class="text-xs font-bold text-[#191917] leading-snug mb-1.5">
							“Saved ₦38,000,000 on our commercial studio fit-out. Wholesale pricing is 100% genuine.”
						</p>
						<p class="text-3xs text-[#7A7365] leading-relaxed mb-3">
							Pre-inspected batches and direct manufacturer warranties gave our clients total peace of mind.
						</p>
						<div class="pt-2.5 border-t border-[#E0D3C1] flex items-center justify-between">
							<div class="flex items-center gap-2">
								<img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=120&auto=format&fit=crop&q=80" 
									alt="Elena Rostova" class="h-7 w-7 rounded-full object-cover border border-[#D8C9B5]">
								<div>
									<h4 class="text-3xs font-bold text-[#191917]">Elena Rostova</h4>
									<p class="text-4xs text-[#9C9283]">Procurement Director @ Studio Mono Group</p>
								</div>
							</div>
							<span class="text-4xs font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded">✓ Verified Buyer</span>
						</div>
					</div>
				</div>

				<!-- Note 4: Dark Contrast Post-It (+5 deg on desktop, flat on mobile) -->
				<div class="scroll-reveal-pop delay-300 w-full sm:w-auto">
					<div class="group relative w-full sm:w-[250px] rounded-2xl p-4 sm:p-4.5 bg-[#191917] text-[#FAF6EE] shadow-sm hover:shadow-2xl transition-all duration-300 transform sm:rotate-5 sm:hover:rotate-0 hover:scale-105 sm:hover:scale-110 hover:z-30 cursor-pointer select-none sm:translate-y-6">
						<!-- Clip -->
						<div class="absolute -top-2 left-8 select-none">
							<span class="flex h-3.5 w-3.5 items-center justify-center rounded-full bg-[#FFD000] shadow-xs border border-[#FAF6EE]">
								<span class="h-1 w-1 rounded-full bg-[#191917]"></span>
							</span>
						</div>
						<div class="flex items-center gap-0.5 text-[#FFD000] text-xs mb-2">★★★★★</div>
						<p class="text-xs font-bold text-[#FAF6EE] leading-snug mb-1.5">
							“Corporate Net-60 terms and zero customs hassle. Requisition cycle: 3 weeks → 15 mins.”
						</p>
						<p class="text-3xs text-[#FAF6EE]/70 leading-relaxed mb-3">
							Single consolidated commercial invoice streamlined multi-entity accounting.
						</p>
						<div class="pt-2.5 border-t border-[#333333] flex items-center justify-between">
							<div class="flex items-center gap-2">
								<img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=120&auto=format&fit=crop&q=80" 
									alt="Priya Sharma" class="h-7 w-7 rounded-full object-cover border border-[#444444]">
								<div>
									<h4 class="text-3xs font-bold text-[#FAF6EE]">Priya Sharma</h4>
									<p class="text-4xs text-[#FAF6EE]/60">Head of Purchasing @ Nexa Health Group</p>
								</div>
							</div>
							<span class="text-4xs font-black bg-[#FFD000] text-[#191917] px-1.5 py-0.5 rounded">Net-60</span>
						</div>
					</div>
				</div>

				<!-- Note 5: Sand Post-It (-4 deg on desktop, flat on mobile) -->
				<div class="scroll-reveal-pop delay-350 w-full sm:w-auto">
					<div class="group relative w-full sm:w-[270px] rounded-2xl p-4 sm:p-4.5 bg-[#F2EAE0] shadow-xs hover:shadow-2xl transition-all duration-300 transform sm:-rotate-4 sm:hover:rotate-0 hover:scale-105 sm:hover:scale-110 hover:z-30 cursor-pointer select-none sm:-translate-y-4">
						<!-- Tape -->
						<div class="absolute -top-3 right-8 w-12 h-4 bg-[#FAF6EE]/80 backdrop-blur-xs rounded-xs border border-[#E0D3C1] shadow-2xs -rotate-3"></div>
						<div class="flex items-center gap-0.5 text-[#FFD000] text-xs mb-2">★★★★★</div>
						<p class="text-xs font-bold text-[#191917] leading-snug mb-1.5">
							“Recurring facilities and supply restocks arrive on autopilot across 5 sites.”
						</p>
						<p class="text-3xs text-[#7A7365] leading-relaxed mb-3">
							Replaced 8 disjointed vendor delivery drivers with 1 scheduled EasyBuy logistics drop.
						</p>
						<div class="pt-2.5 border-t border-[#E0D3C1] flex items-center justify-between">
							<div class="flex items-center gap-2">
								<img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=120&auto=format&fit=crop&q=80" 
									alt="David Park" class="h-7 w-7 rounded-full object-cover border border-[#D8C9B5]">
								<div>
									<h4 class="text-3xs font-bold text-[#191917]">David Park</h4>
									<p class="text-4xs text-[#9C9283]">Facilities Lead @ Horizon Commercial</p>
								</div>
							</div>
							<span class="text-4xs font-bold bg-[#FAF6EE] text-[#191917] px-1.5 py-0.5 rounded border border-[#E0D3C1]">Autopilot PO</span>
						</div>
					</div>
				</div>

				<!-- Sticker 2: Mini Star Stamp (-8 deg) -->
				<div class="scroll-reveal-pop delay-400 hidden sm:block">
					<div class="hidden sm:flex flex-col items-center justify-center w-28 h-28 rounded-3xl bg-[#FAF6EE] border-2 border-dashed border-[#D8C9B5] text-[#191917] p-2 text-center shadow-xs transform -rotate-8 hover:rotate-0 hover:scale-115 hover:z-30 transition cursor-pointer select-none sm:translate-y-2">
						<span class="text-xs font-black text-emerald-600">✓ 100% Direct</span>
						<span class="text-3xs font-extrabold uppercase tracking-tight text-[#191917]">Factory Spec</span>
						<span class="text-4xs text-[#7A7365]">Warranty</span>
					</div>
				</div>

				<!-- Note 6: Cream Note (+3 deg on desktop, flat on mobile) -->
				<div class="scroll-reveal-pop delay-450 w-full sm:w-auto">
					<div class="group relative w-full sm:w-[275px] rounded-2xl p-4 sm:p-4.5 bg-[#FAF6EE] border border-[#E0D3C1]/90 shadow-xs hover:shadow-2xl transition-all duration-300 transform sm:rotate-3 sm:hover:rotate-0 hover:scale-105 sm:hover:scale-110 hover:z-30 cursor-pointer select-none sm:translate-y-5">
						<!-- Pin -->
						<div class="absolute -top-2 left-10 select-none">
							<span class="flex h-3.5 w-3.5 items-center justify-center rounded-full bg-[#FF5A36] shadow-xs border border-[#FAF6EE]">
								<span class="h-1 w-1 rounded-full bg-white"></span>
							</span>
						</div>
						<div class="flex items-center gap-0.5 text-[#FFD000] text-xs mb-2">★★★★★</div>
						<p class="text-xs font-bold text-[#191917] leading-snug mb-1.5">
							“I manage purchasing for 12 corporate clients. EasyBuy is my secret weapon.”
						</p>
						<p class="text-3xs text-[#7A7365] leading-relaxed mb-3">
							Instant batch quoting and automated purchase order generation saves me 20+ hours a week.
						</p>
						<div class="pt-2.5 border-t border-[#E0D3C1] flex items-center justify-between">
							<div class="flex items-center gap-2">
								<img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=120&auto=format&fit=crop&q=80" 
									alt="Liam Campbell" class="h-7 w-7 rounded-full object-cover border border-[#D8C9B5]">
								<div>
									<h4 class="text-3xs font-bold text-[#191917]">Liam Campbell</h4>
									<p class="text-4xs text-[#9C9283]">Independent Sourcing Consultant</p>
								</div>
							</div>
							<span class="text-4xs font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded">✓ Certified Agent</span>
						</div>
					</div>
				</div>

				<!-- Note 7: Sand Post-It (-5 deg on desktop, flat on mobile) -->
				<div class="scroll-reveal-pop delay-500 w-full sm:w-auto">
					<div class="group relative w-full sm:w-[260px] rounded-2xl p-4 sm:p-4.5 bg-[#F2EAE0] shadow-xs hover:shadow-2xl transition-all duration-300 transform sm:-rotate-5 sm:hover:rotate-0 hover:scale-105 sm:hover:scale-110 hover:z-30 cursor-pointer select-none sm:-translate-y-3">
						<!-- Pin -->
						<div class="absolute -top-2 right-8 select-none">
							<span class="flex h-3.5 w-3.5 items-center justify-center rounded-full bg-[#191917] shadow-xs border border-[#FAF6EE]">
								<span class="h-1 w-1 rounded-full bg-white"></span>
							</span>
						</div>
						<div class="flex items-center gap-0.5 text-[#FFD000] text-xs mb-2">★★★★★</div>
						<p class="text-xs font-bold text-[#191917] leading-snug mb-1.5">
							“Standardized our entire enterprise sourcing pipeline into one clean system.”
						</p>
						<p class="text-3xs text-[#7A7365] leading-relaxed mb-3">
							Automated ERP export, verified vendor compliance, and single payment terms across all departments.
						</p>
						<div class="pt-2.5 border-t border-[#E0D3C1] flex items-center justify-between">
							<div class="flex items-center gap-2">
								<img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=120&auto=format&fit=crop&q=80" 
									alt="Rachel Kim" class="h-7 w-7 rounded-full object-cover border border-[#D8C9B5]">
								<div>
									<h4 class="text-3xs font-bold text-[#191917]">Rachel Kim</h4>
									<p class="text-4xs text-[#9C9283]">Director of Procurement @ HyperScale Dynamics</p>
								</div>
							</div>
							<span class="text-4xs font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded">✓ Verified Business</span>
						</div>
					</div>
				</div>

			</div>

			<!-- Bottom Minimal Summary -->
			<div class="mt-8 sm:mt-10 text-center scroll-reveal delay-200">
				<div class="inline-flex flex-col sm:flex-row flex-wrap items-center justify-center gap-3 sm:gap-6 lg:gap-8 px-5 sm:px-6 py-3 sm:py-3 rounded-2xl bg-[#F2EAE0] border border-[#E0D3C1] shadow-2xs text-3xs font-bold text-[#7A7365]">
					<span class="flex items-center gap-1.5 text-[#191917]">
						<svg class="h-3.5 w-3.5 text-emerald-600 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
							<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
						</svg>
						<span>100% Brand Backed Warranty</span>
					</span>
					<span class="hidden sm:inline-block h-3 w-px bg-[#D8C9B5]"></span>
					<span class="flex items-center gap-1.5 text-[#191917]">
						<svg class="h-3.5 w-3.5 text-[#191917] font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
						</svg>
						<span>Average 34% Requisition Savings</span>
					</span>
					<span class="hidden sm:inline-block h-3 w-px bg-[#D8C9B5]"></span>
					<span class="flex items-center gap-1.5 text-[#191917]">
						<svg class="h-3.5 w-3.5 text-[#191917] font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
						</svg>
						<span>1,400+ Verified Direct Suppliers</span>
					</span>
				</div>
			</div>

		</div>
	</section>

	<!-- Section 5: Frequently Asked Questions (FAQ) -->
	<section id="faq" class="py-12 sm:py-20 lg:py-24 border-t border-[#E0D3C1] bg-[#FAF6EE] relative overflow-hidden">
		
		<!-- Ambient Background Radial Glows -->
		<div class="faq-bg-glow absolute top-1/4 right-1/4 w-96 h-96 bg-[#FFD000]/10 rounded-full blur-3xl pointer-events-none transition-transform duration-700"></div>
		<div class="faq-bg-glow absolute bottom-1/4 left-1/4 w-96 h-96 bg-[#FFD000]/10 rounded-full blur-3xl pointer-events-none transition-transform duration-700"></div>

		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
			
			<!-- Section Header -->
			<div class="text-center max-w-2xl mx-auto mb-10 sm:mb-16 scroll-reveal">
				<div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#FFD000] text-[#191917] text-3xs font-black uppercase tracking-wider shadow-2xs">
					<svg class="h-3 w-3 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
					<span>PROCUREMENT INTELLIGENCE</span>
					<span>•</span>
					<span>FREQUENTLY ASKED QUESTIONS</span>
				</div>
				<h2 class="mt-3 text-2xl sm:text-4xl lg:text-[2.75rem] font-extrabold text-[#191917] font-heading tracking-tight leading-tight">
					Got Questions About Wholesale Sourcing?
				</h2>
				<p class="mt-2 text-xs sm:text-sm text-[#5C5549] max-w-lg mx-auto leading-relaxed">
					Clear answers on single-invoice PO consolidation, factory direct pricing, corporate credit terms, and multi-branch logistics.
				</p>
			</div>

			<!-- FAQ Grid: 2 Columns on Large Screens -->
			<div class="grid lg:grid-cols-2 gap-3.5 sm:gap-6 max-w-6xl mx-auto">
				
				<!-- FAQ Item 1 -->
				<div class="faq-item rounded-2xl bg-[#F2EAE0] border border-[#E0D3C1] p-4 sm:p-6 transition-all duration-300 shadow-2xs hover:shadow-sm scroll-reveal delay-100" data-faq-id="1">
					<button onclick="toggleFaq(1)" class="w-full flex items-center justify-between gap-3 sm:gap-4 text-left cursor-pointer group" aria-expanded="false">
						<span class="text-xs sm:text-base font-bold text-[#191917] font-heading group-hover:text-[#191917] transition leading-snug">
							How does single-invoice consolidation work with multiple suppliers?
						</span>
						<span class="faq-icon flex h-6 w-6 sm:h-7 sm:w-7 shrink-0 items-center justify-center rounded-full bg-[#FAF6EE] text-[#191917] font-bold text-xs sm:text-sm border border-[#D8C9B5] group-hover:bg-[#FFD000] transition">
							+
						</span>
					</button>
					<div class="faq-answer hidden mt-3 pt-3 sm:mt-3.5 sm:pt-3.5 border-t border-[#E0D3C1]/80 text-xs text-[#5C5549] leading-relaxed">
						EasyBuy acts as your single merchant of record. When you procure across different categories (such as ergonomic chairs, 4K displays, and pantry supplies) from multiple manufacturers, we verify the inventory, bundle the logistics, and issue <strong class="text-[#191917]">one single line-item tax invoice</strong> with unified tracking. Your accounting team only ever pays EasyBuy.
					</div>
				</div>

				<!-- FAQ Item 2 -->
				<div class="faq-item rounded-2xl bg-[#F2EAE0] border border-[#E0D3C1] p-4 sm:p-6 transition-all duration-300 shadow-2xs hover:shadow-sm scroll-reveal delay-150" data-faq-id="2">
					<button onclick="toggleFaq(2)" class="w-full flex items-center justify-between gap-3 sm:gap-4 text-left cursor-pointer group" aria-expanded="false">
						<span class="text-xs sm:text-base font-bold text-[#191917] font-heading group-hover:text-[#191917] transition leading-snug">
							How do you verify supplier quality and brand warranties?
						</span>
						<span class="faq-icon flex h-6 w-6 sm:h-7 sm:w-7 shrink-0 items-center justify-center rounded-full bg-[#FAF6EE] text-[#191917] font-bold text-xs sm:text-sm border border-[#D8C9B5] group-hover:bg-[#FFD000] transition">
							+
						</span>
					</button>
					<div class="faq-answer hidden mt-3 pt-3 sm:mt-3.5 sm:pt-3.5 border-t border-[#E0D3C1]/80 text-xs text-[#5C5549] leading-relaxed">
						Every manufacturer in our 1,400+ supplier network undergoes a rigorous 4-step vetting process including ISO compliance, direct batch audits, and authentic manufacturer agreements. All products carry standard <strong class="text-[#191917]">100% manufacturer warranties</strong>, managed effortlessly through your unified EasyBuy support portal.
					</div>
				</div>

				<!-- FAQ Item 3 -->
				<div class="faq-item rounded-2xl bg-[#F2EAE0] border border-[#E0D3C1] p-4 sm:p-6 transition-all duration-300 shadow-2xs hover:shadow-sm scroll-reveal delay-200" data-faq-id="3">
					<button onclick="toggleFaq(3)" class="w-full flex items-center justify-between gap-3 sm:gap-4 text-left cursor-pointer group" aria-expanded="false">
						<span class="text-xs sm:text-base font-bold text-[#191917] font-heading group-hover:text-[#191917] transition leading-snug">
							What corporate credit terms do you offer (Net-30 / Net-60)?
						</span>
						<span class="faq-icon flex h-6 w-6 sm:h-7 sm:w-7 shrink-0 items-center justify-center rounded-full bg-[#FAF6EE] text-[#191917] font-bold text-xs sm:text-sm border border-[#D8C9B5] group-hover:bg-[#FFD000] transition">
							+
						</span>
					</button>
					<div class="faq-answer hidden mt-3 pt-3 sm:mt-3.5 sm:pt-3.5 border-t border-[#E0D3C1]/80 text-xs text-[#5C5549] leading-relaxed">
						Verified businesses and certified procurement agencies can qualify for flexible <strong class="text-[#191917]">Net-30 or Net-60 corporate terms</strong> with zero financing fees. You can issue digital purchase orders immediately, receive goods without upfront payment, and settle consolidated monthly statements via ACH, wire, or corporate card.
					</div>
				</div>

				<!-- FAQ Item 4 -->
				<div class="faq-item rounded-2xl bg-[#F2EAE0] border border-[#E0D3C1] p-4 sm:p-6 transition-all duration-300 shadow-2xs hover:shadow-sm scroll-reveal delay-250" data-faq-id="4">
					<button onclick="toggleFaq(4)" class="w-full flex items-center justify-between gap-3 sm:gap-4 text-left cursor-pointer group" aria-expanded="false">
						<span class="text-xs sm:text-base font-bold text-[#191917] font-heading group-hover:text-[#191917] transition leading-snug">
							Can independent sourcing agents manage multiple client entities?
						</span>
						<span class="faq-icon flex h-6 w-6 sm:h-7 sm:w-7 shrink-0 items-center justify-center rounded-full bg-[#FAF6EE] text-[#191917] font-bold text-sm border border-[#D8C9B5] group-hover:bg-[#FFD000] transition">
							+
						</span>
					</button>
					<div class="faq-answer hidden mt-3 pt-3 sm:mt-3.5 sm:pt-3.5 border-t border-[#E0D3C1]/80 text-xs text-[#5C5549] leading-relaxed">
						Yes! EasyBuy includes a dedicated <strong class="text-[#191917]">Agent Workspace</strong> allowing sourcing consultants to create separate client workspaces, generate white-labeled PDF quotes with custom markup, lock volume rebates, and track shipments for dozens of commercial clients from one login.
					</div>
				</div>

				<!-- FAQ Item 5 -->
				<div class="faq-item rounded-2xl bg-[#F2EAE0] border border-[#E0D3C1] p-4 sm:p-6 transition-all duration-300 shadow-2xs hover:shadow-sm scroll-reveal delay-300" data-faq-id="5">
					<button onclick="toggleFaq(5)" class="w-full flex items-center justify-between gap-3 sm:gap-4 text-left cursor-pointer group" aria-expanded="false">
						<span class="text-xs sm:text-base font-bold text-[#191917] font-heading group-hover:text-[#191917] transition leading-snug">
							What formats can I use to submit bulk procurement requests?
						</span>
						<span class="faq-icon flex h-6 w-6 sm:h-7 sm:w-7 shrink-0 items-center justify-center rounded-full bg-[#FAF6EE] text-[#191917] font-bold text-xs sm:text-sm border border-[#D8C9B5] group-hover:bg-[#FFD000] transition">
							+
						</span>
					</button>
					<div class="faq-answer hidden mt-3 pt-3 sm:mt-3.5 sm:pt-3.5 border-t border-[#E0D3C1]/80 text-xs text-[#5C5549] leading-relaxed">
						You can paste raw text lists from Slack or email, upload Excel (.xlsx) / CSV spreadsheets, enter project specs in plain English, or browse our 10,000+ SKU online catalog. Our AI intake parser extracts SKUs, matches wholesale price tiers, and returns a verified quote in seconds.
					</div>
				</div>

				<!-- FAQ Item 6 -->
				<div class="faq-item rounded-2xl bg-[#F2EAE0] border border-[#E0D3C1] p-4 sm:p-6 transition-all duration-300 shadow-2xs hover:shadow-sm scroll-reveal delay-350" data-faq-id="6">
					<button onclick="toggleFaq(6)" class="w-full flex items-center justify-between gap-3 sm:gap-4 text-left cursor-pointer group" aria-expanded="false">
						<span class="text-xs sm:text-base font-bold text-[#191917] font-heading group-hover:text-[#191917] transition leading-snug">
							Can EasyBuy deliver to multiple branches or job sites simultaneously?
						</span>
						<span class="faq-icon flex h-6 w-6 sm:h-7 sm:w-7 shrink-0 items-center justify-center rounded-full bg-[#FAF6EE] text-[#191917] font-bold text-xs sm:text-sm border border-[#D8C9B5] group-hover:bg-[#FFD000] transition">
							+
						</span>
					</button>
					<div class="faq-answer hidden mt-3 pt-3 sm:mt-3.5 sm:pt-3.5 border-t border-[#E0D3C1]/80 text-xs text-[#5C5549] leading-relaxed">
						Yes. Our multi-destination logistics router allows you to place a single consolidated purchase order and distribute items across different regional branches, facilities, or remote employees with custom delivery dates, floor contacts, and separate packing slips.
					</div>
				</div>

			</div>

			<!-- Bottom Enterprise Support Callout Box -->
			<div class="mt-10 sm:mt-16 max-w-4xl mx-auto rounded-3xl p-5 sm:p-8 bg-[#FFD000]/20 border border-[#FFD000]/60 shadow-xs flex flex-col md:flex-row items-center justify-between gap-5 sm:gap-6 text-center md:text-left scroll-reveal-scale delay-200">
				<div>
					<div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-[#191917] text-[#FAF6EE] text-4xs font-black uppercase tracking-wider mb-2">
						Enterprise Sourcing
					</div>
					<h3 class="text-base sm:text-xl font-black text-[#191917] font-heading">
						Have a custom RFP or complex multi-site requisition?
					</h3>
					<p class="text-xs text-[#5C5549] mt-1 max-w-lg">
						Our senior procurement specialists will analyze your spec sheets and provide custom volume tier pricing within 2 hours.
					</p>
				</div>
				<div class="flex items-center gap-3 shrink-0 w-full sm:w-auto justify-center">
					<a href="{{ url('/register') }}" class="w-full sm:w-auto text-center bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-5 py-3 sm:py-2.5 rounded-xl text-xs font-bold transition shadow-xs whitespace-nowrap active:scale-95">
						Submit RFP / Specs &rarr;
					</a>
				</div>
			</div>

		</div>
	</section>

	<!-- ==================== LANDING PAGE FOOTER ==================== -->
	<footer class="bg-[#191917] text-[#FAF6EE] pt-12 sm:pt-16 lg:pt-20 pb-10 sm:pb-12 border-t border-[#333333] relative overflow-hidden">
		<!-- Subtle warm ambient background glow -->
		<div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[200px] bg-[#FFD000]/10 rounded-full blur-3xl pointer-events-none"></div>

		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
			
			<!-- Top Section: Brand Identity & Link Columns -->
			<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 pb-10 sm:pb-16 border-b border-[#2D2D29]">
				
				<!-- Left Brand Column (5 cols) -->
				<div class="lg:col-span-5 space-y-4">
					<a href="{{ url('/') }}" class="flex items-center gap-3 group inline-flex">
						<img src="{{ asset('images/easybuy-logo.png') }}" alt="EasyBuy Logo" class="h-9 w-9 sm:h-10 sm:w-10 object-contain drop-shadow-xs group-hover:scale-105 transition-transform">
						<span class="font-heading tracking-tight text-lg sm:text-xl font-black text-[#FAF6EE]">EASYBUY</span>
					</a>
					<p class="text-xs text-[#9C9283] leading-relaxed max-w-sm">
						The AI-driven B2B procurement engine. Turn raw lists, bill of materials, and office restocks into verified wholesale factory orders with single-invoice consolidated dispatch.
					</p>
					
					<!-- Trust Badges -->
					<div class="pt-1 flex flex-wrap items-center gap-2 text-4xs">
						<span class="px-3 py-1 rounded-full bg-[#262622] text-[#E0D3C1] border border-[#3A3A33] flex items-center gap-1.5 font-semibold">
							<span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> 1,400+ Verified Suppliers
						</span>
						<span class="px-3 py-1 rounded-full bg-[#262622] text-[#E0D3C1] border border-[#3A3A33] flex items-center gap-1.5 font-semibold">
							<span class="h-1.5 w-1.5 rounded-full bg-[#FFD000]"></span> Net-30 / Net-60 Terms
						</span>
						<span class="px-3 py-1 rounded-full bg-[#262622] text-[#E0D3C1] border border-[#3A3A33] flex items-center gap-1.5 font-semibold">
							<span class="h-1.5 w-1.5 rounded-full bg-blue-400"></span> Single Delivery Drop
						</span>
					</div>

					<!-- Social Media & Procurement Desk Channels -->
					<div class="pt-2">
						<span class="text-4xs uppercase tracking-wider font-bold text-[#8A857A] block mb-2.5">Connect & Official Channels</span>
						<div class="flex items-center gap-2 flex-wrap">
							<!-- X / Twitter -->
							<a href="https://x.com" target="_blank" rel="noopener noreferrer" title="Follow EasyBuy on X / Twitter"
								class="h-8.5 w-8.5 rounded-xl bg-[#242420] hover:bg-[#FFD000] text-[#E0D3C1] hover:text-[#191917] border border-[#3A3A33] hover:border-[#FFD000] flex items-center justify-center transition shadow-xs active:scale-95 group">
								<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
									<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
								</svg>
							</a>

							<!-- LinkedIn -->
							<a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" title="Connect with EasyBuy on LinkedIn"
								class="h-8.5 w-8.5 rounded-xl bg-[#242420] hover:bg-[#0A66C2] text-[#E0D3C1] hover:text-white border border-[#3A3A33] hover:border-[#0A66C2] flex items-center justify-center transition shadow-xs active:scale-95 group">
								<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
									<path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2V10.9H6.46M7.83 6.25c-.9 0-1.63.73-1.63 1.63s.73 1.63 1.63 1.63 1.63-.73 1.63-1.63-.73-1.63-1.63-1.63Z"/>
								</svg>
							</a>

							<!-- Instagram -->
							<a href="https://instagram.com" target="_blank" rel="noopener noreferrer" title="Follow EasyBuy on Instagram"
								class="h-8.5 w-8.5 rounded-xl bg-[#242420] hover:bg-gradient-to-tr hover:from-[#F58529] hover:via-[#DD2A7B] hover:to-[#8134AF] text-[#E0D3C1] hover:text-white border border-[#3A3A33] hover:border-transparent flex items-center justify-center transition shadow-xs active:scale-95 group">
								<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
									<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
								</svg>
							</a>

							<!-- Facebook -->
							<a href="https://facebook.com" target="_blank" rel="noopener noreferrer" title="Follow EasyBuy on Facebook"
								class="h-8.5 w-8.5 rounded-xl bg-[#242420] hover:bg-[#1877F2] text-[#E0D3C1] hover:text-white border border-[#3A3A33] hover:border-[#1877F2] flex items-center justify-center transition shadow-xs active:scale-95 group">
								<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
									<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
								</svg>
							</a>
						</div>
					</div>
				</div>

				<!-- Right Link Columns (7 cols: 3 sub-columns, gracefully responsive) -->
				<div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8">
					
					<!-- Col 1: Platform & AI Sourcing -->
					<div class="space-y-3">
						<h4 class="text-xs font-bold uppercase tracking-wider text-[#FFD000] font-heading">
							AI Sourcing
						</h4>
						<ul class="space-y-2 text-xs text-[#9C9283]">
							<li><a href="{{ url('/home') }}" class="hover:text-[#FAF6EE] transition">Ask Easy Engine</a></li>
							<li><a href="{{ url('/#simulator') }}" class="hover:text-[#FAF6EE] transition">Instant Simulator</a></li>
							<li><a href="{{ url('/catalog') }}" class="hover:text-[#FAF6EE] transition">Wholesale Catalog</a></li>
							<li><a href="{{ url('/#how-it-works') }}" class="hover:text-[#FAF6EE] transition">Consolidated Drops</a></li>
							<li><a href="{{ url('/#reviews') }}" class="hover:text-[#FAF6EE] transition">Wall of Trust</a></li>
						</ul>
					</div>

					<!-- Col 2: Categories -->
					<div class="space-y-3">
						<h4 class="text-xs font-bold uppercase tracking-wider text-[#FAF6EE] font-heading">
							Categories
						</h4>
						<ul class="space-y-2 text-xs text-[#9C9283]">
							<li><a href="{{ url('/catalog') }}" class="hover:text-[#FAF6EE] transition">Ergonomic Workstations</a></li>
							<li><a href="{{ url('/catalog') }}" class="hover:text-[#FAF6EE] transition">IT & Enterprise Displays</a></li>
							<li><a href="{{ url('/catalog') }}" class="hover:text-[#FAF6EE] transition">Studio Architectural Lamps</a></li>
							<li><a href="{{ url('/catalog') }}" class="hover:text-[#FAF6EE] transition">Janitorial & Breakrooms</a></li>
							<li><a href="{{ url('/catalog') }}" class="hover:text-[#FAF6EE] transition">Acoustic Felt Dividers</a></li>
						</ul>
					</div>

					<!-- Col 3: Suppliers & Network -->
					<div class="space-y-3">
						<h4 class="text-xs font-bold uppercase tracking-wider text-[#FAF6EE] font-heading">
							Network & Legal
						</h4>
						<ul class="space-y-2 text-xs text-[#9C9283]">
							<li><a href="{{ url('/supplier') }}" class="hover:text-[#FFD000] transition font-bold">Become a Supplier &rarr;</a></li>
							<li><a href="{{ url('/login') }}" class="hover:text-[#FAF6EE] transition">Buyer Sign In</a></li>
							<li><a href="{{ url('/register') }}" class="hover:text-[#FAF6EE] transition">Create Free Account</a></li>
							<li><a href="{{ url('/#faq') }}" class="hover:text-[#FAF6EE] transition">Sourcing FAQ</a></li>
							<li><span class="text-[#66665E]">ISO 9001 Compliant</span></li>
						</ul>
					</div>

				</div>

			</div>

			<!-- Bottom Copyright & Legal -->
			<div class="pt-6 sm:pt-8 flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4 text-3xs text-[#7A7365] text-center sm:text-left">
				<p>© {{ date('Y') }} EasyBuy Technologies Inc. All rights reserved. Direct wholesale procurement platform.</p>
				<div class="flex flex-wrap items-center justify-center sm:justify-end gap-3 sm:gap-4">
					<span class="hover:text-[#FAF6EE] transition cursor-pointer">Terms of Service</span>
					<span>•</span>
					<span class="hover:text-[#FAF6EE] transition cursor-pointer">Privacy Policy</span>
					<span>•</span>
					<span class="hover:text-[#FAF6EE] transition cursor-pointer">Supplier SLA</span>
				</div>
			</div>

		</div>
	</footer>

	<!-- Interactive Sourcing Simulation & UI Scripts -->
	<script>
		// FAQ Accordion Interaction
		function toggleFaq(id) {
			const item = document.querySelector(`[data-faq-id="${id}"]`);
			if (!item) return;
			const answer = item.querySelector('.faq-answer');
			const icon = item.querySelector('.faq-icon');
			const button = item.querySelector('button');
			
			const isExpanded = !answer.classList.contains('hidden');

			// Close all other items for a clean single-open accordion feel
			document.querySelectorAll('.faq-item').forEach(el => {
				if (el !== item) {
					el.querySelector('.faq-answer').classList.add('hidden');
					el.querySelector('.faq-icon').innerText = '+';
					el.querySelector('.faq-icon').classList.remove('bg-[#FFD000]');
					el.querySelector('.faq-icon').classList.add('bg-[#FAF6EE]');
					el.querySelector('button').setAttribute('aria-expanded', 'false');
					el.classList.remove('ring-2', 'ring-[#FFD000]', 'bg-[#FAF6EE]');
					el.classList.add('bg-[#F2EAE0]');
				}
			});

			if (isExpanded) {
				answer.classList.add('hidden');
				icon.innerText = '+';
				icon.classList.remove('bg-[#FFD000]');
				icon.classList.add('bg-[#FAF6EE]');
				button.setAttribute('aria-expanded', 'false');
				item.classList.remove('ring-2', 'ring-[#FFD000]', 'bg-[#FAF6EE]');
				item.classList.add('bg-[#F2EAE0]');
			} else {
				answer.classList.remove('hidden');
				icon.innerText = '−';
				icon.classList.remove('bg-[#FAF6EE]');
				icon.classList.add('bg-[#FFD000]');
				button.setAttribute('aria-expanded', 'true');
				item.classList.add('ring-2', 'ring-[#FFD000]', 'bg-[#FAF6EE]');
				item.classList.remove('bg-[#F2EAE0]');
			}
		}

		// Preset prompt texts
		const PRESETS = {
			dev_workstation: "We are onboarding 5 software developers. I need: 5 ergonomic mesh chairs, 5 electric standing desks, 10 4K 27-inch monitors with USB-C, and 5 mechanical keyboard combos. Budget cap: ₦6,500,000.",
			janitorial: "Monthly office restock: 24 rolls premium 2-ply toilet paper, 12 multi-surface disinfectant sprays, 500 compostable hot coffee cups, and 2kg organic dark roast espresso beans.",
			design_studio: "Need architectural lighting and desktop control hubs: 6 curved terracotta arch LED desk lamps, 6 wireless smart desktop hubs, and 4 cable management trays."
		};

		// GSAP Animated Typing for Presets (triggered on user button click)
		function loadPresetPrompt(key, animate = true) {
			const text = PRESETS[key];
			const input = document.getElementById('prompt-input');
			if (!input) return;
			
			if (animate && typeof gsap !== 'undefined') {
				input.value = '';
				gsap.to(input, {
					duration: 0.7,
					text: text,
					ease: "none"
				});
			} else {
				input.value = text;
			}
		}

		const IS_USER_AUTHENTICATED = @json(auth()->check());

		// Procurement Sourcing Simulation Pipeline
		function startSourcingSimulation() {
			const textarea = document.getElementById('prompt-input');
			let promptVal = textarea ? textarea.value.trim() : '';
			if (!promptVal) {
				promptVal = "5 ergonomic mesh chairs, 5 electric standing desks, 10 4K 27-inch monitors with USB-C, and 5 mechanical keyboard combos.";
				if (textarea) textarea.value = promptVal;
			}

			const btn = document.getElementById('simulate-btn');
			const btnText = document.getElementById('btn-text');
			const resultBox = document.getElementById('consolidated-box-result');
			if (!btn || !btnText) return;

			// Searching animation
			btnText.innerText = "Analyzing & Sourcing...";
			btn.classList.add('animate-pulse');
			btn.disabled = true;

			// Save in sessionStorage as seamless fallback
			try {
				sessionStorage.setItem('pending_easybuy_prompt', promptVal);
			} catch (e) {}

			// Confetti celebration
			if (typeof confetti === 'function') {
				confetti({
					particleCount: 50,
					spread: 60,
					origin: { y: 0.75, x: 0.35 }
				});
			}

			setTimeout(() => {
				btnText.innerText = "Quote Ready ✓";
				btn.classList.remove('animate-pulse');
				if (resultBox) resultBox.classList.remove('hidden');

				setTimeout(() => {
					if (IS_USER_AUTHENTICATED) {
						window.location.href = "{{ url('/home') }}?prompt=" + encodeURIComponent(promptVal);
					} else {
						window.location.href = "{{ url('/register') }}?prompt=" + encodeURIComponent(promptVal);
					}
				}, 400);
			}, 750);
		}

		function resetSimulation() {
			const box = document.getElementById('consolidated-box-result');
			const btnText = document.getElementById('btn-text');
			const input = document.getElementById('prompt-input');
			if (box) box.classList.add('hidden');
			if (btnText) btnText.innerText = "Source with Easy AI";
			if (input) input.value = '';
		}

		// Smooth GPU-Accelerated Scroll Reveal System
		function initScrollRevealAnimations() {
			const revealElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right, .scroll-reveal-scale, .scroll-reveal-pop');
			if (!revealElements.length) return;

			// Fallback if IntersectionObserver is unsupported
			if (!('IntersectionObserver' in window)) {
				revealElements.forEach(el => el.classList.add('revealed'));
				return;
			}

			const observerOptions = {
				root: null,
				rootMargin: '0px 0px -40px 0px',
				threshold: 0.12
			};

			const observer = new IntersectionObserver((entries, obs) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						entry.target.classList.add('revealed');
						obs.unobserve(entry.target);
					}
				});
			}, observerOptions);

			revealElements.forEach(el => {
				const rect = el.getBoundingClientRect();
				// Immediately reveal elements already inside the initial viewport
				if (rect.top < window.innerHeight && rect.bottom > 0) {
					setTimeout(() => {
						el.classList.add('revealed');
					}, 60);
				} else {
					observer.observe(el);
				}
			});
		}

		// Subtle Parallax on Floating Background Elements
		function initParallaxBackgrounds() {
			const sunBackdrop = document.getElementById('hero-sun-backdrop');
			const catalogGlow = document.querySelector('.catalog-bg-glow');

			window.addEventListener('scroll', () => {
				const scrollY = window.scrollY || window.pageYOffset || 0;
				if (sunBackdrop && scrollY < 900) {
					sunBackdrop.style.transform = `translateY(calc(-50% + ${scrollY * 0.12}px)) scale(${1 + scrollY * 0.00015})`;
				}
				if (catalogGlow && scrollY > 400 && scrollY < 2000) {
					const offset = (scrollY - 1000) * 0.08;
					catalogGlow.style.transform = `translate(calc(-50% + ${offset * 0.5}px), calc(-50% + ${offset}px))`;
				}
			}, { passive: true });
		}

		// Interactive Package Canvas Frame-Scrubber with 120 FPS Bidirectional Scrubbing
		function initPackageVideoScrubber() {
			const canvas = document.getElementById('seam-bag-canvas');
			const container = document.getElementById('seam-video-container');
			if (!canvas || !container) return;

			const ctx = canvas.getContext('2d');
			const TOTAL_FRAMES = 121;
			const images = [];
			let imagesLoaded = 0;
			let targetFrame = 121;
			let currentFrame = 121;

			// Base path for pre-extracted transparent frames
			const basePath = "{{ asset('images/bag-frames') }}";

			// Preload all 121 frames into memory
			for (let i = 1; i <= TOTAL_FRAMES; i++) {
				const img = new Image();
				const padIndex = String(i).padStart(3, '0');
				img.src = `${basePath}/frame_${padIndex}.png`;
				img.onload = () => {
					imagesLoaded++;
					if (i === TOTAL_FRAMES || imagesLoaded === 1) {
						drawFrame(targetFrame);
					}
				};
				images.push(img);
			}

			function drawFrame(frameNumber) {
				const clampedIndex = Math.min(Math.max(Math.round(frameNumber), 1), TOTAL_FRAMES) - 1;
				const img = images[clampedIndex];
				if (!img || !img.complete || img.naturalWidth === 0) return;

				// Clear canvas for new frame
				ctx.clearRect(0, 0, canvas.width, canvas.height);
				ctx.save();

				// Normalized closing factor: 0 = fully open, 1 = fully closed
				const t = clampedIndex / (TOTAL_FRAMES - 1);

				// Dynamic Counter-Scale: Smoothly stabilizes physical size to eliminate AI camera zoom
				const counterScale = 0.98 - (t * 0.18);
				const drawW = canvas.width * counterScale;
				const drawH = canvas.height * counterScale;
				const drawX = (canvas.width - drawW) / 2;
				const drawY = (canvas.height - drawH) / 2 + (t * 14);

				// Draw animated transparent frame with 100% solid, rich colors (Zero fade)
				ctx.globalAlpha = 1.0;
				ctx.drawImage(img, drawX, drawY, drawW, drawH);

				ctx.restore();
			}

			// Calculate target frame directly on scroll
			function updateScrollProgress() {
				const scrollY = window.scrollY || window.pageYOffset || 0;
				// Trigger window: from 0px (Hero top) to 450px (scrolled into Section 2)
				const maxScrollDistance = 450;
				const progress = Math.min(Math.max(scrollY / maxScrollDistance, 0), 1);

				// When at top (progress = 0): targetFrame = 121 (Closed)
				// As user scrolls down (progress -> 1): targetFrame = 1 (Open)
				// When user scrolls back up (progress -> 0): targetFrame = 121 (Closed)
				targetFrame = 121 - (progress * (TOTAL_FRAMES - 1));
			}

			// Ultra-responsive 60fps lerp loop
			function renderLoop() {
				if (imagesLoaded > 0) {
					currentFrame += (targetFrame - currentFrame) * 0.22;
					if (Math.abs(targetFrame - currentFrame) > 0.01) {
						drawFrame(currentFrame);
					}
				}
				requestAnimationFrame(renderLoop);
			}

			window.addEventListener('scroll', updateScrollProgress, { passive: true });
			window.addEventListener('resize', updateScrollProgress, { passive: true });

			updateScrollProgress();
			requestAnimationFrame(renderLoop);

			// Tap / click toggle support
			container.addEventListener('click', () => {
				if (targetFrame > 60) {
					targetFrame = 1;
				} else {
					targetFrame = 121;
				}
			});
		}

		// Auto-load starter prompt and initialize animations on DOM ready
		window.addEventListener('DOMContentLoaded', () => {
			// Disable browser auto-scrolling restoration on fresh page refresh
			if ('scrollRestoration' in history) {
				history.scrollRestoration = 'manual';
			}

			// Ensure page always starts at top if not navigating directly to a section anchor
			if (!window.location.hash || window.location.hash === '#simulator') {
				window.scrollTo(0, 0);
			}

			initScrollRevealAnimations();
			initParallaxBackgrounds();
			initPackageVideoScrubber();

			// Enter key listener for hero prompt textarea
			const heroPrompt = document.getElementById('prompt-input');
			if (heroPrompt) {
				heroPrompt.addEventListener('keydown', (e) => {
					if (e.key === 'Enter' && !e.shiftKey) {
						e.preventDefault();
						startSourcingSimulation();
					}
				});
			}
		});
	</script>
</x-layout>
