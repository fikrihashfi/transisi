@extends('layouts.app')
 
@section('content')
    <div style="display:flex; align-items:center;">
        <div class="card" style="width:70%;">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <a class="btn btn-success" href="/employees/add"> + Tambah Pegawai Baru</a>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Company</th>
                        </tr>
                        @foreach($employees as $e)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->email }}</td>
                            <!-- <td>{{ $p->company }}</td> -->
                            <td>
                                <a href="/employees/edit/{{ $p->id }}">Edit</a>
                                |
                                <a href="/employees/delete/{{ $p->id }}">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection