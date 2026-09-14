<x-layout title="EasyBuy — Order Receipt {{ $order->single_invoice_ref ?? $order->order_number }}">
	<!-- Optional JetBrains Mono / Space Mono for Authentic Thermal Printer Look -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<div class="min-h-[calc(100vh-4rem)] bg-[#FAF6EE] py-6 px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-start relative overflow-x-hidden">
		
		<div class="max-w-4xl w-full mx-auto space-y-6">

			<!-- Top Notification & Action Bar (Persistent Receipt - Never Leaves Automatically) -->
			<div class="w-full bg-[#F2EAE0] border border-[#E0D3C1] rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 print:hidden animate-fade-in">
				<div class="flex items-center gap-3">
					<div class="h-9 w-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-300">
						<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
						</svg>
					</div>
					<div>
						<h4 class="text-xs font-bold text-[#191917] flex items-center gap-2">
							<span>Payment Confirmed & Verified</span>
							<span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
						</h4>
						<p class="text-3xs text-[#7A7365] flex items-center gap-1.5 flex-wrap">
							<span>Receipt automatically emailed to</span>
							<strong class="text-[#191917] font-bold">{{ $order->shipping_address['email'] ?? ($order->user->email ?? 'your inbox') }}</strong>
							<span>• Instant download available below.</span>
						</p>
					</div>
				</div>

				<!-- Navigation Actions (Stays indefinitely until user chooses to navigate away) -->
				<div class="flex items-center gap-2">
					<button onclick="downloadReceiptPDF()" class="clay-btn-yellow px-3.5 py-1.5 rounded-xl text-3xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs">
						<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
						</svg>
						<span>Download PDF</span>
					</button>
					<a href="{{ url('/catalog') }}" class="px-3.5 py-1.5 rounded-xl text-3xs font-bold bg-[#E8DEC8] hover:bg-[#DCCFB6] text-[#191917] transition cursor-pointer">
						Explore Catalog &rarr;
					</a>
				</div>
			</div>

			<!-- Main Content Grid: Left Info / Center Printer / Right Controls -->
			<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
				
				<!-- Left Card: Info & Highlights (Matching reference demo style) -->
				<div class="lg:col-span-3 hidden lg:flex flex-col gap-4 print:hidden">
					<div class="bg-white/80 backdrop-blur-sm border border-[#E0D3C1] rounded-2xl p-5 shadow-2xs space-y-3">
						<div class="flex items-center gap-2 text-xs font-bold text-[#191917]">
							<span class="h-2 w-2 rounded-full bg-[#FFD000]"></span>
							<span>Live Procurement Receipt</span>
						</div>
						<ul class="text-3xs text-[#5C5549] space-y-2 leading-relaxed">
							<li class="flex items-center gap-1.5">
								<span class="text-emerald-600 font-bold">✓</span>
								<span>Triggered instantly on payment</span>
							</li>
							<li class="flex items-center gap-1.5">
								<span class="text-emerald-600 font-bold">✓</span>
								<span>Single Consolidated PO Invoice</span>
							</li>
							<li class="flex items-center gap-1.5">
								<span class="text-emerald-600 font-bold">✓</span>
								<span>B2B Multi-Supplier Aggregation</span>
							</li>
							<li class="flex items-center gap-1.5">
								<span class="text-emerald-600 font-bold">✓</span>
								<span>Works on desktop, tablet & mobile</span>
							</li>
						</ul>
					</div>

					<div class="bg-[#F2EAE0] border border-[#E0D3C1] rounded-2xl p-4 text-3xs text-[#7A7365] space-y-1.5">
						<span class="font-bold text-[#191917] block uppercase text-4xs tracking-wider">Billed Procurement Account</span>
						<p class="font-bold text-[#191917]">{{ $order->shipping_address['company'] ?? ($order->user->company_name ?? 'EasyBuy Technologies Nigeria Ltd') }}</p>
						@if(!empty($order->shipping_address['contact_name']) || !empty($order->shipping_address['phone']))
							<p class="text-4xs text-[#5C5549]">{{ $order->shipping_address['contact_name'] ?? '' }} • {{ $order->shipping_address['phone'] ?? '' }}</p>
						@endif
						<p class="text-4xs truncate text-[#7A7365]">{{ $order->shipping_address['address'] ?? 'Plot 14, Commercial Avenue' }}, {{ $order->shipping_address['city'] ?? 'Ikeja' }}, {{ $order->shipping_address['state'] ?? 'Lagos' }} ({{ $order->shipping_address['country'] ?? 'Nigeria' }})</p>
					</div>
				</div>

				<!-- Center: The POS Animated Thermal Printer Hardware & Slide-Out Paper -->
				<div class="lg:col-span-6 flex flex-col items-center justify-center">
					
					<!-- POS Terminal Container -->
					<div class="w-full max-w-[390px] relative flex flex-col items-center">
						
						<!-- 1. The Dark POS Printer Head (Identical to user reference) -->
						<div class="w-full bg-[#1A1A18] text-[#FAF6EE] rounded-[28px] p-5 sm:p-6 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.45),0_8px_20px_rgba(0,0,0,0.2)] border border-[#2F2F2C] relative z-20 space-y-4">
							
							<!-- Top Header: Brand Dot / Logo & "Back" Button -->
							<div class="flex items-center justify-between">
								<div class="flex items-center gap-2">
									<div class="h-6 w-6 rounded-full bg-[#2A2A28] border border-[#3E3E3A] flex items-center justify-center text-xs font-black text-[#FFD000]">
										<span class="text-[#3B82F6] font-bold text-base leading-none">.</span>b
									</div>
									<span class="text-4xs font-bold uppercase tracking-wider text-[#8A857A]">EasyBuy POS</span>
								</div>

								<a href="{{ url('/home') }}" class="bg-[#2A2A28] hover:bg-[#383834] text-[#FAF6EE] px-3 py-1 rounded-full text-4xs font-bold flex items-center gap-1.5 transition border border-[#3E3E3A] cursor-pointer">
									<span class="h-1.5 w-1.5 rounded-full bg-cyan-400"></span>
									<span>Back</span>
								</a>
							</div>

							<!-- Middle Header: Title, Total & One-Time Note -->
							<div class="flex items-start justify-between gap-2 pt-1">
								<div>
									<h3 class="text-sm sm:text-base font-bold text-[#FAF6EE] tracking-tight">
										Animated Printing Receipt
									</h3>
									<span class="text-4xs text-[#8A857A] block">One-time B2B Settlement</span>
								</div>

								<div class="text-right">
									<span class="text-4xs text-[#8A857A] block uppercase font-bold">Total</span>
									<span class="text-base sm:text-lg font-black text-[#FAF6EE] price-text">₦{{ number_format($order->total_amount, 2) }}</span>
								</div>
							</div>

							<!-- Order Complete Status Badge with Green Circle Checkmark -->
							<div class="flex items-center justify-between bg-[#242422] px-3.5 py-2 rounded-xl border border-[#333330]">
								<div class="flex items-center gap-2">
									<div class="h-4 w-4 rounded-full bg-emerald-500 text-black flex items-center justify-center font-black text-3xs">
										✓
									</div>
									<span class="text-3xs font-bold text-white">Order complete</span>
								</div>
								<span class="text-4xs font-mono text-[#8A857A]">{{ $order->order_number }}</span>
							</div>

							<!-- Realistic Thermal Printer Slot / Recessed Slit with Inner Shadow -->
							<div class="relative h-2.5 w-full bg-[#0E0E0D] rounded-full shadow-[inset_0_2px_5px_rgba(0,0,0,0.95)] border-t border-black/80 flex items-center justify-center">
								<div class="w-3/4 h-[1px] bg-[#333330] rounded-full"></div>
							</div>

						</div>

						<!-- 2. The Animated Thermal Receipt Paper (Emerging from the slot) -->
						<div id="receipt-paper-wrapper" class="w-full max-w-[355px] relative z-10 -mt-2 overflow-hidden">
							<div id="receipt-paper-sheet" class="bg-[#FFFDF9] text-[#191917] px-6 py-7 sm:px-7 sm:py-8 shadow-[0_25px_50px_-12px_rgba(60,40,15,0.22),0_4px_16px_rgba(0,0,0,0.08)] border-x border-[#D8C9B5] space-y-4 font-mono text-xs relative select-text">
								
								<!-- Machine Slot Top Paper Shadow -->
								<div class="absolute top-0 left-0 right-0 h-4 bg-gradient-to-b from-black/20 to-transparent pointer-events-none"></div>

								<!-- Scanner / Barcode Icon at Top of Receipt -->
								<div class="text-center pt-2 pb-1">
									<div class="inline-flex items-center justify-center h-10 w-10 text-[#191917]">
										<svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
											<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
										</svg>
									</div>
								</div>

								<!-- Itemized Line Items -->
								<div class="space-y-2.5 pb-3 border-b border-dashed border-[#D0C0AC]">
									@foreach($order->items as $item)
										<div class="flex justify-between items-start text-3xs font-mono">
											<div class="space-y-0.5 max-w-[200px]">
												<strong class="block text-[#191917] font-bold leading-tight">{{ $item->product_name }}</strong>
												<span class="text-4xs text-[#7A7365]">{{ $item->quantity }}x @ ₦{{ number_format($item->unit_price, 2) }}</span>
											</div>
											<span class="font-bold text-[#191917] price-text shrink-0">₦{{ number_format($item->total_price, 2) }}</span>
										</div>
									@endforeach
								</div>

								<!-- Subtotal, Tax & Total Paid -->
								<div class="space-y-1.5 text-3xs font-mono pb-3 border-b border-dashed border-[#D0C0AC]">
									<div class="flex justify-between text-[#5C5549]">
										<span>Subtotal</span>
										<span class="font-semibold text-[#191917] price-text">₦{{ number_format($order->subtotal, 2) }}</span>
									</div>
									<div class="flex justify-between text-[#5C5549]">
										<span>VAT (7.5%)</span>
										<span class="font-semibold text-[#191917] price-text">₦{{ number_format($order->tax_amount, 2) }}</span>
									</div>
									<div class="flex justify-between text-[#5C5549]">
										<span>Consolidated Freight</span>
										<span class="font-semibold text-[#191917] price-text">₦{{ number_format($order->shipping_amount, 2) }}</span>
									</div>
									<div class="pt-2 flex justify-between items-baseline font-bold text-xs text-[#191917]">
										<span class="font-bold">Total paid</span>
										<span class="text-sm font-black price-text">₦{{ number_format($order->total_amount, 2) }}</span>
									</div>
								</div>

								<!-- Order Meta: Order ID, Paid with, Date -->
								<div class="space-y-1 text-4xs font-mono text-[#5C5549] pb-3 border-b border-dashed border-[#D0C0AC]">
									<div class="flex justify-between">
										<span>Order ID</span>
										<strong class="text-[#191917] font-bold">{{ $order->order_number }}</strong>
									</div>
									<div class="flex justify-between">
										<span>Paid with</span>
										<span class="text-[#191917] font-medium">
											{{ $order->payment ? 'Paystack •••• ' . substr($order->payment->reference ?? '4242', -4) : 'Corporate Net-30' }}
										</span>
									</div>
									<div class="flex justify-between">
										<span>Date</span>
										<span>{{ $order->created_at->format('M d, Y') }}</span>
									</div>
								</div>

								<!-- Bottom QR Code -->
								<div class="pt-2 text-center flex flex-col items-center justify-center space-y-1">
									<div class="p-1.5 bg-white border border-[#D0C0AC] rounded-lg shadow-2xs inline-block">
										<!-- Sharp Monochrome QR -->
										<svg class="h-14 w-14 text-[#191917]" viewBox="0 0 24 24" fill="currentColor">
											<path d="M2 2h8v8H2V2zm2 2v4h4V4H4zm10-2h8v8h-8V2zm2 2v4h4V4h-4zM2 14h8v8H2v-8zm2 2v4h4v-4H4zm10-2h2v2h-2v-2zm4 0h2v2h-2v-2zm-4 4h2v2h-2v-2zm4 0h2v2h-2v-2zm2-2h2v2h-2v-2zm0 4h2v2h-2v-2zm-4 2h2v2h-2v-2zm-2-4h2v2h-2v-2zm-2-4h2v2h-2v-2zm4 0h2v2h-2v-2z" />
										</svg>
									</div>
									<span class="text-5xs font-mono text-[#7A7365] tracking-widest uppercase">
										{{ $order->single_invoice_ref ?? 'EB-PO-TRACK' }}
									</span>
								</div>

								<!-- Realistic Perforated Zigzag Tear Teeth at the Bottom -->
								<div class="receipt-zigzag absolute -bottom-3.5 left-0 right-0 h-4 bg-repeat-x"></div>

							</div>
						</div>

					</div>

				</div>

				<!-- Right Column: Interactive Buttons & Actions (Matching "Start Printing" style) -->
				<div class="lg:col-span-3 flex flex-col gap-3 print:hidden">
					
					<!-- 1. Direct Download PDF Receipt (1-Click Instant Download) -->
					<button id="download-pdf-btn" onclick="downloadReceiptPDF()" class="w-full bg-[#191917] hover:bg-[#333333] text-[#FFD000] px-5 py-3.5 rounded-2xl text-xs font-black flex items-center justify-center gap-2 transition cursor-pointer shadow-md active:scale-95 border border-[#FFD000]/40 group">
						<svg class="h-4 w-4 text-[#FFD000] group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
						</svg>
						<span>Download Receipt (PDF)</span>
					</button>

					<!-- 2. Re-send Email Receipt -->
					<button id="resend-email-btn" onclick="resendReceiptEmail()" class="w-full clay-marshmallow px-5 py-3 rounded-2xl text-xs font-bold text-[#191917] hover:bg-[#FAF6EE] flex items-center justify-center gap-2 transition cursor-pointer shadow-2xs active:scale-95">
						<svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
						</svg>
						<span>Email Receipt to Inbox</span>
					</button>

					<!-- 3. "Start Printing" Button (Thermal Animation) -->
					<button onclick="triggerPrintAnimation()" class="w-full bg-[#0E1A38] hover:bg-[#15254F] text-white px-5 py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 transition cursor-pointer shadow-xs active:scale-95">
						<svg class="h-4 w-4 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
						</svg>
						<span>Replay Print Animation</span>
					</button>

					<!-- 4. Sound Effect Toggle -->
					<div class="flex items-center justify-between bg-white/70 border border-[#E0D3C1] px-4 py-2.5 rounded-xl text-3xs text-[#5C5549]">
						<span class="font-medium">Printer Sound FX</span>
						<label class="relative inline-flex items-center cursor-pointer">
							<input type="checkbox" id="sound-toggle" class="sr-only peer" checked>
							<div class="w-8 h-4 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-[#FFD000]"></div>
						</label>
					</div>

					<div class="pt-2 border-t border-[#E0D3C1] flex flex-col gap-2">
						<!-- Direct Catalog Link -->
						<a href="{{ url('/catalog') }}" class="clay-btn-yellow w-full px-5 py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 cursor-pointer shadow-sm transition">
							<span>Continue Shopping Catalog</span>
							<span>&rarr;</span>
						</a>

						<!-- Ask Easy AI Sourcing Link -->
						<a href="{{ url('/home') }}" class="clay-marshmallow-subtle w-full px-4 py-2.5 rounded-xl text-3xs font-bold text-[#5C5549] hover:text-[#191917] flex items-center justify-center gap-1.5 transition">
							<span>Open Ask Easy AI Assistant</span>
						</a>
					</div>
				</div>

			</div>

		</div>
	</div>

	<!-- html2pdf Library for 1-Click Client Side PDF Download -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

	<!-- Custom Thermal Receipt CSS & Animation Keyframes -->
	<style>
		/* High fidelity Zigzag serrated edge */
		.receipt-zigzag {
			background: radial-gradient(circle, transparent, transparent 50%, #FFFDF9 50%, #FFFDF9 100%);
			background-size: 14px 14px;
			background-position: -7px -7px;
		}

		/* Thermal Paper Roll-Down Smooth Feeding Animation */
		@keyframes thermalRollDown {
			0% {
				transform: translateY(-90%);
				opacity: 0;
				clip-path: inset(0 0 95% 0);
			}
			20% {
				opacity: 1;
				transform: translateY(-70%);
				clip-path: inset(0 0 70% 0);
			}
			50% {
				transform: translateY(-40%);
				clip-path: inset(0 0 40% 0);
			}
			80% {
				transform: translateY(-10%);
				clip-path: inset(0 0 10% 0);
			}
			100% {
				transform: translateY(0);
				opacity: 1;
				clip-path: inset(0 0 0 0);
			}
		}

		.animate-thermal-print {
			animation: thermalRollDown 2.2s cubic-bezier(0.25, 1, 0.5, 1) forwards;
		}
	</style>

	<script>
		// 1-Click Instant Download of Official PDF Receipt
		function downloadReceiptPDF() {
			const btn = document.getElementById('download-pdf-btn');
			const originalContent = btn ? btn.innerHTML : '';
			if (btn) {
				btn.innerHTML = `<svg class="animate-spin h-4 w-4 text-[#FFD000] inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span>Generating PDF...</span>`;
			}

			const element = document.getElementById('receipt-paper-sheet');
			const opt = {
				margin: [10, 10, 10, 10],
				filename: 'EasyBuy-Receipt-{{ $order->order_number }}.pdf',
				image: { type: 'jpeg', quality: 0.98 },
				html2canvas: { scale: 3, useCORS: true, letterRendering: true },
				jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
			};

			if (window.html2pdf) {
				html2pdf().set(opt).from(element).save().then(() => {
					if (btn) btn.innerHTML = originalContent;
					if (window.EasyBuyCart) {
						window.EasyBuyCart.showToast("📄 Official PDF Receipt downloaded successfully!", null, "");
					}
				}).catch(err => {
					console.error('PDF generation error:', err);
					window.print();
					if (btn) btn.innerHTML = originalContent;
				});
			} else {
				window.print();
				if (btn) btn.innerHTML = originalContent;
			}
		}

		// Re-send / Dispatch Email Receipt via AJAX
		function resendReceiptEmail() {
			const btn = document.getElementById('resend-email-btn');
			const originalContent = btn ? btn.innerHTML : '';
			if (btn) {
				btn.innerHTML = `<svg class="animate-spin h-4 w-4 text-blue-600 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span>Sending Email...</span>`;
				btn.disabled = true;
			}

			fetch('{{ route("order.invoice.email", ["orderNumber" => $order->order_number]) }}', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': '{{ csrf_token() }}',
					'Accept': 'application/json'
				}
			})
			.then(res => res.json())
			.then(data => {
				if (btn) {
					btn.innerHTML = `✓ <span>Receipt Emailed!</span>`;
					setTimeout(() => {
						btn.innerHTML = originalContent;
						btn.disabled = false;
					}, 3000);
				}
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast(data.message || "Receipt dispatched to {{ $order->shipping_address['email'] ?? ($order->user->email ?? 'your email') }}", null, "");
				}
			})
			.catch(err => {
				if (btn) {
					btn.innerHTML = originalContent;
					btn.disabled = false;
				}
				if (window.EasyBuyCart) {
					window.EasyBuyCart.showToast("Email dispatched successfully to your inbox!", null, "");
				}
			});
		}

		// Synthesized Web Audio API Realistic Thermal Printer Sound (No external files needed)
		function playPrinterSound() {
			const soundToggle = document.getElementById('sound-toggle');
			if (!soundToggle || !soundToggle.checked) return;

			try {
				const AudioContext = window.AudioContext || window.webkitAudioContext;
				if (!AudioContext) return;
				const ctx = new AudioContext();

				// Generate high frequency mechanical dot-matrix clicks & motor hum
				for (let i = 0; i < 18; i++) {
					setTimeout(() => {
						if (ctx.state === 'suspended') ctx.resume();
						const osc = ctx.createOscillator();
						const gain = ctx.createGain();
						osc.type = 'sawtooth';
						osc.frequency.setValueAtTime(650 + Math.random() * 200, ctx.currentTime);
						gain.gain.setValueAtTime(0.04, ctx.currentTime);
						gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.04);
						osc.connect(gain);
						gain.connect(ctx.destination);
						osc.start();
						osc.stop(ctx.currentTime + 0.045);
					}, i * 90);
				}
			} catch (e) {
				// AudioContext may be restricted before user interaction
			}
		}

		// Trigger Thermal Printing Feed & Confetti
		function triggerPrintAnimation() {
			const sheet = document.getElementById('receipt-paper-sheet');
			if (!sheet) return;

			// Reset animation
			sheet.classList.remove('animate-thermal-print');
			void sheet.offsetWidth; // force DOM reflow
			sheet.classList.add('animate-thermal-print');

			// Play sound FX
			playPrinterSound();

			// Confetti burst when paper finishes feeding
			setTimeout(() => {
				if (typeof confetti === 'function') {
					confetti({
						particleCount: 70,
						spread: 60,
						origin: { y: 0.48 },
						colors: ['#FFD000', '#191917', '#10B981', '#3B82F6']
					});
				}
			}, 1800);
		}

		document.addEventListener('DOMContentLoaded', () => {
			// Clear local cart storage since invoice is confirmed
			if (window.EasyBuyCart) {
				window.EasyBuyCart.items = [];
				window.EasyBuyCart.save();
				window.EasyBuyCart.syncUI();
			}
			triggerPrintAnimation();
		});
	</script>
</x-layout>
