<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        session('successMsgAdded') ? toast(session('successMsgAdded'), 'success') : toast(session('errorMsgAdded'), 'error');
        session('successMsgDelete') ? toast(session('successMsgDelete'), 'success') : toast(session('errorMsgDelete'), 'error');
        session('successMsgUpdate') ? toast(session('successMsgUpdate'), 'success') : toast(session('Error update'), 'error');

        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories',
            'description' => 'required'
        ]);

        try {

            Category::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return redirect()->route('admin.category.index')->with('successMsgAdded', 'Succesfully added!');

        } catch (\Exception $e) {
            return redirect()->route('admin.category.index')->with('errorMsgAdded', $e->getMessage());
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
        //
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
        $data = Category::findOrFail($id);
        $data->name = $request->name;
        $data->description = $request->description;

        $data->save();

        return redirect()->route('admin.category.index')->with('successMsgUpdate', 'Succesfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Category::findOrFail($id);
            $data->delete();

            return redirect()->route('admin.category.index')->with('successMsgDelete', 'Successfully delete!');


        } catch (\Exception $e) {
           return redirect()->route('admin.category.index')->with('errorMsgDelete', 'Error deleted ->' . $e->getMessage());
        }
    }
}
