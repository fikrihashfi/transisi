<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['companies'] = Companies::paginate(5);
        return view('companies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $validated_data= Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'logo' => 'required|mimes:png|max:2000|dimensions:min_width=100,min_height=100',
            'website' => 'required'
        ]);

        // 'image_header' => 'required|mimes:jpeg,jpg,png|max:500',
        // 'logo' => 'mimes:jpeg,jpg,png|max:500',
        // dd($id_leader);

        if ($validated_data->fails()) {
            $status =array(
                'modal' => '_form',
                'class' => 'alert-danger',
                'message' => "Form Validation Failed"
            ) ;
            $request->flash();
            return redirect()->route('companies.index')->withErrors($validated_data)->with($status);
        }
        else{
            $file_logo = $request->file('logo');
            $nama_file_logo = time()."_".$file_logo->getClientOriginalName();
            $tujuan_upload_logo = 'company';
            $file_logo->move($tujuan_upload_logo,$nama_file_logo);

            $company = Companies::create([
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'logo' => $nama_file_logo, 
                'website' => $request->input('website'),
            ]);
            
            $status = $company->save();
            
            if($status==true){
                return redirect()->route('companies.index');
            }
            else{
                return redirect()->route('companies.index');
            }
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
        //
    }
}
