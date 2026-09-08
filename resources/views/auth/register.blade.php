<x-layout>
	<div class="flex min-h-[80vh] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
		<div class="w-full max-w-md space-y-8">
			<!-- Header -->
			<div class="text-center">
				<span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FFD000] text-[#191917] shadow-xs">
					<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
					</svg>
				</span>
				<h2 class="mt-6 text-3xl font-extrabold tracking-tight text-[#191917] font-heading">Create your account</h2>
				<p class="mt-2 text-sm text-[#5C5549]">
					Join EasyBuy today and discover smarter wholesale procurement.
				</p>
			</div>

			<!-- Card Container -->
			<div class="clay-card rounded-3xl p-8 shadow-sm">

				@if(request('prompt'))
					<div class="mb-5 rounded-2xl bg-[#FFF9E6] border border-[#FFD000] p-4 text-xs text-[#191917] flex items-start gap-3 shadow-2xs">
						<span class="h-6 w-6 rounded-lg bg-[#FFD000] text-[#191917] flex items-center justify-center shrink-0 font-black text-xs">✨</span>
						<div class="space-y-0.5">
							<p class="font-bold">Your procurement list is saved!</p>
							<p class="text-3xs text-[#7A7365] italic line-clamp-2">"{{ request('prompt') }}"</p>
							<p class="text-3xs text-[#191917] font-semibold pt-1">Create your account to finalize your instant AI quote.</p>
						</div>
					</div>
				@endif

				<form class="space-y-5" action="{{ url('/register') }}" method="POST">
					@if(request('prompt'))
						<input type="hidden" name="pending_prompt" value="{{ request('prompt') }}">
					@endif

					@if ($errors->any())
	                 	<div class="mb-4 rounded-xl bg-red-50 p-4 border border-red-100 text-xs text-red-600 font-semibold">
	                 		<ul class="list-disc pl-4 space-y-1">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
	                 	</div>
					@endif

					@csrf
					<!-- Username Field -->
					<div>
						<label for="username" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Username</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
								</svg>
							</div>
							<input type="text" name="username" id="username" required autocomplete="username" placeholder="johndoe"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition duration-200" />
						</div>
					</div>

					<!-- Email Field -->
					<div>
						<label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Email Address</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
								</svg>
							</div>
							<input type="email" name="email" id="email" required autocomplete="email" placeholder="you@example.com"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition duration-200" />
						</div>
					</div>

					<!-- Password Field -->
					<div>
						<label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Password</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
								</svg>
							</div>
							<input type="password" name="password" id="password" required autocomplete="new-password" placeholder="••••••••"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition duration-200" />
						</div>
					</div>

					<!-- Confirm Password Field -->
					<div>
						<label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Confirm Password</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
								</svg>
							</div>
							<input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition duration-200" />
						</div>
					</div>

					<!-- Terms Checkbox -->
					<div class="flex items-center">
						<input id="terms" name="terms" type="checkbox" required
							class="h-4 w-4 rounded border-[#D8C9B5] text-[#191917] focus:ring-[#FFD000] accent-[#191917]" />
						<label for="terms" class="ml-2 block text-xs text-[#5C5549] font-medium">
							I agree to the <a href="#" class="font-bold text-[#191917] hover:underline">Terms of Service</a> and <a href="#" class="font-bold text-[#191917] hover:underline">Privacy Policy</a>
						</label>
					</div>

					<!-- Submit Button -->
					<button type="submit"
						class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold transition duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-sm cursor-pointer">
						Create Account
					</button>
				</form>

				<div class="mt-6 border-t border-[#E0D3C1] pt-6 text-center">
					<p class="text-xs text-[#5C5549]">
						Already have an account?
						<a href="{{ url('/login') }}{{ request('prompt') ? '?prompt=' . urlencode(request('prompt')) : '' }}" class="font-bold text-[#191917] hover:underline decoration-[#FFD000] decoration-2">Sign in instead</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</x-layout>
