<x-app-layout>
    <x-self.uno>
        <h3 class="text-2xl font-semibold text-center my-4 text-gray-500">Últimas Fotos Subidas</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($fotos as $item)
            <article @class([
                'w-full h-72',
                'lg:col-span-2'=>$loop->first
            ]) style="background-image:url('{{ Storage::url($item->imagen) }}'); backgroud-size:cover; resize:both;">
                <div class="flex flex-col justify-around h-full">
                        <div class="text-xl font-semibold my-2 mx-auto">
                            {{ $item->titulo }}
                        </div>
                        <div class="text-md font-semibold my-2 mx-auto">
                            {{ $item->user->name }} &lt;<span class="text-sm italic text-red-600">{{ $item->user->email }}</span>&gt; 
                        </div>
                        <div class="text-sm font-semibold my-2 mx-auto">
                            <span class="px-2 py-2 rounded-xl shadow-xl" style="background-color:{{ $item->category->color }}">{{ $item->category->nombre }}</span>
                        </div>
                </div>
            </article>
            @endforeach
        </div>
        <div class="mt-2">
            {{ $fotos->links() }}
        </div>
    </x-self.uno>
</x-app-layout>