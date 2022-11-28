<div class="rit-topbar px-15px px-lg-25px d-flex align-items-stretch justify-content-between">
    <div class="d-flex">
        <div class="rit-topbar-nav-toggler d-flex align-items-center justify-content-start mr-2 mr-md-3 ml-0" data-toggle="rit-mobile-nav">
            <button class="rit-mobile-toggler">
                <span></span>
            </button>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1">
        <div class="d-flex justify-content-around align-items-center align-items-stretch">
            <div class="d-flex justify-content-around align-items-center align-items-stretch">
                <div class="rit-topbar-item">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-icon btn-circle btn-light" href="" target="_blank" title="Browse Website">
                            <i class="las la-globe"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-around align-items-center align-items-stretch ml-3">
                <div class="rit-topbar-item">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-soft-danger btn-sm d-flex align-items-center" href="">
                            <i class="las la-hdd fs-20"></i>
                            <span class="fw-500 ml-1 mr-0 d-none d-md-block">Clear Cache</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around align-items-center align-items-stretch">

            <div class="rit-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon p-0 d-flex justify-content-center align-items-center">
                            <span class="d-flex align-items-center position-relative">
                                <i class="las la-bell fs-24"></i>
{{--                                @if(Auth::user()->unreadNotifications->count() > 0)--}}
{{--                                    <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right"></span>--}}
{{--                                @endif--}}
                            </span>
                        </span>
                    </a>

                </div>
            </div>


            <div class="rit-topbar-item ml-2">

            </div>

            <div class="rit-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="d-flex align-items-center">
{{--                            <span class="avatar avatar-sm mr-md-2">--}}
{{--                                <img--}}
{{--                                    src="{{ uploaded_asset(Auth::user()->avatar_original) }}"--}}
{{--                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';"--}}
{{--                                >--}}
{{--                            </span>--}}
                            <span class="d-none d-md-block">
{{--                                <span class="d-block fw-500">{{Auth::user()->name}}</span>--}}
{{--                                <span class="d-block small opacity-60">{{Auth::user()->user_type}}</span>--}}
                            </span>
                        </span>
                    </a>
{{--                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">--}}
{{--                        <a href="{{ route('profile.index') }}" class="dropdown-item">--}}
{{--                            <i class="las la-user-circle"></i>--}}
{{--                            <span>{{translate('Profile')}}</span>--}}
{{--                        </a>--}}

{{--                        <a href="{{ route('logout')}}" class="dropdown-item">--}}
{{--                            <i class="las la-sign-out-alt"></i>--}}
{{--                            <span>{{translate('Logout')}}</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div><!-- .rit-topbar-item -->
        </div>
    </div>
</div><!-- .rit-topbar -->
