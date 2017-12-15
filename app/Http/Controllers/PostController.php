<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Categories;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private function generate_string($length = 5)
    {
        $str = "";
        $characters = array_merge(
                      range('A','Z'),
                      range('a','z'),
                      range('0','9'));
        $max = count($characters) - 1;
      for ($i = 0; $i < $length; $i++)
      {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
        }
            return $str;
    }


    public function index()
    {
        $kategori = Categories::all();
        return view('post/create', compact('kategori'));
    }

    public function masuk(Request $request){

      $request->validate([
        'title' => 'required|min:1|max:255',
        'content' => 'required|min:15|max:600'
      ],[
        'title.require' => 'Maaf Title Tidak Boleh Kosong',
        'title.min'     => 'Maaf Untuk Judul hanya boleh 1 karakter',
        'title.max'     => 'Maaf Untuk Judul Tidak Boleh 255 karakter lebih'
      ]);

        $title       = $request->input('title');
        $content     = strip_tags($request->input('content'));
        $kategori_id = $request->input('kategori');
        $id_user     = $request->input('id_user');
        $slug        = preg_replace("/\s+/","-", strtolower($title.'-'.$this->generate_string()));

        $post = new Post;
        $post->categories_id = $kategori_id;
        $post->user_id       = $id_user;
        $post->title         = $title;
        $post->slug          = $slug;
        $post->content       = $content;

        $post->save();

        return redirect('home')->with('success', 'Berhasil Post data');
    }

    public function edit_show(Request $request, $id_post)
    {
      $post     = Post::where('slug', $id_post)->first();
      $kategori = Categories::all();

      if(Auth::user()->id != $post->user->id){
        return redirect()->route('home')->with('success', 'Maaf Anda Tidak bisa Mengedit Artikel ini Karen Bukan Penulis nya');
      }else{
      return view('post/edit', compact('post', 'kategori'));
    }

  }

    public function edit_save(Request $request, $id_post)
    {
      $post = Post::where('slug', $id_post)->first();
      $post->title         = $request->input('title');
      $post->content       = $request->input('content');
      $post->categories_id = $request->input('kategori');
      $post->save();

      return redirect()->route('home')->with('success', "Berhasil Menupdate data");
    }

    public function hapus_post(Request $request, $id_post)
    {
      $post = Post::find($id_post);

      if(Auth::user()->id != $post->user_id){
        return redirect()->route('home')->with('success', 'Maaf Anda Tidak bisa Menghapus Artikel ini Karen Bukan Penulis nya');
      }else{
      $post->delete();
      return redirect()->route('home')->with('success', "Berhasil Menghapus Data!!!");
      }

    }

    public function show_post(Request $request, $slug)
    {
      $post = Post::where('slug', $slug)->first();
      return view('post/show', compact('post'));
    }

}
