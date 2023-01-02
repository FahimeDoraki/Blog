<?php

namespace App\Http\Livewire\Index;

use Livewire\Component;

class Post extends Component
{
    public $post;
 
    public function mount($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.index.post');
    }
}
