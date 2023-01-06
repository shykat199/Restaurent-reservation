<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-1 text-gray-900">
                {{ __("Category Section") }}
            </div>

        </div>
    </div>

    <div class="py-2">

        <div class="flex justify-end m-2 p-2">
            <a href="{{route('admin.categories.create')}}"
               class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Add New Category</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category Description
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
                @foreach($categories as $category)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$i++}}
                        </td>
                        <td class="px-6 py-4">
                            {{$category->name}}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{\Illuminate\Support\Facades\Storage::url($category->image)}}"
                                 class="w-16 h-16 rounded" alt="">

                        </td>
                        <td class="px-6 py-4">
                            {{$category->description}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">

                                <a href="{{route('admin.categories.edit',$category->id)}}"
                                   class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-lg">Edit</a>

                                <form
                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                    method="POST"
                                    action="{{ route('admin.categories.destroy', $category->id) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                        @endforeach

                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
