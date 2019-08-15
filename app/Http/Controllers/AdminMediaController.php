<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    public function index(){

        $photos = Photo::paginate(10);

        return view('admin.media.index', compact('photos'));
    }

    public function create(){


        return view('admin.media.create');
    }

    public function store(Request $request){

        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        photo::create(['file' => $name]);

    }

    public function destroy($id){

        $photo = Photo:: findOrFail($id);

        unlink(public_path() . $photo->file);

        $photo->delete();

        Session::flash('image_deleted', 'Image Deleted');

    }

    public function deleteMedia(Request $request){

        if (isset($request->delete_single)){

            $this->destroy($request->photo);

            return redirect()->back();
        }

        if (isset($request->delete_all) && !empty($request->checkBoxArray)){

            $photos = Photo::findOrFail($request->checkBoxArray);

            foreach($photos as $photo){

                $photo->delete();
            }
            return redirect()->back();
        }else{
            return redirect()->back();
        }


    }


}
