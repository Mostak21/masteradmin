<!doctype html>
<html lang="EN">
<head>

	<meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="app-url" content="{{ getBaseURL() }}">
	<meta name="file-base-url" content="{{ getFileBaseURL() }}">

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Favicon -->
	<link rel="icon" href="">
	<title></title>

	<!-- google font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

	<!-- aiz core css -->
	<link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">

{{--    <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">--}}

	<link rel="stylesheet" href="{{ static_asset('assets/css/rit-core.css') }}">


    <style>
        body {
            font-size: 12px;
        }
    </style>
	<script>
    	var RIT = RIT || {};
        RIT.local = {
            nothing_selected: 'Nothing selected',
            nothing_found: 'Nothing found',
            choose_file: 'Choose file',
            file_selected: 'File selected',
            files_selected: 'Files selected',
            add_more_files: 'Add more files',
            adding_more_files: 'Adding more files',
            drop_files_here_paste_or: 'Drop files here, paste or',
            browse: 'Browse',
            upload_complete: 'Upload complete',
            upload_paused: 'Upload paused',
            resume_upload: 'Resume upload',
            pause_upload: 'Pause upload',
            retry_upload: 'Retry upload',
            cancel_upload: 'Cancel upload',
            uploading: 'Uploading',
            processing: 'Processing',
            complete: 'Complete',
            file: 'File',
            files: 'Files',
        }
	</script>

</head>
<body class="">

	<div class="rit-main-wrapper">
        @include('backend.inc.admin_sidenav')
		<div class="rit-content-wrapper">
            @include('backend.inc.admin_nav')
			<div class="rit-main-content">
				<div class="px-15px px-lg-25px">
                    @yield('content')
				</div>
				<div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
					<p class="mb-0">&copy; Real It</p>
				</div>
			</div><!-- .rit-main-content -->
		</div><!-- .rit-content-wrapper -->
	</div><!-- .rit-main-wrapper -->

    @yield('modal')


	<script src="{{ static_asset('assets/js/vendors.js') }}" ></script>
	<script src="{{ static_asset('assets/js/rit-core.js') }}" ></script>

    @yield('script')

    <script type="text/javascript">
	    @foreach (session('flash_notification', collect())->toArray() as $message)
	        RIT.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
	    @endforeach

    </script>

</body>
</html>
