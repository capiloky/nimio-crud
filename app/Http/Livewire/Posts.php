<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $idPost;
    public $reload;
    public bool $check = false;

    protected $listeners = ['deleteCheck', 'restoreCheck', 'reloadPost'];

    public function reloadPost()
    {
        $this->reload = true;
    }

    public function check()
    {
        $this->check = true;
        $this->emit('addKey', $this->idPost);
    }

    public function unCheck()
    {
        $this->check = false;
        $this->emit('removeKey', $this->idPost);
    }

    public function deleteCheck()
    {
        if ($this->check) {
            Post::where('id', $this->idPost)->delete();
            $this->check = false;
        }
    }

    public function restoreCheck()
    {
        if ($this->check) {
            Post::onlyTrashed()->where('id', $this->idPost)->restore();
            $this->check = false;
        }
    }

    public function delete()
    {
        Post::where('id', $this->idPost)->delete();
        $this->check = false;
    }

    public function forceDelete()
    {
        Post::onlyTrashed()->where('id', $this->idPost)->forceDelete();
        $this->emit('reload');
        $this->check = false;
    }
    
    public function restore()
    {
        Post::onlyTrashed()->where('id', $this->idPost)->restore();
        $this->check = false;
    }

    public function mount($idPost)
    {
        $this->idPost = $idPost;
    }
    
    public function render()
    {
        return view('livewire.posts',[
            'post' => Post::withTrashed()->where('id',$this->idPost)->get(),
        ]);
    }
}
