
@section('title')
<?php echo 'پنل'.' '.auth()->user()->firstname ; ?>
@endsection

<div x-data="{ tab: '{{$activetab}}' }" class="userpnl d-flex container my-5 border shadow bg-white rounded  p-3">

    <div class="col-2 p-2 d-flex flex-column align-items-center">
        @if (auth()->user()->image)
        <img src="<?php  echo asset(auth()->user()->image) ?>"  class="card-img-top" alt="img" style="max-width: 400px;">
        @else
        <img src="<?php  echo asset('storage/Images/user.png') ?>" class="card-img-top" alt="img">
        @endif
      
        <nav class="d-flex flex-column align-items-start mt-4 gap-2">
            <a :class="{ 'active': tab === 'profile' }" x-on:click.prevent="tab = 'profile'" href="#">مشخصات</a>
            <a :class="{ 'active': tab === 'manageposts' }" x-on:click.prevent="tab = 'manageposts'" href="#">مدیریت پست ها</a>
            <a :class="{ 'active': tab === 'changepassword' }" x-on:click.prevent="tab = 'changepassword'" href="#">تغییر رمز عبور</a>
        </nav>
    </div>


    <div  class="col-10 p-2  shadow-sm border border-1 rounded p-3">
        <div x-show="tab === 'profile'" class="tabs justify-content-between">
            @if(Session::has('message'))
              <p class="alert alert-warning">{!! Session::get('message') !!}</p>
            @endif
                <div class="prof d-flex flex-column gap-3 m-3">
                    <div class="d-flex">
                        <span>نام:</span>
                        <span>{{auth()->user()->firstname}}</span>
                    </div>
                    <div class="d-flex">
                        <span>نام خانوادگی:</span>
                        <span>{{auth()->user()->lastname}}</span>
                    </div>
                    <div class="d-flex">
                        <span>ایمیل:</span>
                        <span>{{auth()->user()->email}}</span>
                    </div>
                    <div class="d-flex">
                        <span>تصویر:</span>
                        @if (auth()->user()->image)
                        <img src="<?php  echo asset(auth()->user()->image) ?>" alt="img" style="max-width: 400px;">
                        @else
                        <span>-</span>
                        @endif
                      
                    </div>
                </div>
                <div class="my-3 p-2">
                    <button type="button"  wire:click="$toggle('editform')" class="btn mb-2 w-100">ویرایش اطلاعات</button>
           
                    @if ($editform)
                    <div class="frm p-3">
                        <div class="d-flex flex-column align-items-center mb-4">

                            <div class="form-outline flex-fill mb-0">
                              <label class="form-label" for="firstname">نام:</label>
                              <input type="text" id="firstname" wire:model="firstname" class="form-control" autocomplete="off" />
                            </div>
                            @error('firstname')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                          </div>
      
                          <div class="d-flex flex-column align-items-center mb-4">

                            <div class="form-outline flex-fill mb-0">
                              <label class="form-label" for="lastname">نام خانوادگی:</label>
                              <input type="text" id="lastname" wire:model="lastname" class="form-control" autocomplete="off" />
                            </div>
                            @error('lastname')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                          </div>
                       
      
                          <div class="d-flex flex-column align-items-center mb-4">
  
                              <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="email">ایمیل:</label>
                                <input type="email" id="email" wire:model="email" class="form-control" autocomplete="off"/>
                              </div>
                              @error('email')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                            </div>


                            <div class="d-flex flex-column align-items-center mb-4">
    
                                <div class="form-outline flex-fill mb-0">
                                  <label class="form-label" for="image">تصویر:</label>
                                  <input type="file" id="image" wire:model="image" class="form-control" autocomplete="off"/>
                                </div>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                              </div>
                    
      
                        
                            
        
        
                          <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="button" class="btn border-none btn-lg" wire:click="updateprofile">تایید</button>
                          </div>
        
                    </div>
                    @endif
        
                            
                  
                

                </div>
        </div>

        <div x-show="tab === 'manageposts'"  class="tabs">


              <div class="my-3 p-2">
                  <button type="button"  wire:click="$toggle('createpost')" class="btn mb-2 w-100">ایجاد پست جدید</button>
         
                  @if ($createpost)
                  <div class="frm p-3">

                      <div class="d-flex flex-column align-items-start mb-4">
                          <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="title">عنوان پست:</label>
                            <input type="text" id="title" wire:model="title" class="form-control" autocomplete="off" />
                          </div>
                          @error('title')
                          <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>

             
                          <div class="d-flex flex-column align-items-start mb-4">
                            <div class="form-outline flex-fill">
                              <label class="form-label">متن پست:</label>
                              @livewire('trix', ['value' => $content])
                              
                            </div>
                            @error('content')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                          </div>

                       
                          <div class="d-flex flex-column align-items-start mb-4">

                            <div class="form-outline flex-fill mb-0">
                              <label class="form-label" for="image">تصویر:</label>
                              <input type="file" id="image" wire:model="image" class="form-control" autocomplete="off"/>
                            </div>
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                          </div>

                   

                          <div class="d-flex flex-column align-items-start mb-4">
                            <div class="form-outline flex-fill mb-0">
                              <label class="form-label" for="category">دسته بندی:</label>
                              <select class="form-select" aria-label="Default select example"  id="category" wire:model="category">
                                <option value="null" disabled selected>لطفا انتخاب کنید.</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" wire:key="category-{{ $category->id }}">{{$category->name}}</option>
                                @endforeach
            
                              </select>
                            </div>
                            @error('category')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                          </div>


                          <div class="d-flex flex-column align-items-start mb-4">
                            <div class="form-outline flex-fill mb-0">
                              <label class="form-label" for="keywords">کلمات کلیدی :</label>
                              <textarea type="text" id="keywords" wire:model="keywords" class="form-control" autocomplete="off"></textarea>
                            </div>
                            @error('keywords')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                          <span class="hlp d-flex">(اخبار-ورزشی-فوتبال)</span>
                          </div>
                    
      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="button" class="btn border-none btn-lg" wire:click="createPost">ارسال</button>
                        </div>
      
                  </div>
                  @endif
      

              </div>
              @if(Session::has('message'))
              <p class="alert alert-warning">{!! Session::get('message') !!}</p>
            @endif
            <div class="px-2">
              <table class="table  my-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">عنوان پست</th>
                    <th scope="col">تاریخ ایجاد</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">تاریخ انتشار</th>
                    <th scope="col">ویرایش</th>
                    <th scope="col">حذف</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;?>
                  @foreach ($posts as $post)
                  <tr>
                    <th scope="row">{{ $i++}}</th>
                    <td>{{ $post->title}}</td>
                    <td>{{ verta($post->created_at)}}</td>
                    <td>
                      @if ($post->active)
                      <span class="bg-success py-1 px-2 rounded-3">منتشر شد</span>
                      @else
                      <span class="bg-warning py-1 px-2 rounded-3">درانتظار تایید</span>
                      @endif
                    </td>
                    <td>{{ $post->published_at}}</td>
                    <td wire:click="$toggle('editpost')"><button class="btn bg-info  py-1 px-2"  wire:click="editPost({{ $post->id }})">ویرایش</button></td>
                    <td><button class="btn bg-danger py-1 px-2" wire:click="deletePost({{ $post->id }})">حذف</button></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
       


            @if ($editpost)
            <div class="frm p-3 mt-5">

                <div class="d-flex flex-column align-items-start mb-4">
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="title">عنوان پست:</label>
                      <input type="text" id="title" wire:model="title" class="form-control" autocomplete="off" value="title" />
                    </div>
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
                  </div>

       
                    <div class="d-flex flex-column align-items-start mb-4">
                      <div class="form-outline flex-fill">
                        <label class="form-label">متن پست:</label>
                        @livewire('trix', ['value' => $content])
                        
                      </div>
                      @error('content')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                    </div>

                 
                    <div class="d-flex flex-column align-items-start mb-4">

                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="image">تصویر:</label>
                        <input type="file" id="image" wire:model="image" class="form-control" autocomplete="off"/>
                      </div>
                      @error('image')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                    </div>

             

                    <div class="d-flex flex-column align-items-start mb-4">
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="category">دسته بندی:</label>
                        <select class="form-select" aria-label="Default select example"  id="category" wire:model="category">
                          <option value="null" disabled selected>لطفا انتخاب کنید.</option>
                          @foreach ($categories as $category)
                          <option value="{{$category->id}}" wire:key="category-{{ $category->id }}">{{$category->name}}</option>
                          @endforeach
      
                        </select>
                      </div>
                      @error('category')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>


                    <div class="d-flex flex-column align-items-start mb-4">
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="keywords">کلمات کلیدی :</label>
                        <textarea type="text" id="keywords" wire:model="keywords" class="form-control" autocomplete="off"></textarea>
                      </div>
                      @error('keywords')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                    <span class="hlp d-flex">(اخبار-ورزشی-فوتبال)</span>
                    </div>
              

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="button" class="btn border-none btn-lg" wire:click="updatePost">ویرایش</button>
                  </div>

            </div>
            @endif





        </div>
        <div x-show="tab === 'changepassword'">
            <h3>changepassword</h3>

        </div>
    </div>

</div>


