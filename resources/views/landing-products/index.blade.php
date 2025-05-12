<x-app-layout>
    <div class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: true }">
        <x-sidebar active="landing-products" />

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
                        {{ $title ?? 'Landing Pages' }}
                    </h2>
                </div>
            </header>

            <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Page Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold text-gray-900">Landing Pages</h1>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Select Product
                        </a>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif

                    <!-- Products Table -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($product->image)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                                @else
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $product->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    ID: {{ $product->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $product->category->name ?? 'Uncategorized' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($product->landingPage && $product->landingPage->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Inactive
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('landing-products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            @if($product->landingPage)
                                            <a href="{{ route('landing-products.show', $product->id) }}" target="_blank" class="text-purple-600 hover:text-purple-900">View Landing</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        No landing pages found. <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-900">Select a product to create landing page</a>.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
