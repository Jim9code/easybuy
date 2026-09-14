<x-layout>
	<div class="flex min-h-[80vh] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
		<div class="w-full max-w-md space-y-8">
			<!-- Header -->
			<div class="text-center">
				<span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FFD000] text-[#191917] shadow-xs">
					<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m-5-4v1a3 3 0 00-3 3v1M3 10h18M4 14h16m-7 8l-3-3m0 0l3-3m-3 3h8" />
					</svg>
				</span>
				<h2 class="mt-6 text-3xl font-extrabold tracking-tight text-[#191917] font-heading">Reset your password</h2>
				<p class="mt-2 text-sm text-[#5C5549]">
					Follow the 2-step process to securely reset your credentials.
				</p>
			</div>

			@if ($errors->any())
				<div class="rounded-2xl bg-red-50 p-4 border border-red-100 text-xs text-red-600 font-semibold">
					<ul class="list-disc pl-4 space-y-1">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<!-- Display Success Messages -->
			@if (session('success'))
				<div class="mb-4 rounded-2xl bg-emerald-50 p-4 border border-emerald-100 text-xs text-emerald-700 font-semibold">
					{{ session('success') }}
				</div>
			@endif

			<!-- Step 1: Request Code Form -->
			@if (!request('email'))
			<div class="clay-card rounded-3xl p-6 shadow-sm">
				<h3 class="text-xs font-bold uppercase tracking-wider text-[#191917] mb-4">Step 1: Request Verification Code</h3>
				<form action="{{ url('/forgot-password/send') }}" method="POST" class="space-y-4">
					@csrf
					<div>
						<label for="request_email" class="block text-xs font-bold text-[#191917] uppercase tracking-wider">Email Address</label>
						<div class="mt-1.5 flex gap-2">
							<div class="relative w-full rounded-xl shadow-sm">
								<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
									<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
									</svg>
								</div>
								<input type="email" name="email" id="request_email" required value="{{ request('email') }}" placeholder="you@example.com"
									class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] focus:outline-none focus:ring-2 focus:ring-[#FFD000] focus:border-[#FFD000] transition" />
							</div>
							<button type="submit" class="bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] px-5 rounded-xl text-xs font-bold transition shadow-sm active:scale-95 whitespace-nowrap cursor-pointer">
								Get Code
							</button>
						</div>
					</div>
				</form>
			</div>
			@else
			<!-- Step 2: Verification and Reset Form -->
			<div class="clay-card rounded-3xl p-8 shadow-sm">
				<h3 class="text-xs font-bold uppercase tracking-wider text-[#191917] mb-4">Step 2: Enter Code & New Password</h3>
				<form class="space-y-5" action="{{ url('/forgot-password/reset') }}" method="POST" id="reset-password-form">
					@csrf
					<!-- Hidden Email field automatically prefilled -->
					<input type="hidden" name="email" value="{{ request('email') }}" />

					<!-- 5-Digit Verification Code -->
					<div>
						<label class="block text-xs font-bold uppercase tracking-wider text-[#191917] text-center mb-3">Verification Code</label>
						<div class="flex justify-between gap-2" id="verification-code-container">
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-[#191917] focus:outline-none focus:ring-2 focus:ring-[#191917] focus:border-[#191917] transition" />
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-[#191917] focus:outline-none focus:ring-2 focus:ring-[#191917] focus:border-[#191917] transition" />
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-[#191917] focus:outline-none focus:ring-2 focus:ring-[#191917] focus:border-[#191917] transition" />
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-[#191917] focus:outline-none focus:ring-2 focus:ring-[#191917] focus:border-[#191917] transition" />
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-[#191917] focus:outline-none focus:ring-2 focus:ring-[#191917] focus:border-[#191917] transition" />
						</div>
						<!-- Hidden Input to store the combined code for form submit -->
						<input type="hidden" name="code" id="combined-code" />
					</div>

					<!-- New Password Field -->
					<div>
						<label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">New Password</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
								</svg>
							</div>
							<input type="password" name="password" id="password" required placeholder="Min 8 characters" minlength="8"
								class="block w-full pl-10 pr-10 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#191917] focus:border-[#191917] transition" />
							
							<button type="button" onclick="togglePasswordVisibility('password', 'forgot-pwd-icon')"
								class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#7A7365] hover:text-[#191917] transition cursor-pointer"
								title="Toggle password visibility">
								<svg id="forgot-pwd-icon" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								</svg>
							</button>
						</div>
					</div>

					<!-- Confirm Password Field -->
					<div>
						<label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#191917]">Confirm New Password</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
								</svg>
							</div>
							<input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm new password" minlength="8"
								class="block w-full pl-10 pr-10 py-3 rounded-xl border border-[#D8C9B5] bg-[#FAF6EE] text-sm text-[#191917] placeholder-[#9C9283] focus:outline-none focus:ring-2 focus:ring-[#191917] focus:border-[#191917] transition" />
							
							<button type="button" onclick="togglePasswordVisibility('password_confirmation', 'forgot-confirm-icon')"
								class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#7A7365] hover:text-[#191917] transition cursor-pointer"
								title="Toggle password visibility">
								<svg id="forgot-confirm-icon" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								</svg>
							</button>
						</div>
					</div>

					<!-- Submit Button -->
					<button type="submit"
						class="w-full bg-[#191917] hover:bg-[#333333] text-[#FAF6EE] flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold transition duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-sm cursor-pointer">
						Verify & Save Password
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
				</script>

				<div class="mt-6 border-t border-[#E0D3C1] pt-6 text-center">
					<a href="{{ url('/login') }}" class="text-xs font-bold text-[#191917] hover:underline decoration-[#FFD000] decoration-2">Back to sign in</a>
				</div>
			</div>
			@endif
		</div>
	</div>
	<!-- JavaScript for Focus Shifting and Code Concatenation -->
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const container = document.getElementById('verification-code-container');
			const inputs = container.querySelectorAll('input');
			const hiddenInput = document.getElementById('combined-code');
			const form = document.getElementById('reset-password-form');

			inputs.forEach((input, index) => {
				// Focus shifting on input
				input.addEventListener('input', (e) => {
					if (e.target.value.length === 1 && index < inputs.length - 1) {
						inputs[index + 1].focus();
					}
					updateCombinedCode();
				});

				// Focus shifting on backspace
				input.addEventListener('keydown', (e) => {
					if (e.key === 'Backspace' && !e.target.value && index > 0) {
						inputs[index - 1].focus();
					}
				});
			});

			function updateCombinedCode() {
				let code = '';
				inputs.forEach(input => {
					code += input.value;
				});
				hiddenInput.value = code;
			}

			form.addEventListener('submit', (e) => {
				updateCombinedCode();
				if (hiddenInput.value.length !== 5) {
					e.preventDefault();
					alert('Please enter a valid 5-digit verification code.');
				}
			});
		});
	</script>
</x-layout>
