<x-layout title="EasyBuy — {{ $product->name }}">
	<!-- Full-Height Modern Dashboard Workspace with Locked Static Sidebar -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED DASHBOARD SIDEBAR ==================== -->
		<x-dashboard-sidebar active="catalog" />

		<!-- ==================== CENTER PRODUCT DETAIL CANVAS ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-8 lg:p-12 pb-28 lg:pb-12 relative">
			
			<div class="max-w-5xl mx-auto space-y-6 animate-fade-in">
				
				<!-- Top Breadcrumbs & Back Navigation -->
				<div class="flex items-center justify-between pb-2 border-b border-[#E0D3C1]/50">
					<a href="{{ url('/catalog') }}" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3.5 py-1.5 rounded-xl inline-flex items-center gap-2 text-3xs font-bold text-[#5C5549] hover:text-[#191917] transition cursor-pointer group">
						<svg class="h-3.5 w-3.5 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
						</svg>
						<span>Back to Catalog</span>
					</a>
					<div class="flex items-center gap-2">
						<span class="clay-icon-pill px-3 py-1 rounded-xl text-4xs font-bold uppercase tracking-wider text-[#191917]">
							{{ $product->category }}
						</span>
						<span class="clay-marshmallow-subtle px-2.5 py-1 rounded-xl text-4xs font-mono text-[#7A7365]">
							{{ $product->sku }}
						</span>
						<button type="button" onclick="toggleDashboardSidebar()" title="Toggle Sidebar Navigation"
							class="sidebar-toggle-inline-btn clay-marshmallow-subtle px-3 py-1 rounded-xl text-3xs font-bold text-[#5C5549] hover:text-[#191917] hover:border-[#191917] transition flex items-center gap-1.5 cursor-pointer shadow-xs active:scale-95">
							<svg class="h-3 w-3 text-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
							</svg>
							<span class="btn-label">Hide Sidebar</span>
						</button>
					</div>
				</div>

				<!-- Main 2-Column Product Studio Layout -->
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
					
					<!-- Left Column: Large High-Res 3D Product Visual Gallery -->
					<div class="lg:col-span-6 space-y-4">
						
						<!-- Main Product Showcase Card -->
						<div class="clay-marshmallow rounded-3xl p-5 sm:p-6 relative group select-none transition">
							<!-- Warm Ambient Radial Glow -->
							<div class="absolute inset-0 bg-[#FFD000]/10 rounded-full blur-3xl transform scale-75 pointer-events-none"></div>

							<!-- Image Cavity with Cursor Zoom Hint -->
							<div onclick="openZoomModal()" 
								class="w-full h-80 sm:h-[400px] rounded-2xl clay-marshmallow-subtle overflow-hidden flex items-center justify-center p-4 sm:p-8 relative cursor-zoom-in group/canvas transition">
								
								<!-- Active Image Display -->
								<img id="main-product-image" 
									src="{{ $product->images[0] ?? $product->image }}" 
									alt="{{ $product->name }}" 
									class="w-full h-full object-contain mix-blend-multiply drop-shadow-md transition-all duration-300 group-hover/canvas:scale-105" 
									onerror="this.src='{{ asset('images/3d-refs/ergo_chair.jpg') }}'" />

								<!-- Zoom / Closer Look Pill Trigger Overlay (Top Right) -->
								<div class="absolute top-3 right-3 flex items-center gap-2">
									<span class="clay-icon-pill hover:bg-[#FAF6EE] text-[#191917] px-3 py-1.5 rounded-xl text-4xs sm:text-3xs font-bold transition flex items-center gap-1.5 shadow-2xs">
										<svg class="w-3.5 h-3.5 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
											<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
										</svg>
										<span>Closer Look / Zoom</span>
									</span>
								</div>

								<!-- Image Counter Badge (Top Left) -->
								<div class="absolute top-3 left-3">
									<span id="image-counter-pill" class="clay-icon-pill px-2.5 py-1 rounded-lg text-4xs font-bold text-[#5C5549]">
										1 / {{ count($product->images ?? [$product->image]) }}
									</span>
								</div>

								<!-- Prev / Next Overlays on Main Canvas -->
								@if(count($product->images ?? []) > 1)
									<button type="button" onclick="event.stopPropagation(); prevProductImage();" 
										class="absolute left-3 top-1/2 -translate-y-1/2 h-9 w-9 rounded-xl clay-icon-pill hover:bg-[#FAF6EE] text-[#191917] flex items-center justify-center transition opacity-0 group-hover:opacity-100 cursor-pointer shadow-xs active:scale-90"
										title="Previous angle">
										<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
											<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
										</svg>
									</button>
									<button type="button" onclick="event.stopPropagation(); nextProductImage();" 
										class="absolute right-3 top-1/2 -translate-y-1/2 h-9 w-9 rounded-xl clay-icon-pill hover:bg-[#FAF6EE] text-[#191917] flex items-center justify-center transition opacity-0 group-hover:opacity-100 cursor-pointer shadow-xs active:scale-90"
										title="Next angle">
										<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
											<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
										</svg>
									</button>
								@endif
							</div>

							<!-- Multi-Angle Thumbnail Filmstrip Row -->
							@if(count($product->images ?? []) > 1)
								<div class="mt-4 flex items-center gap-2.5 sm:gap-3 overflow-x-auto pb-1 scrollbar-none">
									@foreach($product->images as $idx => $img)
										<button type="button" onclick="switchProductImage({{ $idx }})" 
											id="thumb-btn-{{ $idx }}"
											class="thumb-item h-16 w-16 sm:h-20 sm:w-20 rounded-2xl p-1.5 clay-marshmallow-subtle overflow-hidden shrink-0 cursor-pointer transition relative group {{ $idx === 0 ? 'ring-2 ring-[#FFD000] scale-102 shadow-xs' : 'hover:scale-102 opacity-80 hover:opacity-100' }}">
											<img src="{{ $img }}" alt="{{ $product->name }} angle {{ $idx + 1 }}" 
												class="w-full h-full object-cover rounded-xl mix-blend-multiply" 
												onerror="this.src='{{ asset('images/3d-refs/ergo_chair.jpg') }}'" />
										</button>
									@endforeach
								</div>
							@endif

						</div>

						<!-- Factory Assurance Badges -->
						<div class="grid grid-cols-3 gap-2.5 text-center text-4xs">
							<div class="clay-marshmallow rounded-2xl p-3">
								<span class="block text-[#7A7365] mb-0.5">Lead Time</span>
								<strong class="text-[#191917] font-bold text-3xs">{{ $product->lead_time ?? '2-3 Days' }}</strong>
							</div>
							<div class="clay-marshmallow rounded-2xl p-3">
								<span class="block text-[#7A7365] mb-0.5">Stock Status</span>
								<strong class="text-[#191917] font-bold text-3xs">{{ $product->stock ?? 'In Stock' }}</strong>
							</div>
							<div class="clay-marshmallow rounded-2xl p-3">
								<span class="block text-[#7A7365] mb-0.5">Warranty</span>
								<strong class="text-[#191917] font-bold text-3xs">{{ $product->warranty ?? 'Direct 3-Year' }}</strong>
							</div>
						</div>
					</div>

					<!-- Right Column: Product Details, Specs, & Procurement Action -->
					<div class="lg:col-span-6 space-y-5">
						
						<!-- Header Title & Confidence -->
						<div class="space-y-1.5">
							<div class="flex items-center gap-2">
								<span class="clay-icon-pill text-4xs font-bold text-emerald-800 px-2.5 py-0.5 rounded-lg inline-flex items-center gap-1">
									✓ {{ $product->confidence ?? 'Verified Factory Match' }}
								</span>
								<span class="text-4xs text-[#7A7365]">Direct Manufacturer Line</span>
							</div>
							<h1 class="text-2xl sm:text-3xl font-extrabold text-[#191917] tracking-tight leading-snug product-title">
								{{ $product->name }}
							</h1>
						</div>

						<!-- Wholesale Pricing Card (Clay Extruded Tile) -->
						<div class="clay-marshmallow p-5 sm:p-6 rounded-3xl space-y-3">
							<div class="flex items-baseline justify-between">
								<div>
									<span class="text-4xs text-[#7A7365] uppercase font-bold tracking-wider block">Wholesale Unit Price</span>
									<div class="flex items-baseline gap-2 mt-0.5">
										<span class="text-2xl sm:text-3xl font-black text-[#191917] price-text">₦{{ number_format($product->price, 2) }}</span>
										<span class="text-xs text-[#9C9283] line-through price-text">₦{{ number_format($product->msrp, 2) }} MSRP</span>
									</div>
								</div>
								@php
									$savingsPercent = round((($product->msrp - $product->price) / max($product->msrp, 1)) * 100);
								@endphp
								<span class="clay-icon-pill text-3xs font-bold text-emerald-800 px-3 py-1.5 rounded-xl">
									Save {{ $savingsPercent }}% Wholesale
								</span>
							</div>

							<p class="text-3xs text-[#7A7365] border-t border-[#E0D3C1]/50 pt-2.5 flex items-center justify-between">
								<span>All items in 1 delivery & 1 receipt</span>
								<strong class="text-emerald-800 font-bold">Direct Factory Warranty</strong>
							</p>
						</div>

						<!-- Description -->
						<div class="space-y-1">
							<h3 class="text-3xs font-bold uppercase tracking-wider text-[#7A7365]">Product Overview</h3>
							<p class="text-xs text-[#5C5549] leading-relaxed">
								{{ $product->description }}
							</p>
						</div>

						<!-- Technical Specifications Table (Clean Clay Pill Grid) -->
						<div class="space-y-2 pt-2 border-t border-[#E0D3C1]/50">
							<h3 class="text-3xs font-bold uppercase tracking-wider text-[#7A7365]">Factory Verified Specifications</h3>
							<div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
								@if(!empty($product->specs))
									@foreach($product->specs as $key => $val)
										<div class="clay-marshmallow-subtle rounded-2xl p-3 flex flex-col justify-center">
											<span class="text-4xs text-[#7A7365] uppercase font-bold tracking-wider">{{ $key }}</span>
											<span class="text-3xs font-semibold text-[#191917] mt-0.5">{{ $val }}</span>
										</div>
									@endforeach
								@endif
							</div>
						</div>

						<!-- Quantity Selector & Add to Cart Action -->
						<div class="pt-4 border-t border-[#E0D3C1]/50 space-y-3">
							<div class="flex items-center gap-3">
								<!-- Interactive Counter -->
								<div class="flex items-center rounded-2xl clay-marshmallow-subtle p-1 gap-1">
									<button onclick="updateDetailQty(-1)" class="h-8 w-8 rounded-xl clay-icon-pill hover:bg-[#FAF6EE] text-sm font-black text-[#191917] transition cursor-pointer flex items-center justify-center active:scale-95">−</button>
									<input type="number" id="detail-qty-input" value="1" min="1" max="500" 
										class="w-12 text-center text-sm font-bold text-[#191917] price-text bg-transparent border-0 focus:outline-none" />
									<button onclick="updateDetailQty(1)" class="h-8 w-8 rounded-xl clay-icon-pill hover:bg-[#FAF6EE] text-sm font-black text-[#191917] transition cursor-pointer flex items-center justify-center active:scale-95">+</button>
								</div>

								<!-- Add to Cart Button -->
								<button onclick="addDetailProductToCart()" 
									class="flex-1 clay-btn-yellow py-3.5 px-6 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 cursor-pointer active:scale-95 shadow-sm transition">
									<span id="detail-add-btn-text">+ Add to Cart</span>
									<span>&rarr;</span>
								</button>
							</div>

							<p class="text-4xs text-center text-[#7A7365]">
								Includes factory warranty, verified supplier check & buyer protection.
							</p>
						</div>

					</div>

				</div>

			</div>

		</main>

	</div>

	<!-- ==================== INTERACTIVE HIGH-RES ZOOM LIGHTBOX MODAL ==================== -->
	<div id="product-zoom-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-md hidden p-3 sm:p-6 animate-fade-in" onclick="closeZoomModalOnBackdrop(event)">
		
		<div class="clay-marshmallow rounded-3xl p-4 sm:p-6 max-w-5xl w-full h-[90vh] sm:h-[85vh] flex flex-col justify-between shadow-2xl relative select-none animate-scale-in overflow-hidden" onclick="event.stopPropagation()">
			
			<!-- Modal Header Bar -->
			<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]/60 shrink-0">
				<div class="flex items-center gap-3">
					<div class="clay-icon-pill h-9 w-9 rounded-xl flex items-center justify-center text-[#191917]">
						<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
						</svg>
					</div>
					<div>
						<h3 class="text-sm sm:text-base font-bold text-[#191917] truncate max-w-xs sm:max-w-md product-title">{{ $product->name }}</h3>
						<p id="modal-zoom-counter" class="text-3xs text-[#7A7365]">Angle 1 of {{ count($product->images ?? [$product->image]) }} • Click or move cursor to inspect texture</p>
					</div>
				</div>

				<div class="flex items-center gap-2">
					<!-- Zoom Level Toggle -->
					<button onclick="toggleZoomMagnify()" id="zoom-toggle-btn" 
						class="clay-icon-pill hover:bg-[#FAF6EE] text-[#191917] px-3 py-1.5 rounded-xl text-3xs font-bold transition flex items-center gap-1.5 cursor-pointer">
						<span id="zoom-toggle-icon">🔍</span>
						<span id="zoom-toggle-text">2x Zoom</span>
					</button>

					<!-- Close Button -->
					<button onclick="closeZoomModal()" 
						class="h-9 w-9 rounded-full clay-icon-pill hover:bg-red-50 hover:text-red-600 text-[#191917] flex items-center justify-center font-black text-xs transition cursor-pointer active:scale-95"
						title="Close (Esc)">
						✕
					</button>
				</div>
			</div>

			<!-- Large Zoom Canvas Stage with Interactive Magnification & Pan -->
			<div class="relative flex-1 my-3 rounded-2xl clay-marshmallow-subtle overflow-hidden flex items-center justify-center p-4 sm:p-8 cursor-crosshair group/zoomstage"
				id="zoom-stage-container"
				onmousemove="handleZoomPan(event)"
				onmouseleave="resetZoomPan()"
				onclick="toggleZoomMagnify()">
				
				<img id="modal-zoom-image" 
					src="{{ $product->images[0] ?? $product->image }}" 
					alt="{{ $product->name }}" 
					class="max-w-full max-h-full object-contain mix-blend-multiply drop-shadow-lg transition-transform duration-150 select-none pointer-events-none" 
					onerror="this.src='{{ asset('images/3d-refs/ergo_chair.jpg') }}'" />

				<!-- Left Navigation Arrow -->
				@if(count($product->images ?? []) > 1)
					<button type="button" onclick="event.stopPropagation(); prevProductImage();" 
						class="absolute left-4 top-1/2 -translate-y-1/2 h-11 w-11 rounded-2xl clay-icon-pill hover:bg-[#FAF6EE] text-[#191917] flex items-center justify-center transition cursor-pointer shadow-md active:scale-90 z-20"
						title="Previous Image (←)">
						<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
						</svg>
					</button>

					<!-- Right Navigation Arrow -->
					<button type="button" onclick="event.stopPropagation(); nextProductImage();" 
						class="absolute right-4 top-1/2 -translate-y-1/2 h-11 w-11 rounded-2xl clay-icon-pill hover:bg-[#FAF6EE] text-[#191917] flex items-center justify-center transition cursor-pointer shadow-md active:scale-90 z-20"
						title="Next Image (→)">
						<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
						</svg>
					</button>
				@endif

				<!-- Subtle Floating Zoom Hint -->
				<div id="zoom-interactive-hint" class="absolute bottom-3 left-1/2 -translate-x-1/2 clay-icon-pill text-4xs font-bold text-[#5C5549] px-3 py-1 rounded-full pointer-events-none opacity-80 group-hover/zoomstage:opacity-100 transition shadow-2xs">
					Hover to pan • Click image to toggle 2.5x magnification
				</div>
			</div>

			<!-- Modal Bottom Filmstrip Thumbnails -->
			@if(count($product->images ?? []) > 1)
				<div class="pt-2 border-t border-[#E0D3C1]/50 flex items-center justify-center gap-2 sm:gap-3 shrink-0 overflow-x-auto">
					@foreach($product->images as $idx => $img)
						<button type="button" onclick="switchProductImage({{ $idx }})" 
							id="modal-thumb-btn-{{ $idx }}"
							class="modal-thumb-item h-12 w-12 sm:h-14 sm:w-14 rounded-xl p-1 clay-marshmallow-subtle overflow-hidden shrink-0 cursor-pointer transition relative {{ $idx === 0 ? 'ring-2 ring-[#FFD000] scale-105 shadow-xs' : 'hover:scale-105 opacity-70 hover:opacity-100' }}">
							<img src="{{ $img }}" alt="{{ $product->name }} thumb {{ $idx + 1 }}" 
								class="w-full h-full object-cover rounded-lg mix-blend-multiply" 
								onerror="this.src='{{ asset('images/3d-refs/ergo_chair.jpg') }}'" />
						</button>
					@endforeach
				</div>
			@endif

		</div>
	</div>

	<!-- ==================== SCRIPT LOGIC ==================== -->
	<script>
		const CURRENT_PRODUCT = {
			id: "{{ $product->id }}",
			name: "{{ addslashes($product->name) }}",
			price: {{ $product->price }},
			category: "{{ addslashes($product->category) }}",
			image: "{{ $product->image }}"
		};

		const PRODUCT_IMAGES = @json($product->images ?? [$product->image]);
		let currentImageIndex = 0;
		let isMagnified = false;

		// Switch active product image in main view & modal
		function switchProductImage(idx) {
			if (idx < 0 || idx >= PRODUCT_IMAGES.length) return;
			currentImageIndex = idx;
			const newSrc = PRODUCT_IMAGES[idx];

			// Update main canvas image
			const mainImg = document.getElementById('main-product-image');
			if (mainImg) {
				mainImg.src = newSrc;
			}

			// Update modal image
			const modalImg = document.getElementById('modal-zoom-image');
			if (modalImg) {
				modalImg.src = newSrc;
			}

			// Update counter indicators
			const counterPill = document.getElementById('image-counter-pill');
			if (counterPill) {
				counterPill.innerText = `${idx + 1} / ${PRODUCT_IMAGES.length}`;
			}

			const modalCounter = document.getElementById('modal-zoom-counter');
			if (modalCounter) {
				modalCounter.innerText = `Angle ${idx + 1} of ${PRODUCT_IMAGES.length} • Click or move cursor to inspect texture`;
			}

			// Update active thumbnail classes (main page)
			document.querySelectorAll('.thumb-item').forEach((btn, i) => {
				if (i === idx) {
					btn.classList.add('ring-2', 'ring-[#FFD000]', 'scale-102', 'shadow-xs');
					btn.classList.remove('opacity-80');
				} else {
					btn.classList.remove('ring-2', 'ring-[#FFD000]', 'scale-102', 'shadow-xs');
					btn.classList.add('opacity-80');
				}
			});

			// Update active thumbnail classes (modal)
			document.querySelectorAll('.modal-thumb-item').forEach((btn, i) => {
				if (i === idx) {
					btn.classList.add('ring-2', 'ring-[#FFD000]', 'scale-105', 'shadow-xs');
					btn.classList.remove('opacity-70');
				} else {
					btn.classList.remove('ring-2', 'ring-[#FFD000]', 'scale-105', 'shadow-xs');
					btn.classList.add('opacity-70');
				}
			});

			// Reset magnification when switching images
			resetZoomPan();
		}

		function prevProductImage() {
			let newIdx = currentImageIndex - 1;
			if (newIdx < 0) newIdx = PRODUCT_IMAGES.length - 1;
			switchProductImage(newIdx);
		}

		function nextProductImage() {
			let newIdx = currentImageIndex + 1;
			if (newIdx >= PRODUCT_IMAGES.length) newIdx = 0;
			switchProductImage(newIdx);
		}

		// Zoom Lightbox Modal Handling
		function openZoomModal() {
			const modal = document.getElementById('product-zoom-modal');
			if (modal) {
				modal.classList.remove('hidden');
				document.body.style.overflow = 'hidden';
				switchProductImage(currentImageIndex);
			}
		}

		function closeZoomModal() {
			const modal = document.getElementById('product-zoom-modal');
			if (modal) {
				modal.classList.add('hidden');
				document.body.style.overflow = '';
				resetZoomMagnify();
			}
		}

		function closeZoomModalOnBackdrop(e) {
			if (e.target && e.target.id === 'product-zoom-modal') {
				closeZoomModal();
			}
		}

		// Zoom Magnification / Pan Interactive Engine
		function toggleZoomMagnify() {
			isMagnified = !isMagnified;
			const modalImg = document.getElementById('modal-zoom-image');
			const label = document.getElementById('zoom-toggle-text');
			const hint = document.getElementById('zoom-interactive-hint');

			if (isMagnified) {
				if (label) label.innerText = 'Fit Canvas';
				if (hint) hint.innerText = 'Move cursor around canvas to inspect details';
				if (modalImg) {
					modalImg.style.transform = 'scale(2.4)';
					modalImg.style.transformOrigin = 'center center';
				}
			} else {
				resetZoomMagnify();
			}
		}

		function resetZoomMagnify() {
			isMagnified = false;
			const modalImg = document.getElementById('modal-zoom-image');
			const label = document.getElementById('zoom-toggle-text');
			const hint = document.getElementById('zoom-interactive-hint');
			if (label) label.innerText = '2x Zoom';
			if (hint) hint.innerText = 'Hover to pan • Click image to toggle 2.5x magnification';
			if (modalImg) {
				modalImg.style.transform = 'scale(1)';
				modalImg.style.transformOrigin = 'center center';
			}
		}

		function handleZoomPan(e) {
			if (!isMagnified) return;
			const stage = document.getElementById('zoom-stage-container');
			const modalImg = document.getElementById('modal-zoom-image');
			if (!stage || !modalImg) return;

			const rect = stage.getBoundingClientRect();
			const x = e.clientX - rect.left;
			const y = e.clientY - rect.top;

			const xPercent = Math.max(0, Math.min(100, (x / rect.width) * 100));
			const yPercent = Math.max(0, Math.min(100, (y / rect.height) * 100));

			modalImg.style.transformOrigin = `${xPercent}% ${yPercent}%`;
			modalImg.style.transform = 'scale(2.5)';
		}

		function resetZoomPan() {
			if (isMagnified) {
				const modalImg = document.getElementById('modal-zoom-image');
				if (modalImg) {
					modalImg.style.transformOrigin = 'center center';
				}
			}
		}

		// Global Keyboard Navigation (Arrows & Escape)
		document.addEventListener('keydown', (e) => {
			const modal = document.getElementById('product-zoom-modal');
			const isModalOpen = modal && !modal.classList.contains('hidden');

			if (e.key === 'Escape') {
				if (isModalOpen) closeZoomModal();
			} else if (e.key === 'ArrowLeft') {
				prevProductImage();
			} else if (e.key === 'ArrowRight') {
				nextProductImage();
			}
		});

		// Cart & Quantity Operations
		function updateDetailQty(delta) {
			const input = document.getElementById('detail-qty-input');
			if (!input) return;
			let val = parseInt(input.value) || 1;
			val += delta;
			if (val < 1) val = 1;
			input.value = val;
		}

		async function addDetailProductToCart() {
			const input = document.getElementById('detail-qty-input');
			const qty = input ? (parseInt(input.value) || 1) : 1;
			
			if (window.EasyBuyCart) {
				window.EasyBuyCart.addItem({
					id: CURRENT_PRODUCT.id,
					name: CURRENT_PRODUCT.name,
					price: CURRENT_PRODUCT.price,
					qty: qty,
					category: CURRENT_PRODUCT.category,
					image: CURRENT_PRODUCT.image
				});
				
				const btnText = document.getElementById('detail-add-btn-text');
				if (btnText) {
					const old = btnText.innerText;
					btnText.innerText = `Added ${qty} to Cart ✓`;
					setTimeout(() => { btnText.innerText = old; }, 1800);
				}

				// Update sidebar badge
				const badge = document.getElementById('sidebar-cart-count');
				if (badge) badge.innerText = window.EasyBuyCart.getCount();
			}

			// Server sync
			try {
				await fetch("{{ route('cart.add') }}", {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					},
					body: JSON.stringify({
						product_id: CURRENT_PRODUCT.id,
						quantity: qty
					})
				});
			} catch (e) {
				console.error('Server cart add error:', e);
			}
		}

		function toggleCatalogModal(open) {
			window.location.href = "{{ url('/catalog') }}";
		}

		document.addEventListener('DOMContentLoaded', () => {
			const badge = document.getElementById('sidebar-cart-count');
			if (badge && window.EasyBuyCart) {
				badge.innerText = window.EasyBuyCart.getCount();
			}
		});
	</script>
</x-layout>
