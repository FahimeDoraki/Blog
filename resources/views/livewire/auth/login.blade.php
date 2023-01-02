@section('title')
ورود
@endsection
  
<section class="vh-100 auth" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 d-flex flex-column align-items-center">

                  <p class="text-center h1 fw-bold mx-1 mx-md-4 my-4">ورود</p>
             
  
                    @if(Session::has('message'))
                      <p class="alert alert-warning">{!! Session::get('message') !!}</p>
                    @endif

                    <div class="d-flex flex-column align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="email">ایمیل:</label>
                        <input type="text" id="email" wire:model="email"  class="form-control"   />
                      </div>
                      @error('email')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>

                    <div class="d-flex flex-column align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="password">رمزعبور:</label>
                        <input type="password" id="password" wire:model="password" class="form-control" />
                      </div>
                      @error('password')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>

                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="button" class="btn border-none btn-lg"  wire:click="handelLogin">ورود</button>
                      </div>
               
            

                  <div>
                    <a href='{{ route('register') }}' class="linkinto">عضویت</a>
                  </div>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
