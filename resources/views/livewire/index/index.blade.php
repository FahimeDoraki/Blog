
<main>
    <div class="sec1 my-5 row align-items-center">
        <div class="col">
            <div class="baner_txt d-flex flex-column mx-auto">
            <h2>مقاله خودت را بساز</h2>
            <a href="{{ route('user.panel') }}">ایجاد مقاله</a>
            </div>
        </div>
        <div class="col">
            <img src="<?php  echo asset('storage/Images/t.png') ?>" alt="img">
        </div>
    </div>
    
    <div class="category container">ورزشی</div>
    <div class="sec2 container row mx-auto mb-5">
        @foreach ($sportPost as $post)
        @livewire('index.post', ['post' => $post])
        @endforeach
    </div>

    <div class="category container">اخبار</div>
    <div class="sec2 container row mx-auto mb-5">
        @foreach ($cnmaPost as $post)
        @livewire('index.post', ['post' => $post])
        @endforeach
    </div>

</main>





