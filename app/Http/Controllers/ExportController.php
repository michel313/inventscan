<?php

namespace App\Http\Controllers;

use App\ChildProduct;
use App\ExportPaths;
use App\Location;
use App\Product;
use App\Server;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\View\View;

class ExportController extends Controller
{
    /**
     * method __construct
     * ImportController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        chmod(public_path().'/assets/exports-xls',0755);
    }

    /**
     * method export
     * @return View
     **/
    public function index()
    {
        return view('export');
    }

    /**
     * method currentDate
     * @return string
     */
    private function currentDate(){
        
        $date = new \DateTime();
        $currentDate = $date->format('Y-m-d--H-i-s') ;

        return $currentDate;
    }

    /**
     * method returnPath
     * @param $pathname
     * @return string
     */
    private function returnPath($pathname){

        $allPath = json_decode(file_get_contents(storage_path('paths.json')));
        
        $path = $allPath->paths->$pathname;

        if($path == ''){

            $path = base_path('/download');

        }else{

            if (substr($path, 0, 1) == '/') {

                $path = substr($path,1);

            }

            $path = base_path().'/'.$path;

            if(!file_exists($path)) {
                mkdir($path,0755, true);
            }

            chmod($path,0755);

        }

        return $path;
    }

    /**
     * method exportFormula
     * @param $formula
     * @param $server
     * @param $request
     * @return Redirect;
     */
    public function exportProductFormula(Request $request,$formula = false,$server = false){

        session()->forget('formula');

        $childFormulaProducts      = [];
        $childExcelWithoutFormulas = [];

        $childProducts = ChildProduct::getChildAll();
        $products      = Product::getAllProducts();

        if(count($childProducts)){
            $childProducts = $childProducts->toArray();
        }
        
        if(count($products)){
            $products = $products->toArray();
        }

        if(empty($products) && empty($childProducts)){

            flash()->error('There are no Products to export');

            return redirect()->back();
        }

        foreach ($childProducts as $childProduct){

            if(strpos($childProduct['price'],'x') !== false){
                $childFormulaProducts[] = $childProduct;
            }else{
                $childExcelWithoutFormulas[] = $childProduct;
            }
            
        }

        foreach ($childFormulaProducts as $key => $child){

            $childSku  = explode('.',$child['sku']);
            $childSku  = $childSku[0];

            $mainPrice = Product::Select('price')->where(['sku' => $childSku])->pluck('price')->first();



            if(!is_null($mainPrice)){

                if($formula == 'formula'){

                    $childFormulaProducts[$key]['formula'] = $child['price'];

                    session()->put('formula','true');
                }



                if(strpos($child['price'],'*')) {

                    $multiplePrice = explode('*', $child['price']);

                    $childFormulaProducts[$key]['price'] = $mainPrice* $multiplePrice[1];


                }else if(strpos($child['price'],'/')) {

                    $multiplePrice = explode('/', $child['price']);

                    $childFormulaProducts[$key]['price'] = $mainPrice/ (int)$multiplePrice[1];

                }else{

                    $childFormulaProducts[$key]['price'] = $mainPrice;

                }
            }
        }

        $excelProductAll = array_merge($products,$childFormulaProducts,$childExcelWithoutFormulas);


        switch ($server) {

            case false:

                $result =  \Excel::create('product-'.Carbon::now()->toDateString(), function ($excel) use ($excelProductAll) {
                    $excel->sheet('Sheet', function ($sheet) use ($excelProductAll) {
                        $sheet->loadView('export-csv.products-formula', ['products' => $excelProductAll]);
                    });
                })->store('xls',public_path('assets/exports-xls'));


                return response(['status' => 'success','data' => $result->filename.'.xls']);

                break;

            case 'server':

                $path = $this->returnPath('product');

                \Excel::create('product-'.$this->currentDate(), function ($excel) use ($excelProductAll) {
                    $excel->sheet('Sheet', function ($sheet) use ($excelProductAll) {
                        $sheet->loadView('export-csv.products-formula', ['products' => $excelProductAll]);
                    });
                })->store('csv', $path);


                return response(['status' => 'success']);

                break;

            default:

                return response(['status' => 'error']);

        }

    }

    /**
     * method exportLocations
     * @param $server
     * @param $request
     * @return Redirect
     */
    public function exportLocations(Request $request,$server=false){

        $path = $request['path'];

        $locations = Location::all();

        if(count($locations)){

            $locations->toArray();

            switch ($server){

                case false:

                    $result = \Excel::create('location-'.Carbon::now()->toDateString(), function($excel) use ($locations)  {
                            $excel->sheet('Sheet', function($sheet) use ($locations) {
                                $sheet->loadView('export-csv.locations',['locations' => $locations]);
                            });
                        })->store('xls', public_path('assets/exports-xls'));

                        return response(['status' => 'success','data' => $result->filename.'.xls']);

                    break;

                case 'server':

                    $path = $this->returnPath('location');

                    \Excel::create('location'.$this->currentDate(), function($excel) use ($locations)  {
                        $excel->sheet('Sheet', function($sheet) use ($locations) {
                            $sheet->loadView('export-csv.locations',['locations' => $locations]);
                        });
                    })->store('csv', $path);


                    return response(['status' => 'success']);

                    break;

                default:

                    return response(['status' => 'error']);
            }

        }else {
            return response(['status' => 'error']);
        }



    }

    /**
     * method exportServers
     * @param  $request
     * @param  $server
     * @return Redirect
     */
    public function exportServers(Request $request,$server=false){

        $path = $request['path'];

        $servers = Server::get();

        if(count($servers)){

            $servers->toArray();

            switch ($server){

                case false:

                    $result =  \Excel::create('servers-'.Carbon::now()->toDateString(), function($excel) use ($servers)  {
                        $excel->sheet('Sheet', function($sheet) use ($servers) {
                            $sheet->loadView('export-csv.servers',['servers' => $servers]);
                        });
                    })->store('xls',public_path('assets/exports-xls'));

                    return response(['status' => 'success','data' => $result->filename.'.xls']);

                    break;

                case 'server':


                    $path = $this->returnPath('server');

                     \Excel::create('servers'.$this->currentDate(), function($excel) use ($servers)  {
                        $excel->sheet('Sheet', function($sheet) use ($servers) {
                            $sheet->loadView('export-csv.servers',['servers' => $servers]);
                        });
                    })->store('csv', $path);

                    return response(['status' => 'success']);

                    break;

                default:

                    return response(['status' => 'error']);
            }


        }else {
            flash()->error('There are no Servers to export');
        }

        return redirect()->back();

    }
    
    /**
     * method exportIndex
     * @return View;
     **/
    public function exportPath(){

        $path = json_decode(file_get_contents(storage_path('paths.json')));
        
        return view('export.index',compact('path'));
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function exportPathUpdate(Request $request)
    {
        $config = json_decode(file_get_contents(storage_path('paths.json')));
        
        foreach ($request->all() as $key => $path){

            if(isset($config->paths->$key)){
                $config->paths->$key = $path;
            }
        }

        file_put_contents(storage_path('paths.json'),json_encode($config));


        flash()->success('Path has been updated successfully');

        return back();
    }





}