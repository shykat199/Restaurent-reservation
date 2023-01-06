<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-1 text-gray-900">
                {{ __("Reservation Section") }}
            </div>

        </div>
    </div>

    <div class="py-2">

        <div class="flex justify-end m-2 p-2">
            <a href="{{route('admin.reservations.create')}}"
               class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Add New Reservation</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Guest Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reservation Date/Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Guest
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Table Number
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

                @foreach($reservations as $reservation)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$i++}}
                        </th>
                        <td class="px-6 py-4">
                            {{$reservation->first_name}} {{$reservation->last_name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$reservation->email}}
                        </td>
                        <td class="px-6 py-4">
                            {{$reservation->tel_number}}
                        </td>
                        <td class="px-6 py-4">
                            {{$reservation->res_date}}
                        </td>
                        <td class="px-6 py-4">
                            {{$reservation->guest_number}}
                        </td>
                        <td class="px-6 py-4">


                            {{$reservation->tables->name ?? 'None'}}
                        </td>


                        <td class="px-6 py-4 text-right">
                            <div class="flex space-x-2">
                                <a href="{{route('admin.reservations.edit',$reservation->id)}}"
                                   class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-lg">Edit</a>
                                <form action="{{route('admin.reservations.destroy',$reservation->id)}}"
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
