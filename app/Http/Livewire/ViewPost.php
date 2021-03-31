<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ViewPost extends Component
{
    public $idPost;

    protected $listeners = ['updateIdPost'];

    public function closeView()
    {
        $this->reset(['idPost']);
    }

    public function updateIdPost($idPost)
    {
        $this->idPost = $idPost;
    }

    public function render()
    {
        return view('livewire.view-post',[
            'post' => Post::withTrashed()->where('id', $this->idPost)->first(),
        ]);
    }
}
