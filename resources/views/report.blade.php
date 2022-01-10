<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-48 float-left">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Reports for {{ Auth::user()->name }}.
                </div>
                <table class="table w-full mb-8">
                    <caption>
                        <u>Monthly Reports</u>
                    </caption>
                    <thead>
                        <tr>
                            <th width="30%">Day</th>
                            <th width="30%"># of Trackings</th>
                            <th width="30%">Total Tracked Duration</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="30%">Day</th>
                            <th width="30%"># of Trackings</th>
                            <th width="30%">Total Tracked Duration</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($itemsMonthly as $item)
                            <tr>
                                <td class="text-center">
                                    {{ (new \Carbon\Carbon($item->month))->format('M, Y') }}
                                </td>
                                <td class="text-center">
                                    {{ $item->count }}
                                </td>
                                <td class="text-center">
                                    {{ $item->duration }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="table w-full mt-8">
                    <caption>
                        <u>Daily Reports</u>
                    </caption>
                    <thead>
                        <tr>
                            <th width="30%">Day</th>
                            <th width="30%"># of Trackings</th>
                            <th width="30%">Total Tracked Duration</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="30%">Day</th>
                            <th width="30%"># of Trackings</th>
                            <th width="30%">Total Tracked Duration</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($itemsDaily as $item)
                            <tr>
                                <td class="text-center">
                                    {{ (new \Carbon\Carbon($item->day))->toDateString() }}
                                </td>
                                <td class="text-center">
                                    {{ $item->count }}
                                </td>
                                <td class="text-center">
                                    {{ $item->duration }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
