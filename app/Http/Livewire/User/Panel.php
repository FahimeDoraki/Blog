<?php

namespace App\Http\Livewire\User;

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
    public $editform = false,  $createpost = false, $editpost = false , $activetab='manageposts';

    public  $firstname, $lastname, $email, $image;
    public  $posts ,$post_id, $categories, $title ,$content ,$keywords ,$category;

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED
    ];


    public function render(){
        $this->categories = Category::all();
        $this->posts=Auth::user()->posts;
        return view('livewire.user.panel');
    }

    public function mount(){
        $this->firstname = auth()->user()->firstname;
        $this->lastname = auth()->user()->lastname;
        $this->email = auth()->user()->email;
   
    }

    public function updateprofile(){

        $validatedDate = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required |email:User',
            'image' => 'nullable | image | max:1024',
        ]);

        if( $this->email != auth()->user()->email){
            if(User::where('email', '=', $this->email)->exists()){
                session()->flash('message', 'ایمیل تکراری میباشد');
            }
        }

        $user=auth()->user();
        $img=$this->storeimage($user);
  
        $user->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'image' => $img,
        ]);

        $this->editform = false;
        session()->flash('message', 'اطلاعات با موفقیت ویرایش شد');

       


          
    }

    public function createPost(){
        $validatedDate = $this->validate([
            'title' => 'required | unique:posts| max:255',
            'content' => 'required',
            'image' => 'nullable | image | max:1024',
            'keywords' => 'nullable',
            'category'=> 'required',
        ]);


        $img=$this->storeimage(null);

        Post::create([
            'title'=> $this->title,
            'content' =>$this->content,
            'image'=> $img,
            'keywords' =>$this->keywords,
            'user_id' => Auth::id(),
            'slug' => str_slug_persian($this->title),
            'category_id'=> $this->category
        ]);

        $this->createpost = false;
        session()->flash('message', 'پست شمابا موفقیت ایجاد شد ');


    }

    public function editPost($id){

        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->keywords = $post->keywords;

        $this->updateMode = TRUE;

    }
   
    public function updatePost(){

     
        $validatedDate = $this->validate([
            'title' => 'required | max:255',
            'content' => 'required',
            'image' => 'nullable | image | max:1024',
            'keywords' => 'nullable',
            'category'=> 'required',
        ]);

        $post = Post::find($this->post_id);
        if( $this->title !=  $post->title ){
            if(Post::where('title', '=', $this->title)->exists()){
                session()->flash('message', 'عنوان تکراری میباشد');
            }
        }
  
        $img=$this->storeimage($post);
        
        $post->update([
            'title'=> $this->title,
            'content' =>$this->content,
            'image'=> $img,
            'keywords' =>$this->keywords,
            'user_id' => Auth::id(),
            'slug' => str_slug_persian($this->title),
            'category_id'=> $this->category
        ]);
  
        $this->editpost = false;
        session()->flash('message', 'پست با موفقیت ویرایش شد.');

    }
   
    public function deletePost($id){

        Post::find($id)->delete();
        session()->flash('message', 'پست با موفقیت حذف شد.');

    }
 
    public function trix_value_updated($value){
        $this->content = $value;
    }

    public function storeimage($value){
        if(!empty($this->image)){
            $image= $this->image->store('public/Images');
            $img="/storage/Images/". explode("/",$image)[2];
        }else{
            $user=auth()->user();
            $img = $value->image;
        }
        return $img;
    }

    
}
