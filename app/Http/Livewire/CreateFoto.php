<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Foto;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateFoto extends Component
{
    use WithFileUploads;
    public $imagen;
    public string $titulo, $descripcion, $publicada, $category_id;
    public bool $openCrear=false;
    
    public function render()
    {
        $categorias=Category::arrayCategory();
        return view('livewire.create-foto', compact('categorias'));
    }

    protected function rules() :array{
        return [
            'titulo'=>['required', 'string', 'min:3', 'unique:fotos,titulo'],
            'descripcion'=>['required', 'string', 'min:10'],
            'publicada'=>['required', 'in:SI,NO'],
            'category_id'=>['required', 'exists:categories,id'],
            'imagen'=>['required', 'image', 'max:2048']
        ];
    }
    public function guardar(){
        $this->validate();
        $ruta=$this->imagen->store('imagenes');

        Foto::create([
            'titulo'=>$this->titulo,
            'descripcion'=>$this->descripcion,
            'category_id'=>$this->category_id,
            'publicada'=>$this->publicada,
            'user_id'=>auth()->user()->id,
            'imagen'=>$ruta
        ]);
        $this->cancelar();
        $this->emit('info', "La foto se ha guardado");
        $this->emitTo('ver-user-fotos', 'render');

    }

    public function cancelar(){
        $this->reset(['imagen']);
        $this->openCrear=false;
    }
}
