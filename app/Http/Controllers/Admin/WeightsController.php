<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\WeightDatatable;

use Illuminate\Http\Request;
use App\Model\Weight;
use Storage;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WeightDatatable $weight)
    {
        return $weight->render('admin.weights.index',['title'=> trans('admin.weights')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weights.create',['title'=> trans('admin.create_weight')]);
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
            'weight_name_ar'             => 'required',
            'weight_name_en'             => 'required',
        ], [],[
            'weight_name_ar'             => trans('admin.name_ar'),
            'weight_name_ar'             => trans('admin.name_en'),
        ]);

        Weight::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('weights'));
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
        $weight = Weight::find($id);
        $title = trans('admin.edit_record');
        return view('admin.weights.edit',compact('weight','title'));
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
            'weight_name_ar'             => 'required',
            'weight_name_en'             => 'required',
        ], [],[
            'weight_name_ar'            => trans('admin.name_ar'),
            'weight_name_ar'            => trans('admin.name_en'),
        ]);

        
        Weight::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('weights'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Weight::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('weights'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            foreach(request('item') as $id) {
                Weight::find($id)->delete();
            }
        } else {
            Weight::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('weights'));
    }

}
