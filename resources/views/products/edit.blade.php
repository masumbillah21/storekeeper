<x-app-layout title="Products">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ empty($product) ? __('Create Product') : __('Update Product')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-link-button :href="route('product.index')" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Back</x-link-button>
        </div>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
            
            <div class="bg-white overflow-hidden p-11 shadow-sm sm:rounded-lg">
                <form action="{{ empty($product) ? route('product.store') : route('product.update', $product->id) }}" method="POSt" enctype="multipart/form-data">
                    @csrf

                    @if(!empty($product))
                        @method('PATCH')
                        <!-- <input name="_method" type="hidden" value="PATCH"> -->
                        <x-text-input type="hidden" name="product_id"  value="{{ $product->id }}" />
                        <x-text-input type="hidden" name="product_old_image"  value="{{ $product->product_image }}" />
                    @endif
                    
                    <!-- Product Name -->
                    <div class="mb-3">
                        <x-input-label for="product-name" :value="__('Product Name *')" />
                        <x-text-input id="product-name" class="block mt-1 w-full" type="text" name="product_name" value="{{ empty($product) ? '' : $product->product_name }}"  required/>
                        <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <x-input-label for="product-desc" :value="__('Product Description *')" />
                        <x-text-input id="product-desc" class="block mt-1 w-full" type="text" name="product_desc" value="{{ empty($product) ? '' : $product->product_desc }}" required/>
                        <x-input-error :messages="$errors->get('product_desc')" class="mt-2" />
                    </div>

                    <!-- Product Price -->
                    <div class="mb-3">
                        <x-input-label for="product-price" :value="__('Product Price *')" />
                        <x-text-input id="product-price" class="block mt-1 w-full" type="number" min="0" step="0.01" name="product_price" value="{{ empty($product) ? '' : $product->product_price }}" required />
                        <x-input-error :messages="$errors->get('product_price')" class="mt-2" />
                    </div>

                    <!-- Product Stock -->
                    <div class="mb-3">
                        <x-input-label for="product-qyt" :value="__('Product Stock *')" />
                        <x-text-input id="product-qyt" class="block mt-1 w-full" type="number" min="1" name="product_stock" value="{{ empty($product) ? '' : $product->product_stock }}" required/>
                        <x-input-error :messages="$errors->get('product_stock')" class="mt-2" />
                    </div>

                    @if(!empty($product))
                    <div class="mb-3">
                        <img src="{{asset($product->product_image)}}" alt="{{$product->product_name}}" width="100">
                    </div>
                    @endif

                    <!-- Product Image -->
                    <div class="mb-3">
                        <x-input-label for="product-image" :value="__('Product Image *')" />
                        <x-text-input id="product-image" class="block mt-1 w-full" type="file" name="product_image"/>
                        <x-input-error :messages="$errors->get('product_image')" class="mt-2" />
                    </div>
                    <x-primary-button type="submt">
                        {{ empty($product) ? __('Create Product') : __('Update Product')}}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
