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
				    {{ session('message') }}
				</div>
			@endif
                <a class="btn btn-success text-white" style="margin-bottom:10px"  data-action="{{route('companies.create')}}" data-title="Create Company" data-toggle="modal" data-target="#companyModal" > + Add Company</a>
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
                                <a class="btn btn-primary" data-action="" data-title="Detail Company" data-toggle="modal" data-target="#companyModal" data-values="{{$c}}">Detail</a>
                                <a class="btn" data-action="{{route('companies.edit')}}" style="background-color:orange;" data-title="Edit Company" data-toggle="modal" data-target="#companyModal" data-values="{{$c}}">Edit</a>
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
    @if (count($errors) > 0)
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#companyModal').modal('show');
            });
        </script>
    @endif

    <script>
    $( document ).ready(function() {
        $('#companyModal').on('show.bs.modal',function(event){
            var btn = $(event.relatedTarget);
            var data = btn.data('values');
            console.log(data);
            var action = btn.data('action');
            var title = btn.data('title');
            $('#companyForm').attr('action',action);
            $('#companyTitle').text(title);
            $('#companyBtnSubmit').show();
            $('#companyForm input').attr('disabled',false);   
            $('#companyForm input').not("#companyForm input[name=_token]").val('');  
            if(data!=null){
                $('#companyNama').val(data.nama);
                $('#companyEmail').val(data.email);
                $('#companyWebsite').val(data.website);  
                $('#companyId').val(data.id);      
            }

            if(title=='Detail Company'){
                $('#companyBtnSubmit').hide();
                $('#companyForm input').attr('disabled',true);
                $('#companyTitle').parent().css({'background-color':'#3490dc','color':'white'});
            }
            else if(title=='Edit Company'){
                $('#companyTitle').parent().css({'background-color':'orange','color':'white'});
            }
            else{
                $('#companyTitle').parent().css({'background-color':'green','color':'white'});
            }
        });

        $('#companyDelete').on('show.bs.modal',function(event){
            var btn = $(event.relatedTarget);
            var data = btn.data('values');

            $('#deleteId').val(data);          
        });
    });      
    </script>
@endsection
