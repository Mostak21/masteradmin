<?php

namespace App\Http\Controllers;

use App\Models\Uploadedfile;
use Illuminate\Http\Request;
use Auth;
use Intervention\Image\Image;

class UploadedfileController extends Controller
{


    public function index(Request $request){


        $all_uploads = (auth()->user()->user_type == 'seller') ? Uploadedfile::where('user_id',auth()->user()->id) : Uploadedfile::query();
        $search = null;
        $sort_by = null;

        if ($request->search != null) {
            $search = $request->search;
            $all_uploads->where('file_original_name', 'like', '%'.$request->search.'%');
        }

        $sort_by = $request->sort;
        switch ($request->sort) {
            case 'newest':
                $all_uploads->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $all_uploads->orderBy('created_at', 'asc');
                break;
            case 'smallest':
                $all_uploads->orderBy('file_size', 'asc');
                break;
            case 'largest':
                $all_uploads->orderBy('file_size', 'desc');
                break;
            default:
                $all_uploads->orderBy('created_at', 'desc');
                break;
        }

        $all_uploads = $all_uploads->paginate(60)->appends(request()->query());


        return (auth()->user()->user_type == 'seller')
            ? view('frontend.user.seller.uploads.index', compact('all_uploads', 'search', 'sort_by'))
            : view('backend.uploaded_files.index', compact('all_uploads', 'search', 'sort_by'));
    }

    public function create(){
        return (auth()->user()->user_type == 'seller')
            ? view('frontend.user.seller.uploads.create')
            : view('backend.uploaded_files.create');
    }


    public function show_uploader(Request $request){
        return view('uploader.rit-uploader');
    }
    public function upload(Request $request){
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

        if($request->hasFile('aiz_file')){
            $upload = new Uploadedfile;
            $extension = strtolower($request->file('aiz_file')->getClientOriginalExtension());

            if(isset($type[$extension])){
                $upload->file_original_name = null;
                $arr = explode('.', $request->file('aiz_file')->getClientOriginalName());
                for($i=0; $i < count($arr)-1; $i++){
                    if($i == 0){
                        $upload->file_original_name .= $arr[$i];
                    }
                    else{
                        $upload->file_original_name .= ".".$arr[$i];
                    }
                }

                $path = $request->file('aiz_file')->store('uploads/all', 'local');
                $size = $request->file('aiz_file')->getSize();

                // Return MIME type ala mimetype extension
                $finfo = finfo_open(FILEINFO_MIME_TYPE);

                // Get the MIME type of the file
                $file_mime = finfo_file($finfo, base_path('public/').$path);


                if (env('FILESYSTEM_DRIVER') == 's3') {
                    Storage::disk('s3')->put(
                        $path,
                        file_get_contents(base_path('public/').$path),
                        [
                            'visibility' => 'public',
                            'ContentType' =>  $extension == 'svg' ? 'image/svg+xml' : $file_mime
                        ]
                    );
                    if($arr[0] != 'updates') {
                        unlink(base_path('public/').$path);
                    }
                }

                $upload->extension = $extension;
                $upload->file_name = $path;
                $upload->user_id = 1;
                $upload->type = $type[$upload->extension];
                $upload->file_size = $size;
                $upload->save();
            }
            return '{}';
        }
    }

    public function get_uploaded_files(Request $request)
    {
        $uploads = Uploadedfile::where('user_id', 1);
        if ($request->search != null) {
            $uploads->where('file_original_name', 'like', '%'.$request->search.'%');
        }
        if ($request->sort != null) {
            switch ($request->sort) {
                case 'newest':
                    $uploads->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $uploads->orderBy('created_at', 'asc');
                    break;
                case 'smallest':
                    $uploads->orderBy('file_size', 'asc');
                    break;
                case 'largest':
                    $uploads->orderBy('file_size', 'desc');
                    break;
                default:
                    $uploads->orderBy('created_at', 'desc');
                    break;
            }
        }
        return $uploads->paginate(60)->appends(request()->query());
    }

    public function destroy(Request $request,$id)
    {
        $upload = Uploadedfile::findOrFail($id);

        if(auth()->user()->user_type == 'seller' && $upload->user_id != auth()->user()->id){
            flash(translate("You don't have permission for deleting this!"))->error();
            return back();
        }
        try{
            if(env('FILESYSTEM_DRIVER') == 's3'){
                Storage::disk('s3')->delete($upload->file_name);
                if (file_exists(public_path().'/'.$upload->file_name)) {
                    unlink(public_path().'/'.$upload->file_name);
                }
            }
            else{
                unlink(public_path().'/'.$upload->file_name);
            }
            $upload->delete();
            flash('File deleted successfully')->success();
        }
        catch(\Exception $e){
            $upload->delete();
            flash('File deleted successfully')->success();
        }
        return back();
    }

    public function get_preview_files(Request $request){
        $ids = explode(',', $request->ids);
        $files = Uploadedfile::whereIn('id', $ids)->get();
        return $files;
    }

    //Download project attachment
    public function attachment_download($id)
    {
        $project_attachment = Uploadedfile::find($id);
        try{
            $file_path = public_path($project_attachment->file_name);
            return Response::download($file_path);
        }catch(\Exception $e){
            flash('File does not exist!')->error();
            return back();
        }

    }
    //Download project attachment
    public function file_info(Request $request)
    {
        $file = Uploadedfile::findOrFail($request['id']);

        return  view('backend.uploaded_files.info',compact('file'));
    }


    public function bulkdestroy(Request $request){
        foreach($request->image as $id){

            $upload = Uploadedfile::findOrFail($id);

            if(auth()->user()->user_type == 'seller' && $upload->user_id != auth()->user()->id){
                flash('You dont have permission for deleting this!')->error();
                return back();
            }
            try{
                if(env('FILESYSTEM_DRIVER') == 's3'){
                    Storage::disk('s3')->delete($upload->file_name);
                    if (file_exists(public_path().'/'.$upload->file_name)) {
                        unlink(public_path().'/'.$upload->file_name);
                    }
                }
                else{
                    unlink(public_path().'/'.$upload->file_name);
                }
                $upload->delete();
                flash('File deleted successfully')->success();
            }
            catch(\Exception $e){
                $upload->delete();
                flash('File deleted successfully')->success();
            }

        }
        return back();
    }


    public function bulkdelete(Request $request)
    {


        $all_uploads = (auth()->user()->user_type == 'seller') ? Uploadedfile::where('user_id',auth()->user()->id) : Uploadedfile::query();
        $search = null;
        $sort_by = null;

        if ($request->search != null) {
            $search = $request->search;
            $all_uploads->where('file_original_name', 'like', '%'.$request->search.'%');
        }

        $sort_by = $request->sort;
        switch ($request->sort) {
            case 'newest':
                $all_uploads->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $all_uploads->orderBy('created_at', 'asc');
                break;
            case 'smallest':
                $all_uploads->orderBy('file_size', 'asc');
                break;
            case 'largest':
                $all_uploads->orderBy('file_size', 'desc');
                break;
            default:
                $all_uploads->orderBy('created_at', 'desc');
                break;
        }

        $all_uploads = $all_uploads->paginate(60)->appends(request()->query());


        return (auth()->user()->user_type == 'seller')
            ? view('frontend.user.seller.uploads.index', compact('all_uploads', 'search', 'sort_by'))
            : view('backend.uploaded_files.bulkdelete', compact('all_uploads', 'search', 'sort_by'));
    }



}
