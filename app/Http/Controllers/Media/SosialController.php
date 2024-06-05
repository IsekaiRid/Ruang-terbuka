<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Commatar;
use App\Models\LogPostingan;
use App\Models\User;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class SosialController extends Controller
{
    public function viewcontet()
    {
        $konten = LogPostingan::with('user')->get();

        $likes = [];
        foreach ($konten as $post) {
            $likes[$post->id] = Likes::where('id_post', $post->id)->count();
        }
        return view('media.contet', compact('konten', 'likes'));
    }


    public function posting()
    {

        return view('media.add_contet');
    }


    public function editview($id_post)
    {
        $konten = LogPostingan::where('id', $id_post)->first();
        $post = LogPostingan::where('id', $id_post)->get();
        if ($konten) {
            $currentUserId = Auth::user()->id;
            if ($currentUserId === $konten->user_id) {
                return view('media.edit_contet', compact('post'));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    public function editpost(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_post' => 'required',
            'konten' => 'required',
            'des' => 'required',
            'gambar' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $foto = $request->file('gambar');
        $filename = date('Y-m-d_H-i') . '_' . $foto->getClientOriginalName();
        $path = 'photo-content/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($foto));

        LogPostingan::where('id', $request->id_post)->update([
            'user_id' => $request->id_user,
            'konten' => $request->konten,
            'des' => $request->des,
            'gambar' => $filename,
        ]);
        

        return redirect()->route('viewcontet');
    }

    public function deletepoting(Request $request)
    {
        $request->validate([
            'id_post' => 'required',
        ]);
        $post = LogPostingan::find($request->id_post);
        if (!$post) {
            return back()->with('gagal', 'Posting not found.');
        }
        if ($post->gambar) {
            Storage::disk('public')->delete('photo-content/' . $post->gambar);
        }

        $post->delete();
    
        return redirect()->route('viewcontet')->with('sukses', 'Posting deleted successfully.');
    }
    
    

    public function comend($id_post)
    {
        $post = LogPostingan::where('id', $id_post)->get();
        $comd = Commatar::where('id_post', $id_post)->with('user')->get();
        return view('media.commad_conten', compact('post', 'comd'));
    }



    public function createComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255',
            'post_id' => 'required|',
        ]);

        Commatar::create([
            'id_post' => $request->post_id,
            'user_id' => auth()->user()->id,
            'commad' => $request->comment,
        ]);

        return back();
    }



    public function add(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'konten' => 'required',
            'des' => 'required',
            'gambar' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $request->file('gambar');
        $filename = date('Y-m-d_H-i') . '_' . $foto->getClientOriginalName();
        $path = 'photo-content/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($foto));

        LogPostingan::create([
            'user_id' => $request->id_user,
            'konten' => $request->konten,
            'des' => $request->des,
            'gambar' => $filename,
        ]);

        return redirect()->route('posting')->with('sukses', 'Postingan sukses');
    }



    public function Likes($id_post)
    {
        $likes = Likes::where('id_post', $id_post)->where('user_id', auth()->user()->id)->first();

        if ($likes) {

            $likes->delete();
            $jumlah = $likes[$id_post] = Likes::where('id_post', $id_post)->count();
            return response()->json([
                'likes' =>  $jumlah,
            ]);
        } else {
            Likes::create([
                'id_post' => $id_post,
                'user_id' => auth()->user()->id,
            ]);

            $jumlah = $likes[$id_post] = Likes::where('id_post', $id_post)->count();

            return response()->json([
                'likes' => $jumlah,
            ]);
        }
    }
}
