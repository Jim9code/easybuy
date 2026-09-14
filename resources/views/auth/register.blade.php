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
						<div class="flex items-center justify-between">
							<label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Password</label>
							<span id="password-strength-label" class="text-4xs font-bold uppercase tracking-wider text-[#7A7365]">Strength: None</span>
						</div>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
								</svg>
							</div>
							<input type="password" name="password" id="password" required autocomplete="new-password" placeholder="••••••••"
								oninput="validateRegistrationPassword()"
								class="block w-full pl-10 pr-10 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition duration-200" />
							
							<!-- Password Visibility Toggle Button -->
							<button type="button" onclick="togglePasswordVisibility('password', 'toggle-pwd-icon')"
								class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#7A7365] hover:text-[#191917] transition cursor-pointer"
								title="Toggle password visibility">
								<svg id="toggle-pwd-icon" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								</svg>
							</button>
						</div>

						<!-- Password Strength Bar (4 Segment Progress) -->
						<div class="mt-2 grid grid-cols-4 gap-1.5 h-1.5 rounded-full overflow-hidden bg-[#E8DECF]">
							<div id="strength-bar-1" class="h-full rounded-full transition-all duration-300 bg-transparent"></div>
							<div id="strength-bar-2" class="h-full rounded-full transition-all duration-300 bg-transparent"></div>
							<div id="strength-bar-3" class="h-full rounded-full transition-all duration-300 bg-transparent"></div>
							<div id="strength-bar-4" class="h-full rounded-full transition-all duration-300 bg-transparent"></div>
						</div>

						<!-- Live Validation Criteria Checklist Pills -->
						<div class="mt-2.5 grid grid-cols-2 gap-1.5 text-4xs font-bold text-[#7A7365]">
							<div id="rule-length" class="flex items-center gap-1.5 transition-colors">
								<span class="rule-icon h-3.5 w-3.5 rounded-full bg-[#E8DECF] text-[#7A7365] flex items-center justify-center text-4xs">○</span>
								<span>8+ characters</span>
							</div>
							<div id="rule-upper" class="flex items-center gap-1.5 transition-colors">
								<span class="rule-icon h-3.5 w-3.5 rounded-full bg-[#E8DECF] text-[#7A7365] flex items-center justify-center text-4xs">○</span>
								<span>1 uppercase (A-Z)</span>
							</div>
							<div id="rule-lower" class="flex items-center gap-1.5 transition-colors">
								<span class="rule-icon h-3.5 w-3.5 rounded-full bg-[#E8DECF] text-[#7A7365] flex items-center justify-center text-4xs">○</span>
								<span>1 lowercase (a-z)</span>
							</div>
							<div id="rule-number" class="flex items-center gap-1.5 transition-colors">
								<span class="rule-icon h-3.5 w-3.5 rounded-full bg-[#E8DECF] text-[#7A7365] flex items-center justify-center text-4xs">○</span>
								<span>1 number or symbol</span>
							</div>
						</div>
					</div>

					<!-- Confirm Password Field -->
					<div>
						<div class="flex items-center justify-between">
							<label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Confirm Password</label>
							<span id="password-match-indicator" class="text-4xs font-bold uppercase tracking-wider hidden"></span>
						</div>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
								</svg>
							</div>
							<input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
								oninput="validatePasswordMatch()"
								class="block w-full pl-10 pr-10 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition duration-200" />
							
							<!-- Confirm Password Visibility Toggle -->
							<button type="button" onclick="togglePasswordVisibility('password_confirmation', 'toggle-confirm-icon')"
								class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#7A7365] hover:text-[#191917] transition cursor-pointer"
								title="Toggle password visibility">
								<svg id="toggle-confirm-icon" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								</svg>
							</button>
						</div>
					</div>

					<!-- Terms Checkbox -->
					<div class="flex items-center">
						<input id="terms" name="terms" type="checkbox" required
							class="h-4 w-4 rounded border-[#D8C9B5] text-[#191917] focus:ring-[#FFD000] accent-[#191917] cursor-pointer" />
						<label for="terms" class="ml-2 block text-xs text-[#5C5549] font-medium cursor-pointer">
							I agree to the <a href="#" class="font-bold text-[#191917] hover:underline">Terms of Service</a> and <a href="#" class="font-bold text-[#191917] hover:underline">Privacy Policy</a>
						</label>
					</div>

					<!-- Submit Button -->
					<button type="submit" id="register-submit-btn"
						class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold transition duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-sm cursor-pointer">
						Create Account
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

					function validateRegistrationPassword() {
						const pwd = document.getElementById('password').value || '';
						
						const hasLength = pwd.length >= 8;
						const hasUpper = /[A-Z]/.test(pwd);
						const hasLower = /[a-z]/.test(pwd);
						const hasNumber = /[0-9\W_]/.test(pwd);

						updateRuleElement('rule-length', hasLength);
						updateRuleElement('rule-upper', hasUpper);
						updateRuleElement('rule-lower', hasLower);
						updateRuleElement('rule-number', hasNumber);

						const score = (hasLength ? 1 : 0) + (hasUpper ? 1 : 0) + (hasLower ? 1 : 0) + (hasNumber ? 1 : 0);
						const label = document.getElementById('password-strength-label');
						const b1 = document.getElementById('strength-bar-1');
						const b2 = document.getElementById('strength-bar-2');
						const b3 = document.getElementById('strength-bar-3');
						const b4 = document.getElementById('strength-bar-4');

						// Reset bars
						[b1, b2, b3, b4].forEach(b => b.className = 'h-full rounded-full transition-all duration-300 bg-transparent');

						if (pwd.length === 0) {
							label.innerText = 'Strength: None';
							label.className = 'text-4xs font-bold uppercase tracking-wider text-[#7A7365]';
						} else if (score <= 1) {
							label.innerText = 'Strength: Weak';
							label.className = 'text-4xs font-bold uppercase tracking-wider text-rose-600';
							b1.className = 'h-full rounded-full transition-all duration-300 bg-rose-500';
						} else if (score === 2) {
							label.innerText = 'Strength: Fair';
							label.className = 'text-4xs font-bold uppercase tracking-wider text-amber-600';
							b1.className = 'h-full rounded-full transition-all duration-300 bg-amber-500';
							b2.className = 'h-full rounded-full transition-all duration-300 bg-amber-500';
						} else if (score === 3) {
							label.innerText = 'Strength: Good';
							label.className = 'text-4xs font-bold uppercase tracking-wider text-blue-600';
							b1.className = 'h-full rounded-full transition-all duration-300 bg-blue-500';
							b2.className = 'h-full rounded-full transition-all duration-300 bg-blue-500';
							b3.className = 'h-full rounded-full transition-all duration-300 bg-blue-500';
						} else if (score === 4) {
							label.innerText = 'Strength: Strong';
							label.className = 'text-4xs font-bold uppercase tracking-wider text-emerald-700';
							[b1, b2, b3, b4].forEach(b => b.className = 'h-full rounded-full transition-all duration-300 bg-emerald-500');
						}

						validatePasswordMatch();
					}

					function updateRuleElement(elementId, passed) {
						const el = document.getElementById(elementId);
						if (!el) return;
						const icon = el.querySelector('.rule-icon');
						if (passed) {
							el.className = 'flex items-center gap-1.5 transition-colors text-emerald-800 font-bold';
							if (icon) {
								icon.className = 'rule-icon h-3.5 w-3.5 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-4xs font-black';
								icon.innerText = '✓';
							}
						} else {
							el.className = 'flex items-center gap-1.5 transition-colors text-[#7A7365] font-normal';
							if (icon) {
								icon.className = 'rule-icon h-3.5 w-3.5 rounded-full bg-[#E8DECF] text-[#7A7365] flex items-center justify-center text-4xs';
								icon.innerText = '○';
							}
						}
					}

					function validatePasswordMatch() {
						const pwd = document.getElementById('password').value || '';
						const confirmPwd = document.getElementById('password_confirmation').value || '';
						const matchIndicator = document.getElementById('password-match-indicator');
						const confirmInput = document.getElementById('password_confirmation');

						if (!confirmPwd) {
							matchIndicator.classList.add('hidden');
							confirmInput.classList.remove('border-emerald-500', 'border-rose-400');
							return;
						}

						matchIndicator.classList.remove('hidden');

						if (pwd === confirmPwd) {
							matchIndicator.innerText = '✓ Passwords match';
							matchIndicator.className = 'text-4xs font-bold uppercase tracking-wider text-emerald-700';
							confirmInput.classList.add('border-emerald-500');
							confirmInput.classList.remove('border-rose-400');
						} else {
							matchIndicator.innerText = '✕ Does not match';
							matchIndicator.className = 'text-4xs font-bold uppercase tracking-wider text-rose-600';
							confirmInput.classList.add('border-rose-400');
							confirmInput.classList.remove('border-emerald-500');
						}
					}
				</script>

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
