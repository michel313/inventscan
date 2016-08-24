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
     * method currentDate
     * @return string
     */
    private function currentDate(){
        
        $date = new \DateTime();
        $currentDate = $date->format('Y-m-d--H-i-s') ;

        return $currentDate;
    }

    /**
     * method exportFormula
     * @param $formula
     * @param $server
     * @return Redirect;
     */
    public function exportProductFormula($formula = false,$server = false){

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

                \Excel::create('product-'.Carbon::now()->toDateString(), function ($excel) use ($excelProductAll) {
                    $excel->sheet('Sheet', function ($sheet) use ($excelProductAll) {
                        $sheet->loadView('export-csv.products-formula', ['products' => $excelProductAll]);
                    });
                })->export('xls');

                break;

            case 'server':

                \Excel::create('product-'.$this->currentDate(), function ($excel) use ($excelProductAll) {
                    $excel->sheet('Sheet', function ($sheet) use ($excelProductAll) {
                        $sheet->loadView('export-csv.products-formula', ['products' => $excelProductAll]);
                    });
                })->store('csv', public_path('assets/exports'));

                break;

            default:

                flash()->error('Please Try Again');

                return redirect()->back();
        }


        return redirect()->back();
    }

    /**
     * method exportLocations
     * @param $server
     * @return Redirect
     */
    public function exportLocations($server=false){

        $locations = Location::all();

        if(count($locations)){

            $locations->toArray();

            switch ($server){

                case false:
                        \Excel::create('location-'.Carbon::now()->toDateString(), function($excel) use ($locations)  {
                            $excel->sheet('Sheet', function($sheet) use ($locations) {
                                $sheet->loadView('export-csv.locations',['locations' => $locations]);
                            });
                        })->download('xls');
                    break;

                case 'server':

                    \Excel::create('location'.$this->currentDate(), function($excel) use ($locations)  {
                        $excel->sheet('Sheet', function($sheet) use ($locations) {
                            $sheet->loadView('export-csv.locations',['locations' => $locations]);
                        });
                    })->store('csv', public_path('assets/exports'));

                    break;

                default:

                    flash()->error('Please Try Again');

                    return redirect()->back();
            }

        }else {
            flash()->error('There are no Locations to export');
        }

        return redirect()->back();

    }

    /**
     * method exportServers
     * @param $server
     * @return Redirect
     */
    public function exportServers($server=false){

        $servers = Server::get();

        if(count($servers)){

            $servers->toArray();


            switch ($server){

                case false:

                    \Excel::create('servers-'.Carbon::now()->toDateString(), function($excel) use ($servers)  {
                        $excel->sheet('Sheet', function($sheet) use ($servers) {
                            $sheet->loadView('export-csv.servers',['servers' => $servers]);
                        });
                    })->download('xls');

                    break;

                case 'server':

                    \Excel::create('servers'.$this->currentDate(), function($excel) use ($servers)  {
                        $excel->sheet('Sheet', function($sheet) use ($servers) {
                            $sheet->loadView('export-csv.servers',['servers' => $servers]);
                        });
                    })->store('csv', public_path('assets/exports'));

                    break;
                default:

                    flash()->error('Please Try Again');

                    return redirect()->back();
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