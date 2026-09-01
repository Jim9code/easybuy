<x-layout>
	<div class="flex min-h-[80vh] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
		<div class="w-full max-w-md space-y-8">
			<!-- Header -->
			<div class="text-center">
				<span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-[#1f5fd8] to-[#4f8eff] text-white shadow-md shadow-[#1f5fd8]/20">
					<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m-5-4v1a3 3 0 00-3 3v1M3 10h18M4 14h16m-7 8l-3-3m0 0l3-3m-3 3h8" />
					</svg>
				</span>
				<h2 class="mt-6 text-3xl font-extrabold tracking-tight text-[#1b1b18]">Reset your password</h2>
				<p class="mt-2 text-sm text-[#666666]">
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
			<div class="rounded-3xl border border-[#eadfce] bg-white p-6 shadow-sm">
				<h3 class="text-xs font-bold uppercase tracking-wider text-[#1b1b18] mb-4">Step 1: Request Verification Code</h3>
				<form action="{{ url('/forgot-password/send') }}" method="POST" class="space-y-4">
					@csrf
					<div>
						<label for="request_email" class="block text-xs font-bold text-[#4b4b4b] uppercase tracking-wider">Email Address</label>
						<div class="mt-1.5 flex gap-2">
							<div class="relative w-full rounded-xl shadow-sm">
								<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
									<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
									</svg>
								</div>
								<input type="email" name="email" id="request_email" required value="{{ request('email') }}" placeholder="you@example.com"
									class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
							</div>
							<button type="submit" class="bg-[#1b1b18] text-white px-5 rounded-xl text-xs font-bold hover:bg-neutral-800 transition shadow-sm active:scale-95 whitespace-nowrap">
								Get Code
							</button>
						</div>
					</div>
				</form>
			</div>
			@else
			<!-- Step 2: Verification and Reset Form -->
			<div class="rounded-3xl border border-[#eadfce] bg-white p-8 shadow-sm">
				<h3 class="text-xs font-bold uppercase tracking-wider text-[#1b1b18] mb-4">Step 2: Enter Code & New Password</h3>
				<form class="space-y-5" action="{{ url('/forgot-password/reset') }}" method="POST" id="reset-password-form">
					@csrf
					<!-- Hidden Email field automatically prefilled -->
					<input type="hidden" name="email" value="{{ request('email') }}" />

					<!-- 5-Digit Verification Code -->
					<div>
						<label class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b] text-center mb-3">Verification Code</label>
						<div class="flex justify-between gap-2" id="verification-code-container">
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
							<input type="text" maxlength="1" pattern="[0-9]" required
								class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
						</div>
						<!-- Hidden Input to store the combined code for form submit -->
						<input type="hidden" name="code" id="combined-code" />
					</div>

					<!-- New Password Field -->
					<div>
						<label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">New Password</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
								</svg>
							</div>
							<input type="password" name="password" id="password" required placeholder="Min 8 characters"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] placeholder-[#a39e96] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
						</div>
					</div>

					<!-- Confirm Password Field -->
					<div>
						<label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Confirm New Password</label>
						<div class="mt-1.5 relative rounded-xl shadow-sm">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
								</svg>
							</div>
							<input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm new password"
								class="block w-full pl-10 pr-4 py-3 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] placeholder-[#a39e96] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
						</div>
					</div>

					<!-- Submit Button -->
					<button type="submit"
						class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-[#1f5fd8] hover:bg-[#184db1] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1f5fd8] transition duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-sm">
						Verify & Save Password
					</button>
				</form>

				<div class="mt-6 border-t border-[#f4eee6] pt-6 text-center">
					<a href="{{ url('/login') }}" class="text-xs font-semibold text-[#1f5fd8] hover:underline">Back to sign in</a>
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
