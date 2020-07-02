@extends('layouts.app')
 
@section('content')
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center">
        <div class="card" style="width:70%;">
            <div class="card-header bg-dark text-white">
                Employees
            </div>
            <div class="card-body">
            @if (session('message'))
			    <div class="alert {{ session('class') }}">
                    <input id="errorId" data-modalid="{{ session('modal') }}" hidden>
				    {{ session('message') }}
				</div>
			@endif
                <a id="create" class="btn btn-success text-white" style="margin-bottom:10px" data-company="{{$companies}}"  data-action="{{route('employees.create')}}" data-title="Create Employee" data-toggle="modal" data-target="#employeeModal" > + Add Employee</a>
                <div class="table-responsive">
                    <table class="table text-center">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nama Company</th>
                            <th>Action</th>
                        </tr>
                        @foreach($employees as $e)
                        <tr>
                            <td>{{ $e->nama }}</td>
                            <td>{{ $e->email }}</td>
                            <td>{{ $e->companies->nama }}</td>
                            <td class="text-white">
                                <a class="btn btn-primary" id="detail{{$e->id}}"  data-action="" data-title="Detail Employee" data-toggle="modal" data-target="#employeeModal" data-values="{{$e}}">Detail</a>
                                <a class="btn" id="edit{{$e->id}}"  data-action="{{route('employees.edit')}}" style="background-color:orange;" data-title="Edit Employee" data-toggle="modal" data-target="#employeeModal" data-values="{{$e}}">Edit</a>
                                <a class="btn btn-danger" data-toggle="modal" data-target="#employeeDelete" data-values="{{$e->id}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('employees._delete')
    @include('employees._form')

@endsection


@section('js')
    <script>
    $( document ).ready(function() {
        function init(event=null,from){
            var btn = $(event);
            var data = btn.data('values');
            console.log(data);
            var action = btn.data('action');
            var title = btn.data('title');
            companyOption();
            $('#employeeForm').attr('action',action);
            $('#employeeTitle').text(title);
            if(from=='btn'){
                $('#employeeForm input').not("#employeeForm input[name=_token]").val('');  
                $.each($('#employeeForm input'), function( index, value ) {
                    $(value).removeClass('is-invalid');
                });
            }
            $('#employeeBtnSubmit').show();
            $('#employeeForm input').attr('disabled',false);
            $('#employeeForm select').attr('disabled',false);
            if(data!=null){
                $('#employeeNama').val(data.nama);
                $('#employeeEmail').val(data.email);
                $('#employeeCompany').val(data.companies_id);
                $('#employeeId').val(data.id);      
            }

            if(title=='Detail Employee'){
                $('#employeeBtnSubmit').hide();
                $('#employeeForm input').attr('disabled',true);
                $('#employeeForm select').attr('disabled',true);
                $('#employeeTitle').parent().css({'background-color':'#3490dc','color':'white'});
            }
            else if(title=='Edit Employee'){
                $('#employeeTitle').parent().css({'background-color':'orange','color':'white'});
            }
            else{
                $('#employeeTitle').parent().css({'background-color':'green','color':'white'});
            }
        }

        $('#employeeModal').on('show.bs.modal',function(event){
            if(event.relatedTarget!=null){
                init(event.relatedTarget,'btn');
            }
        });
           
        $('#employeeDelete').on('show.bs.modal',function(event){
            var btn = $(event.relatedTarget);
            var data = btn.data('values');

            $('#deleteId').val(data);          
        });

        function companyOption(){
            var company = $('#create').data('company');
            $("#employeeCompany option").remove();
            $("#employeeCompany").append(new Option("Select Company", ""));
            $.each(company,function(index,value){
                var companyOption = new Option(value.nama, value.id);
                $(companyOption).html(value.nama);
                $("#employeeCompany").append(companyOption);
            })
        }

        if($('#errorId').data('modalid')!=null && $('#errorId').data('modalid')!=""){
            console.log($('#errorId').data('modalid'));
            init('#'+$('#errorId').data('modalid'),'server');
            $('#employeeModal').modal('show');
        }
        
    });      
    </script>
@endsection
