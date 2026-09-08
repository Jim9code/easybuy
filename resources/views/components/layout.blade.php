<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title ?? 'EasyBuy — Smart Procurement & Wholesale Sourcing' }}</title>
	
	<!-- Clean High-Impact Google Fonts: Inter (Numbers & UI), Space Grotesk (Body) & Syne (Display Headlines) -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
	
	<!-- GSAP & Three.js for 3D & Animation Storytelling -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/TextPlugin.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>

	@vite(['resources/css/app.css', 'resources/js/app.js'])

	<style>
		body {
			font-family: 'Space Grotesk', sans-serif;
			letter-spacing: -0.015em;
		}
		h1, h2, h3, h4, .font-heading {
			font-family: 'Syne', sans-serif;
			letter-spacing: -0.035em;
		}
		/* Clean, highly readable product titles & standard financial numbers */
		.price-text, .font-price, .font-mono, [data-price], .product-title, .font-product {
			font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
			letter-spacing: -0.02em !important;
		}
		.price-text, .font-price, [data-price] {
			font-feature-settings: 'tnum' 1, 'ss01' 1;
		}
		
		/* Warm Claymorphic Shadows */
		.clay-card {
			background: #F2EAE0;
			border: 1px solid #E0D3C1;
			box-shadow: 
				0 12px 28px -6px rgba(80, 55, 25, 0.08), 
				0 2px 6px rgba(0, 0, 0, 0.02),
				inset 0 2px 4px rgba(255, 255, 255, 0.75),
				inset 0 -2px 3px rgba(180, 160, 130, 0.15);
		}

		.clay-card-hero {
			background: #F2EAE0;
			border: 1px solid #E0D3C1;
			box-shadow: 
				0 20px 40px -12px rgba(80, 55, 25, 0.1),
				0 4px 12px rgba(0, 0, 0, 0.02),
				inset 0 2px 5px rgba(255, 255, 255, 0.8),
				inset 0 -2px 4px rgba(180, 160, 130, 0.2);
		}

		.clay-btn-yellow {
			background: #FFD000;
			color: #191917;
			font-family: 'Space Grotesk', sans-serif;
			font-weight: 700;
			letter-spacing: normal;
			box-shadow: 
				0 8px 20px -4px rgba(255, 208, 0, 0.4),
				inset 0 1px 2px rgba(255, 255, 255, 0.6);
		}
		.clay-btn-yellow:hover {
			background: #F2C200;
			box-shadow: 
				0 12px 24px -4px rgba(255, 208, 0, 0.5),
				inset 0 1px 2px rgba(255, 255, 255, 0.6);
		}

		.clay-btn-orange {
			background: #191917;
			color: #FAF6EE;
			font-family: 'Space Grotesk', sans-serif;
			font-weight: 700;
			letter-spacing: normal;
			box-shadow: 
				0 8px 20px -4px rgba(25, 25, 23, 0.3),
				inset 0 1px 2px rgba(255, 255, 255, 0.2);
		}
		.clay-btn-orange:hover {
			background: #333333;
		}

		.clay-btn-dark {
			background: #191917;
			color: #FAF6EE;
			font-family: 'Space Grotesk', sans-serif;
			font-weight: 700;
			letter-spacing: normal;
			box-shadow: 
				0 8px 20px -4px rgba(25, 25, 23, 0.3),
				inset 0 1px 2px rgba(255, 255, 255, 0.2);
		}
		.clay-btn-dark:hover {
			background: #333333;
		}

		.clay-input {
			background: #E8DECF;
			border: 1px solid #D8C9B5;
			box-shadow: inset 0 2px 4px rgba(60, 40, 20, 0.06);
		}
	</style>
</head>
<body class="bg-[#FAF6EE] font-sans antialiased text-[#191917] selection:bg-[#FFD000]/40 selection:text-[#191917]">
	<!-- Sticky Header -->
	<header class="sticky top-0 z-50 border-b border-[#E0D3C1]/80 bg-[#FAF6EE]/95 backdrop-blur-md transition-all">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="flex h-14 sm:h-16 items-center justify-between gap-4">
				<!-- Brand logo: Circular Sunny Yellow Badge -->
				<a class="flex items-center gap-2.5 group tracking-tight text-[#191917] shrink-0" href="{{ Auth::check() ? url('/home') : url('/') }}">
					<span class="flex h-9 w-9 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] shadow-xs transition-transform group-hover:scale-105 font-black text-2xs sm:text-xs uppercase tracking-tight">
						EB
					</span>
					<span class="font-heading tracking-tight text-lg sm:text-xl font-black text-[#191917]">EASYBUY</span>
				</a>

				<!-- Nav Links: Landing Page vs Buyer Dashboard Workspace -->
				@php
					$isDashboard = Request::is('home*') || Request::is('catalog*') || Request::is('cart*') || Request::is('product*') || Request::is('admin*') || Request::is('supplier*');
				@endphp

				@if(!$isDashboard && !Auth::check())
				<nav class="hidden md:flex items-center gap-6 lg:gap-8 text-xs font-bold text-[#5C5549]" aria-label="Main navigation">
					<a class="transition hover:text-[#191917] whitespace-nowrap" href="{{ url('/catalog') }}">Shop Catalog</a>
					<a class="transition hover:text-[#191917] whitespace-nowrap" href="{{ url('/#simulator') }}">Instant Sourcing</a>
					<a class="transition hover:text-[#191917] whitespace-nowrap" href="{{ url('/#how-it-works') }}">How It Works</a>
					<a class="transition hover:text-[#191917] whitespace-nowrap font-extrabold text-[#191917]" href="{{ url('/supplier') }}">Become a Supplier</a>
				</nav>
				@elseif(Request::is('admin*'))
				<div class="hidden md:flex items-center gap-3">
					<span class="text-3xs font-extrabold uppercase tracking-wider text-[#FAF6EE] bg-[#191917] px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-2xs">
						<span class="h-2 w-2 rounded-full bg-[#FFD000] animate-pulse"></span>
						<span>Admin Console</span>
					</span>
					<a href="{{ url('/catalog') }}" class="text-3xs font-bold uppercase tracking-wider text-[#7A7365] hover:text-[#191917] clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3.5 py-1.5 rounded-full transition flex items-center gap-1">
						<span>View Catalog</span>
						<span>&rarr;</span>
					</a>
				</div>
				@elseif(Request::is('supplier/dashboard*') || Request::is('supplier/status*'))
				<div class="hidden md:flex items-center gap-3">
					<span class="text-3xs font-extrabold uppercase tracking-wider text-[#191917] clay-marshmallow px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-2xs">
						<span class="h-2 w-2 rounded-full bg-emerald-500"></span>
						<span>Supplier Hub</span>
					</span>
					<a href="{{ url('/home') }}" class="text-3xs font-bold uppercase tracking-wider text-[#7A7365] hover:text-[#191917] clay-marshmallow-subtle hover:bg-[#FAF6EE] px-3.5 py-1.5 rounded-full transition flex items-center gap-1">
						<span>Switch to Buyer</span>
						<span>&rarr;</span>
					</a>
				</div>
				@else
				<div class="hidden md:flex items-center gap-3">
					<a href="{{ url('/catalog') }}" class="text-xs font-bold text-[#5C5549] hover:text-[#191917] transition px-3 py-1.5 rounded-xl hover:bg-[#F2EAE0] whitespace-nowrap">
						Catalog
					</a>
					<a href="{{ url('/home') }}" class="text-xs font-bold text-[#5C5549] hover:text-[#191917] transition px-3 py-1.5 rounded-xl hover:bg-[#F2EAE0] whitespace-nowrap">
						Ask Easy AI
					</a>
					@if(Auth::check() && Auth::user()->isAdmin())
					<a href="{{ url('/admin') }}" class="text-3xs font-bold uppercase tracking-wider text-[#FAF6EE] hover:text-[#FAF6EE] bg-[#191917] hover:bg-[#333333] px-3.5 py-1.5 rounded-full transition flex items-center gap-1.5 shadow-xs">
						<span class="h-1.5 w-1.5 rounded-full bg-[#FFD000]"></span>
						<span>Admin Console</span>
					</a>
					@elseif(Auth::check() && Auth::user()->isSupplier())
					<a href="{{ url('/supplier/dashboard') }}" class="text-3xs font-bold uppercase tracking-wider text-[#191917] hover:text-[#191917] bg-[#FAF6EE] hover:bg-[#F2EAE0] px-3.5 py-1.5 rounded-full border border-[#D8C9B5] transition flex items-center gap-1.5">
						<span class="h-1.5 w-1.5 rounded-full bg-[#FFD000]"></span>
						<span>Supplier Hub</span>
					</a>
					@endif
				</div>
				@endif

				<!-- Auth / Cart Controls & Mobile Toggle -->
				<div class="flex items-center gap-2 sm:gap-3 shrink-0">
					<!-- Cart Button -->
					<a href="{{ url('/cart') }}" class="clay-marshmallow-subtle hover:bg-[#FAF6EE] px-2.5 py-1.5 sm:px-3.5 sm:py-2 rounded-xl text-xs font-bold text-[#191917] transition flex items-center gap-1.5 sm:gap-2 cursor-pointer shadow-2xs" aria-label="Shopping Cart">
						<svg class="h-4 w-4 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
						</svg>
						<span class="hidden sm:inline">Cart</span>
						<span id="nav-cart-count" class="h-5 w-5 rounded-full bg-[#191917] text-[#FFD000] text-3xs font-black flex items-center justify-center">0</span>
					</a>

					@auth
						<!-- Desktop Sign Out -->
						<form action="{{ url('/logout') }}" method="POST" class="hidden md:inline">
							@csrf
							<button type="submit" class="rounded-xl px-3 py-1.5 text-xs font-bold text-[#5C5549] hover:text-red-600 transition cursor-pointer">
								Sign Out
							</button>
						</form>
					@else
						<!-- Desktop Auth Buttons -->
						<div class="hidden md:flex items-center gap-2">
							<a class="rounded-xl px-3 py-1.5 text-xs font-bold text-[#5C5549] transition hover:text-[#191917] whitespace-nowrap" href="{{ url('/login') }}">
								Sign In
							</a>
							<a class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-sm cursor-pointer whitespace-nowrap" href="{{ url('/register') }}">
								<span>Get Started</span>
								<span>&rarr;</span>
							</a>
						</div>
					@endauth

					<!-- Mobile Menu Hamburger Button -->
					<button id="mobile-nav-toggle" onclick="toggleMobileMenu(true)" 
						class="md:hidden flex h-9 w-9 items-center justify-center rounded-xl bg-[#F2EAE0] border border-[#D8C9B5] text-[#191917] hover:bg-[#FAF6EE] active:scale-95 transition shadow-2xs cursor-pointer" 
						aria-label="Open navigation menu">
						<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
						</svg>
					</button>
				</div>
			</div>
		</div>
	</header>

	<!-- ==================== MOBILE NAVIGATION DRAWER & BACKDROP ==================== -->
	<div id="mobile-nav-backdrop" onclick="toggleMobileMenu(false)" 
		class="fixed inset-0 z-50 bg-[#191917]/60 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out md:hidden"></div>

	<aside id="mobile-nav-drawer" 
		class="fixed top-0 right-0 z-50 h-full w-[85%] max-w-sm bg-[#FAF6EE] border-l border-[#E0D3C1] shadow-2xl translate-x-full transition-transform duration-300 ease-out flex flex-col justify-between overflow-y-auto md:hidden">
		
		<!-- Top Drawer Header -->
		<div class="p-5 border-b border-[#E0D3C1] flex items-center justify-between">
			<a class="flex items-center gap-2 group tracking-tight text-[#191917]" href="{{ Auth::check() ? url('/home') : url('/') }}" onclick="toggleMobileMenu(false)">
				<span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#FFD000] text-[#191917] font-black text-2xs uppercase">
					EB
				</span>
				<span class="font-heading tracking-tight text-lg font-black text-[#191917]">EASYBUY</span>
			</a>
			<button onclick="toggleMobileMenu(false)" class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#F2EAE0] hover:bg-[#E8DECF] text-[#191917] transition cursor-pointer" aria-label="Close menu">
				<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>

		<!-- Drawer Navigation Body -->
		<div class="p-5 space-y-6 flex-1">
			@auth
				<!-- Authenticated User Profile Summary Pill -->
				<div class="clay-card rounded-2xl p-4 border border-[#D8C9B5] bg-[#F2EAE0]">
					<div class="flex items-center gap-3">
						<div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#191917] text-[#FFD000] font-black text-xs">
							{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
						</div>
						<div class="overflow-hidden">
							<h4 class="text-xs font-bold text-[#191917] truncate">{{ Auth::user()->name ?? 'EasyBuy Member' }}</h4>
							<p class="text-3xs text-[#7A7365] truncate">{{ Auth::user()->email }}</p>
							<div class="mt-1">
								@if(Auth::user()->isAdmin())
									<span class="text-4xs font-black uppercase px-2 py-0.5 rounded-md bg-[#191917] text-[#FFD000]">Admin</span>
								@elseif(Auth::user()->isSupplier())
									<span class="text-4xs font-black uppercase px-2 py-0.5 rounded-md bg-emerald-600 text-white">Supplier</span>
								@else
									<span class="text-4xs font-black uppercase px-2 py-0.5 rounded-md bg-[#D8C9B5] text-[#191917]">Verified Buyer</span>
								@endif
							</div>
						</div>
					</div>
				</div>

				<!-- Navigation Section -->
				<div class="space-y-1">
					<p class="text-4xs font-black uppercase tracking-wider text-[#9C9283] px-3 pb-1">Workspace</p>
					
					<a href="{{ url('/home') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<svg class="h-4 w-4 text-[#FFD000]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
						</svg>
						<span>Ask Easy AI Sourcing</span>
					</a>

					<a href="{{ url('/catalog') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
						</svg>
						<span>Wholesale Catalog</span>
					</a>

					<a href="{{ url('/cart') }}" onclick="toggleMobileMenu(false)" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<div class="flex items-center gap-3">
							<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
							</svg>
							<span>My Cart</span>
						</div>
						<span class="h-5 w-5 rounded-full bg-[#191917] text-[#FFD000] text-3xs font-black flex items-center justify-center" id="mobile-drawer-cart-count">0</span>
					</a>

					@if(Auth::user()->isAdmin())
					<a href="{{ url('/admin') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#FAF6EE] bg-[#191917] hover:bg-[#333333] transition shadow-xs mt-2">
						<span class="h-2 w-2 rounded-full bg-[#FFD000] animate-pulse"></span>
						<span>Admin Console</span>
					</a>
					@endif

					@if(Auth::user()->isSupplier())
					<a href="{{ url('/supplier/dashboard') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] bg-[#FAF6EE] border border-[#D8C9B5] hover:bg-[#F2EAE0] transition mt-2">
						<span class="h-2 w-2 rounded-full bg-emerald-500"></span>
						<span>Supplier Hub</span>
					</a>
					@endif
				</div>
			@else
				<!-- Guest Navigation Links -->
				<div class="space-y-1">
					<p class="text-4xs font-black uppercase tracking-wider text-[#9C9283] px-3 pb-1">Explore</p>
					
					<a href="{{ url('/catalog') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
						</svg>
						<span>Shop Wholesale Catalog</span>
					</a>

					<a href="{{ url('/#simulator') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<svg class="h-4 w-4 text-[#FFD000]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
						</svg>
						<span>Instant AI Sourcing</span>
					</a>

					<a href="{{ url('/#how-it-works') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						<span>How It Works</span>
					</a>

					<a href="{{ url('/#reviews') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
						</svg>
						<span>Wall of Trust</span>
					</a>

					<a href="{{ url('/#faq') }}" onclick="toggleMobileMenu(false)" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						<span>Sourcing FAQ</span>
					</a>

					<a href="{{ url('/cart') }}" onclick="toggleMobileMenu(false)" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#191917] hover:bg-[#F2EAE0] transition">
						<div class="flex items-center gap-3">
							<svg class="h-4 w-4 text-[#7A7365]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
							</svg>
							<span>My Cart</span>
						</div>
						<span class="h-5 w-5 rounded-full bg-[#191917] text-[#FFD000] text-3xs font-black flex items-center justify-center" id="mobile-drawer-cart-count">0</span>
					</a>
				</div>

				<!-- Highlighted Supplier CTA -->
				<div class="pt-2">
					<a href="{{ url('/supplier') }}" onclick="toggleMobileMenu(false)" class="block p-3.5 rounded-2xl bg-[#FFD000] hover:bg-[#F2C200] transition text-[#191917] shadow-xs">
						<div class="flex items-center justify-between">
							<div class="flex items-center gap-2">
								<svg class="h-4 w-4 text-[#191917]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
								</svg>
								<span class="text-xs font-black">Become a Supplier</span>
							</div>
							<span class="text-xs font-black">&rarr;</span>
						</div>
						<p class="text-3xs text-[#191917]/80 mt-1">Direct access to corporate procurement buyers.</p>
					</a>
				</div>

				<!-- Guest Auth Callout Buttons -->
				<div class="space-y-2 pt-2">
					<a href="{{ url('/register') }}" onclick="toggleMobileMenu(false)" class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] rounded-xl py-3 text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm">
						<span>Get Started Free</span>
						<span>&rarr;</span>
					</a>
					<a href="{{ url('/login') }}" onclick="toggleMobileMenu(false)" class="w-full bg-[#F2EAE0] hover:bg-[#E8DECF] text-[#191917] rounded-xl py-2.5 text-xs font-bold transition flex items-center justify-center border border-[#D8C9B5]">
						<span>Sign In to Account</span>
					</a>
				</div>
			@endif
		</div>

		<!-- Drawer Bottom Footer -->
		<div class="p-5 border-t border-[#E0D3C1] bg-[#F2EAE0]/60 space-y-3">
			@auth
				<form action="{{ url('/logout') }}" method="POST">
					@csrf
					<button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#FAF6EE] border border-red-200 text-red-600 hover:bg-red-50 text-xs font-bold transition flex items-center justify-center gap-2 cursor-pointer">
						<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
						</svg>
						<span>Sign Out</span>
					</button>
				</form>
			@endauth

			<div class="flex items-center justify-between text-4xs font-bold text-[#7A7365]">
				<span>✓ Net-30 / Net-60 Verified</span>
				<span>1,400+ Suppliers</span>
			</div>
		</div>
	</aside>

	<main class="min-h-screen">
		{{ $slot }}
	</main>

	<!-- Global EasyBuy Cart & Utility Script -->
	<script>
		// Global Cart State (Fresh real database-synchronized cart)
		const DEFAULT_SAMPLE_ITEMS = [];

		window.EasyBuyCart = {
			items: [],
			init() {
				try {
					const saved = localStorage.getItem('easybuy_cart_items_v2');
					if (saved) {
						this.items = JSON.parse(saved);
					} else {
						this.items = [];
					}
				} catch (e) {
					this.items = [];
				}
				this.syncUI();

				// Automatically sync with server database cart table
				fetch("{{ route('cart.count') }}")
					.then(res => res.json())
					.then(data => {
						if (data && typeof data.count !== 'undefined') {
							if (data.count === 0 && this.items.length > 0) {
								this.items = [];
								this.save();
								this.syncUI();
							}
						}
					})
					.catch(() => {});
			},
			save() {
				try {
					localStorage.setItem('easybuy_cart_items_v2', JSON.stringify(this.items));
				} catch (e) {}
			},
			addItem(product) {
				const existing = this.items.find(i => String(i.id) === String(product.id));
				if (existing) {
					existing.qty += (product.qty || 1);
					if (product.image && !existing.image) existing.image = product.image;
				} else {
					this.items.push({
						id: product.id,
						name: product.name,
						price: parseFloat(product.price),
						qty: product.qty || 1,
						category: product.category || 'General',
						image: product.image || null
					});
				}
				this.save();
				this.syncUI();
				this.showToast(`Added ${product.name} to Cart!`, "{{ url('/cart') }}", "View Cart &rarr;");
			},
			async removeItem(id) {
				this.items = this.items.filter(i => String(i.id) !== String(id));
				this.save();
				this.syncUI();

				try {
					await fetch("{{ url('/cart/remove') }}/" + encodeURIComponent(id), {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}',
							'Accept': 'application/json'
						}
					});
				} catch (e) {}
			},
			async updateQty(id, delta) {
				const item = this.items.find(i => String(i.id) === String(id));
				if (item) {
					item.qty += delta;
					if (item.qty <= 0) {
						this.removeItem(id);
					} else {
						this.save();
						this.syncUI();

						try {
							await fetch("{{ url('/cart/update') }}/" + encodeURIComponent(id), {
								method: 'POST',
								headers: {
									'Content-Type': 'application/json',
									'X-CSRF-TOKEN': '{{ csrf_token() }}',
									'Accept': 'application/json'
								},
								body: JSON.stringify({ quantity: item.qty })
							});
						} catch (e) {}
					}
				}
			},
			async clear() {
				this.items = [];
				this.save();
				this.syncUI();

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
			},
			getTotal() {
				return this.items.reduce((sum, item) => sum + (item.price * item.qty), 0);
			},
			getCount() {
				return this.items.reduce((sum, item) => sum + item.qty, 0);
			},
			syncUI() {
				const totalCount = this.getCount();
				const navBadge = document.getElementById('nav-cart-count');
				const sidebarBadge = document.getElementById('sidebar-cart-count');
				const drawerBadge = document.getElementById('mobile-drawer-cart-count');

				if (navBadge) navBadge.innerText = totalCount;
				if (sidebarBadge) sidebarBadge.innerText = totalCount;
				if (drawerBadge) drawerBadge.innerText = totalCount;

				// If on dedicated Cart page, trigger re-render
				if (typeof window.renderCartPage === 'function') {
					window.renderCartPage();
				}
			},
			showToast(msg, actionUrl = "{{ url('/cart') }}", actionText = "View Cart &rarr;") {
				const toast = document.createElement('div');
				toast.className = 'fixed bottom-6 right-6 z-50 bg-[#191917] text-[#FAF6EE] px-4 py-3 rounded-2xl shadow-2xl text-xs font-bold flex items-center gap-3 border border-[#FFD000]/40 animate-fade-in select-none';
				toast.innerHTML = `
					<svg class="h-4 w-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
						<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
					</svg>
					<span class="max-w-xs truncate">${msg}</span>
					${actionUrl ? `<a href="${actionUrl}" class="ml-2 px-2.5 py-1 rounded-lg bg-[#FFD000] text-[#191917] font-black text-3xs uppercase tracking-wider hover:bg-[#F2C200] transition shrink-0">${actionText}</a>` : ''}
				`;
				document.body.appendChild(toast);
				setTimeout(() => {
					toast.style.opacity = '0';
					toast.style.transition = 'opacity 0.3s ease';
					setTimeout(() => toast.remove(), 300);
				}, 3500);
			}
		};

		// Persistent Standing Orders & Monthly Auto-Dispatch Controller
		window.EasyBuyStandingOrders = {
			orders: [],
			init() {
				try {
					const saved = localStorage.getItem('easybuy_standing_orders_v1');
					this.orders = saved ? JSON.parse(saved) : [];
				} catch(e) {
					this.orders = [];
				}
			},
			save() {
				try {
					localStorage.setItem('easybuy_standing_orders_v1', JSON.stringify(this.orders));
				} catch(e) {}
			},
			getAll() {
				return this.orders;
			},
			add(orderData) {
				const id = 'STO-' + Math.floor(100000 + Math.random() * 900000);
				const nextDate = new Date();
				nextDate.setDate(nextDate.getDate() + 30);
				const formattedNextDate = nextDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

				const newOrder = {
					id: id,
					title: orderData.title || 'Monthly Workspace Restock',
					frequency: orderData.frequency || 'Monthly (Every 30 Days)',
					nextDelivery: formattedNextDate,
					total: orderData.total || '$0.00',
					savings: orderData.savings || 'Wholesale Applied',
					items: orderData.items || [],
					status: 'Active',
					createdAt: new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
				};

				this.orders.unshift(newOrder);
				this.save();
				return newOrder;
			},
			togglePause(id) {
				const ord = this.orders.find(o => o.id === id);
				if (ord) {
					ord.status = ord.status === 'Active' ? 'Paused' : 'Active';
					this.save();
				}
			},
			cancel(id) {
				this.orders = this.orders.filter(o => o.id !== id);
				this.save();
			}
		};
		window.EasyBuyStandingOrders.init();

		// Mobile Navigation Drawer Controller
		function toggleMobileMenu(open) {
			const backdrop = document.getElementById('mobile-nav-backdrop');
			const drawer = document.getElementById('mobile-nav-drawer');
			if (!backdrop || !drawer) return;

			if (open) {
				backdrop.classList.remove('opacity-0', 'pointer-events-none');
				backdrop.classList.add('opacity-100', 'pointer-events-auto');
				drawer.classList.remove('translate-x-full');
				document.body.style.overflow = 'hidden';
			} else {
				backdrop.classList.remove('opacity-100', 'pointer-events-auto');
				backdrop.classList.add('opacity-0', 'pointer-events-none');
				drawer.classList.add('translate-x-full');
				document.body.style.overflow = '';
			}
		}

		// Close mobile drawer on Escape key
		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape') {
				toggleMobileMenu(false);
			}
		});

		// Fallback for any legacy navigation callers
		function toggleCartDrawer(open) {
			if (open) {
				window.location.href = "{{ url('/cart') }}";
			}
		}

		function toggleSupplierModal(open) {
			if (open) {
				window.location.href = "{{ url('/supplier') }}";
			}
		}

		document.addEventListener('DOMContentLoaded', () => {
			EasyBuyCart.init();

			@if(session('error'))
				EasyBuyCart.showToast("{{ addslashes(session('error')) }}", null, "");
			@endif
			@if(session('info'))
				EasyBuyCart.showToast("{{ addslashes(session('info')) }}", null, "");
			@endif
			@if(session('success'))
				EasyBuyCart.showToast("{{ addslashes(session('success')) }}", null, "");
			@endif
		});
	</script>
</body>
</html>
