<div class="rit-sidebar-wrap">
    <div class="rit-sidebar left c-scrollbar">
        <div class="rit-side-nav-logo-wrap">
{{--            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">--}}
{{--                @if(get_setting('system_logo_white') != null)--}}
{{--                    <img class="mw-100" src="{{ uploaded_asset(get_setting('system_logo_white')) }}" class="brand-icon" alt="{{ get_setting('site_name') }}">--}}
{{--                @else--}}
{{--                    <img class="mw-100" src="{{ static_asset('assets/img/logo.png') }}" class="brand-icon" alt="{{ get_setting('site_name') }}">--}}
{{--                @endif--}}
{{--            </a>--}}
        </div>
        <div class="rit-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text" name="" placeholder="Search in menu" id="menu-search" >
            </div>
            <ul class="rit-side-nav-list" id="search-menu">
            </ul>
            <ul class="rit-side-nav-list" id="main-menu" data-toggle="rit-side-menu">
                <li class="rit-side-nav-item">
                    <a href="{{route('admin.dashboard')}}" class="rit-side-nav-link">
                        <i class="las la-home rit-side-nav-icon"></i>
                        <span class="rit-side-nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="rit-side-nav-item">
                    <a href="{{route('categories.index')}}" class="rit-side-nav-link">
                        <i class="las la-home rit-side-nav-icon"></i>
                        <span class="rit-side-nav-text">Category</span>
                    </a>
                </li>
                <li class="rit-side-nav-item">
                    <a href="#" class="rit-side-nav-link">
                        <i class="las la-shopping-cart rit-side-nav-icon"></i>
                        <span class="rit-side-nav-text">Address</span>
                        <span class="rit-side-nav-arrow"></span>
                    </a>
                    <!--Submenu-->
                    <ul class="rit-side-nav-list level-2">
                        <li class="rit-side-nav-item">
                            <a class="rit-side-nav-link" href="{{route('countries.index')}}">
                                <span class="rit-side-nav-text">Country</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item">
                            <a class="rit-side-nav-link" href="{{route('states.index')}}">
                                <span class="rit-side-nav-text">State</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item">
                            <a class="rit-side-nav-link" href="{{route('cities.index')}}">
                                <span class="rit-side-nav-text">City</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item">
                            <a class="rit-side-nav-link" href="{{route('districts.index')}}">
                                <span class="rit-side-nav-text">District</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item">
                            <a class="rit-side-nav-link" href="{{route('subdistricts.index')}}">
                                <span class="rit-side-nav-text">Sub District</span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="rit-side-nav-item">
                    <a href="#" class="rit-side-nav-link">
                        <i class="las la-folder-open rit-side-nav-icon"></i>
                        <span class="rit-side-nav-text">Media and Files</span>
                        <span class="rit-side-nav-arrow"></span>
                    </a>
                    <ul class="rit-side-nav-list level-2">
                        <li class="rit-side-nav-item">
                            <a href="{{ route('uploaded-files.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['uploaded-files.create'])}}">
                                <i class="las la-photo-video rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">Uploaded Files</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item">
                            <a href="{{ route('uploaded-files.bulkdelete') }}" class="rit-side-nav-link {{ areActiveRoutes(['uploaded-files.bulkdelete'])}}">
                                <i class="las la-trash rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">Bulk Delete</span>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>



            <!-- .rit-side-nav -->
        </div><!-- .rit-side-nav-wrap -->
    </div><!-- .rit-sidebar -->
    <div class="rit-sidebar-overlay"></div>
</div><!-- .rit-sidebar -->
