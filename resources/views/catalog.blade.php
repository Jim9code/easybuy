<x-layout title="EasyBuy — Verified Wholesale Catalog">
	<!-- Full-Height Modern Dashboard Workspace with Locked Static Sidebar -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED DASHBOARD SIDEBAR (NEVER MOVES ON SCROLL) ==================== -->
		<x-dashboard-sidebar active="catalog" />

		<!-- ==================== CENTER CATALOG CANVAS ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-6 lg:p-10 relative">
			
			<div class="max-w-6xl mx-auto space-y-6 sm:space-y-7 animate-fade-in pb-16">
				
				<!-- Top Breadcrumbs & Back Navigation -->
				<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]">
					<div class="flex items-center gap-3">
						<a href="{{ url('/home') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#5C5549] hover:text-[#191917] transition group">
							<svg class="h-4 w-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
							</svg>
							<span>Ask Easy</span>
						</a>
						<span class="text-[#D8C9B5]">/</span>
						<span class="text-xs font-bold text-[#191917]">Wholesale Catalog</span>
					</div>
				</div>

				<!-- Header Title -->
				<div>
					<h1 class="text-2xl sm:text-3xl font-black text-[#191917] font-sans tracking-tight">
						Wholesale Catalog
					</h1>
					<p class="text-xs text-[#7A7365] mt-0.5">
						Browse pre-inspected B2B inventory with consolidated single-invoice dispatch.
					</p>
				</div>

				<!-- Clean Filter & Search Controls Bar (Elevated Marshmallow Clay) -->
				<div class="clay-marshmallow rounded-3xl p-4 sm:p-5 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
					
					<!-- Search Input Capsule -->
					<div class="clay-input-pill rounded-2xl px-3.5 py-2 flex items-center gap-2.5 flex-1">
						<svg class="h-4 w-4 text-[#7A7365] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
						</svg>
						<input type="text" id="catalog-search-input" onkeyup="filterCatalog()" placeholder="Search catalog by title, category, or SKU..." 
							class="w-full bg-transparent border-0 text-xs text-[#191917] placeholder:text-[#9C9283] focus:outline-none" />
					</div>

					<!-- Category Filter Pills (Soft Clay) -->
					<div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar py-1 shrink-0">
						<button onclick="setCategoryFilter('all')" data-cat="all" class="cat-pill active px-3.5 py-1.5 rounded-xl text-3xs font-bold transition cursor-pointer bg-[#191917] text-[#FAF6EE] shadow-xs">
							All Lines
						</button>
						<button onclick="setCategoryFilter('ergonomics')" data-cat="ergonomics" class="cat-pill px-3.5 py-1.5 rounded-xl text-3xs font-bold transition cursor-pointer clay-marshmallow-subtle text-[#5C5549] hover:text-[#191917]">
							Ergonomics
						</button>
						<button onclick="setCategoryFilter('it & tech')" data-cat="it & tech" class="cat-pill px-3.5 py-1.5 rounded-xl text-3xs font-bold transition cursor-pointer clay-marshmallow-subtle text-[#5C5549] hover:text-[#191917]">
							IT & Tech
						</button>
						<button onclick="setCategoryFilter('lighting & facilities')" data-cat="lighting & facilities" class="cat-pill px-3.5 py-1.5 rounded-xl text-3xs font-bold transition cursor-pointer clay-marshmallow-subtle text-[#5C5549] hover:text-[#191917]">
							Lighting
						</button>
						<button onclick="setCategoryFilter('janitorial & restocks')" data-cat="janitorial & restocks" class="cat-pill px-3.5 py-1.5 rounded-xl text-3xs font-bold transition cursor-pointer clay-marshmallow-subtle text-[#5C5549] hover:text-[#191917]">
							Restocks
						</button>
					</div>
				</div>

				<!-- Catalog Products Grid (Clean & Minimal Extruded Clay Tiles) -->
				<div id="catalog-products-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
					@foreach($catalogProducts as $product)
						<div class="catalog-card clay-marshmallow clay-marshmallow-hover rounded-3xl p-3.5 sm:p-4 flex flex-col justify-between select-none transition group"
							data-name="{{ strtolower($product->name) }}"
							data-category="{{ strtolower($product->category) }}"
							data-sku="{{ strtolower($product->sku ?? '') }}"
							data-desc="{{ strtolower($product->description ?? '') }}">
							
							<div>
								<!-- Product Image Box (Full-Width Edge-to-Edge Cavity) -->
								<a href="{{ url('/home/product/' . $product->id) }}" class="block w-full h-48 sm:h-52 rounded-2xl overflow-hidden clay-marshmallow-subtle relative mb-3 group-hover:shadow-xs transition">
									<img src="{{ $product->image }}" alt="{{ $product->name }}" 
										class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
										onerror="this.src='{{ asset('images/3d-refs/ergo_chair.jpg') }}'" />
								</a>

								<!-- Product Title -->
								<a href="{{ url('/home/product/' . $product->id) }}" class="block text-xs sm:text-sm font-bold text-[#191917] leading-snug line-clamp-2 hover:text-[#5C5549] transition px-1 product-title">
									{{ $product->name }}
								</a>
							</div>

							<!-- Price & Quick Add Action (Single Minimal Bottom Row) -->
							<div class="mt-3 pt-2.5 border-t border-[#E0D3C1]/50 flex items-center justify-between">
								<span class="text-sm sm:text-base font-bold text-[#191917] price-text">
									${{ number_format($product->price, 2) }}
								</span>

								<button onclick="addProductToCart('{{ $product->id }}', '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ addslashes($product->category) }}', '{{ $product->image }}')"
									class="clay-icon-pill hover:bg-[#FAF6EE] text-[#191917] px-3 py-1.5 rounded-xl text-3xs font-bold transition flex items-center gap-1 cursor-pointer active:scale-95">
									<span>+ Add</span>
								</button>
							</div>

						</div>
					@endforeach
				</div>

				<!-- Empty State for Search / Filter -->
				<div id="catalog-empty-search" class="hidden clay-marshmallow rounded-3xl p-12 flex flex-col items-center justify-center text-center space-y-3">
					<div class="h-12 w-12 rounded-2xl clay-icon-pill flex items-center justify-center text-[#7A7365]">
						<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
						</svg>
					</div>
					<h3 class="text-sm font-bold text-[#191917]">No products matched your search</h3>
					<p class="text-xs text-[#7A7365] max-w-sm">Try searching for other keywords or reset the category filter.</p>
					<button onclick="resetFilters()" class="clay-btn-yellow px-4 py-2 rounded-xl text-xs font-bold cursor-pointer">
						Reset Filters
					</button>
				</div>

			</div>
		</main>
	</div>

	<script>
		let activeCategory = 'all';

		function filterCatalog() {
			const query = (document.getElementById('catalog-search-input')?.value || '').toLowerCase().trim();
			const cards = document.querySelectorAll('.catalog-card');
			let visibleCount = 0;

			cards.forEach(card => {
				const name = card.dataset.name || '';
				const cat = card.dataset.category || '';
				const sku = card.dataset.sku || '';
				const desc = card.dataset.desc || '';

				const matchesCat = (activeCategory === 'all') || cat.includes(activeCategory);
				const matchesSearch = !query || name.includes(query) || cat.includes(query) || sku.includes(query) || desc.includes(query);

				if (matchesCat && matchesSearch) {
					card.classList.remove('hidden');
					visibleCount++;
				} else {
					card.classList.add('hidden');
				}
			});

			const emptyEl = document.getElementById('catalog-empty-search');
			if (emptyEl) {
				if (visibleCount === 0) emptyEl.classList.remove('hidden');
				else emptyEl.classList.add('hidden');
			}
		}

		function setCategoryFilter(cat) {
			activeCategory = cat.toLowerCase();
			document.querySelectorAll('.cat-pill').forEach(btn => {
				if (btn.dataset.cat === activeCategory) {
					btn.classList.add('bg-[#191917]', 'text-[#FAF6EE]', 'shadow-xs');
					btn.classList.remove('clay-marshmallow-subtle', 'text-[#5C5549]');
				} else {
					btn.classList.remove('bg-[#191917]', 'text-[#FAF6EE]', 'shadow-xs');
					btn.classList.add('clay-marshmallow-subtle', 'text-[#5C5549]');
				}
			});
			filterCatalog();
		}

		function resetFilters() {
			const searchInput = document.getElementById('catalog-search-input');
			if (searchInput) searchInput.value = '';
			setCategoryFilter('all');
		}

		async function addProductToCart(productId, name, price, category, image) {
			if (window.EasyBuyCart) {
				window.EasyBuyCart.addItem({
					id: productId,
					name: name,
					price: price,
					qty: 1,
					category: category,
					image: image
				});
			}

			// Also sync to server session / DB
			try {
				await fetch("{{ route('cart.add') }}", {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					},
					body: JSON.stringify({
						product_id: productId,
						quantity: 1
					})
				});
			} catch (e) {
				console.error('Server cart error:', e);
			}
		}
	</script>
</x-layout>
