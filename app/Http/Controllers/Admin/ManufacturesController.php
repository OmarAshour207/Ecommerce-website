<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ManufactureDatatable;

use Illuminate\Http\Request;
use App\Model\Manufacture;
use Storage;

class ManufacturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufactureDatatable $manufacture)
    {
        return $manufacture->render('admin.manufactures.index',['title'=> trans('admin.manufactures')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufactures.create',['title'=> trans('admin.create_manufacture')]);
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
            'manufacture_name_ar'      => 'required',
            'manufacture_name_en'      => 'required',
            'contact_name'             => 'sometimes|nullable|string',
            'mobile'                   => 'required|numeric',
            'email'                    => 'required|email',
            'address'                  => 'sometimes|nullable',
            'lat'                      => 'sometimes|nullable|numeric',
            'lng'                      => 'sometimes|nullable|numeric',
            'facebook'                 => 'sometimes|nullable|url',
            'twitter'                  => 'sometimes|nullable|url',
            'website'                  => 'sometimes|nullable|url',
            'icon'                     => validate_image(),
        ], [],[
            'manufacture_name_ar'      => trans('admin.manufacture_name_ar'),
            'manufacture_name_ar'      => trans('admin.manufacture_name_en'),
            'facebook'                 => trans('admin.facebook'),
            'twitter'                  => trans('admin.twitter'),
            'website'                  => trans('admin.website'),
            'contact_name'             => trans('admin.contact_name'),
            'email'                    => trans('admin.email'),
            'mobile'                   => trans('admin.mobile'),          
            'address'                  => trans('admin.address'),              
            'lat'                      => trans('admin.lat'),
            'lng'                      => trans('admin.lng'),
            'icon'                     => trans('admin.manufacture_icon'),
        ]);

        if(request()->hasFile('icon')) {
            
            $data['icon'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'icon',
                'path'          => 'manufactures',
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]);
        }

        Manufacture::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('manufactures'));
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
        $manufacture = Manufacture::find($id);
        $title   = trans('admin.edit_record');
        return view('admin.manufactures.edit',compact('manufacture','title'));
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
            'manufacture_name_ar'      => 'required',
            'manufacture_name_en'      => 'required',
            'facebook'                 => 'sometimes|nullable|url',
            'twitter'                  => 'sometimes|nullable|url',
            'website'                  => 'sometimes|nullable|url',
            'contact_name'             => 'sometimes|nullable|string',
            'mobile'                   => 'required|numeric',
            'email'                    => 'required|email',
            'address'                  => 'sometimes|nullable',
            'lat'                      => 'sometimes|nullable',
            'lng'                      => 'sometimes|nullable',
            'icon'                     => validate_image(),
        ], [],[
            'manufacture_name_ar'      => trans('admin.manufacture_name_ar'),
            'manufacture_name_ar'      => trans('admin.manufacture_name_en'),
            'facebook'                 => trans('admin.facebook'),
            'twitter'                  => trans('admin.twitter'),
            'website'                  => trans('admin.website'),
            'contact_name'             => trans('admin.contact_name'),
            'email'                    => trans('admin.email'),
            'mobile'                   => trans('admin.mobile'),
            'address'                  => trans('admin.address'),            
            'lat'                      => trans('admin.lat'),
            'lng'                      => trans('admin.lng'),
            'icon'                     => trans('admin.manufacture_icon'),
        ]);

        if(request()->hasFile('icon')) {
            
            $data['icon'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'icon',
                'path'          => 'manufactures',
                'upload_type'   => 'single',
                'delete_file'   => manufacture::find($id)->icon,
            ]);
        }

        Manufacture::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('manufactures'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufactures = Manufacture::find($id);
        Storage::delete($manufactures->icon);
        $manufactures->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('manufactures'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            foreach(request('item') as $id) {
                $manufactures = Manufacture::find($id);
                Storage::delete($manufactures->icon);
                $manufactures->delete();
            }
        } else {
            $manufactures = Manufacture::find(request('item'));
            Storage::delete($manufactures->icon);
            $manufactures->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('manufactures'));
    }

}
