<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-48 float-left">
            {{ __('Time Tracking') }}
        </h2>
        @if($items->first()->ended_at)
            <form action={{ route('timetable.store')  }} method="POST" class="w-48 float-right">
                {{ csrf_field()  }}
                    <x-button type="submit" name="started_at">Start Tracking</x-button>
            </form>
        @else
            <form action={{ route('timetable.update', $items->first()->id)  }} method="POST" class="w-48 float-right">
                {{ csrf_field()  }}
                <input type="hidden" name="_method" value="PUT"/>
                <x-button type="submit" name="ended_at">Stop Tracking</x-button>
            </form>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ count($items) }} trackings found for {{ Auth::user()->name }}.
                </div>
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th width="30%">Started At</th>
                            <th width="30%">Ended At</th>
                            <th width="30%">Duration</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="30%">Started At</th>
                            <th width="30%">Ended At</th>
                            <th width="30%">Duration</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td class="text-center">
                                    @if($editedItem && $editedItem->id === $item->id && $editedItem->started_at)
                                        <form action={{ route('timetable.update', $editedItem->id)  }} method="POST" class="inline w-auto">
                                            {{ csrf_field()  }}
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="datetime-local" name="started_at" value="{{ $editedItem->started_at->toDateTimeLocalString() }}"/>
                                            <x-button type="submit">Save</x-button>
                                        </form>
                                    @else
                                        {{ $item->started_at  }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($editedItem && $editedItem->id === $item->id && $editedItem->ended_at)
                                        <form action={{ route('timetable.update', $editedItem->id)  }} method="POST" class="inline w-auto">
                                            {{ csrf_field()  }}
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="datetime-local" name="ended_at" value="{{ $editedItem->ended_at->toDateTimeLocalString() }}"/>
                                            <x-button type="submit">Save</x-button>
                                        </form>
                                    @else
                                        {{ $item->ended_at  }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->ended_at ? $item->ended_at->diffForHumans($item->started_at, \Carbon\CarbonInterface::DIFF_ABSOLUTE, false, 4) : 'Still tracking...' }}</td>
                                <td class="text-center">
                                    @if($editedItem && $editedItem->id === $item->id)
                                        <a href="{{ route('timetable.index')  }}">Cancel</a>
                                    @else
                                        <a href="{{ route('timetable.edit', $item->id)  }}">Edit</a>
                                        <form action={{ route('timetable.destroy', $item->id)  }} method="POST" class="inline w-auto">
                                            {{ csrf_field()  }}
                                            <input type="hidden" name="_method" value="DELETE"/>
                                            <a href="{{ route('timetable.edit', $item->id)  }}" onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
