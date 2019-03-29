<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\SizeDatatable;

use Illuminate\Http\Request;
use App\Model\Size;
use Storage;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizeDatatable $size)
    {
        return $size->render('admin.sizes.index',['title'=> trans('admin.sizes')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create',['title'=> trans('admin.create_size')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validate(request(),[
            'size_name_ar'              => 'required',
            'size_name_en'              => 'required',
            'department_id'             => 'required|numeric',
            'is_public'                 => 'required|in:yes,no',
        ], [],[
            'size_name_ar'              => trans('admin.name_ar'),
            'size_name_ar'              => trans('admin.name_en'),
            'department_id'             => trans('admin.department_id'),
            'is_public'                 => trans('admin.is_public'),          
        ]);

        Size::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('sizes'));
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
        $size = size::find($id);
        $title = trans('admin.edit_record');
        return view('admin.sizes.edit',compact('size','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = $this->validate(request(),[
            'size_name_ar'              => 'required',
            'size_name_en'              => 'required',
            'department_id'             => 'required|numeric',
            'is_public'                 => 'required|in:yes,no',
        ], [],[
            'size_name_ar'              => trans('admin.name_ar'),
            'size_name_ar'              => trans('admin.name_en'),
            'department_id'             => trans('admin.department_id'),
            'is_public'                 => trans('admin.is_public'),          
        ]);

        
        Size::where('id', $id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('sizes'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Size::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('sizes'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            foreach(request('item') as $id) {
                Size::find($id)->delete();
            }
        } else {
            Size::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('sizes'));
    }

}
