<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title ?? 'EasyBuy' }}</title>
	
	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
	
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#faf8f5] font-sans antialiased text-[#1b1b18] selection:bg-[#1f5fd8]/10 selection:text-[#1f5fd8]">
	<header class="sticky top-0 z-50 border-b border-[#e8dfd3] bg-white/80 backdrop-blur-md">
		<div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
			<div class="flex h-16 items-center justify-between">
				<!-- Brand logo -->
				<a class="flex items-center gap-2 group text-xl font-bold tracking-tight text-[#1b1b18] transition hover:opacity-90" href="{{ url('/') }}">
					<span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-[#1f5fd8] to-[#4f8eff] text-white shadow-md shadow-[#1f5fd8]/20 transition-transform group-hover:scale-105">
						<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
						</svg>
					</span>
					<span>Easy<span class="text-[#1f5fd8]">Buy</span></span>
				</a>

				<!-- Nav Links -->
				<nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-[#4b4b4b]" aria-label="Main navigation">
					<a class="transition hover:text-[#1b1b18]" href="#features">Features</a>
					<a class="transition hover:text-[#1b1b18]" href="#products">Categories</a>
					<a class="transition hover:text-[#1b1b18]" href="#deals">Deals</a>
				</nav>

				<!-- Auth Buttons -->
				<div class="flex items-center gap-3">
					<a class="rounded-xl px-4 py-2 text-sm font-semibold text-[#4b4b4b] transition hover:bg-[#faf8f5] hover:text-[#1b1b18]" href="#">Sign In</a>
					<a class="rounded-xl bg-[#1b1b18] px-4 py-2 text-sm font-semibold text-white transition hover:bg-neutral-800 shadow-sm" href="#">Sign Up</a>
				</div>
			</div>
		</div>
	</header>

	<main class="min-h-screen py-8">
		{{ $slot }}
	</main>

	<footer class="border-t border-[#e8dfd3] bg-white py-12 text-sm text-[#666666]">
		<div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
			<div class="grid gap-8 md:grid-cols-4">
				<div class="space-y-4">
					<div class="flex items-center gap-2 text-base font-bold text-[#1b1b18]">
						<span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#1f5fd8] text-white font-black text-xs">E</span>
						<span>EasyBuy</span>
					</div>
					<p class="text-xs leading-relaxed">
						Making commerce simple, elegant, and secure for everyone, everywhere.
					</p>
				</div>
				<div>
					<h4 class="font-semibold text-[#1b1b18] mb-3">Shop</h4>
					<ul class="space-y-2 text-xs">
						<li><a href="#products" class="hover:text-[#1b1b18] transition">All Products</a></li>
						<li><a href="#deals" class="hover:text-[#1b1b18] transition">Featured Bundles</a></li>
						<li><a href="#deals" class="hover:text-[#1b1b18] transition">Weekly Deals</a></li>
					</ul>
				</div>
				<div>
					<h4 class="font-semibold text-[#1b1b18] mb-3">Company</h4>
					<ul class="space-y-2 text-xs">
						<li><a href="#" class="hover:text-[#1b1b18] transition">About Us</a></li>
						<li><a href="#" class="hover:text-[#1b1b18] transition">Careers</a></li>
						<li><a href="#" class="hover:text-[#1b1b18] transition">Privacy Policy</a></li>
					</ul>
				</div>
				<div>
					<h4 class="font-semibold text-[#1b1b18] mb-3">Support</h4>
					<ul class="space-y-2 text-xs">
						<li><a href="#" class="hover:text-[#1b1b18] transition">Help Center</a></li>
						<li><a href="#" class="hover:text-[#1b1b18] transition">Shipping & Returns</a></li>
						<li><a href="#" class="hover:text-[#1b1b18] transition">Contact Support</a></li>
					</ul>
				</div>
			</div>
			<div class="mt-8 border-t border-[#f4eee6] pt-8 text-center text-xs">
				<p>&copy; {{ date('Y') }} EasyBuy Inc. All rights reserved.</p>
			</div>
		</div>
	</footer>
</body>
</html>
