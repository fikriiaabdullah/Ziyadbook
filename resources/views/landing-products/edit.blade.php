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

                        <form method="POST" action="{{ route('landing-products.update', $product->id) }}" class="p-6 space-y-6">
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
</x-app-layout>
