<x-layout title="EasyBuy — Consolidated B2B Checkout">
	<div class="min-h-[calc(100vh-4rem)] bg-[#FAF6EE] p-4 sm:p-8 lg:p-12">
		<div class="max-w-6xl mx-auto space-y-6 animate-fade-in">

			<!-- Top Breadcrumbs & Back Navigation -->
			<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]/50">
				<a href="{{ url('/cart') }}" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3.5 py-1.5 rounded-xl inline-flex items-center gap-2 text-3xs font-bold text-[#5C5549] hover:text-[#191917] transition cursor-pointer">
					<svg class="h-3.5 w-3.5 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
					</svg>
					<span>Back to Cart</span>
				</a>
				<div class="flex items-center gap-2 text-3xs font-bold text-emerald-800 clay-marshmallow-subtle px-3 py-1 rounded-full">
					<span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
					<span>Single Consolidated Invoice Guarantee</span>
				</div>
			</div>

			<!-- Page Heading -->
			<div>
				<h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#191917] tracking-tight">
					Checkout & PO Issuance
				</h1>
				<p class="text-xs text-[#5C5549] mt-1">
					Consolidated single-payment settlement for all direct factory line items.
				</p>
			</div>

			<!-- Flash Messages -->
			@if(session('error'))
				<div class="clay-marshmallow rounded-2xl p-4 bg-red-50 border border-red-200 text-red-800 text-xs font-bold flex items-center gap-3">
					<svg class="h-5 w-5 text-red-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
					</svg>
					<span>{{ session('error') }}</span>
				</div>
			@endif

			<form action="{{ route('payment.initialize') }}" method="POST" id="checkout-form">
				@csrf
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
					
					<!-- Left Column: Delivery & Payment Details (7 Cols) -->
					<div class="lg:col-span-7 space-y-6">
						
						<!-- 1. Corporate / Delivery Organization -->
						<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 space-y-5">
							<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]/50">
								<h2 class="text-base font-bold text-[#191917] flex items-center gap-2">
									<span class="h-6 w-6 rounded-full bg-[#FFD000] text-[#191917] text-3xs font-black flex items-center justify-center">1</span>
									<span>Procurement Entity & Contact</span>
								</h2>
								<span class="text-4xs font-bold uppercase tracking-wider text-[#7A7365]">B2B Account</span>
							</div>

							<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
								<div>
									<label class="block text-3xs font-bold uppercase tracking-wider text-[#5C5549] mb-1.5">Company / Entity Name</label>
									<input type="text" name="company_name" value="{{ old('company_name', Auth::user()->company_name ?? 'Acme Corp Procurement') }}" required
										class="w-full clay-input rounded-xl px-3.5 py-2.5 text-xs text-[#191917] font-medium focus:outline-none focus:ring-2 focus:ring-[#FFD000]" placeholder="e.g. Acme Logistics Ltd.">
								</div>
								<div>
									<label class="block text-3xs font-bold uppercase tracking-wider text-[#5C5549] mb-1.5">Billing / PO Email</label>
									<input type="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" required
										class="w-full clay-input rounded-xl px-3.5 py-2.5 text-xs text-[#191917] font-medium focus:outline-none focus:ring-2 focus:ring-[#FFD000]" placeholder="billing@company.com">
								</div>
							</div>
						</div>

						<!-- 2. Consolidated Destination Shipping Address -->
						<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 space-y-5">
							<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]/50">
								<h2 class="text-base font-bold text-[#191917] flex items-center gap-2">
									<span class="h-6 w-6 rounded-full bg-[#FFD000] text-[#191917] text-3xs font-black flex items-center justify-center">2</span>
									<span>Single Delivery Destination (Blind Drop Facility)</span>
								</h2>
								<span class="text-4xs font-bold uppercase tracking-wider text-emerald-800">Unified Drop</span>
							</div>

							<div class="space-y-4">
								<div>
									<label class="block text-3xs font-bold uppercase tracking-wider text-[#5C5549] mb-1.5">Street Address / Receiving Dock Bay</label>
									<input type="text" name="shipping_address" value="{{ old('shipping_address', 'Dock 4B, 100 Innovation Parkway') }}" required
										class="w-full clay-input rounded-xl px-3.5 py-2.5 text-xs text-[#191917] font-medium focus:outline-none focus:ring-2 focus:ring-[#FFD000]" placeholder="Street address or loading dock">
								</div>

								<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
									<div>
										<label class="block text-3xs font-bold uppercase tracking-wider text-[#5C5549] mb-1.5">City</label>
										<input type="text" name="city" value="{{ old('city', 'Austin') }}" required
											class="w-full clay-input rounded-xl px-3.5 py-2.5 text-xs text-[#191917] font-medium focus:outline-none focus:ring-2 focus:ring-[#FFD000]" placeholder="City">
									</div>
									<div>
										<label class="block text-3xs font-bold uppercase tracking-wider text-[#5C5549] mb-1.5">State / Province</label>
										<input type="text" name="state" value="{{ old('state', 'Texas') }}" required
											class="w-full clay-input rounded-xl px-3.5 py-2.5 text-xs text-[#191917] font-medium focus:outline-none focus:ring-2 focus:ring-[#FFD000]" placeholder="State">
									</div>
									<div>
										<label class="block text-3xs font-bold uppercase tracking-wider text-[#5C5549] mb-1.5">Zip / Postal Code</label>
										<input type="text" name="zip" value="{{ old('zip', '78701') }}"
											class="w-full clay-input rounded-xl px-3.5 py-2.5 text-xs text-[#191917] font-medium focus:outline-none focus:ring-2 focus:ring-[#FFD000]" placeholder="78701">
									</div>
								</div>

								<div>
									<label class="block text-3xs font-bold uppercase tracking-wider text-[#5C5549] mb-1.5">Delivery Instructions (Optional)</label>
									<textarea name="notes" rows="2" class="w-full clay-input rounded-xl px-3.5 py-2 text-xs text-[#191917] font-medium focus:outline-none focus:ring-2 focus:ring-[#FFD000]" placeholder="e.g. Liftgate required on consolidated drop"></textarea>
								</div>
							</div>
						</div>

						<!-- 3. Payment Method Selection (Paystack Live Gateway vs Net-30) -->
						<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 space-y-5">
							<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]/50">
								<h2 class="text-base font-bold text-[#191917] flex items-center gap-2">
									<span class="h-6 w-6 rounded-full bg-[#FFD000] text-[#191917] text-3xs font-black flex items-center justify-center">3</span>
									<span>Settlement & Payment Method</span>
								</h2>
								<span class="text-4xs font-bold uppercase tracking-wider text-[#7A7365]">Secure Gateway</span>
							</div>

							<div class="space-y-3">
								
								<!-- Option 1: Paystack Live Integration -->
								<label class="block cursor-pointer">
									<div class="clay-marshmallow-subtle p-4 rounded-2xl border-2 border-[#FFD000] flex items-start gap-4 transition hover:bg-[#FAF6EE]">
										<input type="radio" name="payment_method" value="paystack" checked class="mt-1 accent-[#191917] h-4 w-4">
										<div class="space-y-1 flex-1">
											<div class="flex items-center justify-between">
												<span class="text-xs font-bold text-[#191917]">Paystack Online Payment</span>
												<div class="flex items-center gap-1.5">
													<span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-900 text-4xs font-extrabold uppercase">Instant Escrow</span>
													<span class="px-2 py-0.5 rounded bg-[#FFD000]/30 text-[#191917] text-4xs font-extrabold uppercase">Cards / Transfer / USSD</span>
												</div>
											</div>
											<p class="text-3xs text-[#7A7365]">
												Direct encrypted checkout via Paystack. Supports Mastercard, Visa, Verve, Direct Bank Transfer & Virtual Accounts.
											</p>
										</div>
									</div>
								</label>

								<!-- Option 2: Net-30 Terms -->
								<label class="block cursor-pointer">
									<div class="clay-marshmallow-subtle p-4 rounded-2xl border border-[#E0D3C1] flex items-start gap-4 transition hover:bg-[#FAF6EE]">
										<input type="radio" name="payment_method" value="net30" class="mt-1 accent-[#191917] h-4 w-4">
										<div class="space-y-1 flex-1">
											<div class="flex items-center justify-between">
												<span class="text-xs font-bold text-[#191917]">Corporate Net-30 Invoicing</span>
												<span class="px-2 py-0.5 rounded bg-blue-100 text-blue-900 text-4xs font-extrabold uppercase">Commercial Credit</span>
											</div>
											<p class="text-3xs text-[#7A7365]">
												Issue official Purchase Order (PO) immediately. Settle tax invoice in 30 days via corporate wire or ACH.
											</p>
										</div>
									</div>
								</label>

								<!-- Option 3: Net-60 Terms -->
								<label class="block cursor-pointer">
									<div class="clay-marshmallow-subtle p-4 rounded-2xl border border-[#E0D3C1] flex items-start gap-4 transition hover:bg-[#FAF6EE]">
										<input type="radio" name="payment_method" value="net60" class="mt-1 accent-[#191917] h-4 w-4">
										<div class="space-y-1 flex-1">
											<div class="flex items-center justify-between">
												<span class="text-xs font-bold text-[#191917]">Enterprise Net-60 Terms</span>
												<span class="px-2 py-0.5 rounded bg-purple-100 text-purple-900 text-4xs font-extrabold uppercase">Approved Accounts</span>
											</div>
											<p class="text-3xs text-[#7A7365]">
												Extended 60-day billing cycle for qualified enterprise procurement teams.
											</p>
										</div>
									</div>
								</label>

							</div>
						</div>

					</div>

					<!-- Right Column: Order Summary & Single Invoice Preview (5 Cols) -->
					<div class="lg:col-span-5 space-y-6">
						<div class="clay-marshmallow rounded-3xl p-6 sm:p-7 space-y-5 sticky top-20">
							
							<div class="flex items-center justify-between pb-3 border-b border-[#E0D3C1]/50">
								<h2 class="text-base font-bold text-[#191917]">
									Consolidated Order Summary
								</h2>
								<span class="text-3xs font-black text-[#191917] clay-icon-pill px-2.5 py-1 rounded-full">
									{{ $cartItems->count() }} Line {{ $cartItems->count() === 1 ? 'Item' : 'Items' }}
								</span>
							</div>

							<!-- Items Mini List -->
							<div class="space-y-3 max-h-64 overflow-y-auto pr-1">
								@foreach($cartItems as $item)
									<div class="flex items-center justify-between gap-3 text-xs pb-2 border-b border-[#E0D3C1]/30">
										<div class="flex items-center gap-2.5 min-w-0 flex-1">
											<img src="{{ $item->product->primary_image ?? asset('images/3d-refs/ergo_chair.jpg') }}" 
												alt="{{ $item->product->name ?? 'Item' }}" 
												class="h-10 w-10 rounded-xl object-cover clay-marshmallow-subtle shrink-0">
											<div class="min-w-0 flex-1">
												<span class="font-bold text-[#191917] block truncate">{{ $item->product->name ?? 'Product' }}</span>
												<span class="text-4xs text-[#7A7365]">Qty: {{ $item->quantity }} • ${{ number_format($item->unit_price, 2) }}</span>
											</div>
										</div>
										<span class="font-bold text-[#191917] price-text shrink-0">${{ number_format($item->unit_price * $item->quantity, 2) }}</span>
									</div>
								@endforeach
							</div>

							<!-- Financial Totals -->
							<div class="space-y-2.5 text-xs pt-2">
								<div class="flex justify-between text-[#5C5549]">
									<span>Wholesale Subtotal</span>
									<span class="font-bold text-[#191917] price-text">${{ number_format($subtotal, 2) }}</span>
								</div>

								@if($savings > 0)
									<div class="flex justify-between items-center text-emerald-800 clay-marshmallow-subtle p-2.5 rounded-xl">
										<span class="font-bold text-3xs uppercase tracking-wider">Wholesale Direct Savings</span>
										<span class="font-bold price-text">-${{ number_format($savings, 2) }}</span>
									</div>
								@endif

								<div class="flex justify-between text-[#5C5549] text-3xs">
									<span>Consolidated Unified Delivery</span>
									<span class="font-bold text-emerald-800 uppercase">FREE</span>
								</div>

								<div class="flex justify-between text-[#5C5549] text-3xs">
									<span>Estimated Tax & Duties</span>
									<span class="font-bold text-[#191917] price-text">$0.00 (Exempt)</span>
								</div>

								<!-- Grand Total -->
								<div class="pt-4 border-t border-[#E0D3C1]/50 flex justify-between items-baseline">
									<div>
										<span class="text-xs font-bold text-[#191917] block">Single Total Invoice</span>
										<span class="text-4xs text-[#7A7365]">All direct suppliers bundled</span>
									</div>
									<span class="text-2xl sm:text-3xl font-black text-[#191917] price-text">
										${{ number_format($subtotal, 2) }}
									</span>
								</div>
							</div>

							<!-- Big Submit Button -->
							<button type="submit" id="submit-checkout-btn"
								class="w-full clay-btn-yellow py-3.5 px-6 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 cursor-pointer active:scale-95 shadow-sm transition">
								<span>Complete Consolidated Order</span>
								<span>&rarr;</span>
							</button>

							<!-- Safe & Verified Callout -->
							<div class="pt-2 text-4xs text-[#7A7365] space-y-1.5 border-t border-[#E0D3C1]/50">
								<p class="flex items-center gap-2">
									<span class="text-emerald-800 font-bold">✓</span>
									<span>Paystack 256-bit SSL secured transaction</span>
								</p>
								<p class="flex items-center gap-2">
									<span class="text-emerald-800 font-bold">✓</span>
									<span>Single tax invoice issued upon confirmation</span>
								</p>
							</div>

						</div>
					</div>

				</div>
			</form>

		</div>
	</div>
</x-layout>
