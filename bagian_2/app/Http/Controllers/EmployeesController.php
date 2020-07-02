<?php

namespace App\Http\Controllers;

use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['employees'] = Employees::paginate(5);
        $data['companies'] = DB::table('companies')->select('nama', 'id')->get();

        return view('employees.index', $data);

    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $validated_data= Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'company' => 'required'
        ]);

        if ($validated_data->fails()) {
            $status =array(
                'modal' => 'create',
                'class' => 'alert-danger',
                'message' => "Form Validation Failed"
            ) ;
            $request->flash();
            return redirect()->route('employees.index')->withErrors($validated_data)->with($status);
        }
        else{

            $employee = Employees::create([
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'companies_id' => $request->input('company'),
            ]);
            
            $status = $employee->save();
            
            if($status==true){
                return redirect()->route('employees.index');
            }
            else{
                $status =array(
                    'class' => 'alert-danger',
                    'message' => "Failed Create Employee!"
                ) ;
                $request->flash();
                return redirect()->route('employees.index')->with($status);
            }
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees)
    {
        //
        $all_data = $request->all();
        $validated_data= Validator::make($all_data, [
            'nama' => 'required',
            'email' => 'required',
            'company' => 'required'
        ]);

        if ($validated_data->fails()) {
            $status =array(
                'modal' => 'edit'.$all_data['id'],
                'class' => 'alert-danger',
                'message' => "Form Validation Failed"
            ) ;
            $request->flash();
            return redirect()->route('employees.index')->withErrors($validated_data)->with($status);
        }
        else{
            $all_data['companies_id'] = $all_data['company'];
            unset($all_data['company']);
            unset($all_data['_token']);
            $status = $employees->where('id', $all_data['id'])
                    ->update($all_data);
            
            if($status==true){
                return redirect()->route('employees.index');
            }
            else{
                $status =array(
                    'class' => 'alert-danger',
                    'message' => "Failed Update Employee!"
                ) ;
                $request->flash();
                return redirect()->route('employees.index')->with($status);
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
        $employee = Employees::find($request->input('id'));
        if($employee!=null){
            $result = DB::transaction(function() use(&$employee) {
                $delete_data = $employee->delete();
                return true;
            });

            if($result==true){
                return redirect()->route('employees.index');
            }
            else{
                $status =array(
                    'modal' => '_delete',
                    'class' => 'alert-danger',
                    'message' => "Delete Failed"
                ) ;
                $request->flash();
                return redirect()->route('employees.index')->with($status);
            }

        }
        else{
            $status =array(
                'modal' => '_delete',
                'class' => 'alert-danger',
                'message' => "company not found!"
            ) ;
            $request->flash();
            return redirect()->route('employees.index')->with($status);
        }
    }
}
