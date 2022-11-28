@extends('frontend.layout.independent')

@section('content')
    <div class="col-lg-12">
        <div class="white_box mb_30">
            <div class="row justify-content-center">
                <div class="col-lg-5">

                    <div class="modal-content cs_modal">
                        <div class="modal-header justify-content-center theme_bg_1">
                            <h5 class="modal-title text_white">Registration</h5>
                        </div>

                        <div class="modal-body">
                            <form action="{{route('reg.action')}}" method="post">
                                @csrf
                                @if ($errors->has('name'))
                                   <span class="f_w_400 fs-12 text-danger"> *{{$errors->first('name')}}</span>
                                @endif

                                <div class="">
                                    <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="f_w_400 fs-12 text-danger"> *{{$errors->first('email')}}</span>
                                @endif
                                <div class="">
                                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="f_w_400 fs-12 text-danger"> *{{$errors->first('password')}}</span>
                                @endif
                                <div class="">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <div class="">
                                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
                                </div>
                                <button class="btn_1 full_width text-center" type="submit">Log in</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
