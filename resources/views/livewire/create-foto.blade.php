<div>
    <x-button wire:click="$set('openCrear', true)">
        <i class="fas fa-add mr-1"></i> Nueva Foto
    </x-button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Nueva Foto
        </x-slot>
        <x-slot name="content">
            <x-form>
                @wire('defer')
                    <x-form-input name="titulo" label="Titula tu foto" />
                    <x-form-textarea name="descripcion" label="Describe tu foto" />
                    <x-form-select name="category_id" :options="$categorias" label="Selecciona una categría para tu foto" />
                    <x-form-group name="publicada" label="¿Publicarás esta foto?" inline>
                        <x-form-radio name="publicada" value="SI" label="Si, voy a plublicarla" />
                        <x-form-radio name="publicada" value="NO" label="No, prefiero esperar" />
                    </x-form-group>
                @endwire
                <div class="text-gray-700 mt-4">Sube tu foto (hasta 2048Mb)</div>
                <div class="relative h-72 w-full mt-2">
                    @if (!$imagen)
                        <img src="{{ Storage::url('noimage.png') }}" class="w-full h-full object-cover object-center rounded" />
                    @else
                        <img src="{{ $imagen->temporaryUrl() }}" class="w-full h-full object-cover object-center rounded" />
                    @endif
                    <label type="button" for="imc"
                        class="absolute bottom-2 end-2 text-white bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i> SUBIR</label>
                    <input type="file" accept="image/*" name="imagen" class="hidden" id="imc"
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
                    wire:click="guardar()" wire:loading.attr="disabled">
                    <i class="fas fa-save mr-2"></i>GUARDAR
                </button>
                <button class="mr-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>

</div>
