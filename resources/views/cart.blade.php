<x-layout title="EasyBuy — Your Cart">
	<!-- Full-Height Modern Dashboard Workspace with Locked Static Sidebar -->
	<div class="h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-[#FAF6EE] overflow-hidden">
		
		<!-- ==================== FIXED DASHBOARD SIDEBAR (NEVER MOVES ON SCROLL) ==================== -->
		<x-dashboard-sidebar active="cart" />

		<!-- ==================== CENTER CART CANVAS ==================== -->
		<main class="flex-1 h-full overflow-y-auto p-4 sm:p-8 lg:p-12 relative">
			
			<div class="max-w-5xl mx-auto space-y-6 animate-fade-in">
				
				<!-- Top Breadcrumbs & Back Navigation -->
				<div class="flex flex-wrap items-center justify-between gap-2 pb-2 border-b border-[#E0D3C1]/50">
					<a href="{{ url('/home') }}" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3.5 py-1.5 rounded-xl inline-flex items-center gap-2 text-3xs font-bold text-[#5C5549] hover:text-[#191917] transition cursor-pointer">
						<svg class="h-3.5 w-3.5 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
						</svg>
						<span>Continue Sourcing (Ask Easy)</span>
					</a>
					<div class="flex items-center gap-2">
						<a href="{{ url('/home') }}#standing-orders-section" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3.5 py-1.5 rounded-xl text-3xs font-bold text-purple-900 border border-purple-200/60 transition flex items-center gap-1.5">
							<span>🔄 Standing Orders</span>
						</a>
						<button onclick="clearEntireCart()" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3.5 py-1.5 rounded-xl text-3xs font-bold text-[#7A7365] hover:text-red-600 transition cursor-pointer">
							Clear All Items
						</button>
					</div>
				</div>

				<!-- Header Title & Item Count -->
				<div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2">
					<div>
						<h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#191917] tracking-tight">
							Your Cart
						</h1>
						<p class="text-xs text-[#5C5549] mt-1">
							All items combined into a single unified delivery and single invoice.
						</p>
					</div>
					<span id="cart-item-badge-top" class="text-3xs font-bold text-[#191917] clay-icon-pill px-3.5 py-1.5 rounded-full self-start sm:self-auto">
						0 Items
					</span>
				</div>

				<!-- Main 2-Column Cart Layout -->
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
					
					<!-- Left Column: Line Items List (8 cols) -->
					<div class="lg:col-span-8 space-y-4">
						
						<!-- Container for dynamically rendered cart items -->
						<div id="cart-page-items-list" class="space-y-4">
							<!-- Rendered via JavaScript -->
						</div>

						<!-- Clean Clay Empty State (Displayed when items array is empty) -->
						<div id="cart-page-empty" class="hidden clay-marshmallow rounded-3xl p-10 sm:p-12 flex flex-col items-center justify-center text-center space-y-4">
							<div class="h-16 w-16 rounded-3xl clay-icon-pill flex items-center justify-center text-[#7A7365]">
								<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
									<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
								</svg>
							</div>
							<div class="space-y-1">
								<h3 class="text-base sm:text-lg font-bold text-[#191917]">Your cart is empty</h3>
								<p class="text-xs text-[#7A7365] max-w-sm">
									You haven't added any products yet. Use Ask Easy to generate a bill of materials or explore our verified wholesale catalog.
								</p>
							</div>
							<div class="pt-2 flex items-center gap-3">
								<a href="{{ url('/home') }}" class="clay-btn-yellow px-5 py-2.5 rounded-2xl text-xs font-bold flex items-center gap-2 cursor-pointer shadow-xs">
									<span>Start Sourcing with Ask Easy</span>
									<span>&rarr;</span>
								</a>
							</div>
						</div>

					</div>

					<!-- Right Column: Order Summary (4 cols) -->
					<div class="lg:col-span-4 space-y-4">
						
						<div class="clay-marshmallow p-6 sm:p-7 rounded-3xl space-y-5 sticky top-4 select-none">
							<h2 class="text-base font-bold text-[#191917] pb-3 border-b border-[#E0D3C1]/50">
								Order Summary
							</h2>

							<div class="space-y-3 text-xs">
								<!-- Items Subtotal -->
								<div class="flex justify-between text-[#5C5549]">
									<span>Items Subtotal</span>
									<span id="summary-subtotal" class="font-bold text-[#191917] price-text">$0.00</span>
								</div>

								<!-- Wholesale Savings Callout -->
								<div class="flex justify-between items-center text-emerald-800 clay-marshmallow-subtle p-3 rounded-2xl">
									<div class="flex items-center gap-1.5">
										<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
											<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
										</svg>
										<span class="font-bold text-3xs uppercase tracking-wider">Wholesale Savings</span>
									</div>
									<span id="summary-savings" class="font-bold price-text">-$0.00</span>
								</div>

								<!-- Delivery -->
								<div class="flex justify-between text-[#5C5549] text-3xs">
									<span>Unified Delivery</span>
									<span class="font-bold text-emerald-800 uppercase tracking-wider">FREE (Single Drop)</span>
								</div>

								<!-- Factory Inspection & Warranty -->
								<div class="flex justify-between text-[#5C5549] text-3xs">
									<span>Factory Warranty & Inspection</span>
									<span class="font-bold text-emerald-800 uppercase tracking-wider">Included</span>
								</div>

								<!-- Estimated Total -->
								<div class="pt-4 border-t border-[#E0D3C1]/50 flex justify-between items-baseline">
									<div>
										<span class="text-xs font-bold text-[#191917] block">Estimated Total</span>
										<span class="text-4xs text-[#7A7365]">All fees included</span>
									</div>
									<span id="summary-total" class="text-2xl sm:text-3xl font-black text-[#191917] price-text">$0.00</span>
								</div>
							</div>

							<!-- Big Checkout Button -->
							<button onclick="handleCartCheckout()" 
								id="cart-checkout-btn"
								class="w-full clay-btn-yellow py-3.5 px-6 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 cursor-pointer active:scale-95 shadow-sm transition">
								<span id="checkout-btn-label">Proceed to Checkout</span>
								<span>&rarr;</span>
							</button>

							<!-- Assurance Checklist -->
							<div class="pt-3 text-4xs text-[#7A7365] space-y-2 border-t border-[#E0D3C1]/50">
								<p class="flex items-center gap-2">
									<span class="clay-icon-pill h-4 w-4 rounded-full flex items-center justify-center text-emerald-800 font-bold text-4xs shrink-0">✓</span>
									<span>100% Direct verified manufacturer pricing</span>
								</p>
								<p class="flex items-center gap-2">
									<span class="clay-icon-pill h-4 w-4 rounded-full flex items-center justify-center text-emerald-800 font-bold text-4xs shrink-0">✓</span>
									<span>Single shipment & consolidated billing</span>
								</p>
								<p class="flex items-center gap-2">
									<span class="clay-icon-pill h-4 w-4 rounded-full flex items-center justify-center text-emerald-800 font-bold text-4xs shrink-0">✓</span>
									<span>Net-30 payment terms available</span>
								</p>
							</div>
						</div>

					</div>

				</div>

			</div>

		</main>

	</div>

	<!-- ==================== CART PAGE JAVASCRIPT ==================== -->
	<script>
		// Image mapping lookup for known IDs
		const IMAGE_MAP = {
			'res-erg-1': "{{ asset('images/3d-refs/ergo_chair.jpg') }}",
			'sample-1': "{{ asset('images/3d-refs/ergo_chair.jpg') }}",
			'res-disp-2': "{{ asset('images/3d-refs/4k_display.jpg') }}",
			'sample-2': "{{ asset('images/3d-refs/4k_display.jpg') }}",
			'res-dsk-3': "{{ asset('images/3d-refs/standing_desk.jpg') }}",
			'res-st-1': "{{ asset('images/3d-refs/modern_lamp.jpg') }}",
			'res-st-2': "{{ asset('images/3d-refs/smart_hub.jpg') }}",
			'res-sp-1': "{{ asset('images/3d-refs/ergo_chair.jpg') }}",
			'res-sp-2': "{{ asset('images/3d-refs/4k_display.jpg') }}"
		};

		function getProductImage(item) {
			if (item.image) return item.image;
			if (IMAGE_MAP[item.id]) return IMAGE_MAP[item.id];
			return "{{ asset('images/3d-refs/ergo_chair.jpg') }}";
		}

		// Cart Page Render Function (called on load & on any cart mutation)
		window.renderCartPage = function() {
			const container = document.getElementById('cart-page-items-list');
			const emptyState = document.getElementById('cart-page-empty');
			const subtotalEl = document.getElementById('summary-subtotal');
			const savingsEl = document.getElementById('summary-savings');
			const totalEl = document.getElementById('summary-total');
			const topBadge = document.getElementById('cart-item-badge-top');
			const checkoutBtn = document.getElementById('cart-checkout-btn');

			if (!container || !window.EasyBuyCart) return;

			const items = window.EasyBuyCart.items || [];
			const totalCount = window.EasyBuyCart.getCount();
			const totalSum = window.EasyBuyCart.getTotal();
			const savingsSum = totalSum * 0.34;

			// Update top badge
			if (topBadge) {
				topBadge.innerText = `${totalCount} ${totalCount === 1 ? 'Item' : 'Items'} (${items.length} ${items.length === 1 ? 'SKU' : 'SKUs'})`;
			}

			// Empty State Handling
			if (items.length === 0) {
				container.innerHTML = '';
				if (emptyState) emptyState.classList.remove('hidden');
				if (subtotalEl) subtotalEl.innerText = '$0.00';
				if (savingsEl) savingsEl.innerText = '-$0.00';
				if (totalEl) totalEl.innerText = '$0.00';
				if (checkoutBtn) {
					checkoutBtn.disabled = true;
					checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
				}
				return;
			}

			if (emptyState) emptyState.classList.add('hidden');
			if (checkoutBtn) {
				checkoutBtn.disabled = false;
				checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
			}

			// Update Summary Numbers
			if (subtotalEl) subtotalEl.innerText = `$${totalSum.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
			if (savingsEl) savingsEl.innerText = `-$${savingsSum.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} (34% wholesale)`;
			if (totalEl) totalEl.innerText = `$${totalSum.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

			// Render Line Items
			container.innerHTML = items.map(item => {
				const itemImg = getProductImage(item);
				const lineTotal = (item.price * item.qty).toFixed(2);
				const detailUrl = "{{ url('/home/product') }}/" + item.id;

				return `
					<div class="clay-marshmallow rounded-3xl p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 select-none transition group">
						
						<!-- Left: Product Image & Details -->
						<div class="flex items-center gap-4 min-w-0 flex-1 w-full sm:w-auto">
							<a href="${detailUrl}" class="h-20 w-20 sm:h-24 sm:w-24 rounded-2xl overflow-hidden clay-marshmallow-subtle shrink-0 relative block group-hover:shadow-xs transition">
								<img src="${itemImg}" alt="${item.name}" 
									class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
									onerror="this.src='{{ asset('images/3d-refs/ergo_chair.jpg') }}'" />
							</a>
							
							<div class="min-w-0 flex-1 space-y-1">
								<div class="flex items-center gap-1.5 flex-wrap">
									<span class="clay-icon-pill text-4xs font-bold px-2.5 py-0.5 rounded-lg text-[#5C5549] uppercase tracking-wider inline-block">
										${item.category || 'General'}
									</span>
									${item.recurring ? `<span class="clay-icon-pill text-4xs font-bold px-2 py-0.5 rounded-lg text-purple-900 bg-purple-100 border border-purple-200">🔄 Monthly Cadence (Month 1 Drop)</span>` : ''}
								</div>
								<a href="${detailUrl}" class="block text-xs sm:text-sm font-bold text-[#191917] leading-snug hover:text-[#5C5549] transition truncate product-title">
									${item.name}
								</a>
								<p class="text-3xs text-[#7A7365] price-text">
									$${parseFloat(item.price).toFixed(2)} each • Direct Factory Line
								</p>
							</div>
						</div>

						<!-- Right: Quantity Selector, Line Total & Remove -->
						<div class="flex items-center justify-between sm:justify-end gap-4 w-full sm:w-auto pt-3 sm:pt-0 border-t sm:border-t-0 border-[#E0D3C1]/50">
							
							<!-- Quantity Stepper -->
							<div class="flex items-center rounded-2xl clay-marshmallow-subtle p-1 gap-1">
								<button onclick="EasyBuyCart.updateQty('${item.id}', -1)" 
									class="h-7 w-7 rounded-xl clay-icon-pill hover:bg-[#FAF6EE] text-xs font-black text-[#191917] flex items-center justify-center transition cursor-pointer active:scale-95">−</button>
								<span class="w-8 text-center text-xs font-bold text-[#191917] price-text">${item.qty}</span>
								<button onclick="EasyBuyCart.updateQty('${item.id}', 1)" 
									class="h-7 w-7 rounded-xl clay-icon-pill hover:bg-[#FAF6EE] text-xs font-black text-[#191917] flex items-center justify-center transition cursor-pointer active:scale-95">+</button>
							</div>

							<!-- Line Item Total -->
							<div class="text-right min-w-[80px]">
								<span class="text-xs sm:text-sm font-bold text-[#191917] price-text block">$${lineTotal}</span>
								<span class="text-4xs text-emerald-800 font-bold block">Wholesale</span>
							</div>

							<!-- Remove Trash Button -->
							<button onclick="EasyBuyCart.removeItem('${item.id}')" 
								class="h-8 w-8 rounded-xl clay-icon-pill hover:text-red-600 hover:bg-[#FAF6EE] text-[#9C9283] flex items-center justify-center transition cursor-pointer shrink-0 active:scale-95" 
								title="Remove item">
								<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
								</svg>
							</button>

						</div>

					</div>
				`;
			}).join('');
		};

		async function clearEntireCart() {
			if (confirm('Are you sure you want to clear all items from your cart?')) {
				if (window.EasyBuyCart) {
					window.EasyBuyCart.clear();
				}
				try {
					await fetch("{{ route('cart.clear') }}", {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}',
							'Accept': 'application/json'
						}
					});
				} catch (e) {}
			}
		}

		async function handleCartCheckout() {
			if (!window.EasyBuyCart || window.EasyBuyCart.items.length === 0) {
				alert('Please add items to your cart first.');
				return;
			}
			const btn = document.getElementById('cart-checkout-btn');
			const label = document.getElementById('checkout-btn-label');
			if (btn && label) {
				btn.disabled = true;
				label.innerText = 'Preparing Consolidated Checkout...';
			}

			try {
				await fetch("{{ route('cart.sync') }}", {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					},
					body: JSON.stringify({
						items: window.EasyBuyCart.items
					})
				});
			} catch (err) {
				console.error('Cart sync error:', err);
			}

			window.location.href = "{{ route('checkout') }}";
		}

		document.addEventListener('DOMContentLoaded', () => {
			if (typeof window.renderCartPage === 'function') {
				window.renderCartPage();
			}
		});
	</script>
</x-layout>
