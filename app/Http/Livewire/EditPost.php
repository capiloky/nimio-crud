<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Weidner\Goutte\GoutteFacade;
use Intervention\Image\ImageManagerStatic as Image;

class EditPost extends Component
{
    use WithFileUploads;
    public $photo;
    public $descripcion;
    public $titulo;
    public $idPost;
    public $imagen;

    protected $listeners = ['actualizarEdit', 'edit'];
    protected $messages = [
        'photo.required'              =>   'La foto es obligatoria',
        'photo.image'                 =>   'Debes seleccionar un archivo de extensión .jpg o .png',
        'titulo.required'             =>   'El título es obligatorio',
        'descripcion.required'        =>   'La descripción es obligatoria',
    ];

    public function closeEdit()
    {
        $this->reset(['photo', 'imagen', 'titulo', 'descripcion','idPost']);
        $this->emit('wipeContentEdit');
    }

    public function edit($idPost)
    {
        $this->reset(['photo', 'imagen', 'titulo', 'descripcion']);
        $this->idPost = $idPost;
        $post = Post::withTrashed()->where('id', $idPost)->first();
        $this->titulo = $post['titulo'];
        $this->imagen = $post['imagen'];
        $this->descripcion = $post['descripcion'];
        $this->emit('updateDescripcionEdit', $this->descripcion);
    }

    public function actualizarEdit($contenido)
    {
        $this->descripcion = $contenido;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'photo' => 'image|max:1024',
            'titulo'       =>   'required',
        ]);
    }

    public function update($formData)
    {
        $replaces = ['&nbsp;',' ','<p></p>'];
        $aux = preg_replace("/[\r\n|\n|\r]+/", " ", $this->descripcion);
        $aux = str_replace($replaces, '',$aux);

        if($aux == "" || $aux == "<p></p>"){
            session()->flash('descripcion', 'La descripcion es obligatoria.');
        }
        
        if (!empty($this->photo)) {
            $this->validate([
                'photo' => 'image|max:1024',
            ]);
        }

        $this->validate([
            'titulo' => 'required',
        ]);

        Post::withTrashed()->where('id', $this->idPost)->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ]);
        
        if(!empty($this->photo)){
            $rand = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16);
            $image_resize = Image::make($this->photo->getRealPath());
            $image_resize->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image_resize->save(public_path("img/".$rand.'-'.$this->idPost.'.jpeg'), 60, 'jpeg');
            Post::withTrashed()->where('id', $this->idPost)->update([
                'imagen' => $rand.'-'.$this->idPost.'.jpeg',
            ]);
        }

        session()->flash('update', 'Cambios guardados');
        $this->emit('reload');
        $this->emit('reloadPost');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
