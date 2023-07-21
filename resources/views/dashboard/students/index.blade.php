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
<!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
            </div>
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

    //   $('body').on('click', '.delete1', function () {
    // var id = $(this).data("id");
    // if (confirm("Are you sure you want to delete this record?")) {
    //     $.ajax({
    //         type: "DELETE",
    //         url: "{{ route('dashboard.students.destroy', ['student' => ':id']) }}".replace(':id', id),
    //         data: {
    //         _token: '{{ csrf_token() }}'
    //         },
    //         success: function (data) {
    //                     var n = new Noty({
    //                         type: 'success',
    //                         text: 'Student deleted successfully!',
    //                         layout: 'center',
    //                         timeout: 2000,
    //                         aria: {
    //                             live: 'polite'
    //                         }
    //                     });
    //                     n.show();
    //                     table.draw();
    //                 },
    //                 error: function (data) {
    //                     console.log('Error:', data);
    //                 }

    //     });
    // }
    // });

               $('#confirm-delete').on('shown.bs.modal', function() {
                $(this).find('#confirm').on('click', function() {
                    var id = $('.delete-item').attr('data-id');

                    $.ajax({
                        url: "{{ route('dashboard.students.destroy', ['student' => ':id']) }}".replace(':id', id),
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            // Refresh the datatable after delete
                            $('.yajra-datatable').DataTable().ajax.reload();
                            // Hide the confirmation pop-up
                            $('#confirm-delete').modal('hide');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });

    });


  </script>
@endpush
