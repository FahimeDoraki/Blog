<?php

namespace App\Http\Livewire\Index;

use Livewire\Component;
use App\Models\post;

class Index extends Component
{
    public $sportPost;
    public $cnmaPost;  
    public function mount()
    {
        $this->sportPost= post::where('category_id', 1)->where('active', 1)->orderBy('created_at','DESC')->take(3)->get();
        $this->cnmaPost= post::where('category_id', 2)->where('active', 1)->orderBy('created_at','DESC')->take(3)->get();
    }
    public function render()
    {
        return view('livewire.index.index');
    }
}
