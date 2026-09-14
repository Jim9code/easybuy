<x-layout>
	<div class="flex min-h-[80vh] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
		<div class="w-full max-w-md space-y-8">
			<!-- Header -->
			<div class="text-center">
				<span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FFD000] text-[#191917] shadow-xs">
					<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
					</svg>
				</span>
				<h2 class="mt-6 text-3xl font-extrabold tracking-tight text-[#191917] font-heading">Sign in to your account</h2>
				<p class="mt-2 text-sm text-[#5C5549]">
					Welcome back! Enter your credentials to continue.
				</p>
			</div>

			<div class="clay-card rounded-3xl p-8 shadow-sm">

				@if(request('prompt'))
					<div class="mb-5 rounded-2xl bg-[#FFF9E6] border border-[#FFD000] p-4 text-xs text-[#191917] flex items-start gap-3 shadow-2xs">
						<span class="h-6 w-6 rounded-lg bg-[#FFD000] text-[#191917] flex items-center justify-center shrink-0 font-black text-xs">✨</span>
						<div class="space-y-0.5">
							<p class="font-bold">Welcome back!</p>
							<p class="text-3xs text-[#7A7365] italic line-clamp-2">"{{ request('prompt') }}"</p>
							<p class="text-3xs text-[#191917] font-semibold pt-1">Sign in to immediately process your AI quote.</p>
						</div>
					</div>
				@endif

				<form class="space-y-6" action="{{ url('/login') }}" method="POST">
					@if(request('prompt'))
						<input type="hidden" name="pending_prompt" value="{{ request('prompt') }}">
					@endif

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
						<label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Email Address</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
								</svg>
							</div>
							<input type="email" name="email" id="email" required autocomplete="email" placeholder="you@example.com"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border @error('email') border-red-500 @else border-[#D8C9B5] @enderror bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition duration-200" />
						</div>
					</div>

					<!-- Password Field -->
					<div>
						<div class="flex items-center justify-between">
							<label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Password</label>
							<a href="{{ url('/forgot-password') }}" class="text-xs font-bold text-[#191917] hover:underline decoration-[#FFD000] decoration-2">Forgot password?</a>
						</div>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
								</svg>
							</div>
							<input type="password" name="password" id="password" required autocomplete="current-password" placeholder="••••••••"
								onkeyup="checkCapsLock(event)" onkeydown="checkCapsLock(event)"
								class="block w-full pl-10 pr-10 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition duration-200" />
							
							<!-- Password Visibility Toggle Button -->
							<button type="button" onclick="togglePasswordVisibility('password', 'login-pwd-icon')"
								class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#7A7365] hover:text-[#191917] transition cursor-pointer"
								title="Toggle password visibility">
								<svg id="login-pwd-icon" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								</svg>
							</button>
						</div>

						<!-- Caps Lock Warning Badge -->
						<div id="caps-lock-warning" class="mt-1.5 hidden flex items-center gap-1.5 text-4xs font-bold text-amber-800 bg-amber-100 px-2.5 py-1 rounded-lg animate-pulse">
							<span>⚠️</span>
							<span>Caps Lock is ON</span>
						</div>
					</div>

					<!-- Remember Me Checkbox -->
					<div class="flex items-center">
						<input id="remember_me" name="remember_me" type="checkbox"
							class="h-4 w-4 rounded border-[#D8C9B5] text-[#191917] focus:ring-[#FFD000] accent-[#191917] cursor-pointer" />
						<label for="remember_me" class="ml-2 block text-xs text-[#5C5549] font-medium cursor-pointer">
							Keep me signed in on this device
						</label>
					</div>

					<!-- Submit Button -->
					<button type="submit"
						class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold transition duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-sm cursor-pointer">
						Sign In
					</button>
				</form>

				<script>
					function togglePasswordVisibility(inputId, iconId) {
						const input = document.getElementById(inputId);
						const icon = document.getElementById(iconId);
						if (!input || !icon) return;

						if (input.type === 'password') {
							input.type = 'text';
							icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`;
						} else {
							input.type = 'password';
							icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
						}
					}

					function checkCapsLock(e) {
						const warning = document.getElementById('caps-lock-warning');
						if (!warning) return;
						if (e.getModifierState && e.getModifierState('CapsLock')) {
							warning.classList.remove('hidden');
						} else {
							warning.classList.add('hidden');
						}
					}
				</script>

				<div class="mt-6 border-t border-[#E0D3C1] pt-6 text-center">
					<p class="text-xs text-[#5C5549]">
						Don't have an account?
						<a href="{{ url('/register') }}{{ request('prompt') ? '?prompt=' . urlencode(request('prompt')) : '' }}" class="font-bold text-[#191917] hover:underline decoration-[#FFD000] decoration-2">Create an account</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</x-layout>
