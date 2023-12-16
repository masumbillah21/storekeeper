<x-app-layout title="Sales">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(Session::has('status'))
                    @if(Session::get('status') == 'success')
                        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-bold">Info: </span> {{ Session::get('message') }}
                        </div>
                    @else 
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-bold">Info: </span> {{ Session::get('message') }}
                        </div>
                    @endif
                @endif
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    SL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($products) && count($products) > 0)
                                @foreach($products as $product)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{asset($product->product_image)}}" alt="{{$product->product_name}}" width="50">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$product->product_name}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$product->product_desc}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$product->product_stock}}
                                        </td>
                                        <td class="px-6 py-4">
                                            Tk. {{number_format($product->product_price, 2)}}
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                            <x-primary-button
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-product-sale-{{$product->id}}')"
                                            >{{ __('Sale') }}</x-primary-button>

                                            <x-modal name="confirm-product-sale-{{$product->id}}" :show="$errors->has('product_stock')" focusable>
                                                <form method="post" action="{{ route('sale.update', $product->id) }}" class="p-6">
                                                    @csrf
                                                    @method('patch')

                                                    <!-- Product Qyt -->
                                                    <div class="mb-3">
                                                        <x-input-label for="product-qyt" :value="__('Product Qyt *')" />
                                                        <x-text-input id="product-qyt" class="block mt-1 w-full" type="number" min="1" name="product_stock" required/>
                                                        <x-input-error :messages="$errors->get('product_stock')" class="mt-2" />
                                                    </div>
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Sale Product') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td colspan="7" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No product found.
                                </th>
                            </tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
