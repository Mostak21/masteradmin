<?php
use App\Models\uploadedfile;

function uploadedfile($file){

    $type = array(
        "jpg"=>"image",
        "jpeg"=>"image",
        "png"=>"image",
        "svg"=>"image",
        "webp"=>"image",
        "gif"=>"image",
        "mp4"=>"video",
        "mpg"=>"video",
        "mpeg"=>"video",
        "webm"=>"video",
        "ogg"=>"video",
        "avi"=>"video",
        "mov"=>"video",
        "flv"=>"video",
        "swf"=>"video",
        "mkv"=>"video",
        "wmv"=>"video",
        "wma"=>"audio",
        "aac"=>"audio",
        "wav"=>"audio",
        "mp3"=>"audio",
        "zip"=>"archive",
        "rar"=>"archive",
        "7z"=>"archive",
        "doc"=>"document",
        "txt"=>"document",
        "docx"=>"document",
        "pdf"=>"document",
        "csv"=>"document",
        "xml"=>"document",
        "ods"=>"document",
        "xlr"=>"document",
        "xls"=>"document",
        "xlsx"=>"document"
    );

    $filename = $file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension();
    $destinationPath = 'uploads/all';
    $slug=time().rand(4,7).'.'.$extension;
    $file->move($destinationPath,$slug);

    $upload= new uploadedfile();
    $upload->name=$filename;
    $upload->extenstion= $extension;
    $upload->slug=$slug;
    $upload->user_id = 1;
    $upload->type=$type[$extension];
    $upload->save();
    return $upload->id;
}


 function my_asset($path)
    {
            return app('url')->asset('/' . $path);
    }


function static_asset($path, $secure = null)
{
    return app('url')->asset('/' . $path, $secure);
}


if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = '//' . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}


if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return env('AWS_URL') . '/';
        } else {
            return getBaseURL() . '/';
        }
    }
}


if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}



//highlights the selected navigation on admin panel
if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

//highlights the selected navigation on frontend
if (!function_exists('areActiveRoutesHome')) {
    function areActiveRoutesHome(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}


