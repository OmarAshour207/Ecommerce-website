<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ProductDatatable;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Size;
use App\Model\OtherData;
use App\Model\MallProduct;
use App\Model\Weight;
use Storage;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDatatable $product)
    {
        return $product->render('admin.products.index',['title'=> trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function prepare_weight_size()
    {
        if(request()->ajax() and request()->has('dep_id')) {
            $dep_list = array_diff(explode(',', get_parent(request('dep_id'))), [request('dep_id')]);

            $sizes = Size::where('is_public','yes')
            ->whereIn('department_id', $dep_list)
            ->orWhere('department_id', request('dep_id'))
            ->pluck('size_name_'.session('lang'),'id');
            
            $weights = Weight::pluck('weight_name_' . session('lang'), 'id');
            return view('admin.products.ajax.size_weight',[
                'sizes' => $sizes, 
                'weights' => $weights,
                'product' => Product::find(request('product_id')),
            ])->render();
        } else {
            return trans('admin.please_choose_dep');
        }
    }

    public function create()
    {
        $product = Product::create([
        'title'         => '',              
        ]);

        if(!empty($product)) {
            return redirect(aurl('products/'. $product->id . '/edit'));
        }
    }

    public function delete_main_image($id)
    {
        $product = Product::find($id);
        Storage::delete($product->photo);
        $product->photo = null;
        $product->save();
    }

    public function update_product_image($id)
    {
        $product = Product::where('id',$id)->update([
            'photo' => up()->upload([
                'file'          => 'file',
                'path'          => 'products/' . $id,
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]),
        ]);
        return response(['status' => true],200);
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
            'product_name_ar'      => 'required',
            'product_name_en'      => 'required',
            'logo'                 => 'required|'.validate_image(),
        ], [],[
            'product_name_ar'     => trans('admin.product_name_ar'),
            'product_name_ar'     => trans('admin.product_name_en'),
            'logo'                => trans('admin.Product_logo'),
        ]);

        if(request()->hasFile('logo')) {
            
            $data['logo'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'logo',
                'path'          => 'products',
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]);
        }

        Product::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('products'));
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
        $product = Product::find($id);
        return view('admin.products.product',[
            'title' => trans('admin.create_or_edit_product', 
            ['title' => $product->title ] ), 
            'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload_file($id)
    {
        if(request()->hasFile('file')) {    
            $fid = up()->upload([
                'file'          => 'file',
                'path'          => 'products/' . $id,
                'upload_type'   => 'files',
                'file_type'     => 'product',
                'relation_id'   => $id,
            ]);
            return response(['status' => true, 'id' => $fid], 200);
        }
    }

    public function delete_file()
    {
        if(request()->has('id')) {    
            up()->delete_f(request('id'));
        }
    }

    public function update($id)
    {
        $data = $this->validate(request(),[
            'title'             => 'required',
            'content'           => 'required',
            'photo'             => 'sometimes|nullable'.validate_image(),
            'department_id'     => 'required|numeric',
            'trade_id'          => 'required|numeric',
            'manu_id'           => 'required|numeric',
            'color_id'          => 'sometimes|nullable|numeric',
            'size'              => 'sometimes|nullable|',
            'size_id'           => 'sometimes|nullable|numeric',
            'currency_id'       => 'sometimes|nullable|numeric',
            'price'             => 'required|numeric',
            'stock'             => 'required|numeric',
            'start_at'          => 'required|date',
            'end_at'            => 'required|date',
            'price_offer'       => 'sometimes|nullable|numeric',
            'start_offer_at'    => 'sometimes|nullable|date',
            'end_offer_at'      => 'sometimes|nullable|date',
            'weight'            => 'sometimes|nullable',
            'weight_id'         => 'sometimes|nullable|numeric',
            'status'            => 'sometimes|nullable|in:pending,refused,active',
            'reason'            => 'sometimes|nullable',
        ], [],[
            'title'             => trans('admin.product_title'),
            'content'           => trans('admin.product_content'),
            'photo'             => trans('admin.photo'),
            'department_id'     => trans('admin.department_id'),
            'trade_id'          => trans('admin.trade_id'),
            'manu_id'           => trans('admin.manufacture_id'),
            'color_id'          => trans('admin.color_id'),
            'size'              => trans('admin.size'),
            'size_id'           => trans('admin.size_id'),
            'currency_id'       => trans('admin.currency_id'),
            'price'             => trans('admin.product_price'),
            'stock'             => trans('admin.stock'),
            'start_at'          => trans('admin.start_at'),
            'end_at'            => trans('admin.end_at'),
            'price_offer'       => trans('admin.price_offer'),
            'start_offer_at'    => trans('admin.start_offer_at'),
            'end_offer_at'      => trans('admin.end_offer_at'),
            'weight'            => trans('admin.weight'),
            'weight_id'         => trans('admin.weight_id'),
            'status'            => trans('admin.product_status'),
            'reason'            => trans('admin.reason'),
        ]);

        if(request()->has('mall')) {
            MallProduct::where('product_id' ,$id)->delete();
            foreach (request('mall') as $mall) {
                MallProduct::create([
                    'product_id' => $id,
                    'mall_id'    => $mall
                ]);
            }
        } else {
            MallProduct::where('product_id' ,$id)->delete();
        }

        if(request()->has('input_key') && request()->has('input_value')) {
            $i = 0;
            $other_data = '';
            OtherData::where('product_id' ,$id)->delete();
            foreach(request('input_key') as $key) {
                $data_value = !empty(request('input_value')[$i]) ? request('input_value')[$i] : '';
                OtherData::create([
                    'product_id'    => $id,
                    'data_key'      => $key,
                    'data_value'    => $data_value,
                ]);
                $i++;
            }
            // $data['other_data'] = rtrim($other_data, '|');
        }

        Product::where('id', $id)->update($data);
        return response(['status' => true,'message' => trans('admin.updated_record')],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        Storage::delete($products->logo);
        $products->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('products'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            foreach(request('item') as $id) {
                $products = Product::find($id);
                Storage::delete($products->logo);
                $products->delete();
            }
        } else {
            $products = Product::find(request('item'));
            Storage::delete($products->logo);
            $products->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('products'));
    }

}
