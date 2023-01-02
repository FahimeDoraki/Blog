<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use App\Models\post as modelpost;

class Post extends Component
{

    public $post;

    public function mount($slug){
        $this->post = modelpost::where('slug', $slug)->first();
    }

    public function render(){
       return view('livewire.post.post');
    }

    
}
