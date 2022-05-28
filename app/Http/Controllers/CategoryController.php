<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=Category::where('user_id',Auth::user()->id)->get();
        return view('pages.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'category'=>'required'
            ],
            [
                'category.required'=>"Inputan nama kategori harus diisi !"
            ]
        );

        Category::insert(
            [
                'name'=>$request['category'],
                'user_id'=>Auth::user()->id
            ]
        );
        Alert::success('Berhasil', 'Kategori baru berhasil dibuat');
        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::where('id',$id)->first();
        return view('pages.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate(
            [
                'category'=>'required'
            ],
            [
                'category.required'=>"Inputan nama kategori harus diisi !"
            ]
        );
        Category::where('id',$id)->update(
            [
                'name'=>$request['category'],
            ]
        );
        Alert::success('Berhasil', 'Kategori berhasil diubah');
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        Alert::success('Berhasil', 'Kategori berhasil dihapus');
        return redirect('/category');
    }
}
