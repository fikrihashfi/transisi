<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $validated_data= Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'logo' => 'required|mimes:png|max:2000|dimensions:min_width=100,min_height=100',
            'website' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ]);

        if ($validated_data->fails()) {
            $status =array(
                'modal' => 'create',
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
                $status =array(
                    'class' => 'alert-danger',
                    'message' => "Failed Create Company!"
                ) ;
                $request->flash();
                return redirect()->route('companies.index')->with($status);
            }
        }
        
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
        $all_data = $request->all();
        if(isset($all_data['logo'])){
            $validated_data= Validator::make($all_data, [
                'nama' => 'required',
                'email' => 'required',
                'logo' => 'required|mimes:png|max:2000|dimensions:min_width=100,min_height=100',
                'website' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
            ]);
        }
        else{
            $validated_data= Validator::make($all_data, [
                'nama' => 'required',
                'email' => 'required',
                'website' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
            ]);
        }

        if ($validated_data->fails()) {
            $status =array(
                'modal' => 'edit'.$all_data['id'],
                'class' => 'alert-danger',
                'message' => "Form Validation Failed"
            ) ;
            $request->flash();
            return redirect()->route('companies.index')->withErrors($validated_data)->with($status);
        }
        else{
            $company = Companies::find($all_data['id']);
            if(isset($all_data['logo'])){
                $file_logo = $request->file('logo');
                $nama_file_logo = time()."_".$file_logo->getClientOriginalName();
                $tujuan_upload_logo = 'company';
                $file_logo->move($tujuan_upload_logo,$nama_file_logo);
                $all_data['logo'] = $nama_file_logo;
            }
            unset($all_data['_token']);
            $status = Companies::where('id', $all_data['id'])
                    ->update($all_data);
            
            if($status==true){
                return redirect()->route('companies.index');
            }
            else{
                $status =array(
                    'class' => 'alert-danger',
                    'message' => "Edit company failed!"
                ) ;
                $request->flash();
                return redirect()->route('companies.index')->with($status);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        if(Employees::where('companies_id',$request->input('id'))->first()!=null){
            $status =array(
                'class' => 'alert-danger',
                'message' => "This company id is used by employee!"
            ) ;
            $request->flash();
            return redirect()->route('companies.index')->with($status);
        }
        
        $company = Companies::find($request->input('id'));
        if($company!=null){
            $file = $company->logo;
            $result = DB::transaction(function() use(&$file,&$company) {
                $delete_file = Storage::delete('company/'.$file);
                $delete_data = $company->delete();
                return true;
            });

            if($result==true){
                return redirect()->route('companies.index');
            }
            else{
                $status =array(
                    'class' => 'alert-danger',
                    'message' => "Delete Failed"
                ) ;
                $request->flash();
                return redirect()->route('companies.index')->with($status);
            }
        }
        else{
            $status =array(
                'class' => 'alert-danger',
                'message' => "company not found!"
            ) ;
            $request->flash();
            return redirect()->route('companies.index')->with($status);
        }
    }
}
