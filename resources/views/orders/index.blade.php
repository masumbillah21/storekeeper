<x-app-layout title="Sales History">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-link-button :href="route('order.index')" :active="$id == 'all'">All</x-link-button>
            <x-link-button :href="route('order.show', 'today')" :active="$id == 'today'">Today Sale</x-link-button>
            <x-link-button :href="route('order.show', 'yesterday')" :active="$id == 'yesterday'">Yesterday Sale</x-link-button>
            <x-link-button :href="route('order.show', 'this-month')" :active="$id == 'this-month'">This Month Sale</x-link-button>
            <x-link-button :href="route('order.show', 'last-month')" :active="$id == 'last-month'">Last Month Sale</x-link-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-9">
                
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
                                    Qty
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Unit Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($orders) && count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{asset($order->product_image)}}" alt="{{$order->product_name}}" width="50">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$order->product_name}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$order->product_desc}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$order->qyt}}
                                        </td>
                                        <td class="px-6 py-4">
                                            Tk. {{number_format($order->unit_price, 2)}}
                                        </td>
                                        <td class="px-6 py-4">
                                            Tk. {{number_format($order->unit_price * $order->qyt, 2)}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
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
