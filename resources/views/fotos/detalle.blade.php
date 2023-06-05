<x-app-layout>
    <x-self.uno>
        <h3 class="text-2xl font-semibold text-center my-4 text-gray-500">Detalle Foto</h3>
        <div class="max-w-sm rounded overflow-hidden shadow-lg mx-auto">
            <img class="w-full" src="{{ Storage::url($foto->imagen) }}" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $foto->titulo }}</div>
                <p class="text-gray-700 text-base">
                    {{ $foto->descripcion }}
                </p>
            </div>
            <div class="px-6 pt-4">
                Categoría: <span
                    class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-gray-200 mr-2 mb-2"
                    style="background-color:{{ $foto->category->color }}">
                    {{ $foto->category->nombre }}</span>

            </div>
            <div class="px-6 pt-2">
                Fecha Pub: <span class="italic text-sm text-red-600">{{ $foto->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="px-6 pt-4">
                Fecha Act: <span class="italic text-sm text-blue-500">{{ $foto->updated_at->format('d/m/Y') }}</span>
            </div>
            <div class="px-6 pt-2 pb-2">
                <span @class([
                    'border-2 border-gray-300 w-3/4 inline-flex items-center gap-1 rounded-full  px-2 py-1 text-xs font-semibold ',
                    'bg-green-50 text-green-600' => $foto->publicada == 'SI',
                    'bg-red-50 text-red-600' => $foto->publicada == 'NO',
                ])>
                    <span @class([
                        'h-1.5 w-1.5 rounded-full',
                        'bg-green-600' => $foto->publicada == 'SI',
                        'bg-red-600' => $foto->publicada == 'NO',
                    ])></span>
                    {{ $foto->publicada }} está publicada.
                </span>
            </div>
            <div class="flex my-4 justify-center">
                <a href="{{ route('dashboard') }}"
                    class="mr-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark mr-2"></i>Volver
                </a>
            </div>
        </div>
    </x-self.uno>
</x-app-layout>
