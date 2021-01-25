<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\Admin\Product\CreateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session('success') ? toast(session('success'), 'success') : toast(session('error'), 'error');
        $data = Product::with('category')->orderBy('created_at', 'DESC')->get();
        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        return view('admin.product.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $req)
    {
        try {

            $image = $req->file('image');
            $nameFile = Str::slug($req->name). '-' .time().'.'.$image->getClientOriginalExtension();
            $path = 'assets/images/product';

            $image->move($path, $nameFile);

            Product::create([
                'name' => $req->name,
                'price' => $req->price,
                'stock' => $req->stock,
                'category_id' => $req->category,
                'description' => $req->description,
                'image' => $nameFile
            ]);

            return redirect()->route('admin.product.index')->with('success', 'Succesfully create product');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $category = Category::orderBy('name', 'ASC')->get();
        return view('admin.product.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
