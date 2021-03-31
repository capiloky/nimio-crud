<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Weidner\Goutte\GoutteFacade;
use Goutte\Client;
use DOMXPath;

class Form extends Component
{
    use WithFileUploads;
    public $photo;
    public $autoImage;
    public $descripcion;
    public $titulo;
    public $link;
    public $select = 1;
    public $selectFormat = "texto enriquecido";

    protected $listeners = ['actualizar'];
    protected $messages = [
        'photo.required'              =>   'La foto es obligatoria',
        'photo.image'                 =>   'Debes seleccionar un archivo de extensión .jpg o .png',
        'titulo.required'             =>   'El título es obligatorio',
        'descripcion.required'        =>   'La descripción es obligatoria',
    ];

    public function updateFormat($format)
    {
        $this->selectFormat = $format;
        $this->updateLink();
    }

    public function clear()
    {
        $this->reset(['photo', 'autoImage', 'titulo', 'descripcion', 'link']);
        $this->emit('wipeContent');
    }

    public function actualizar($contenido)
    {
        $this->descripcion = $contenido;
    }

    public function select($select)
    {
        $this->select = $select;
    }

    public function updateLink()
    {
        if (!empty($this->link)) {
            try {
                $crawler = GoutteFacade::request('GET', $this->link);
                if ($this->selectFormat == 'texto plano') {
                    if (!empty($crawler->filter('.mw-parser-output > p')->eq(0)->text())) {
                        $parrafo = $crawler->filter('.mw-parser-output > p')->eq(0)->text();
                    }elseif(!empty($crawler->filter('.mw-parser-output > p')->eq(1)->text())){
                        $parrafo = $crawler->filter('.mw-parser-output > p')->eq(1)->text();
                    }else{
                        $parrafo = $crawler->filter('.mw-parser-output > p')->eq(2)->text();
                    }
                    preg_match_all('/[+[0-9]+]/', $parrafo, $salida);
                    for ($i=0; $i < count($salida[0]); $i++) {
                        $parrafo = str_replace($salida[0][$i], "", $parrafo);
                    }
                }else{
                    if (!empty($crawler->filter('.mw-parser-output > p')->eq(0)->text())) {
                        $parrafo = $crawler->filter('.mw-parser-output > p')->eq(0)->html();
                    }elseif(!empty($crawler->filter('.mw-parser-output > p')->eq(1)->text())){
                        $parrafo = $crawler->filter('.mw-parser-output > p')->eq(1)->html();
                    }else{
                        $parrafo = $crawler->filter('.mw-parser-output > p')->eq(2)->html();
                    }
                    $patterndocumentLinks ='/<a\s+(?:[^"\'>]+|"[^"]*"|\'[^\']*\')*href=("[^"]+"|\'[^\']+\'|[^<>\s]+)/i'; 
                    preg_match_all($patterndocumentLinks, $parrafo, $salida, PREG_PATTERN_ORDER);
                    $hrefs = [];
                    for ($i=0; $i < count($salida[1]); $i++) {
                        $prepend = "https://es.wikipedia.org";
                        $href = str_replace('"', "",$salida[1][$i]);
                        if(substr($href, 0, 1) == "#") {
                            $string_aux = $this->link.$href;
                        }elseif(substr($href, 0, 1) == "/"){
                            $string_aux = $prepend.$href;
                        }else{
                            $string_aux = $href;
                        }
                        $hrefs += [$href => $string_aux];
                    }
                    foreach ($hrefs as $key => $value) {
                        $parrafo = str_replace($key, $value, $parrafo);
                    }
                }
                $this->titulo = $crawler->filter('#firstHeading')->eq(0)->text();
                try {
                    $image = $crawler->filter('.image img')->eq(0)->attr('src');
                    $this->autoImage = $image;
                } catch (\Throwable $th) {
                    $this->autoImage = asset('img/wikipedia.png');
                }
                $this->reset(['photo']);
                $this->emit('updateDescripcion', $parrafo);
            } catch (\Throwable $th) {
                session()->flash('warning', 'Error inesperado');
            }
        }
    }

    public function updated($propertyName)
    {
        if (!empty($this->photo)) {
            $this->reset(['autoImage']);
        }

        $this->validateOnly($propertyName, [
            'photo' => 'image|max:1024',
            'titulo'       =>   'required',
        ]);
    }

    public function save($formData)
    {
        $replaces = ['&nbsp;',' ','<p></p>'];
        $aux = preg_replace("/[\r\n|\n|\r]+/", " ", $this->descripcion);
        $aux = str_replace($replaces, '',$aux);

        if($aux == "" || $aux == "<p></p>"){
            session()->flash('descripcion', 'La descripcion es obligatoria.');
        }

        if ($this->select == 2) {
            $this->validate([
                'link' => 'required',
            ]);
        }
        
        if (empty($this->autoImage)) {
            $this->validate([
                'photo' => 'required|image|max:1024',
            ]);
        }

        $this->validate([
            'titulo'       =>   'required',
        ]);

        $post = new Post();
        $post->titulo = $this->titulo;
        $post->descripcion = $this->descripcion;
        $post->save();
        $rand = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16);
        if (!empty($this->autoImage)) {
            if ($this->autoImage == asset('img/wikipedia.png')) {
                Post::where('id', $post->id)->update(['imagen' => 'wikipedia.png']);
            }else{
                file_put_contents(public_path("img/".$rand.'-'.$post->id.'.jpeg'), file_get_contents('https:'.$this->autoImage));
                Post::where('id', $post->id)->update(['imagen' => $rand.'-'.$post->id.'.jpeg']);
            }
        }elseif(!empty($this->photo)){
            $image_resize = Image::make($this->photo->getRealPath());
            $image_resize->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });       
            $image_resize->save(public_path("img/".$rand.'-'.$post->id.'.jpeg'), 60, 'jpeg');
            Post::where('id', $post->id)->update(['imagen' => $rand.'-'.$post->id.'.jpeg']);
        }else{
            Post::where('id', $post->id)->update(['imagen' => 'wikipedia.png']);
        }

        session()->flash('create', 'Post subido correctamente');
        $this->clear();
        $this->emit('reload');
    }

    public function render()
    {
        return view('livewire.form');
    }
}
