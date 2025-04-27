<x-app-layout>
    <div class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: true }">
        <div class="flex">
            <x-sidebar active="orders" />
            <div class="flex flex-col flex-1 transition-all duration-300 ease-in-out"
                 :class="{'pl-64': sidebarOpen, 'pl-0': !sidebarOpen}">

                <header class="bg-white shadow">
                    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" x-show="!sidebarOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg class="h-6 w-6" x-show="sidebarOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <h2 class="text-xl font-semibold text-gray-800">
                            Orders Management
                        </h2>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto py-6 px-4 sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">All Orders</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shipping Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $order->user_name }}<br>
                                            <span class="text-gray-500 text-xs">{{ $order->email }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-800' :
                                                   ($order->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $order->shipping_status == 'selesai' ? 'bg-green-100 text-green-800' :
                                                   ($order->shipping_status == 'dikirim' ? 'bg-blue-100 text-blue-800' :
                                                   ($order->shipping_status == 'proses' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                                                {{ ucfirst($order->shipping_status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No orders found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
