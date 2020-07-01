@extends('layouts.app')
 
@section('content')
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center">
        <div class="card" style="width:70%;">
            <div class="card-header">
                Companies
            </div>
            <div class="card-body">
                <a class="btn btn-success" style="margin-bottom:10px" data-toggle="modal" data-target="#companyForm" > + Add Company</a>
                <div class="table-responsive">
                    <table class="table">
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
                            <td>
                                <a class="btn btn-success" data-toggle="modal" data-target="#companyEdit" data-values="{{$c}}">Edit</a>
                                |
                                <a href="/companies/delete/{{ $c->id }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('companies._form')
    @include('companies._edit')

@endsection


@section('js')
    @if (count($errors) > 0 && $modal = Session::get('modal'))
        @if($modal=="_form")
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#companyForm').modal('show');
            });
        </script>
        @endif
    @endif

    <script>
    $( document ).ready(function() {
        $('#companyEdit').on('show.bs.modal',function(event){
            var btn = $(event.relatedTarget);
            var data = btn.data('values');
            console.log(data);
            
        });
    });      
    </script>
@endsection
