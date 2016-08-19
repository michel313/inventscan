<?php

namespace App\Http\Controllers;

use App\Category;
use App\ChildProduct;
use App\Http\Requests;
use App\Product;
use App\rememberedSuppliers;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ImportController extends Controller
{
    /**
     * method __construct
     * ImportController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * method importCsvCreate
     * @param $id
     * @return View
     */
    public function importCsvCreate($id = false)
    {
        $supplierID = $id;
        return view('import-csv.csv-create',compact('supplierID'));
    }
    
    /**
     * method importCsv
     * @param Request $request
     * @param $product
     * @param $rememberedSuppliers
     * @return Redirect
     */
    public function importCsv(Request $request, Product $product,rememberedSuppliers $rememberedSuppliers)
    {
        if ($request->hasFile('import_file_csv')) {

            $file       = $request->file('import_file_csv');
            $fileName   = $file->getClientOriginalName();
            $path       = $request->file('import_file_csv')->getRealPath();
            $content    = file_get_contents($path);
            $supplierID = time() .$request['supplierID']. uniqid();

            session(['supplierID' => $supplierID]);
            session([$supplierID  => $request['supplierID']]);

            $destinationPath = base_path() . '/public/assets/csv/';
            $file->move($destinationPath, $fileName);

            $lines                 = explode("\n", $content);
            $data['fillProducts']  = $product->getFillable();
            unset( $data['fillProducts'][6]);

            $data['fileName']      = $fileName;
            $data['supplierID']    = $request['supplierID'];
            $data['supplierID']    =  $supplierID;

            if(strpos($lines[0],',')) {
                $data['columnsNames'] = explode(",", $lines[0]);
            }else if(strpos($lines[0],';')){
                $data['columnsNames'] = explode(";", $lines[0]);
            }

            $rememberSupplier = $rememberedSuppliers->where('supplier_id',$request['supplierID'])->first();

            if(!is_null($rememberSupplier)){
                $rememberSupplier->toArray();
            }

            return view('import-csv.csv-create',compact('data','rememberSupplier'));

        } else {

            return redirect('suppliers');

        }

    }

    /**
     * method importCsvDB
     * @param $request
     * @param $category
     * @param $supplier
     * @return  Redirect
     */
    public function importStore(Request $request,Category $category,Supplier $supplier){

        $this->validate($request, [
            'sku'   => 'required',
            'price' => 'required',
        ]);

        $supplierRandID = session('supplierID');

        if($supplierRandID != $request['supplierID']){
            return back();
        }

        $supplierID     = session($supplierRandID);
        $row            = [];
        $insertProduct  = [];

        $insertChild  = [];
        $updateChild  = [];
        $insertMain   = [];
        $path         = base_path() . '/public/assets/csv/'.$request['fileName'];
        $content      = file_get_contents($path);
        $lines        = explode("\n", $content);
        $data         = $request->except('_method','_token','fileName', 'import_file_csv','supplierID');


        // Getting All Supllier Info
        $supplierInfo = $supplier->where('id',$supplierID)->first();

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

        // Update Remembered Table
        $updateSupplier                 = $data;
        $updateSupplier['supplier_id']  = [$supplierID];
        $this->updateRememberedSupplier($updateSupplier);
        
        for ($i=0;$i < sizeof($row);$i++){

            foreach ($data as $key => $v) {

                if(sizeof($v) == 2){

                    $insertProduct[$i][$key]=$row[$i][$v[0]].$row[$i][$v[1]];

                }else if(sizeof($v) == 1){

                    if($key == 'sku'){


                        if(!preg_match("/[a-z]/i", $row[$i][$v[0]])){

                            $insertProduct[$i][$key] = $supplierInfo['shortcode'].$row[$i][$v[0]];

                        }else{

                            $insertProduct[$i][$key] = $row[$i][$v[0]];
                        }

                    }
                else{

                        $insertProduct[$i][$key] = $row[$i][$v[0]];
                    }

                }
            }
        }





        foreach ($insertProduct as $key=>$value)
        {

            if(strpos($value['sku'],'.')){
                $insertChild[$key] = $value;
                $insertChild[$key] ['supplier_id'] = $supplierID;
            }else{
                $insertMain[$key] = $value;
                $insertMain[$key]['supplier_id'] = $supplierID;
            }

        }



//        $selectUpdateProduct = ChildProduct::select('sku')->whereIn('sku',array_column($insertChild,"sku"))->get()->toArray();
//
//        for ($i = 0;$i<sizeof($selectUpdateProduct);$i++) {
//            foreach ($insertChild as $item) {
//
//                if ($item['sku'] == $selectUpdateProduct[$i]['sku']) {
//                    $updateChild[$i] = $insertChild[$i];
//                    unset($insertChild[$i]);
//                }
//
//            }
//        }
//
//        foreach ($updateChild as $value){
//
//            ChildProduct::where('sku',$value['sku'])->update($value);
//        }


        $categoriesChild = array_unique(array_column($insertChild,"category_id"));
        $categoriesMain  = array_unique(array_column($insertMain,"category_id"));


        $categories = array_merge($categoriesChild,$categoriesMain);

        foreach ($categories as $cat){

            $selectCat = Category::where('title',$cat)->first();

            if(is_null($selectCat)){
                Category::create(['title'=>$cat]);
            }

        }

        $allCategories = Category::all();

        if(count($allCategories)){

            $allCategories = $allCategories->toArray();

            foreach ($allCategories as $item){

                foreach ($insertMain as $key => $product){

                    if($product['category_id'] == $item['title']){

                        $insertMain[$key]['category_id'] = $item['id'];
                    }
                }

                foreach ($insertChild as $key => $product){

                    if($product['category_id'] == $item['title']){

                        $insertChild[$key]['category_id'] = $item['id'];
                    }
                }

            }

        }

        Product::whereIn('sku',array_column($insertMain,"sku"))->delete();

        Product::insert($insertMain);

        ChildProduct::whereIn('sku',array_column($insertChild,"sku"))->delete();

        ChildProduct::insert($insertChild);
        
        unlink($path);

        return response()->json(['status' => 'success']);
    }

    /**
     * method updateRememberedSupplier
     * @param $data
     */
    public function updateRememberedSupplier($data){

        $UpdateData = [];

        foreach ($data as $key=>$value){

            if(count($value) == 1){
                $UpdateData[$key] = $value[0];
            }else if(count($value) == 2){
                $UpdateData[$key]= implode($value,',');
            }

        }

        $productInsert = rememberedSuppliers::firstOrCreate(['supplier_id' => $UpdateData['supplier_id']]);

        $productInsert->update($UpdateData);
    }

    /**
     * method importCreate
     * @param $supplier;
     * @return View
     */
    public function importCreate(Supplier $supplier){


        $supplierInfo = $supplier->all()->toArray();
        
        return view('import-csv.csv-create',compact('supplierInfo'));
    }



}


