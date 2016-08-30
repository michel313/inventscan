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
    }

    /**
     * method export
     * @param ExportPaths $exportPaths
     * @return View
     **/
    public function index(ExportPaths $exportPaths)
    {

        $paths = $exportPaths->all();

        if(is_null($paths)){
            return redirect('export');
        }

        return view('export',compact('paths'));
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
     * @param $path
     * @return string
     */
    private function returnPath($path){

        if($path == '0'){

            $path = public_path('assets/exports');

        }else{

            if (substr($path, 0, 1) == '/') {

                $path = substr($path,1);

            }

            $path = base_path().'/'.$path;


        
            if(!file_exists($path)) {
                mkdir($path,0600, true);
            }

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


        $path = $request['path'];

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

            $mainPrice = Product::Select('price')->where(['sku' => $childSku])->first();
            

            if(!is_null($mainPrice)){

                $mainPrice->toArray();

                if($formula == 'formula'){

                    $childFormulaProducts[$key]['formula'] = $child['price'];

                    session()->put('formula','true');
                }

                if(strpos($child['price'],'*')) {

                    $multiplePrice = explode('*', $child['price']);

                    $childFormulaProducts[$key]['price'] = $child['price'] * $multiplePrice[1];

                }else if(strpos($child['price'],'/')) {

                    $multiplePrice = explode('/', $child['price']);

                    $childFormulaProducts[$key]['price'] = $child['price'] / (int)$multiplePrice[1];

                }else{

                    $childFormulaProducts[$key]['price'] = $mainPrice['price'];

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

                $path = $this->returnPath($path);

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

                    $path = $this->returnPath($path);

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


                    $path = $this->returnPath($path);

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
     * @param $exportPaths
     * @return View;
     **/
    public function exportIndex(ExportPaths $exportPaths){
        
        $paths = $exportPaths->all();
        
        return view('export.index',compact('paths'));
    }
    
    /**
     * method exportCreate
     * @return View;
     */
    public function exportCreate(){
        return view('export.create');
    }

    /**
     * @param Request $request
     * @param ExportPaths $exportPaths
     * @return Redirect
     */
    public function exportStore(Request $request,ExportPaths $exportPaths){

        $this->validate($request, [
            'path' => 'required',
        ]);

        $exportPaths->create($request->all());

        return redirect('/export-path');

    }

    /**
     * method updateExport
     * @param int $id
     * @param ExportPaths $exportPaths
     * @return View
     */
    public function exportEdit(ExportPaths $exportPaths,$id){

        $path = $exportPaths->find($id);

        if(is_null($path)){
            return redirect('export-path');
        }

        return view('export.edit',compact('path'));
    }

    /**
     * method updateExport
     * @param int $id
     * @param ExportPaths $exportPaths
     * @param Request $request
     * @return View
     */
    public function updateEdit(ExportPaths $exportPaths,Request $request,$id){

        $this->validate($request, [
            'path' => 'required',
        ]);

        $path = [
          'path' =>  $request['path']
        ];

        $exportPaths->where('id',$id)->update($path);

        return redirect('export-path');
    }

    /**
     * method destroy
     * @param $request
     * @param $id
     * @param $exportPaths
     * @return resource
     */
    public function exportDestroy(Request $request,ExportPaths $exportPaths,$id){

        if ($request->ajax()) {

            $pathID = $request['deleteID'];
            $exportPaths->find($pathID)->delete();

            return response()->json(['status' => 'success']);

        } else {

            return redirect('export-path');

        }
    }

}