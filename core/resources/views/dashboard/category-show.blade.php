@extends('layouts.dashboard')
@section('content')




    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <button id="btn-add" name="btn-add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Category</button>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="tasks-list" name="tasks-list">
                        <?php $no=0; ?>
                        @foreach ($category as $cat)
                            <?php $no++; ?>
                            <tr id="task{{$cat->id}}">
                                <td>{{$no}}</td>
                                <td>{{$cat->name}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-detail open-modal" value="{{$cat->id}}"><i class="fa fa-edit"></i> Edit Category</button>
                                    <button class="btn btn-danger btn-sm btn-delete delete-task" value="{{$cat->id}}" data-toggle="modal" data-target="#DelModal"
                                            data-id="{{ $cat->id }}"><i class="fa fa-trash"></i> Delete Category</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <meta name="_token" content="{!! csrf_token() !!}" />


        </div>
    </div><!-- ROW-->


        <div class="text-center">
            {!! $category->render() !!}
        </div>


    {{-- Modal For Add New Category--}}

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bars"></i> Manage Category</h4>
                </div>
                <div class="modal-body">
                    <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Category Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error" id="name" name="name" placeholder="Category Name" value="">
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add"><i class="fa fa-send"></i> Save Category</button>
                    <input type="hidden" id="task_id" name="task_id" value="0">
                </div>
            </div>
        </div>
    </div>

    {{-- End Modal Add new Category--}}


@endsection

@section('scripts')

    <script>

        $(document).ready(function () {

            var url = '{{ url('/category') }}';

            //display modal form for creating new task
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });


            //create new task / update existing task
            $("#btn-save").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                e.preventDefault();

                var formData = {
                    'name': $('#name').val()
                }

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save').val();

                var type = "POST"; //for creating new resource
                var task_id = $('#task_id').val();;
                var my_url = url;

                if (state == "update"){
                    type = "PUT"; //for updating existing resource
                    my_url += '/' + task_id;
                }

                console.log(formData);

                $.ajax({

                    type: type,
                    url: my_url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);

                        var task = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td>';
                        task += '<td><button class="btn btn-primary btn-sm btn-detail open-modal" value="' + data.id + '"><i class="fa fa-edit"></i> Edit Category</button>';
                        task += '<button class="btn btn-danger btn-sm btn-delete delete-task" value="' + data.id + '"><i class="fa fa-trash"></i> Delete Category</button></td></tr>';

                        if (state == "add"){ //if user added a new record
                            $('#tasks-list').append(task);
                        }else{ //if user updated an existing record

                            $("#task" + task_id).replaceWith( task );
                        }

                        $('#frmTasks').trigger("reset");

                        $('#myModal').modal('hide');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                }) .done(function() {
                    swal('Success','Successfully Category Saved.','success');
                });
            });

            //display modal form for task editing
            $('.open-modal').click(function(){
                var task_id = $(this).val();

                $.get(url + '/' + task_id, function (data) {
                    //success data
                    console.log(data);
                    $('#task_id').val(data.id);
                    $('#name').val(data.name);
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                })
            });

            //delete task and remove it from list

            $(document).on("click", '.delete-task', function (e) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                var id = $(this).data('id');

                $.ajax({

                    type: "DELETE",
                    url: url + '/' + id,
                    success: function (data) {
                        console.log(data);

                        $("#task" + id).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                }).done(function() {
                    swal('Success','Successfully Category Deleted.','success');
                });

            });

        });


    </script>

@endsection

