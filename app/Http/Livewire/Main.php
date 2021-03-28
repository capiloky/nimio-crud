<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\LoadPosts;

class Main extends Component
{
    public $reload;
    public $q;
    public $perPage = 15;
    public $keys = [];
    public $ids = [];
    public $order = 'DESC';
    public $orderBy = "id";

    use WithPagination;

    protected $listeners = ['reload'];

    public function checkAll()
    {
        $this->reset(['keys']);
        foreach ($this->ids as $id) {
            array_push($this->keys, $id);
        }
    }

    public function unCheckAll()
    {
        $this->reset(['keys']);
    }

    public function check($idPost)
    {
        if (($key = array_search($idPost, $this->keys)) === false) {
            array_push($this->keys, $idPost);
        }
    }

    public function unCheck($idPost)
    {
        if (($key = array_search($idPost, $this->keys)) !== false) {
            unset($this->keys[$key]);
        }
    }

    public function deleteCheck()
    {
        foreach ($this->keys as $id) {
            Post::where('id', $id)->delete();
        }
        $this->reset(['keys']);
    }

    public function restoreCheck()
    {
        foreach ($this->keys as $id) {
            Post::onlyTrashed()->where('id', $id)->restore();
        }
        $this->reset(['keys']);
    }

    public function delete($idPost)
    {
        Post::where('id', $idPost)->delete();
        $this->check = false;
    }

    public function forceDelete($idPost)
    {
        Post::onlyTrashed()->where('id', $idPost)->forceDelete();
        $this->check = false;
    }
    
    public function restore($idPost)
    {
        Post::onlyTrashed()->where('id', $idPost)->restore();
        $this->check = false;
    }
    
    public function order($orderBy,$order)
    {
        $this->orderBy = $orderBy;
        $this->order = $order;
        $this->reset(['keys']);
    }

    public function reload()
    {
        $this->reload = true;
        $this->reset(['keys']);
    }

    public function updatePerPage($perPage)
    {
        $this->page = 1;
        $this->perPage = $perPage;
        $this->reset(['keys']);
    }

    public function render()
    {
        $posts = Post::query();
        $posts = $posts->withTrashed();
        if(!empty($this->q)){
            $compare = explode(":", $this->q);
            if (count($compare) > 1) {
                switch ($compare[0]) {
                    case 'id':
                        $words = explode(" ", $compare[1]);
                        $posts = $posts->where( function ($q) use($words){
                            foreach($words as $word){
                                $q->Where(function ($q) use($word){
                                    $q->where('id', 'like', $word);
                                });
                            }
                        });
                        break;
                    case 'tl':
                        $words = explode(" ", $compare[1]);
                        $posts = $posts->where( function ($q) use($words){
                            foreach($words as $word){
                                $q->Where(function ($q) use($word){
                                    $q->where('titulo', 'like', '%'.$word.'%');
                                });
                            }
                        });
                        break;
                    case 'ds':
                        $words = explode(" ", $compare[1]);
                        $posts = $posts->where( function ($q) use($words){
                            foreach($words as $word){
                                $q->Where(function ($q) use($word){
                                    $q->where('descripcion', 'like', '%'.$word.'%');
                                });
                            }
                        });
                        break;
                    
                    default:
                        $words = explode(" ", $this->q);
                        $posts = $posts->where( function ($q) use($words){
                            foreach($words as $word){
                                $q->Where(function ($q) use($word){
                                    $q->where('titulo', 'like', '%'.$word.'%')->orWhere('descripcion', 'like', '%'.$word.'%')->orWhere('id', 'like', $word);
                                });
                            }
                        });
                        break;
                }
            }else{
                $words = explode(" ", $this->q);
                $posts = $posts->where( function ($q) use($words){
                    foreach($words as $word){
                        $q->Where(function ($q) use($word){
                            $q->where('titulo', 'like', '%'.$word.'%')->orWhere('descripcion', 'like', '%'.$word.'%')->orWhere('id', 'like', $word);
                        });
                    }
                });
            }
        }
        $posts = $posts->orderBy($this->orderBy, $this->order);
        $posts = $posts->paginate($this->perPage, ['*'], null, $this->page);
        $this->reset(['ids']);
        foreach ($posts as $post) {
            array_push($this->ids,$post->id);
        }
        return view('livewire.main',[
            'posts' => $posts,
        ]);
    }
}
