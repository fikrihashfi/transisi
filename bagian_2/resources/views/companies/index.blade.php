@extends('layouts.app')
 
@section('content')
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center">
        <div class="card" style="width:70%;">
            <div class="card-header bg-dark text-white">
                Companies
            </div>
            <div class="card-body">
            @if (session('message'))
			    <div class="alert {{ session('class') }}">
                    <input id="errorId" data-modalid="{{ session('modal') }}" hidden>
				    {{ session('message') }}
				</div>
			@endif
                <a id="create" class="btn btn-success text-white" style="margin-bottom:10px"  data-action="{{route('companies.create')}}" data-title="Create Company" data-toggle="modal" data-target="#companyModal" > + Add Company</a>
                <div class="table-responsive">
                    <table class="table text-center">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Website</th>
                            <th>Action</th>
                        </tr>
                        @foreach($companies as $c)
                        <tr>
                            <td>{{ $c->nama }}</td>
                            <td>{{ $c->email }}</td>
                            <td><a href="{{ asset('company').'/'.$c->logo }}">Lihat</a></td>
                            <td>{{ $c->website }}</td>
                            <td class="text-white">
                                <a class="btn btn-primary" id="detail{{$c->id}}" data-action="" data-title="Detail Company" data-toggle="modal" data-target="#companyModal" data-values="{{$c}}">Detail</a>
                                <a class="btn" id="edit{{$c->id}}"  data-action="{{route('companies.edit')}}" style="background-color:orange;" data-title="Edit Company" data-toggle="modal" data-target="#companyModal" data-values="{{$c}}">Edit</a>
                                <a class="btn btn-danger" data-toggle="modal" data-target="#companyDelete" data-values="{{$c->id}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('companies._delete')
    @include('companies._form')

@endsection


@section('js')
    <script>
    $( document ).ready(function() {
        function init(event=null, from){
            var btn = $(event);
            var data = btn.data('values');
            var action = btn.data('action');
            var title = btn.data('title');
            $('#companyForm').attr('action',action);
            $('#companyTitle').text(title);
            $('#companyBtnSubmit').show();
            $('#companyForm input').attr('disabled',false);   
            if(from=='btn'){
                $('#companyForm input').not("#companyForm input[name=_token]").val('');  
                $.each($('#companyForm input'), function( index, value ) {
                    $(value).removeClass('is-invalid');
                });
            }
            $('#companyLogoContainer').children().show();
            if(data!=null){
                $('#companyNama').val(data.nama);
                $('#companyEmail').val(data.email);
                $('#companyWebsite').val(data.website);  
                $('#companyId').val(data.id);      
            }

            if(title=='Detail Company'){
                $('#companyBtnSubmit').hide();
                $('#companyLogoContainer').children().hide();
                $('#companyForm input').attr('disabled',true);
                $('#companyTitle').parent().css({'background-color':'#3490dc','color':'white'});
            }
            else if(title=='Edit Company'){
                $('#companyTitle').parent().css({'background-color':'orange','color':'white'});
            }
            else{
                $('#companyTitle').parent().css({'background-color':'green','color':'white'});
            }
        }
        
        $('#companyModal').on('show.bs.modal',function(event){
            if(event.relatedTarget!=null){
                init(event.relatedTarget,'btn');
            }
        });

        $('#companyDelete').on('show.bs.modal',function(event){
            var btn = $(event.relatedTarget);
            var data = btn.data('values');

            $('#deleteId').val(data);          
        });
        
        if($('#errorId').data('modalid')!=null && $('#errorId').data('modalid')!=""){
            init('#'+$('#errorId').data('modalid'),'server');
            $('#companyModal').modal('show');
        }
        
    });      
    </script>
@endsection
