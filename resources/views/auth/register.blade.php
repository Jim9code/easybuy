<x-layout>
	<div class="flex min-h-[80vh] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
		<div class="w-full max-w-md space-y-8">
			<!-- Header -->
			<div class="text-center">
				<span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-[#1f5fd8] to-[#4f8eff] text-white shadow-md shadow-[#1f5fd8]/20">
					<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
					</svg>
				</span>
				<h2 class="mt-6 text-3xl font-extrabold tracking-tight text-[#1b1b18]">Create your account</h2>
				<p class="mt-2 text-sm text-[#666666]">
					Join EasyBuy today and discover smarter shopping.
				</p>
			</div>

			<!-- Card Container -->
			<div class="rounded-3xl border border-[#eadfce] bg-white p-8 shadow-sm">

				<form class="space-y-5" action="{{ url('/register') }}" method="POST">
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
						<label for="username" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Username</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
								</svg>
							</div>
							<input type="text" name="username" id="username" required autocomplete="username" placeholder="johndoe"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] placeholder-[#a39e96] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition duration-200" />
						</div>
					</div>

					<!-- Email Field -->
					<div>
						<label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Email Address</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
								</svg>
							</div>
							<input type="email" name="email" id="email" required autocomplete="email" placeholder="you@example.com"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] placeholder-[#a39e96] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition duration-200" />
						</div>
					</div>

					<!-- Password Field -->
					<div>
						<label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Password</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
								</svg>
							</div>
							<input type="password" name="password" id="password" required autocomplete="new-password" placeholder="••••••••"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] placeholder-[#a39e96] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition duration-200" />
						</div>
					</div>

					<!-- Confirm Password Field -->
					<div>
						<label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Confirm Password</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
								</svg>
							</div>
							<input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] placeholder-[#a39e96] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition duration-200" />
						</div>
					</div>

					<!-- Terms Checkbox -->
					<div class="flex items-center">
						<input id="terms" name="terms" type="checkbox" required
							class="h-4 w-4 rounded border-[#d7d0c8] text-[#1f5fd8] focus:ring-[#1f5fd8] accent-[#1f5fd8]" />
						<label for="terms" class="ml-2 block text-xs text-[#555]">
							I agree to the <a href="#" class="font-semibold text-[#1f5fd8] hover:underline">Terms of Service</a> and <a href="#" class="font-semibold text-[#1f5fd8] hover:underline">Privacy Policy</a>
						</label>
					</div>

					<!-- Submit Button -->
					<button type="submit"
						class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-[#1f5fd8] hover:bg-[#184db1] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1f5fd8] transition duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-sm">
						Create Account
					</button>
				</form>

				<div class="mt-6 border-t border-[#f4eee6] pt-6 text-center">
					<p class="text-xs text-[#666666]">
						Already have an account?
						<a href="{{ url('/login') }}" class="font-semibold text-[#1f5fd8] hover:underline">Sign in instead</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</x-layout>
