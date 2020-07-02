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
     * Show the form for creating a new resource.
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
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employees)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function delete(Employees $employees)
    {
        //
    }
}
