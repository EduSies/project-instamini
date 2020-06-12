<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {
        $validate = $this->validate($request, [
            'image_path' => ['required', 'image'],
            'description' => ['required', 'string', 'max:255']
        ]);

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $user = Auth::user();
        $image =  new Image();
        $image->user_id = $user->id;
        $image->image_path = $image_path;
        $image->description = $description;

        if( $image_path ){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')
                ->with(['message' => 'La foto ha sido subida correctamente']);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    public function getDetail($id)
    {
        $image = Image::find($id);

        return view('image.detail',['image' => $image]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if( $user && $image && $image->user->id == $user->id ){

            // Delete Comments
            if( $comments && count($comments) >= 1 ){
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            // Delete Likes
            if( $likes && count($likes) >= 1 ){
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // Delete File to Storage
            Storage::disk('images')->delete($image->image_path);

            // Delete Image Register
            $image->delete();

            $message = array('message' => 'La foto se ha borrado correctamente');
        } else {
            $message = array('message-error' => 'La foto no se ha borrado correctamente');
        }

        return redirect()->route('home')
                ->with($message);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $image = Image::find($id);

        if( $user && $image && $image->user->id == $user->id ){
            $result = view('image.edit',['image' => $image]);
        } else {
            $result = redirect()->route('home');
        }

        return $result;
    }

    public function update(Request $request)
    {
        $validate = $this->validate($request, [
            'image_path' => ['image'],
            'description' => ['required', 'string', 'max:255']
        ]);

        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $image = Image::find($image_id);
        $image->description = $description;

        if( $image_path ){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->update();

        return redirect()->route('image.detail',['id' => $image_id])
                ->with(['message' => 'La foto se ha actualizado correctamente']);
    }
}
