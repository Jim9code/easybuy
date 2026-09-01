<x-layout>
	<div class="py-8 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
		<!-- Welcome Header -->
		<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-[#e8dfd3] pb-6 mb-8">
			<div>
				<span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#1f5fd8]">Customer Dashboard</span>
				<h1 class="text-3xl font-extrabold tracking-tight text-[#1b1b18] mt-1">
					Welcome back, <span class="bg-gradient-to-r from-[#1f5fd8] to-[#4f8eff] bg-clip-text text-transparent">{{ Auth::user()->username }}</span>!
				</h1>
			</div>
			<div>
				<div>
					<!-- Sign Out / Logout Form -->
					<form action="{{ url('/logout') }}" method="POST">
						@csrf
						<button type="submit"
							class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50/50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50 hover:border-red-300 hover:text-red-700 cursor-pointer">
							<svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
							</svg>
							<span>Sign Out</span>
						</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Display Validation Errors and Success Messages -->
		@if (session('success'))
			<div class="mb-8 rounded-2xl bg-emerald-50 p-4 border border-emerald-100 text-xs text-emerald-700 font-semibold shadow-sm">
				{{ session('success') }}
			</div>
		@endif
		@if ($errors->any())
			<div class="mb-8 rounded-2xl bg-red-50 p-4 border border-red-100 text-xs text-red-600 font-semibold shadow-sm">
				<ul class="list-disc pl-4 space-y-1">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		
		
			
		<!-- Product Catalog Management (CRUD) Section -->
		<div class="rounded-3xl border border-[#eadfce] bg-[#fdfcfa] p-6 sm:p-8">
			<div class="flex items-center justify-between border-b border-[#e8dfd3] pb-4 mb-6">
				<div>
					<h2 class="text-2xl font-bold text-[#1b1b18]">Product Catalog</h2>
					<p class="text-xs text-[#666666] mt-0.5">Manage your store products dynamically</p>
				</div>
				<button onclick="toggleModal('add-product-modal', true)" 
					class="inline-flex items-center gap-1.5 rounded-xl bg-[#1f5fd8] px-4 py-2.5 text-xs font-bold text-white hover:bg-[#184db1] transition cursor-pointer shadow-sm">
					<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
					</svg>
					<span>Add Product</span>
				</button>
			</div>

			<!-- Product Catalog Grid -->
			@if($products->isEmpty())
				<div class="flex flex-col items-center justify-center py-12 text-center">
					<span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-neutral-100 text-neutral-400 mb-4">
						<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
						</svg>
					</span>
					<h3 class="text-base font-bold text-[#1b1b18]">No products in catalog</h3>
					<p class="text-xs text-[#666666] mt-1 max-w-sm">Start building your database by adding your first product to the dashboard catalog.</p>
				</div>
			@else
				<div class="grid gap-6 md:grid-cols-3">
					@foreach($products as $product)
						<div class="group rounded-2xl border border-[#eadfce] bg-white p-5 shadow-sm transition hover:shadow-md duration-300 flex flex-col justify-between">
							<div>
								<div class="flex items-start justify-between">
									<span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-2xs font-semibold text-[#1f5fd8] border border-blue-100">
										{{ $product->category }}
									</span>
									<span class="text-lg font-bold text-[#1f5fd8]">${{ number_format($product->price, 2) }}</span>
								</div>
								<h4 class="text-base font-bold text-[#1b1b18] mt-2 group-hover:text-[#1f5fd8] transition duration-200">{{ $product->name }}</h4>
								<p class="mt-2 text-xs text-[#666] leading-relaxed truncate-2-lines">
									{{ $product->description ?: 'No description provided.' }}
								</p>
							</div>

							<!-- Actions -->
							<div class="mt-5 pt-4 border-t border-[#f4eee6] flex items-center justify-between gap-2">
								<!-- Edit Button (triggers Modal prefill JS) -->
								<button onclick="openEditModal('{{ $product->id }}', '{{ addslashes($product->name) }}', '{{ addslashes($product->category) }}', '{{ $product->price }}', '{{ addslashes($product->description) }}')"
									class="flex items-center gap-1 text-xs font-semibold text-[#1f5fd8] hover:text-[#184db1] transition cursor-pointer">
									<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
									</svg>
									<span>Edit</span>
								</button>

								<!-- Delete Button -->
								<form action="{{ url('/products/' . $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="flex items-center gap-1 text-xs font-semibold text-red-500 hover:text-red-700 transition cursor-pointer">
										<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
											<path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
										</svg>
										<span>Delete</span>
									</button>
								</form>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>

	<!-- ==================== CREATE MODAL ==================== -->
	<div id="add-product-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden">
		<div class="bg-white rounded-3xl border border-[#eadfce] p-8 max-w-md w-full m-4 shadow-xl relative animate-in fade-in zoom-in-95 duration-200">
			<button onclick="toggleModal('add-product-modal', false)" class="absolute top-4 right-4 text-neutral-400 hover:text-neutral-600 transition cursor-pointer">
				<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
			<h3 class="text-xl font-bold text-[#1b1b18] mb-1">Add Product</h3>
			<p class="text-xs text-[#666] mb-6">Fill in the fields to list a new catalog item.</p>

			<form action="{{ url('/products') }}" method="POST" class="space-y-4">
				@csrf
				<div>
					<label for="add-name" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Product Name</label>
					<input type="text" name="name" id="add-name" required placeholder="e.g. Minimalist Table Lamp"
						class="mt-1.5 block w-full px-4 py-2.5 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
				</div>
				<div class="grid grid-cols-2 gap-4">
					<div>
						<label for="add-category" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Category</label>
						<input type="text" name="category" id="add-category" required placeholder="e.g. Home Goods"
							class="mt-1.5 block w-full px-4 py-2.5 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
					</div>
					<div>
						<label for="add-price" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Price ($)</label>
						<input type="number" step="0.01" min="0" name="price" id="add-price" required placeholder="e.g. 49.99"
							class="mt-1.5 block w-full px-4 py-2.5 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
					</div>
				</div>
				<div>
					<label for="add-description" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Description</label>
					<textarea name="description" id="add-description" rows="3" placeholder="Describe your product utility..."
						class="mt-1.5 block w-full px-4 py-2.5 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition resize-none"></textarea>
				</div>

				<button type="submit" class="w-full mt-2 py-3 px-4 rounded-xl text-sm font-semibold text-white bg-[#1f5fd8] hover:bg-[#184db1] transition shadow-sm active:scale-98">
					Save Product
				</button>
			</form>
		</div>
	</div>

	<!-- ==================== EDIT MODAL ==================== -->
	<div id="edit-product-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden">
		<div class="bg-white rounded-3xl border border-[#eadfce] p-8 max-w-md w-full m-4 shadow-xl relative animate-in fade-in zoom-in-95 duration-200">
			<button onclick="toggleModal('edit-product-modal', false)" class="absolute top-4 right-4 text-neutral-400 hover:text-neutral-600 transition cursor-pointer">
				<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
			<h3 class="text-xl font-bold text-[#1b1b18] mb-1">Edit Product</h3>
			<p class="text-xs text-[#666] mb-6">Modify product specs in the fields below.</p>

			<form id="edit-product-form" action="" method="POST" class="space-y-4">
				@csrf
				@method('PUT')
				<div>
					<label for="edit-name" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Product Name</label>
					<input type="text" name="name" id="edit-name" required
						class="mt-1.5 block w-full px-4 py-2.5 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
				</div>
				<div class="grid grid-cols-2 gap-4">
					<div>
						<label for="edit-category" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Category</label>
						<input type="text" name="category" id="edit-category" required
							class="mt-1.5 block w-full px-4 py-2.5 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
					</div>
					<div>
						<label for="edit-price" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Price ($)</label>
						<input type="number" step="0.01" min="0" name="price" id="edit-price" required
							class="mt-1.5 block w-full px-4 py-2.5 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition" />
					</div>
				</div>
				<div>
					<label for="edit-description" class="block text-xs font-bold uppercase tracking-wider text-[#4b4b4b]">Description</label>
					<textarea name="description" id="edit-description" rows="3"
						class="mt-1.5 block w-full px-4 py-2.5 rounded-xl border border-[#d7d0c8] bg-[#faf8f5] text-sm text-[#1b1b18] focus:outline-none focus:border-[#1f5fd8] focus:bg-white transition resize-none"></textarea>
				</div>

				<button type="submit" class="w-full mt-2 py-3 px-4 rounded-xl text-sm font-semibold text-white bg-[#1f5fd8] hover:bg-[#184db1] transition shadow-sm active:scale-98">
					Update Product
				</button>
			</form>
		</div>
	</div>

	<!-- Modal Management & Utilities Scripts -->
	<script>
		// Open/Close Modals
		function toggleModal(modalId, isVisible) {
			const modal = document.getElementById(modalId);
			if (isVisible) {
				modal.classList.remove('hidden');
			} else {
				modal.classList.add('hidden');
			}
		}

		// Prefill and open edit modal
		function openEditModal(id, name, category, price, description) {
			const form = document.getElementById('edit-product-form');
			
			// Dynamically set form action route
			form.action = "{{ url('/products') }}/" + id;
			
			// Fill values
			document.getElementById('edit-name').value = name;
			document.getElementById('edit-category').value = category;
			document.getElementById('edit-price').value = price;
			document.getElementById('edit-description').value = description;

			// Show modal
			toggleModal('edit-product-modal', true);
		}

		// Close modal if clicked backdrop
		window.onclick = function(event) {
			const addModal = document.getElementById('add-product-modal');
			const editModal = document.getElementById('edit-product-modal');
			if (event.target === addModal) {
				toggleModal('add-product-modal', false);
			}
			if (event.target === editModal) {
				toggleModal('edit-product-modal', false);
			}
		}
	</script>

	<!-- CSS Utility for description text line limit -->
	<style>
		.truncate-2-lines {
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;  
			overflow: hidden;
		}
	</style>
</x-layout>
