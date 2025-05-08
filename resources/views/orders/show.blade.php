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
                            Order Details #{{ $order->id }}
                        </h2>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto py-6 px-4 sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="mb-6">
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
                            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Orders
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Order Information -->
                        <div class="md:col-span-2">
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Order Information</h3>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500 mb-2">Order Details</h4>
                                            <p class="text-sm"><span class="font-medium">Order ID:</span> #{{ $order->id }}</p>
                                            <p class="text-sm"><span class="font-medium">Date:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
                                            <p class="text-sm"><span class="font-medium">Payment Method:</span> {{ $order->payment_method == 'transfer_bank' ? 'Bank Transfer' : 'Cash on Delivery' }}</p>
                                            <p class="text-sm"><span class="font-medium">Courier:</span> {{ strtoupper($order->courier) }}</p>
                                            <p class="text-sm"><span class="font-medium">Service:</span> {{ $order->courier_service }}</p>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500 mb-2">Customer Information</h4>
                                            <p class="text-sm"><span class="font-medium">Name:</span> {{ $order->user_name }}</p>
                                            <p class="text-sm"><span class="font-medium">Email:</span> {{ $order->email }}</p>
                                            <p class="text-sm"><span class="font-medium">Address:</span> {{ $order->address }}</p>
                                            <p class="text-sm"><span class="font-medium">Province:</span> {{ $provinceName ?? 'N/A' }}</p>
                                            <p class="text-sm"><span class="font-medium">City:</span> {{ $cityName ?? 'N/A' }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <h4 class="text-sm font-medium text-gray-500 mb-2">Order Items</h4>
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach($order->items as $item)
                                                    <tr>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                @if($item->product && $item->product->image)
                                                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="h-10 w-10 rounded-md object-cover mr-3">
                                                                @else
                                                                <div class="h-10 w-10 rounded-md bg-gray-200 flex items-center justify-center mr-3">
                                                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                    </svg>
                                                                </div>
                                                                @endif
                                                                <div>
                                                                    <div class="text-sm font-medium text-gray-900">{{ $item->product ? $item->product->name : 'Product not found' }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $item->quantity }}
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot class="bg-gray-50">
                                                    <tr>
                                                        <td colspan="3" class="px-4 py-3 text-right text-sm font-medium">Shipping:</td>
                                                        <td class="px-4 py-3 text-sm text-gray-500">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="px-4 py-3 text-right text-sm font-medium">Total:</td>
                                                        <td class="px-4 py-3 text-sm font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Status and Payment Proof -->
                        <div>
                            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Order Status</h3>
                                </div>
                                <div class="p-6">
                                    <form action="{{ route('orders.update.status', $order) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                                            <select id="payment_status" name="payment_status" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                                <option value="cancelled" {{ $order->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="shipping_status" class="block text-sm font-medium text-gray-700 mb-1">Shipping Status</label>
                                            <select id="shipping_status" name="shipping_status" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="proses" {{ $order->shipping_status == 'proses' ? 'selected' : '' }}>Processing</option>
                                                <option value="dikirim" {{ $order->shipping_status == 'dikirim' ? 'selected' : '' }}>Shipped</option>
                                                <option value="selesai" {{ $order->shipping_status == 'selesai' ? 'selected' : '' }}>Completed</option>
                                                <option value="dibatalkan" {{ $order->shipping_status == 'dibatalkan' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                                            Update Status
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Payment Status Badges -->
                            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Status</h3>
                                </div>
                                <div class="p-6">
                                    <div class="flex flex-col space-y-3">
                                        <div>
                                            <span class="text-sm font-medium text-gray-700">Payment Status:</span>
                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-800' :
                                                   ($order->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-700">Shipping Status:</span>
                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $order->shipping_status == 'selesai' ? 'bg-green-100 text-green-800' :
                                                   ($order->shipping_status == 'dikirim' ? 'bg-blue-100 text-blue-800' :
                                                   ($order->shipping_status == 'proses' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                                                {{ ucfirst($order->shipping_status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($order->payment_method == 'transfer_bank')
                                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                    <div class="px-6 py-4 border-b border-gray-200">
                                        <h3 class="text-lg font-medium text-gray-900">Payment Proof</h3>
                                    </div>
                                    <div class="p-6">
                                        @if($order->payment && $order->payment->proof)
                                            <div class="mb-4">
                                                <img src="{{ asset($order->payment->proof) }}" alt="Payment Proof" class="w-full h-auto rounded-md">
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <p><span class="font-medium">Uploaded at:</span> {{ $order->payment->created_at->format('d M Y H:i') }}</p>
                                                <p><span class="font-medium">Status:</span>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $order->payment->status == 'verified' ? 'bg-green-100 text-green-800' :
                                                        ($order->payment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                        {{ ucfirst($order->payment->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                        @else
                                            <div class="text-center py-6">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <p class="mt-2 text-sm text-gray-500">No payment proof uploaded yet.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
