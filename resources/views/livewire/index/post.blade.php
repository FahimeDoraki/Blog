


<div class="col-4 d-flex justify-content-center align-items-center p-4">
    <div class="card">
        <img src="<?php  echo asset($post->image) ?>" class="card-img-top" alt="img">
        <div class="card-body">
            <h5>{{$post->title}}</h5>
            <div class="mt-4 mb-3">
                <div class="d-flex">
                <span class="fw-bold px-2">نویسنده:</span>
                <span>{{$post->user->firstname.' '.$post->user->lastname}}</span>
            </div>
            <div class="d-flex">
            <span  class="fw-bold px-2">تاریخ انتشار:</span>
            <span class="tx">{{$post->created_at->diffForHumans()}}</span>
        </div>  </div>
            <a href="post/{{$post->slug}}" class="btn">مشاهده پست</a>
        </div>
    </div>
</div>




