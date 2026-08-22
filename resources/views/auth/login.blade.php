<x-layout>
	<div class="flex min-h-[80vh] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
		<div class="w-full max-w-md space-y-8">
			<!-- Header -->
			<div class="text-center">
				<span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-[#1f5fd8] to-[#4f8eff] text-white shadow-md shadow-[#1f5fd8]/20">
					<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
					</svg>
				</span>
				<h2 class="mt-6 text-3xl font-extrabold tracking-tight text-[#1b1b18]">Sign in to your account</h2>
				<p class="mt-2 text-sm text-[#666666]">
					Welcome back! Enter your details to continue.
				</p>
			</div>

			<div class="rounded-3xl border border-[#eadfce] bg-white p-8 shadow-sm">

				<form class="space-y-6" action="{{ url('/login') }}" method="POST">
					<!-- display validation errors properly -->
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
								class="block w-full pl-10 pr-4 py-3 rounded-xl border @error('email') border-red-500 @else border-[#d7d0c8] @enderror bg-[#faf8f5] text-sm text-[#1b1b18] placeholder-[#a39e96] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition duration-200" />
						</div>
					</div>

					<!-- Password Field -->
					<div>
						<div class="flex items-center justify-between">
							<label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Password</label>
							<a href="{{ url('/forgot-password') }}" class="text-xs font-semibold text-[#1f5fd8] hover:underline">Forgot password?</a>
						</div>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
								</svg>
							</div>
							<input type="password" name="password" id="password" required autocomplete="current-password" placeholder="••••••••"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] placeholder-[#a39e96] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition duration-200" />
						</div>
					</div>

					<!-- Remember Me Checkbox -->
					<div class="flex items-center">
						<input id="remember_me" name="remember_me" type="checkbox"
							class="h-4 w-4 rounded border-[#d7d0c8] text-[#1f5fd8] focus:ring-[#1f5fd8] accent-[#1f5fd8]" />
						<label for="remember_me" class="ml-2 block text-xs text-[#555]">
							Keep me signed in on this device
						</label>
					</div>

					<!-- Submit Button -->
					<button type="submit"
						class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-[#1f5fd8] hover:bg-[#184db1] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1f5fd8] transition duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-sm">
						Sign In
					</button>
				</form>

				<div class="mt-6 border-t border-[#f4eee6] pt-6 text-center">
					<p class="text-xs text-[#666666]">
						Don't have an account?
						<a href="{{ url('/register') }}" class="font-semibold text-[#1f5fd8] hover:underline">Create an account</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</x-layout>
