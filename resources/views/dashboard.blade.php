<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 text-gray-900">
                    <div class="flex mb-4">
                        <x-sales-summery title="Today" sales="0"/>
                        <x-sales-summery title="Yesterday" sales="0"/>
                        <x-sales-summery title="This Month" sales="0"/>
                        <x-sales-summery title="Last Month" sales="0"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
