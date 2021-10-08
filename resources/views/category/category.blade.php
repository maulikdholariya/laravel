@extends('layouts.app')
@section('assets')
{{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}"> --}}
{{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> --}}
<link rel="stylesheet" href="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="http://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>


@endsection
@section('title', 'Category')
@section('content')

<div class="row">
    <div class="col-6">
        @if (session('status'))
               <div class="alert alert-success" role="alert">
                    {{ session('status') }}
               </div>
        @endif
        <div class="col-3">
            <a href="{{ route('category.create') }}" class="btn btn-primary" >Add</a>
        </div>
        <div class="page">
            <div class="container-fluid">
                    {!! $dataTable->table() !!}

                    {{-- <table class="table table-bordered yajra-datatable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>

    </div>
</div>
{!! $dataTable->scripts() !!}
<script type="text/javascript">

$('#category-table').on('click','.delete',function(e){
    // if(!confirm("Do you really want to do this?")) {
    //    return false;
    //  }
    e.preventDefault();

    var url = e.target;

    var id = $(this).data('delete');

    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({

        url:url,
        data:{"_token":token,"id":id},
        type:'DELETE',
        success: function(data){
            console.log(data);
            $('#category-table').DataTable().ajax.reload();
        }
    });

});
</script>

@endsection
