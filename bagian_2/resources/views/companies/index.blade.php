@extends('layouts.app')
 
@section('content')
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center">
        <div class="card" style="width:70%;">
            <div class="card-header">
                Companies
            </div>
            <div class="card-body">
            @if (session('message'))
			    <div class="alert {{ session('class') }}">
				    {{ session('message') }}
				</div>
			@endif
                <a class="btn btn-success text-white" style="margin-bottom:10px" data-toggle="modal" data-target="#companyForm" > + Add Company</a>
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
                                <a class="btn btn-primary" data-toggle="modal" data-target="#companyDetail" data-values="{{$c}}">View</a>
                                <a class="btn" style="background-color:orange;" data-toggle="modal" data-target="#companyEdit" data-values="{{$c}}">Edit</a>
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
    @include('companies._create')
    @include('companies._edit')
    @include('companies._delete')
    @include('companies._detail')

@endsection


@section('js')
    @if (count($errors) > 0 && $modal = Session::get('modal'))
        @if($modal=="_create")
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#companyForm').modal('show');
            });
        </script>
        @elseif($modal=="_edit")
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#companyEdit').modal('show');
            });
        </script>
        @endif
    @endif

    <script>
    $( document ).ready(function() {
        $('#companyEdit').on('show.bs.modal',function(event){
            var btn = $(event.relatedTarget);
            var data = btn.data('values');

            $('#editNama').val(data.nama);
            $('#editEmail').val(data.email);
            $('#editWebsite').val(data.website);  
            $('#editId').val(data.id);      
        });

        $('#companyDetail').on('show.bs.modal',function(event){
            var btn = $(event.relatedTarget);
            var data = btn.data('values');

            $('#detailNama').val(data.nama);
            $('#detailEmail').val(data.email);
            $('#detailWebsite').val(data.website);      
        });

        $('#companyDelete').on('show.bs.modal',function(event){
            var btn = $(event.relatedTarget);
            var data = btn.data('values');

            $('#deleteId').val(data);          
        });
    });      
    </script>
@endsection
