<x-self.uno>
    <!-- component -->
    <div class="flex gap-4 mb-5">
        <x-input placeholder="Buscar..." wire:model="buscar" class="flex-1" />
        @livewire('create-foto')
    </div>
    @if ($fotos->count())
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 cursor-pointer" wire:click="ordenar('titulo')">
                            <i class="fas fa-sort"></i> Título
                        </th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 cursor-pointer" wire:click="ordenar('publicada')">
                            <i class="fas fa-sort"></i> Publicada
                        </th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 cursor-pointer" wire:click="ordenar('category_id')">
                            <i class="fas fa-sort"></i> Categoría
                        </th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 cursor-pointer" wire:click="ordenar('created_at')">
                            <i class="fas fa-sort"></i> Fecha
                        </th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                    @foreach ($fotos as $item)
                        <tr class="hover:bg-gray-50">
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="h-10 w-10 hover:scale-150">
                                    <img class="h-full w-full rounded object-cover object-center"
                                        src="{{ Storage::url($item->imagen) }}" alt="" />

                                </div>
                                <div class="text-sm justify-items-center">
                                    <div class="font-medium text-gray-700">{{ $item->titulo }}</div>

                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <span wire:click="editarPerfil({{ $item->id }})" @class([
                                    'border-2 border-gray-300 w-3/4 inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold cursor-pointer',
                                    'bg-green-50 text-green-600' => $item->publicada == 'SI',
                                    'bg-red-50 text-red-600' => $item->publicada == 'NO',
                                ])>
                                    <span @class([
                                        'h-1.5 w-1.5 rounded-full',
                                        'bg-green-600' => $item->publicada == 'SI',
                                        'bg-red-600' => $item->publicada == 'NO',
                                    ])></span>
                                    {{ $item->publicada }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-center w-3/4 rounded-full  px-2 py-1 text-xs font-semibold text-gray-100"
                                    style="background-color:{{ $item->category->color }}">
                                    {{ $item->category->nombre }}
                            </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-4">
                                    <a href="{{ route('foto.detalle', $item) }}"><i class="fas fa-info text-blue-600 hover:text-xl"></i></a>
                                    <button wire:click="edit({{ $item->id }})"><i class="fas fa-pencil text-yellow-500 hover:text-xl"></i></button>
                                    <button wire:click="confirmar({{ $item->id }})"><i class="fas fa-trash text-red-700 hover:text-xl"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
        <div class="mt-4">
            {{ $fotos->links() }}
        </div>
    @else
        <p class="px-2 py-2 mt-2 rounded-xl shadow-xl font-semibold bg-gray-200">
            No se encontró ninguna foto o aún no ha subido ninguna
        </p>
    @endif
    <!-- -------------------------------------------------------- MODAL PARA EDITAR -------------------------------------------------------------- -->
    @if($foto)
    <x-dialog-modal wire:model="openEditar">
        <x-slot name="title">
            Editar Foto
        </x-slot>
        <x-slot name="content">
            <x-form>
                @wire($foto, 'defer')
                    <x-form-input name="foto.titulo" label="Titula tu foto" />
                    <x-form-textarea rows='4' name="foto.descripcion" label="Describe tu foto" />
                    <x-form-select name="foto.category_id" :options="$categorias" label="Selecciona una categría para tu foto" />
                    <x-form-group name="publicada" label="¿Publicarás esta foto?" inline>
                        <x-form-radio name="foto.publicada" value="SI" label="Si, voy a plublicarla" />
                        <x-form-radio name="foto.publicada" value="NO" label="No, prefiero esperar" />
                    </x-form-group>
                @endwire
                <div class="text-gray-700 mt-4">Sube tu foto (hasta 2048Mb)</div>
                <div class="relative h-72 w-full mt-2">
                    @if (!$imagen)
                        <img src="{{ Storage::url($foto->imagen) }}" class="w-full h-full object-cover object-center rounded" />
                    @else
                        <img src="{{ $imagen->temporaryUrl() }}" class="w-full h-full object-cover object-center rounded" />
                    @endif
                    <label type="button" for="ime"
                        class="absolute bottom-2 end-2 text-white bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i> SUBIR</label>
                    <input type="file" accept="image/*" name="imagen" class="hidden" id="ime"
                        wire:model.defer="imagen" />
                </div>
                @error('imagen')
                <p class="text-red-600 text-sm italic">{{ $message }}</p>
                @enderror

            </x-form>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="update" wire:loading.attr="disabled">
                    <i class="fas fa-edit mr-2"></i>EDITAR
                </button>
                <button class="mr-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif
</x-self.uno>
