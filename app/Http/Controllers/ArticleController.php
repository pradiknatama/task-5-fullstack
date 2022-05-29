<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::where('user_id', Auth::user()->id)->get();
        return view('pages.article.index', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('pages.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file['gambar']);
        $valid=$request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'gambar' => 'required|image',
            'konten' => 'required'
        ]);
        $valid['image'] = $request->file('gambar')->store('post-images');
        $valid['title'] = $request['judul'];
        $valid['category_id'] = $request['kategori'];
        $valid['content'] = $request['konten'];
        $valid['user_id'] = Auth::user()->id;
        Article::create($valid);
        Alert::success('Berhasil', 'Article baru berhasil dibuat');
        return redirect('/article');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::where('id', $id)->first();
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view("pages.article.edit", compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate(
            [
                'judul' => 'required',
                'kategori' => 'required',
                'konten' => 'required'
            ],
        );
        if ($request->file('gambar')) {
            $img=$request->file('gambar')->store('post-images');
            Storage::delete($request->oldImage);
            $update=Article::where('id',$id)
            ->update(
                [
                    'title'=>$request['judul'],
                    'category_id'=>$request['kategori'],
                    'content'=>$request['konten'],
                    'image'=>$img,
                ]
            );
        } else {
            $update=Article::where('id',$id)
            ->update(
                [
                    'title'=>$request['judul'],
                    'category_id'=>$request['kategori'],
                    'content'=>$request['konten'],
                ]
            );
        }
        Alert::success('Berhasil', 'Article berhasil diubah');
        return redirect('/article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img=Article::where('id', $id)->first();
        Storage::delete($img->image);
        Article::where('id',$id)->delete();
        return redirect('/article');
    }
}
