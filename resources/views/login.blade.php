@extends('frontend.layout.independent')

@section('content')
    <div class="col-lg-12">
        <div class="white_box mb_30">
            <div class="row justify-content-center">
                <div class="col-lg-5">

                    <div class="modal-content cs_modal">
                        <div class="modal-header justify-content-center theme_bg_1">
                            <h5 class="modal-title text_white">Log in</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('login.attempt')}}" method="post">
                                @csrf
                                @if ($errors->has('email'))
                                    <span class="f_w_400 fs-12 text-danger"> *{{$errors->first('email')}}</span>
                                @endif
                                    <span class="f_w_400 fs-12 text-danger"> {{session('emailerror')}}</span>
                                <div class="">
                                    <input type="text" name="email" class="form-control" placeholder="Enter your email">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="f_w_400 fs-12 text-danger"> *{{$errors->first('password')}}</span>
                                @endif
                                <span class="f_w_400 fs-12 text-danger"> {{session('passworderror')}}</span>
                                <div class="">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <button class="btn_1 full_width text-center"  type="submit">Log in</button>
                                <p>Need an account? <a data-toggle="modal" data-target="#sing_up" data-dismiss="modal" href="{{route('registration')}}"> Sign Up</a></p>
                                <div class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal" class="pass_forget_btn">Forget Password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
