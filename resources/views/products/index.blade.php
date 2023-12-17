<x-app-layout title="Products">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-link-button :href="route('product.create')" active="true">Add New</x-link-button>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                    Created Date
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
                                            {{ \Carbon\Carbon::parse($product->created_at)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-link-button :href="route('product.edit', $product->id)" active="true">Edit</x-link-button>
                                            <x-danger-button
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion-{{$product->id}}')"
                                            >{{ __('Delete') }}</x-danger-button>

                                            <x-modal name="confirm-product-deletion-{{$product->id}}" :show="$errors->has('password_'.$product->id)" focusable>
                                                <form method="post" action="{{ route('product.destroy', $product->id) }}" class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Are you sure you want to delete product?') }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ __('Please enter your password to confirm you would like to delete this product.') }}
                                                    </p>

                                                    <div class="mt-6">
                                                        <x-input-label :for="'password_'.$product->id" value="{{ __('Password') }}" class="sr-only" />

                                                        <x-text-input
                                                            :id="'password_'.$product->id"
                                                            :name="'password_'.$product->id"
                                                            type="password"
                                                            class="mt-1 block w-3/4"
                                                            placeholder="{{ __('Password') }}"
                                                        />

                                                        <x-input-error :messages="$errors->get('password_'.$product->id)" class="mt-2" />
                                                    </div>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Delete Product') }}
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
