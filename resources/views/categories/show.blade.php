<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        @foreach($category->menus as $menu)
            <div class="grid lg:grid-cols-4 gap-y-6">
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{\Illuminate\Support\Facades\Storage::url($menu->image)}}"
                         alt="Image"/>

                    <div class="px-6 py-4 hover: 1 px border-blue-300">
                        <div class="flex mb-2">
                            <span
                                class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">{{$category->name}}</span>
                        </div>
                        <h4 class="mb-3 text-xl font-semi-bold tracking-tight text-green-600 hover:text-green-400 uppercase">{{$menu->name}}</h4>

                        <h4 class="leading-normal text-gray-500 ">
                            {{$menu->description}}
                        </h4>
                    </div>
                    <div class="flex items-center justify-between pb-3 ml-4">
                        <span class="text-xl text-green-600 ml-2">${{$menu->price}}</span>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-guest-layout>
