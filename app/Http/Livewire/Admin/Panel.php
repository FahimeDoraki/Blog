<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Trix;
use Illuminate\Support\Str;




class Panel extends Component
{


    use WithFileUploads;
    public  $activetab='posts';
    public $createcategory = false , $publishPost = false;

    public $users, $posts, $categories;

    public function render(){
        $this->users = User::all();
        $this->posts = Post::withTrashed()->get();
        $this->categories = Category::all();
        return view('livewire.admin.panel');
    }

    public function mount(){
     
    }

    public function publishPost($id){

        $post = Post::find($id);
        $post->update([
            'active' => 1,
            'published_at'=> date('Y-m-d H:i:s'),
        ]);
  
    }

    public function deletePost($id){

        Post::find($id)->delete();
        session()->flash('message', 'پست با موفقیت حذف شد.');

    }

    public function restorePost($id){

        Post::withTrashed()->find($id)->restore();
        session()->flash('message', 'پست با موفقیت حذف شد.');

    }


}
