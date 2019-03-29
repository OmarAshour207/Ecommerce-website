<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\TradeMarkDatatable;

use Illuminate\Http\Request;
use App\Model\TradeMark;
use Storage;

class TradeMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarkDatatable $trademark)
    {
        return $trademark->render('admin.trademarks.index',['title'=> trans('admin.trademarks')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trademarks.create',['title'=> trans('admin.create_trademarks')]);
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
            'trademark_name_ar'      => 'required',
            'trademark_name_en'      => 'required',
            'icon'                   => validate_image(),
        ], [],[
            'trademark_name_ar'     => trans('admin.trademark_name_ar'),
            'trademark_name_ar'     => trans('admin.trademark_name_en'),
            'icon'                  => trans('admin.trademark_icon'),
        ]);

        if(request()->hasFile('icon')) {
            
            $data['icon'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'icon',
                'path'          => 'trademarks',
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]);
        }

        TradeMark::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('trademarks'));
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
        $trademark = TradeMark::find($id);
        $title   = trans('admin.edit_record');
        return view('admin.trademarks.edit',compact('trademark','title'));
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
            'trademark_name_ar'      => 'required',
            'trademark_name_en'      => 'required',
            'icon'                   => 'sometimes|nullable'.validate_image(),
        ], [],[
            'trademark_name_ar'     => trans('admin.trademark_name_ar'),
            'trademark_name_ar'     => trans('admin.trademark_name_en'),
            'icon'                  => trans('admin.trademark_icon'),
        ]);

        if(request()->hasFile('icon')) {
            
            $data['icon'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'icon',
                'path'          => 'trademarks',
                'upload_type'   => 'single',
                'delete_file'   => TradeMark::find($id)->icon,
            ]);
        }

        TradeMark::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('trademarks'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trademarks = TradeMark::find($id);
        Storage::delete($trademarks->icon);
        $trademarks->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('trademarks'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            foreach(request('item') as $id) {
                $trademarks = TradeMark::find($id);
                Storage::delete($trademarks->icon);
                $trademarks->delete();
            }
        } else {
            $trademarks = TradeMark::find(request('item'));
            Storage::delete($trademarks->icon);
            $trademarks->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('trademarks'));
    }

}
