@extends('layouts.dashboard.app')

@section('content')
<div class="container mt-5">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Task Test

                <a href="{{ route('dashboard.students.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Usuario"><i class="fa fa-user-plus"></i> Creat Student </a>

            </h3>
        </div>
        <div class="panel-body">

    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
        </div>
    </div>
</div>

@endsection

@push('js')

<script type="text/javascript">
    $(function () {

      var table = $('.yajra-datatable').DataTable({
        //   processing: true,
        //   serverSide: true,
          ajax: "{{ route('dashboard.students.list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'username', name: 'username'},
              {data: 'phone', name: 'phone'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
              },
          ]
      });




    });


  </script>
@endpush
