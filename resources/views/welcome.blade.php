<x-layout>
	<div class="w-full py-8">
		<section class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
			<!-- Hero Section -->
			<div class="rounded-[32px] border border-[#e8e1d7] bg-white p-6 shadow-[0_10px_40px_rgba(0,0,0,0.02)] sm:p-10 lg:p-14">
				<div class="grid items-center gap-12 lg:grid-cols-[1.1fr_0.9fr]">
					<div class="text-left space-y-6">
						<span class="inline-flex items-center gap-1.5 rounded-full bg-[#f0e7d8] px-3.5 py-1 text-xs font-semibold uppercase tracking-wider text-[#5b3d20]">
							Shop smarter, live better
						</span>

						<h1 class="text-4xl font-extrabold tracking-[-0.04em] text-[#1b1b18] sm:text-5xl lg:text-6xl leading-[1.1]">
							Welcome to <span class="bg-gradient-to-r from-[#1f5fd8] to-[#4f8eff] bg-clip-text text-transparent">EasyBuy</span>
						</h1>

						<p class="text-lg text-[#555] leading-relaxed max-w-xl">
							Discover curated quality products, transparent deals, and a frictionless shopping experience designed around you.
						</p>

						<div class="flex flex-col gap-3 sm:flex-row pt-2">
							<a href="#products" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#1f5fd8] px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-[#184db1] hover:scale-[1.02] active:scale-[0.98] shadow-md shadow-[#1f5fd8]/10">
								<span>Start Shopping</span>
								<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
								</svg>
							</a>
							<a href="#features" class="inline-flex items-center justify-center rounded-xl border border-[#d7d0c8] bg-white px-6 py-3.5 text-sm font-semibold text-[#1b1b18] transition hover:bg-[#f8f5f1] hover:border-[#1b1b18]">
								Explore Features
							</a>
						</div>
					</div>

					<!-- Featured Card -->
					<div class="rounded-[28px] bg-gradient-to-br from-[#dfe9ff] via-[#f8f2ea] to-[#f0ebdf] p-4 shadow-inner">
						<div class="rounded-[24px] border border-[#e8dfd3] bg-white p-6 shadow-md transition duration-300 hover:shadow-xl">
							<div class="mb-4 flex items-start justify-between">
								<div>
									<span class="text-xs font-semibold uppercase tracking-wider text-[#1f5fd8]">Featured Product</span>
									<h2 class="text-2xl font-bold text-[#1b1b18] mt-1">Smart Home Hub</h2>
								</div>
								<span class="rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-600 border border-red-100">
									Save 25%
								</span>
							</div>

							<!-- Graphic Mockup -->
							<div class="mb-5 flex h-48 items-center justify-center rounded-2xl bg-gradient-to-br from-[#f3f6ff] to-[#eaeefc] border border-blue-50 relative overflow-hidden group">
								<!-- Abstract SVG Speaker Design -->
								<div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.8)_0%,transparent_100%)] opacity-60"></div>
								<div class="relative z-10 flex flex-col items-center">
									<div class="h-24 w-24 rounded-full bg-[#1b1b18] flex items-center justify-center shadow-lg shadow-black/20 group-hover:scale-105 transition-transform duration-500">
										<div class="h-20 w-20 rounded-full border-4 border-dashed border-[#444] flex items-center justify-center">
											<div class="h-12 w-12 rounded-full bg-gradient-to-tr from-[#1f5fd8] to-[#4f8eff] animate-pulse"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="flex items-center justify-between text-sm">
								<div class="flex items-center gap-1 text-[#4b4b4b]">
									<span class="text-yellow-500 font-bold">★</span>
									<span class="font-semibold text-[#1b1b18]">4.9</span>
									<span class="text-[#888]">(142 reviews)</span>
								</div>
								<div class="flex items-baseline gap-1.5">
									<span class="text-xs text-[#888] line-through">$199.00</span>
									<span class="text-lg font-bold text-[#1f5fd8]">$149.25</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Features Section -->
			<div id="features" class="mt-16 grid gap-6 md:grid-cols-3">
				<div class="rounded-2xl border border-[#eadfce] bg-white p-6 shadow-sm hover:shadow-md transition duration-300">
					<div class="mb-4 inline-flex rounded-xl bg-[#e8f0ff] p-3 text-[#1f5fd8]">
						<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
						</svg>
					</div>
					<h3 class="mb-2 text-xl font-bold text-[#1b1b18]">Quality Assurance</h3>
					<p class="text-[#555] leading-relaxed text-sm">
						Every product is inspected and handpicked for materials, craftsmanship, and longevity.
					</p>
				</div>

				<div class="rounded-2xl border border-[#eadfce] bg-white p-6 shadow-sm hover:shadow-md transition duration-300">
					<div class="mb-4 inline-flex rounded-xl bg-[#fff0d9] p-3 text-[#c27b1b]">
						<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
						</svg>
					</div>
					<h3 class="mb-2 text-xl font-bold text-[#1b1b18]">Express Checkout</h3>
					<p class="text-[#555] leading-relaxed text-sm">
						Fast loading interfaces and a streamlined one-click purchase path to save you time.
					</p>
				</div>

				<div class="rounded-2xl border border-[#eadfce] bg-white p-6 shadow-sm hover:shadow-md transition duration-300">
					<div class="mb-4 inline-flex rounded-xl bg-[#edf8ea] p-3 text-[#2d7d46]">
						<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
						</svg>
					</div>
					<h3 class="mb-2 text-xl font-bold text-[#1b1b18]">Fair Return Policy</h3>
					<p class="text-[#555] leading-relaxed text-sm">
						Not matching your expectations? Return it within 30 days hassle-free with zero hidden fees.
					</p>
				</div>
			</div>

			<!-- Popular Products Grid -->
			<div id="products" class="mt-16 rounded-[32px] border border-[#eadfce] bg-[#fdfcfa] p-8 sm:p-10">
				<div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
					<div>
						<p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#1f5fd8]">Popular Categories</p>
						<h2 class="mt-2 text-3xl font-bold tracking-tight text-[#1b1b18]">Curated Catalog picks</h2>
					</div>
					<a href="#" class="group text-sm font-semibold text-[#1f5fd8] inline-flex items-center gap-1 hover:text-[#184db1]">
						<span>Browse all products</span>
						<span class="transition-transform group-hover:translate-x-0.5">&rarr;</span>
					</a>
				</div>

				<!-- Product items -->
				<div class="mt-8 grid gap-6 md:grid-cols-3">
					<div class="group rounded-2xl border border-[#eadfce] bg-white p-5 shadow-sm transition hover:shadow-md hover:-translate-y-0.5 duration-300">
						<!-- Visual box -->
						<div class="mb-4 flex h-40 items-center justify-center rounded-xl bg-gradient-to-br from-[#dfe9ff] to-[#f7d9b8] relative overflow-hidden">
							<svg class="h-12 w-12 text-[#1b1b18] opacity-70 group-hover:scale-110 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
							</svg>
						</div>
						<span class="text-xs font-semibold text-[#1f5fd8]">Home Goods</span>
						<h3 class="text-lg font-bold text-[#1b1b18] mt-1">Interior Accents</h3>
						<p class="mt-2 text-xs text-[#666] leading-relaxed">Artisan pieces curated to bring warmth, functionality, and timeless style into your living space.</p>
					</div>

					<div class="group rounded-2xl border border-[#eadfce] bg-white p-5 shadow-sm transition hover:shadow-md hover:-translate-y-0.5 duration-300">
						<!-- Visual box -->
						<div class="mb-4 flex h-40 items-center justify-center rounded-xl bg-gradient-to-br from-[#d8f0df] to-[#e5eae4] relative overflow-hidden">
							<svg class="h-12 w-12 text-[#1b1b18] opacity-70 group-hover:scale-110 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</div>
						<span class="text-xs font-semibold text-[#1f5fd8]">Lifestyle</span>
						<h3 class="text-lg font-bold text-[#1b1b18] mt-1">Everyday Packs</h3>
						<p class="mt-2 text-xs text-[#666] leading-relaxed">Ergonomic, lightweight bags and organizers that make daily commuting and traveling effortless.</p>
					</div>

					<div class="group rounded-2xl border border-[#eadfce] bg-white p-5 shadow-sm transition hover:shadow-md hover:-translate-y-0.5 duration-300">
						<!-- Visual box -->
						<div class="mb-4 flex h-40 items-center justify-center rounded-xl bg-gradient-to-br from-[#f7dfd8] to-[#f4e8db] relative overflow-hidden">
							<svg class="h-12 w-12 text-[#1b1b18] opacity-70 group-hover:scale-110 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm0 0h4m-4 0H8m0 0v13m0-13V6a2 2 0 112 2H8zm0 0V5a2 2 0 10-2 2h2zm0 0h4" />
							</svg>
						</div>
						<span class="text-xs font-semibold text-[#1f5fd8]">Essentials</span>
						<h3 class="text-lg font-bold text-[#1b1b18] mt-1">Seasonal Offers</h3>
						<p class="mt-2 text-xs text-[#666] leading-relaxed">Timely discounts and limited-edition items compiled to deliver high utility during the current season.</p>
					</div>
				</div>
			</div>
		</section>
	</div>
</x-layout>
