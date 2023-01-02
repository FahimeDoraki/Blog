@section('title')
<?php  echo $post->title; ?>
@endsection
<div class="showpost row m-0 my-4 justify-content-center gap-4">

    <div class="rightside col-3 shadow bg-white">
        <div class="my-2 d-flex flex-column justify-content-center align-items-center p-1 gap-3">
            @if (empty($post->user->image))
            <img src="<?php  echo asset('storage/Images/user.png') ?>" alt="">
            @else
            <img src="<?php  echo asset($post->user->image) ?>" alt="">
            @endif
          
            <div class="d-flex flex-column align-items-center">
                <span class="fw-bold">نویسنده:</span>
                <a href="#" class="tx">{{$post->user->firstname.' '.$post->user->lastname}}</a>
            </div>
            <div class="d-flex flex-column align-items-center">
                <span class="fw-bold">دسته بندی:</span>
                <a href="#" class="tx">{{$post->category->name}}</a>
            </div>
            <div class="d-flex flex-column align-items-center">
                <span  class="fw-bold">تاریخ انتشار:</span>
                <span class="tx">{{verta($post->created_at)->format('d F Y')}}</span>
            </div>
            <div class="border-top w-100"></div>
            <div class="d-flex">
                @foreach (explode("-", $post->keywords) as $key)
                   <a href="#" class="keywords mx-1 px-1 border-2">{{$key}}</a>
                @endforeach
            </div>
        </div>
    </div>

        <div class="col-8 d-flex flex-column align-items-center shadow bg-white">
            <div class="my-5 d-flex flex-column justify-content-center align-items-center w-100 p-1 gap-4">
                <img src="<?php  echo asset($post->image) ?>" alt="">
                <h2 class="card-title">{{$post->title}}</h2>
            </div>
            <div class="w-75">
                <p class="card-text">{!!$post->content!!}</p>
            </div>
            <div class="border-top w-75 py-2 mt-4 d-flex justify-content-end">
                    <a href="#"><img src="https://img.icons8.com/material-outlined/24/null/instagram-new--v1.png"/></a>
                    <a href="#"><img src="https://img.icons8.com/material-outlined/24/null/linkedin--v1.png"/></a>
                    <a href="#"><img src="https://img.icons8.com/material-outlined/24/null/twitter.png"/></a>
            </div>
        </div>

</div>

