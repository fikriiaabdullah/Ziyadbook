<x-app-layout>
    <div class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: true }">
        <x-sidebar active="products" />

        <div class="flex flex-col flex-1 transition-all duration-300 ease-in-out"
             :class="{'pl-64': sidebarOpen, 'pl-0': !sidebarOpen}">

            <header class="bg-white shadow">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" x-show="!sidebarOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="h-6 w-6" x-show="sidebarOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $title ?? 'Edit Landing Page' }}
                    </h2>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" style="display: none;">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="/">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Landing Page for {{ $product->name }}</h3>
                            <p class="mt-1 text-sm text-gray-500">Customize the landing page content using the Problem-Agitate-Solution (PAS) framework.</p>
                        </div>

                        <form method="POST" action="{{ route('landing-products.update', $product->id) }}" class="p-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Status Toggle -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Enable Landing Page</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $landingProduct->is_active ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>

                            <!-- Headline -->
                            <div>
                                <label for="headline" class="block text-sm font-medium text-gray-700">Headline</label>
                                <input type="text" name="headline" id="headline" value="{{ old('headline', $landingProduct->headline) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="mt-1 text-xs text-gray-500">The main attention-grabbing headline for your product.</p>
                            </div>

                            <!-- Subheadline -->
                            <div>
                                <label for="subheadline" class="block text-sm font-medium text-gray-700">Subheadline</label>
                                <input type="text" name="subheadline" id="subheadline" value="{{ old('subheadline', $landingProduct->subheadline) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="mt-1 text-xs text-gray-500">A supporting statement that adds context to your headline.</p>
                            </div>

                            <!-- Problem Section -->
                            <div>
                                <label for="problem" class="block text-sm font-medium text-gray-700">Problem</label>
                                <textarea name="problem" id="problem" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('problem', $landingProduct->problem) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Identify the problem your customer is facing that your product solves.</p>
                            </div>

                            <!-- Agitate Section -->
                            <div>
                                <label for="agitate" class="block text-sm font-medium text-gray-700">Agitate</label>
                                <textarea name="agitate" id="agitate" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('agitate', $landingProduct->agitate) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Emphasize the pain points and consequences of not solving the problem.</p>
                            </div>

                            <!-- Solution Section -->
                            <div>
                                <label for="solution" class="block text-sm font-medium text-gray-700">Solution</label>
                                <textarea name="solution" id="solution" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('solution', $landingProduct->solution) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Present your product as the perfect solution to their problem.</p>
                            </div>

                            <!-- Benefits -->
                            <div>
                                <label for="benefits" class="block text-sm font-medium text-gray-700">Benefits</label>
                                <textarea name="benefits" id="benefits" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('benefits', $landingProduct->benefits) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">List the key benefits of your product (one benefit per line).</p>
                            </div>

                            <!-- YouTube Video URL -->
                            <div>
                                <label for="youtube_video_url" class="block text-sm font-medium text-gray-700">YouTube Video URL</label>
                                <input type="text" name="youtube_video_url" id="youtube_video_url" value="{{ old('youtube_video_url', $landingProduct->youtube_video_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="mt-1 text-xs text-gray-500">Enter the full YouTube video URL (e.g., https://www.youtube.com/watch?v=XXXXXXXXXXX).</p>
                            </div>

                            <!-- Image Gallery -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Image Gallery</label>
                                    <p class="mt-1 text-xs text-gray-500">Add multiple images to showcase your product. You can add as many as you need.</p>
                                </div>

                                <!-- Existing Images -->
                                @if($landingProduct->exists && $landingProduct->images->count() > 0)
                                <div class="border rounded-md p-4">
                                    <h4 class="font-medium text-gray-700 mb-3">Current Images</h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="sortable-gallery">
                                        @foreach($landingProduct->images as $image)
                                        <div class="relative group border rounded-md p-2 gallery-item" data-id="{{ $image->id }}">
                                            <img src="{{ asset($image->image_path) }}" alt="{{ $image->caption }}" class="w-full h-32 object-cover rounded">
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-600 truncate">{{ $image->caption ?: 'No caption' }}</p>
                                            </div>
                                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded">
                                                <a href="{{ route('landing-products.delete-image', $image->id) }}" class="text-white bg-red-600 hover:bg-red-700 p-1 rounded" onclick="return confirm('Are you sure you want to delete this image?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                                <div class="cursor-move ml-2 text-white bg-gray-600 hover:bg-gray-700 p-1 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <p class="mt-3 text-xs text-gray-500">Drag and drop to reorder images. Hover over an image to delete it.</p>
                                </div>
                                @endif

                                <!-- Add New Images -->
                                <div class="border rounded-md p-4" x-data="{ imageCount: 1 }">
                                    <h4 class="font-medium text-gray-700 mb-3">Add New Images</h4>

                                    <div class="space-y-4" id="image-inputs">
                                        <template x-for="i in imageCount" :key="i">
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start border-b border-gray-200 pb-4">
                                                <div class="md:col-span-2">
                                                    <label :for="'gallery_images_'+i" class="block text-sm font-medium text-gray-700">Image</label>
                                                    <input type="file" :name="'gallery_images[]'" :id="'gallery_images_'+i" class="mt-1 block w-full text-sm text-gray-500
                                                        file:mr-4 file:py-2 file:px-4
                                                        file:rounded-md file:border-0
                                                        file:text-sm file:font-semibold
                                                        file:bg-indigo-50 file:text-indigo-700
                                                        hover:file:bg-indigo-100
                                                    " accept="image/*">
                                                </div>
                                                <div>
                                                    <label :for="'image_captions_'+i" class="block text-sm font-medium text-gray-700">Caption (optional)</label>
                                                    <input type="text" :name="'image_captions[]'" :id="'image_captions_'+i" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Image caption">
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <div class="mt-4 flex justify-center">
                                        <button type="button" @click="imageCount++" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Add Another Image
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonials -->
                            <div>
                                <label for="testimonials" class="block text-sm font-medium text-gray-700">Testimonials</label>
                                <textarea name="testimonials" id="testimonials" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('testimonials', $landingProduct->testimonials) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Add customer testimonials (format: Name|Position|Quote - one per line).</p>
                            </div>

                            <!-- Call to Action -->
                            <div>
                                <label for="call_to_action" class="block text-sm font-medium text-gray-700">Call to Action</label>
                                <input type="text" name="call_to_action" id="call_to_action" value="{{ old('call_to_action', $landingProduct->call_to_action) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="mt-1 text-xs text-gray-500">The text for your call-to-action button (e.g., "Buy Now", "Get Started").</p>
                            </div>

                            <div class="flex justify-end space-x-3 pt-5 border-t border-gray-200">
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save Landing Page
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Include jQuery and jQuery UI for drag and drop functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#sortable-gallery").sortable({
                update: function(event, ui) {
                    const imageIds = $(this).sortable('toArray', { attribute: 'data-id' });

                    // Send the new order to the server
                    $.ajax({
                        url: '{{ route("landing-products.reorder-images") }}',
                        method: 'POST',
                        data: {
                            images: imageIds,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('Images reordered successfully');
                        },
                        error: function(error) {
                            console.error('Error reordering images', error);
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
