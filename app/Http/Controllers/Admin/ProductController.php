<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\Admin\Product\CreateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\Product\UpdateRequest;


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
        session('successUpdate') ? toast(session('successUpdate'), 'success') : toast(session('error'), 'error');
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
    public function update(UpdateRequest $request, $id)
    {
        try {

            $product = Product::findOrFail($id);
            $photo = $product->image;

            if ($request->file('image')) {
                !empty($photo) ? File::delete(public_path('assets/images/product/' . $photo)) : null;

                $image = $request->file('image');
                $photo =  Str::slug($request->name). '-' .time().'.'.$image->getClientOriginalExtension();

                $path = 'assets/images/product';

                $image->move($path, $photo);
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category,
                'description' => $request->description,
                'image' => $photo
            ]);

            return redirect()->route('admin.product.index')->with('successUpdate', 'Succesfully update product');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);

        if(!empty($data->image)){
            File::delete(public_path('assets/images/product/' . $data->image));
        }

        $data->delete();

        return redirect()->route('admin.product.index')->with('successDelete', 'Succesfully delete product ' .  $data->name);
    }
}
