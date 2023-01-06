<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-1 text-gray-900">
                {{ __("Menu Section") }}
            </div>

        </div>
    </div>

    <div class="py-2">

        <div class="flex justify-end m-2 p-2">
            <a href="{{route('admin.menus.create')}}"
               class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Add New Menu</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Menu name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Menu price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Menu Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Menu Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Menu Description
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
                @foreach($menus as $menu)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$i++}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$menu->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$menu->price}}
                        </td>

                        <td class="px-6 py-4">
                            <ol>
                                @php
                                    $idx=1;
                                @endphp
                                @foreach($menu->categories as $category)
                                    <li>
                                        {{$idx++}}. {{$category->name}}
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{\Illuminate\Support\Facades\Storage::url($menu->image)}}"
                                 class="w-16 h-16 rounded" alt="">
                        </td>
                        <td class="px-6 py-4">
                            {{$menu->description}}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex space-x-2">
                                <a href="{{route('admin.menus.edit',$menu->id)}}"
                                   class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-lg">Edit</a>
                                <form action="{{route('admin.menus.destroy',$menu->id)}}"
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
