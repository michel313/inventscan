<?php

namespace App\Http\Controllers;

use App\ProductChildMerge;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Supplier;
use App\Category;
use App\Subcategory;
use App\ChildProduct;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Psy\Util\Json;


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
     * @return View
     **/
    public function index()
    {

        $products = ProductChildMerge::orderBy('sku')->paginate(20);

        foreach ($products as $key=>$product) {


            if(strpos($product->sku,'.')){

                $sku = explode('.',$product->sku);

                $mainProductPrice = Product::where('sku',$sku[0])->get()->pluck('price')->first();

            }else{
                $mainProductPrice = Product::where('id', $product->product_id)->get()->pluck('price')->first();
            }


            if (strpos($product->childPrice, '/')) {

                $quantity = explode('/', $product->childPrice);
                $formulaPrice = (float)$mainProductPrice / (float)$quantity[1];
                $products[$key]->childPriceForm = $formulaPrice;


                
            } else if (strpos($product->childPrice, '*')) {

                $quantity = explode('*', $product->childPrice);
                $formulaPrice = (float)$mainProductPrice * (float)$quantity[1];
                $products[$key]->childPriceForm = $formulaPrice;

            }else{

                $products[$key]->childPriceForm = $mainProductPrice;

            }

        }
        
        return view('products.index', compact('products'));
    }

    /**
     * method edit
     * @param $product
     * @return View
     **/
    public function edit(Product $product)
    {
        $selectCats['suppliersList']   = Supplier::all();
        $selectCats['categoryList']    = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        return view('products.edit', compact('product', 'selectCats'));
    }

    /**
     * method new
     * @return View
     */
    public function new()
    {
        $selectCats['suppliersList']   = Supplier::all();
        $selectCats['categoryList']    = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        return view('products.new', compact('selectCats'));
    }

    /**
     * method store
     * @param $request
     * @param $product
     * @return Redirect
     **/
    public function store(Request $request, Product $product)
    {

        $this->validate($request, [
            'sku'      => 'required|unique:products,sku',
            'title'    => 'required',
            'price'    => 'required',
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
     * @return Redirect
     **/
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
                'sku'      => 'required',
                'title'    => 'required',
                'price'    => 'required',
                'ean_code' => 'required'
        ]);

        $product->update($request->all());

        flash()->success('Product has been updated successfully');

        return redirect('products');
    }

    /**
     * method destroy
     * @param $request
     * @param $product
     * @return Json
     **/
    public function destroy(Request $request, Product $product)
    {
        if ($request->ajax()) {

            $product_id = $request['deleteID'];
            $result = $product->find($product_id)->delete();

            return response()->json(['status' => 'success']);

            exit;

        } else {

            $product->delete();

            flash()->success('Product has been removed successfully');

            return redirect('products');

        }

    }

    /**
     * method productsChild
     * @param $id
     * @return View
     **/
    public function productsChild($id = false)
    {

        $product_id = $id;
        $productChildList = ChildProduct::where('product_id', $product_id)->get();

        return view('products.child-all', compact('product_id', 'productChildList'));
    }

    /**
     * method productsChildCreate
     * @param int|bool $sku
     * @return \Illuminate\View\
     */
    public function productsChildCreate($sku = false,ChildProduct $childProduct)
    {

        $selectCats['suppliersList'] = Supplier::all();
        $selectCats['categoryList'] = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        $productInfo = Product::where('sku',$sku)->first();

        if(count($productInfo)){
            $productInfo = $productInfo->toArray();
        }

        $productChild = $childProduct->productChild($sku);

        if(count($productChild)){
            
            $productChildLast = $productChild[0];

            if (!empty($productChildLast->sku)) {
                $getChildNumber = explode('.', $productChildLast->sku)['1'];
            }
        }

        $productInfo['childCount'] = ChildProduct::where('sku', $sku)->count();
        
        if (empty($getChildNumber)) {
            $getChildNumber = 1;
        } else {
            $getChildNumber++;
        }

        $productInfo['childSkuNumber'] = $getChildNumber;

        return view('products.child-create', compact('productInfo', 'productChildLast', 'selectCats'));
    }

    /**
     * method createChild
     * @param $request
     * @functionality add in db childProduct new child
     * @return Redirect
     **/
    public function createChild(Request $request)
    {

        $this->validate($request, [
            'sku'      => 'required|unique:child_products,sku',
            'title'    => 'required',
            'price'    => 'required',
            'ean_code' => 'required|unique:child_products,ean_code'
        ]);


        ChildProduct::create($request->all());

        return redirect('products');
    }

    /**
     * method editChild
     * @param $pr_id ;
     * @param $child_id ;
     * @functionality edit part of Child Product
     * @return Redirect
     **/
    public function editChild($child_id = false)
    {

        $selectCats['suppliersList']   = Supplier::all();
        $selectCats['categoryList']    = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        $product = ChildProduct::find($child_id);

        return view('products.child-edit', compact('product', 'selectCats'));
    }

    /**
     * method updateChild
     * @param $request
     * @param $childProduct
     * @return Redirect
     **/
    public function updateChild(Request $request, ChildProduct $childProduct)
    {

        $this->validate($request, [
            'title'    => 'required',
            'price'    => 'required',
            'ean_code' => 'required'
        ]);
        
        $childID = $request->input('childID');
        $input   = $request->except('_method', '_token', 'childID', 'sku');
        $childProduct->where('id', $childID)->update($input);

        return redirect('products/');

    }

    /**
     * method destroyChild
     * @param $request
     * @param $childProduct
     * @return Json
     **/
    public function destroyChild(Request $request, ChildProduct $childProduct)
    {
        if ($request->ajax()) {

            $product_id = $request['deleteID'];
            $result = $childProduct->find($product_id)->delete();

            return response()->json(['status' => 'success']);
        }

    }

    
   


}
