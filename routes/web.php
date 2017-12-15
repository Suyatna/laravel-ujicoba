<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function(){
     Route::get('/post/create', 'PostController@index')->name('post.write');
     Route::post('/post/create', 'PostController@masuk')->name('post.masuk');
     Route::get('/post/edit/{id_post}',  ['uses' => 'PostController@edit_show'])->name('post.edit');
     Route::post('/post/edit/{id_post}', ['uses' => 'PostController@edit_save'])->name('post.save_edit');
     Route::get('/post/delete/{id_post}', ['uses' => 'PostController@hapus_post'])->name('post_delete');
     Route::post('/komentar/post/{slug}', ['uses' => 'KomentarController@save'])->name('save_komen');
});

Route::get('/artikel/{slug}', ['uses' => 'PostController@show_post'])->name('post.show');
Route::get('/kategori/{nama}', ['uses' => 'KategoriController@show'])->name('show.kategori');
Route::get('/user/{id}', ['uses' => 'UserController@show'])->name('show.user');
