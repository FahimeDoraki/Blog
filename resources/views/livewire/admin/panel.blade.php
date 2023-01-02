@section('title')
پنل ادمین
@endsection

<div x-data="{ tab: '{{$activetab}}' }" class="adminpnl d-flex container my-5 border shadow bg-white rounded  p-3">

   <div class="col-2 p-2 d-flex flex-column align-items-center">
       @if (auth()->user()->image)
       <img src="<?php  echo asset(auth()->user()->image) ?>"  class="card-img-top" alt="img" style="max-width: 400px;">
       @else
       <img src="<?php  echo asset('storage/Images/user.png') ?>" class="card-img-top" alt="img">
       @endif
     
       <nav class="d-flex flex-column align-items-start mt-4 gap-2">
           <a :class="{ 'active': tab === 'dashboard' }" x-on:click.prevent="tab = 'dashboard'" href="#">داشبورد</a>
           <a :class="{ 'active': tab === 'users' }" x-on:click.prevent="tab = 'users'" href="#">کاربران</a>
           <a :class="{ 'active': tab === 'posts' }" x-on:click.prevent="tab = 'posts'" href="#">پست ها</a>
           <a :class="{ 'active': tab === 'categories' }" x-on:click.prevent="tab = 'categories'" href="#">دسته بندی ها</a>
       </nav>
   </div>


   <div  class="col-10 p-2  shadow-sm border border-1 rounded p-3">
       <div x-show="tab === 'dashboard'" class="tabs">
        <h3>dashboard</h3>
       </div>

       <div x-show="tab === 'users'" class="tabs">
        <table class="table  my-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">نام کاربر</th>
                <th scope="col">ایمیل</th>
                <th scope="col">پست فعال</th>
                <th scope="col">پست غیرفعال</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;?>
              @foreach ($users as $user)
              <tr>
                <th scope="row">{{ $i++}}</th>
                <td>{{ $user->firstname .' '. $user->lastname}}</td>
                <td>{{ $user->email}}</td>
                <td>
                   {{$user->posts->where('active', '=', '1')->count() }}
                </td>
                <td> {{$user->posts->where('active', '=', '0')->count()}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
       </div>
       <div x-show="tab === 'posts'" class="tabs">
        <div class="my-3 p-2">
            <button type="button"  wire:click="$toggle('publishPost')" class="btn mb-2 w-100">انتشار پست جدید</button>
   
            @if ($publishPost)
            <table class="table toggletble  my-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">عنوان پست</th>
                    <th scope="col">عملیات</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;?>
                  @foreach ($posts->where('active','0')->where('deleted_at', null) as $post)
                  <tr>
                    <th scope="row">{{ $i++}}</th>
                    <td>{{ $post->title}}</td>
                
                    <td> 
                        <button type="button" class="btn bg-info py-1 px-2 rounded-3 border-none btn-lg" wire:click="publishPost({{$post->id}})">انتشار</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            @endif


        </div>
        <table class="table  my-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">عنوان پست</th>
                <th scope="col">دسته بندی</th>
                <th scope="col">کاربر</th>
                <th scope="col">تاریخ ایجاد</th>
                <th scope="col">وضعیت</th>
                <th scope="col">عملیات</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;?>
              @foreach ($posts as $post)
              <tr>
                <th scope="row">{{ $i++}}</th>
                <td>{{ $post->title}}</td>
                <td>{{ $post->category->name}}</td>
                <td>{{ $post->user->firstname.' '.$post->user->lastname}}</td>
                <td>{{  verta($post->created_at) }}</td>
                <td> 
                    @if(!empty($post->deleted_at))
                        <span  class="bg-warning py-1 px-2 rounded-3">حذف شده</span>
                    @else
                        @if($post->active == '1')
                        <span  class="bg-success py-1 px-2 rounded-3">منتشر شده</span>
                        @elseif($post->active == '0')
                        <span  class="bg-warning py-1 px-2 rounded-3">در انتظار انتشار</span>
                        @endif
                    @endif
                </td>
                <td>
                    @if(!empty($post->deleted_at))
                    <button type="button" class="btn bg-info py-1 px-2 rounded-3 border-none btn-lg" wire:click="restorePost({{$post->id}})">بازگرداندن</button>
                    @else
                        <button type="button" class="btn bg-danger py-1 px-2 rounded-3 border-none btn-lg" wire:click="deletePost({{$post->id}})">حذف</button>
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>




       </div>
       <div x-show="tab === 'categories'" class="tabs">
        <div class="my-3 p-2">
            <button type="button"  wire:click="$toggle('createcategory')" class="btn mb-2 w-100">ایجاد دسته بندی جدید</button>
   
            @if ($createcategory)
            <div class="frm p-3">

                <div class="d-flex flex-column align-items-start mb-4">
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="name">عنوان دسته بندی:</label>
                      <input type="text" id="name" wire:model="name" class="form-control" autocomplete="off" />
                    </div>
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
                  </div>


                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="button" class="btn border-none btn-lg" wire:click="createcategory">ایجاد</button>
                  </div>

            </div>
            @endif


        </div>
        @if(Session::has('message'))
            <p class="alert alert-warning">{!! Session::get('message') !!}</p>
        @endif
        <table class="table  my-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام دسته بندی</th>
                <th scope="col">تعداد پست</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;?>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{ $i++}}</th>
                <td>{{ $category->name}}</td>
                <td>{{ $category->posts->count()}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
   </div>

</div>


