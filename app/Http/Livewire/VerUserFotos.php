<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Foto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class VerUserFotos extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;
    

    public string $orden="desc", $campo="created_at";
    public string $buscar="";
    public bool $openEditar=false;
    public $imagen;
    public Foto $foto;

    protected $listeners=[
        'render',
        'borrar'
    ];
    
    public function render()
    {
        $fotos=Foto::where('user_id', auth()->user()->id)
        ->where('titulo', 'like', "%{$this->buscar}%")
        ->orderBy($this->campo, $this->orden)
        ->paginate(5);

        $categorias=Category::arrayCategory();
        
        return view('dashboard', compact('fotos', 'categorias'));
    }

    protected function rules() :array{
        return [
            'foto.titulo'=>['required', 'string', 'min:3', 'unique:fotos,titulo,'.$this->foto->id],
            'foto.descripcion'=>['required', 'string', 'min:10'],
            'foto.publicada'=>['required', 'in:SI,NO'],
            'foto.category_id'=>['nullable', 'exists:categories,id'],
            'imagen'=>['nullable', 'image', 'max:2048']
        ];
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function ordenar(string $campo): void{
        $this->orden=($this->orden=='desc') ? 'asc' : 'desc';
        $this->campo=$campo;
    }

    public function confirmar(Foto $foto){
        $this->authorize('delete', $foto);
        $this->emit('pedirPermiso', $foto->id);
    }

    public function borrar(Foto $foto){
        Storage::delete($foto->imagen);
        $foto->delete();
        $this->emit('info', 'Foto Eliminda.');

    }

    public function edit(Foto $foto){
        $this->authorize('update' ,$foto);
        $this->foto=$foto;
        $this->openEditar=true;
    }
    public function update(){
        $this->validate();
        $ruta=$this->foto->imagen;
        if($this->imagen){
            $ruta=$this->imagen->store('imagenes');
            Storage::delete($this->foto->imagen);
        }
        $this->foto->update([
            'titulo'=>$this->foto->titulo,
            'descripcion'=>$this->foto->descripcion,
            'category_id'=>$this->foto->category_id,
            'publicada'=>$this->foto->publicada,
            'user_id'=>auth()->user()->id,
            'imagen'=>$ruta
        ]);
        $this->cancelar();
        $this->emit('info', 'Se ha actualizado la foto');
    }
    public function cancelar(){
        $this->reset(['openEditar', 'imagen']);
        $this->foto=new Foto;
    }
    
    public function editarPerfil(Foto $foto){
        $this->authorize('update', $foto);
        $publicada=($foto->publicada=='SI') ? 'NO' : 'SI';
        $foto->update([
            'publicada'=>$publicada,
        ]);
        $mensaje=($publicada=='SI') ? "Se ha hecho visible la foto" : "Ahora la foto NO es visible";
        $this->emit('info', $mensaje);
 

    }
}
