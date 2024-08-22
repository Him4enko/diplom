<div class="bg-gray-100">
    <section class="relative py-10">
        <div class="container mx-auto px-4">
            <div class="lg:flex items-start justify-between">
                <div class="lg:w-3/5 lg:mx-auto lg:pl-20">
                    <h2 class="mb-8 text-5xl font-bold">{{ __('Thank you') }}
                        @if (!empty($order->user))
                            {{ $order->user->fullName }}
                        @endif
                    </h2>

                    <p class="mb-12 custom-text-gray">{{ __('Your order is processing') }}</p>

                    <!-- Order Details -->
                    <div class="mb-12">
                        <!-- Loop through products -->
                        @foreach ($order->products()->get() as $product)
                            <div class="flex flex-wrap items-center mb-8">
                                <div class="w-full lg:w-2/6 pr-4">
                                    <img class="w-full h-32 object-contain"
                                         src="{{ asset('images/products/' . $product->image) }}" alt="">
                                </div>
                                <div class="w-full lg:w-4/6 pl-4">
                                    <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                                    <p class="text-gray-500">{!! $product->description !!}</p>
                                    <p class="text-gray-500">
                                        <span>{{ __('Quantity') }}:</span>
                                        <span class="font-bold">{{ $order->quantity }}</span>
                                    </p>
                                    <span class="text-2xl font-bold custom-text-blue">{{ $product->price }} BYN</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="mb-10">
                        <!-- Order subtotal, shipping, tax, total -->
                        <!-- Custom styling for each item -->
                    </div>

                    <!-- Delivery Address and Shipping Information -->
                    <div class="mb-10 py-10 custom-bg-gray">
                        <div class="container mx-auto flex flex-wrap justify-around">
                            <div class="w-full md:w-auto mb-6 md:mb-0">
                                <h4 class="mb-6 font-bold">{{ __('Delivery Address') }}</h4>
                                <p class="text-gray-500">
                                    {{ $order->shipping_address }}
                                </p>
                                <p class="text-gray-500">{{ $order->shipping_city }} - {{ $order->shipping_country }}
                                </p>
                            </div>
                            <div class="w-full md:w-auto mb-6 md:mb-0">
                                <h4 class="mb-6 font-bold">{{ __('Shipping Information') }}</h4>
                                <p class="text-gray-500">
                                    {{ $order->user->email }}
                                </p>
                                <p class="text-gray-500">
                                    {{ $order->user->phone }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Content Section -->
                    <div class="mb-10">
                        <h4 class="mb-4 font-bold">{{ __('Your content') }}</h4>
                        <ul class="list-disc list-inside text-gray-500">
                            @foreach($keys as $key)
                                <li>{{ $key->key }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Go Back Shopping Button -->
                    <a href="{{ route('front.index') }}"
                       class="block w-full md:w-auto px-8 py-4 bg-red-500 hover:bg-red-700 text-white font-bold uppercase rounded-md text-center transition duration-200">
                        {{ __('Go back Shopping') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
