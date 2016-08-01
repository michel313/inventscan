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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;
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
        $products = ProductChildMerge::orderBy('sku')->paginate(5);

        foreach ($products as $product) {

            $mainProductPrice = Product::where('id', $product->product_id)->get()->pluck('price')->first();

            if (strpos($product->mainPrice, '/')) {
                $quantity = explode('/', $product->mainPrice);
                $formulaPrice = (float)$mainProductPrice / (float)$quantity[1];
                $product->FormulaPrice = $formulaPrice;

            } else if (strpos($product->mainPrice, '*')) {
                $quantity = explode('*', $product->mainPrice);
                $formulaPrice = (float)$mainProductPrice * (float)$quantity[1];
                $product->FormulaPrice = $formulaPrice;
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
        $selectCats['suppliersList'] = Supplier::all();
        $selectCats['categoryList'] = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        return view('products.edit', compact('product', 'selectCats'));
    }

    /**
     * method new
     * @return View
     */
    public function new()
    {
        $selectCats['suppliersList'] = Supplier::all();
        $selectCats['categoryList'] = Category::all();
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
     * @return Redirect
     **/
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'sku' => 'required',
            'title' => 'required',
            'price' => 'required',
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
     * @param int|bool $id
     * @return \Illuminate\View\
     */
    public function productsChildCreate($id = false)
    {

        $selectCats['suppliersList'] = Supplier::all();
        $selectCats['categoryList'] = Category::all();
        $selectCats['subCategoryList'] = Subcategory::all();

        $productInfo = Product::find($id);
        $productChildLast = ChildProduct::orderBy('id', 'desc')->where('product_id', $id)->first();
        $productInfo['childCount'] = ChildProduct::where('product_id', $id)->count();

        if (!empty($productChildLast->sku)) {
            $getChildNumber = explode('.', $productChildLast->sku)['1'];
        }

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
            'sku' => 'required|unique:childproducts,sku',
            'title' => 'required',
            'mainPrice' => 'required',
            'ean_code' => 'required|unique:childproducts,ean_code'
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
    public function editChild($pr_id = false, $child_id = false)
    {

        $selectCats['suppliersList'] = Supplier::all();
        $selectCats['categoryList'] = Category::all();
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
            'title' => 'required',
            'mainPrice' => 'required',
            'ean_code' => 'required'
        ]);

        $childID = $request->input('childID');
        $input   = $request->except('_method', '_token', 'childID', 'mainProductID', 'sku');
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

            exit;
        }

    }

    /**
     * method importCsvCreate
     * @return View
     */
    public function importCsvCreate()
    {
        return view('products.csv-create');
    }

    /**
     * method importCsv
     * @param Request $request
     * @param Excel $excel
     * @param $product
     * @return Redirect
     */
    public function importCsv(Request $request, Excel $excel, Product $product)
    {
        if ($request->hasFile('import_file_csv')) {

            $file     = $request->file('import_file_csv');
            $fileName = $file->getClientOriginalName();
            $path     = $request->file('import_file_csv')->getRealPath();
            $content  = file_get_contents($path);

            $destinationPath = base_path() . '/public/assets/csv/';
            $file->move($destinationPath, $fileName);

            $data['fillProducts']  = $product->getFillable();
            $data['fileName']      = $fileName;

            $lines                 = explode("\n", $content);
            if(strpos($lines[0],',')) {
                $data['columnsNames'] = explode(",", $lines[0]);
            }else if(strpos($lines[0],';')){
                $data['columnsNames'] = explode(";", $lines[0]);
            }

            return view('products.csv-create',compact('data'));

        } else {
            return redirect('products/import/csv');
        }

    }

    /**
     * method importCsvDB
     * @param $request
     * @param $product
     * @return  Redirect
     */
    public function importStore(Request $request,Product $product){

        $row          = [];
        $columnsNames = [];
        $insertData   = [];
        $path         = base_path() . '/public/assets/csv/'.$request['fileName'];
        $content      = file_get_contents($path);
        $lines        = explode("\n", $content);

        for ($i = 1; $i < sizeof($lines); $i++)
        {
            if(strpos($lines[0],',')) {
                $line = explode(",",$lines[$i]);
                if(count($line) > 1) {
                    $row[] = explode(",", $lines[$i]);
                }
            }else if(strpos($lines[0],';')){
                $line = explode(";",$lines[$i]);
                if(count($line) > 1){
                    $row[] = explode(";",$lines[$i]);
                }
            }
        }

        if(strpos($lines[0],',')) {
            $columnsNames = explode(",", $lines[0]);
        }else if(strpos($lines[0],';')){
            $columnsNames = explode(";", $lines[0]);
        }

        $skuPrefix = strtoupper(substr($columnsNames[0],0,2));
        $data      = $request->except('_method','_token','fileName', 'import_file_csv');

        for ($i =0;$i < sizeof($row);$i++){

            foreach ($data as $key => $v) {

                if(sizeof($v) == 2){

                    $insertData[$i][$key]=$row[$i][$v[0]].$row[$i][$v[1]];

                }else if(sizeof($v) == 1){

                    if($key == 'sku'){

                        $insertData[$i][$key] = $skuPrefix.$row[$i][$v[0]];

                    }else{

                        $insertData[$i][$key] = $row[$i][$v[0]];

                    }
                }
            }
        }

        $i = 0;

        foreach ($insertData as $value){

            if($i < 5){
                $product->create($value);
            }

            $i++;
        }


        unlink($path);

        return redirect('products');
    }


























    
}
