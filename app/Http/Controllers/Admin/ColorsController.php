<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ColorDatatable;

use Illuminate\Http\Request;
use App\Model\Color;
use Storage;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ColorDatatable $color)
    {
        return $color->render('admin.colors.index',['title'=> trans('admin.colors')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create',['title'=> trans('admin.create_color')]);
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
            'color_name_ar'             => 'required',
            'color_name_en'             => 'required',
            'color'                     => 'required|string',
        ], [],[
            'color_name_ar'             => trans('admin.name_ar'),
            'color_name_ar'             => trans('admin.name_en'),
            'color'                     => trans('admin.color'),          
        ]);

        Color::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('colors'));
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
        $color = Color::find($id);
        $title = trans('admin.edit_record');
        return view('admin.colors.edit',compact('color','title'));
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
            'color_name_ar'             => 'required',
            'color_name_en'             => 'required',
            'color'                     => 'required|string',
        ], [],[
            'color_name_ar'            => trans('admin.name_ar'),
            'color_name_ar'            => trans('admin.name_en'),
            'color'                    => trans('admin.color'),
        ]);

        
        Color::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('colors'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Color::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('colors'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            foreach(request('item') as $id) {
                Color::find($id)->delete();
            }
        } else {
            Color::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('colors'));
    }

}
