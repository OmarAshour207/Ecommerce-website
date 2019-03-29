<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\MallDatatable;

use Illuminate\Http\Request;
use App\Model\Mall;
use Storage;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallDatatable $Mall)
    {
        return $Mall->render('admin.malls.index',['title'=> trans('admin.malls')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.malls.create',['title'=> trans('admin.create_mall')]);
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
            'mall_name_ar'             => 'required',
            'mall_name_en'             => 'required',
            'contact_name'             => 'sometimes|nullable|string',
            'mobile'                   => 'required|numeric',
            'email'                    => 'required|email',
            'address'                  => 'sometimes|nullable',
            'country_id'               => 'required|numeric',
            'lat'                      => 'sometimes|nullable|numeric',
            'lng'                      => 'sometimes|nullable|numeric',
            'facebook'                 => 'sometimes|nullable|url',
            'twitter'                  => 'sometimes|nullable|url',
            'website'                  => 'sometimes|nullable|url',
            'icon'                     => validate_image(),
        ], [],[
            'mall_name_ar'             => trans('admin.name_ar'),
            'mall_name_ar'             => trans('admin.name_en'),
            'contact_name'             => trans('admin.contact_name'),
            'mobile'                   => trans('admin.mobile'),          
            'email'                    => trans('admin.email'),
            'address'                  => trans('admin.address'),
            'country_id'               => trans('admin.country_id'),              
            'facebook'                 => trans('admin.facebook'),
            'twitter'                  => trans('admin.twitter'),
            'website'                  => trans('admin.website'),
            'lat'                      => trans('admin.lat'),
            'lng'                      => trans('admin.lng'),
            'icon'                     => trans('admin.mall_icon'),
        ]);

        if(request()->hasFile('icon')) {
            
            $data['icon'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'icon',
                'path'          => 'malls',
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]);
        }

        Mall::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('malls'));
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
        $mall = Mall::find($id);
        $title   = trans('admin.edit_record');
        return view('admin.malls.edit',compact('mall','title'));
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
            'mall_name_ar'             => 'required',
            'mall_name_en'             => 'required',
            'contact_name'             => 'sometimes|nullable|string',
            'mobile'                   => 'required|numeric',
            'email'                    => 'required|email',
            'country_id'               => 'required|numeric',
            'facebook'                 => 'sometimes|nullable|url',
            'twitter'                  => 'sometimes|nullable|url',
            'website'                  => 'sometimes|nullable|url',
            'address'                  => 'sometimes|nullable',
            'lat'                      => 'sometimes|nullable',
            'lng'                      => 'sometimes|nullable',
            'icon'                     => validate_image(),
        ], [],[
            'mall_name_ar'             => trans('admin.name_ar'),
            'mall_name_ar'             => trans('admin.name_en'),
            'contact_name'             => trans('admin.contact_name'),
            'mobile'                   => trans('admin.mobile'),
            'email'                    => trans('admin.email'),
            'address'                  => trans('admin.address'),
            'country_id'               => trans('admin.country_id'),            
            'facebook'                 => trans('admin.facebook'),
            'twitter'                  => trans('admin.twitter'),
            'website'                  => trans('admin.website'),
            'lat'                      => trans('admin.lat'),
            'lng'                      => trans('admin.lng'),
            'icon'                     => trans('admin.mall_icon'),
        ]);

        if(request()->hasFile('icon')) {
            
            $data['icon'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'icon',
                'path'          => 'malls',
                'upload_type'   => 'single',
                'delete_file'   => Mall::find($id)->icon,
            ]);
        }

        Mall::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('malls'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $malls = Mall::find($id);
        Storage::delete($malls->icon);
        $malls->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('malls'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            foreach(request('item') as $id) {
                $malls = Mall::find($id);
                Storage::delete($malls->icon);
                $malls->delete();
            }
        } else {
            $malls = Mall::find(request('item'));
            Storage::delete($malls->icon);
            $malls->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('malls'));
    }

}
