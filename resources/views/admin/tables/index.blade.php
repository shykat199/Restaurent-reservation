<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-1 text-gray-900">
                {{ __("Restaurant Table Section") }}
            </div>

        </div>
    </div>

    <div class="py-2">

        <div class="flex justify-end m-2 p-2">
            <a href="{{route('admin.tables.create')}}"
               class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Add New Table</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Table Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Guest
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Table Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Table Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i=1;
                @endphp

                @foreach($tables as $table)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$i++}}
                        </th>
                        <td class="px-6 py-4">
                            {{$table->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$table->guest_number}}
                        </td>
                        <td class="px-6 py-4">
                            {{$table->location->name}}
                        </td>
                        <td class="px-6 py-4">
                            <span>{{$table->status->name}}</span>
{{--                                                        @if($table->status==='pending')--}}
{{--                                                            <span style="color: mistyrose">{{$table->status->name}}</span>--}}
{{--                                                        @elseif($table->status==='available')--}}
{{--                                                            <span class="text-success">{{$table->status->name}}</span>--}}
{{--                                                        @elseif($table->status==='unavailable')--}}
{{--                                                            <span class="text-secondary">{{$table->status->name}}</span>--}}
{{--                                                        @endif--}}

                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="flex space-x-2">
                                <a href="{{route('admin.tables.edit',$table->id)}}"
                                   class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-lg">Edit</a>
                                <form action="{{route('admin.tables.destroy',$table->id)}}"
                                      class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button>Delete</button>
                                </form>
                            </div>


                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
