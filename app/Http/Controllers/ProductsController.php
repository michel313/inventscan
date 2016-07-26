<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Supplier;
use App\Category;
use App\Subcategory;
use App\ChildProduct;

class ProductsController extends Controller
{

    /**
     * method construct
    **/
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * method index
     **/

    public function index()
    {
      $products = Product::paginate(50);
      return view('products.index', compact('products'));
    }
    
    /**
     * method edit
     * @param $product
     **/
    public function edit(Product $product)
    {
        $selectCats['suppliersList']   = Supplier::all();
        $selectCats['categoryList']    = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        return view('products.edit', compact('product','selectCats'));
    }
    

    /**
     * method new
     **/
    public function new()
    {
        $selectCats['suppliersList']   = Supplier::all();
        $selectCats['categoryList']    = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();
        
        return view('products.new',compact('selectCats'));
    }
    

    /**
     * method store
     * @param $request
     * @param $product
     **/
    public function store(Request $request, Product $product)
    {
        
      $this->validate($request, [
        'sku' => 'required|unique:products,sku',
        'title' => 'required',
        'price' => 'required',
        'ean_code' => 'required|unique:products,ean_code'
      ]);

      $product->create($request->all());

      flash()->success('Product has been saved successfully');

      return redirect('products');
    }



    /**
     * method update
     * @param $request
     * @param $product
     **/
    public function update(Request $request, Product $product)
    {
      $this->validate($request, [
        'sku'       => 'required',
        'title'     => 'required',
        'price'     => 'required',
        'ean_code'  => 'required'
      ]);




      $product->update($request->all());

      flash()->success('Product has been updated successfully');

      return redirect('products');
    }

    
    /**
     * method destroy
     * @param $request
     * @param $product
     **/
    public function destroy(Request $request, Product $product)
    {
        if ($request->ajax()){

           $product_id = $request['product_id'];
           $result     = $product->find($product_id)->delete();

           return response()->json(['status' => 'success']);

           exit;
            
        }else{
            $product->delete();

            flash()->success('Product has been removed successfully');

            return redirect('products');
        }

    }
    
    
    /**
     * @param $id
     * @return \Illuminate\View\View
    **/
    public function productsChild($id = false){

        $product_id       = $id;
        $productChildList = ChildProduct::where('product_id',$product_id)->get();
      
        return view('products.child-product-all',compact('product_id','productChildList'));
    }


    /**
     * @param int|bool $id
     * @return \Illuminate\View\View
     */
    public function productsChildCreate($id = false){
        
        $selectCats['suppliersList']   = Supplier::all();
        $selectCats['categoryList']    = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        $productInfo                   =  Product::find($id);
        $productChildLast              =  ChildProduct::orderBy('id', 'desc')->where('product_id',$id)->first();
        $productInfo['childCount']     =  ChildProduct::where('product_id',$id)->count();

        if(!empty($productChildLast->sku)){
            $getChildNumber  =  explode('.',$productChildLast->sku)['1'];
        }

        if(empty($getChildNumber)){
            $getChildNumber = 1;
        }else{
            $getChildNumber++;
        }

        $productInfo['childSkuNumber']  =  $getChildNumber;

        return view('products.product-child-create',compact('productInfo','productChildLast','selectCats'));
    }


    /**
     * @param $request
     * @param $childProduct
     * @param $product
     * @functionality add in db childProduct new child
    **/
    public function createChild(Request $request,ChildProduct $childProduct,Product $product){

        $priceFormula  = $request['priceFormula'];
        $mainPrice     = $product->where('id', $request['product_id'])->pluck('price')->first();
        $childPrice    = '';


        if (strpos($priceFormula, '/') !== false ) {

            $priceFormula = explode('/',$priceFormula);

            $quantity = $priceFormula[1];

            $childPrice = (int)$mainPrice/(int)$quantity;

        }else if(strpos($priceFormula, '*') !== false){

            $priceFormula = explode('*',$priceFormula);

            $quantity = $priceFormula[1];

            $childPrice = (int)$mainPrice*(int)$quantity;

        }

        $request['secondaryPrice'] = $childPrice;

        ChildProduct::create($request->all());

        return redirect('products/'.$request['product_id'].'/child');
    }

    /**
     * method editChild
     * @param $pr_id;
     * @param $child_id;
     * @functionality edit part of Child Product
    **/

    public function editChild($pr_id = false,$child_id = false){

        $selectCats['suppliersList']   = Supplier::all();
        $selectCats['categoryList']    = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        $product                = ChildProduct::find($child_id);
        $product['mainProduct'] = $pr_id;

        return view('products.editChild',compact('product','selectCats'));
    }


    /**
     * method updateChild
     * @param $request
     * @param $childProduct
     * @param $product
    **/

    public function updateChild(Request $request,ChildProduct $childProduct,Product $product){

        $this->validate($request, [
            'title'     => 'required',
            'mainPrice' => 'required'
        ]);

        $childID       = $request->input('childID');
        $mainProductID = $request->input('mainProductID');
        $priceFormula  = $request['priceFormula'];
        $mainPrice     = $product->where('id',$mainProductID)->pluck('price')->first();
        $childPrice    = '';



        if (strpos($priceFormula, '/') !== false ) {

            $priceFormula = explode('/',$priceFormula);

            $quantity = $priceFormula[1];

            $childPrice = (int)$mainPrice/(int)$quantity;

        }else if(strpos($priceFormula, '*') !== false){

            $priceFormula = explode('*',$priceFormula);

            $quantity = $priceFormula[1];

            $childPrice = (int)$mainPrice*(int)$quantity;

        }



        $input                   = $request->except('_method', '_token','childID','mainProductID','sku','secondaryPrice');
        $input['secondaryPrice'] = $childPrice;

        $childProduct->where('id',$childID)->update($input);

        return redirect('products/'.$mainProductID.'/child');

    }

    /**
     * method destroy
     * @param $request
     * @param $childProduct
     **/
    public function destroyChild(Request $request, ChildProduct $childProduct)
    {
        if ($request->ajax()) {

            $product_id = $request['product_id'];
            $result     = $childProduct->find($product_id)->delete();

            return response()->json(['status' => 'success']);

            exit;
        }
   
    }
    
    
    /**
     * method priceFormula
     * @param $request
     * @param $product
    **/
    public function priceFormula(Request $request,Product $product){
        if ($request->ajax()) {

            $mainProductID = $request['mainProductID'];
            $priceFormula  = $request['priceFormula'];

            $mainPrice = $product->where('id', $mainProductID)->pluck('price')->first();

            if (strpos($priceFormula, '/') !== false ) {

                $priceFormula = explode('/',$priceFormula);

                $quantity = $priceFormula[1];

                $childPrice = (int)$mainPrice/(int)$quantity;

                return response()->json(['status' => 'success','response' => $childPrice]);

                exit;

            }else if(strpos($priceFormula, '*') !== false){

                $priceFormula = explode('*',$priceFormula);

                $quantity = $priceFormula[1];

                $childPrice = (int)$mainPrice*(int)$quantity;

                return response()->json(['status' => 'success','response' => $childPrice]);

                exit;
            }

        }
    }


}
