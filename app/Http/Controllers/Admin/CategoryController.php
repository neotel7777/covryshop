<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $categories = Category::latest()->get();
            return Datatables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<a class="btn btn-success" id="edit-user"  href="'.route('categories.edit',$row->id).'">Edit </a>
                <a data-id='.$row->id.' class="btn btn-danger delete_row">Delete</a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view("admin.categories.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(request()->ajax()) {
            $value = $request->value;
            return encodestrings($value);
        }

        $categories = Category::latest()->get();
        return view("admin.categories.create",['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator      = Validator::make($request->all(),Category::getValidationRules($request->hasFile('image')))->validateWithBag('message');
        $categories     = Category::latest()->get();
        $image          = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = md5(time()) . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/uploads/images'), $image);
        }

        $requestList    = $request->all();

        if($requestList['meta_title'] == '') {
            $requestList['meta_title'] = $requestList['title'];
        }
        Category::create([
            'name'              => $requestList['name'],
            'title'             => $requestList['title'],
            'parent'            => $requestList['parent'],
            'meta_title'        => $requestList['meta_title'],
            'meta_description'  => $requestList['meta_description'],
            'image'             => $image
        ]);

        return redirect()->route("categories.index")->with('success',"Категория успешно была создана");
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
        $categories = Category::latest()->where('id', "!=", $id)->get();
        $category   = Category::where("id","=",$id)->first();

        return view("admin.categories.edit",['categories'=>$categories,'category'=>$category]);
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

        $validator      = Validator::make($request->all(),
            Category::getValidationRules($request->hasFile('image'),$id))
            ->validateWithBag('message');
        $categories     = Category::latest()->where('id', "!=", $id)->get();
        $category       = Category::where("id","=",$id)->first();
        $image          = $category->image;

        if ($request->hasFile('image')) {
            $file       = $request->file('image');
            $newImage   = md5(time()) . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/uploads/images/'), $newImage);

            if($image && file_exists(storage_path("app/public/uploads/images/".$image))) {
                unlink(storage_path("app/public/uploads/images/".$image));
            }

            $image      = $newImage;
        }

        $requestList    = $request->all();

        if($requestList['meta_title'] == '') {
            $requestList['meta_title'] = $requestList['title'];
        }
        $category->update([
            'name'              => $requestList['name'],
            'title'             => $requestList['title'],
            'parent'            => $requestList['parent'],
            'meta_title'        => $requestList['meta_title'],
            'meta_description'  => $requestList['meta_description'],
            'image'             => $image
        ]);

        return redirect()->route("categories.index")->with('success',"Категория успешно была отредактирована");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category       = Category::where("id","=",$id)->first();

        if($category->image && file_exists(storage_path("app/public/uploads/images/".$category->image))) {
            unlink(storage_path("app/public/uploads/images/".$category->image));
        }

        $category->delete();

        return response(true);
    }
}
