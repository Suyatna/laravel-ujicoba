<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Comment;

class KomentarController extends Controller
{
    public function save(Request $request, $slug)
    {
      $request->validate([
          'content' => 'required|min:1|max:255'
      ],[
        'content.required' => "Harap jangan Dikosongkan",
        'content.min'      => "Harap Jangan di bawah 1 karakter",
        'content.max'      => 'Anda tidak diperbolehkan untuk komentar diatas 255 karakter'
      ]);

        $komen = new Comment;
        $komen->post_id = $request->input('id_post');
        $komen->user_id = $request->input('id_user');
        $komen->message = $request->input('content');
        $komen->save();

        return redirect()->route('post.show', ['slug' => $slug])->with('success', "Berhasil Post Data");
    }
}
