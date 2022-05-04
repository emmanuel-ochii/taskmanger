@extends('layout.taskapp')
@section('title', 'View & Edit Task')

@section('content')

    <div class="col-md-9 app-content">
        <h3 class="mb-4">Task Details</h3>
        <div class="card">
            <div class="card-header">
                <div class="app-detail-action-right">
                    <div>
                        @if ($task->status == 'Done')
                            <a href="#" class="btn btn-success" data-toggle="tooltip" title="{{ $task->created_at }}">
                                <i class="ti-check mr-2"></i>
                                Completed
                            </a>
                        @else
                            <a href="#" class="btn btn-warning">
                                <i class="ti-sad-face mr-2"></i>
                                Pending
                            </a>
                        @endif

                        <span data-toggle="modal" data-target="#editTaskModal">
                            <a href="#" class="btn btn-outline-light ml-2" title="Edit Task" data-toggle="tooltip">
                                <i class="ti-pencil"></i>
                            </a>
                        </span>
                        <span>
                            <form action="{{ route('task.destroy', $task->id) }}" method="POST" style="display: inherit">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-outline-light ml-2 show_confirm" title="Delete Task" data-toggle="tooltip">
                                    <i class="ti-trash"></i>
                                </button>
                            </form>

                        </span>
                    </div>
                </div>
            </div>
            <div class="app-detail-article">
                <div class="card-body">
                    <div class="d-flex align-items-center p-l-r-0 m-b-20">
                        <div class="ml-auto">Category:
                            <span class="badge bg-warning-bright text-warning badge-pill mr-2"> {{ $task->category->category_name ?? 'None' }}
                            </span>
                            Created At: <span class="text-muted mr-2">{{ $task->created_at }}</span>
                        </div>
                    </div>
                    <p>{{ $task->task_name }}</p>
                </div>
                <hr class="m-0">
            </div>

        </div>
    </div>
    </div>

    <div class="modal fade" id="newTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" action="{{ route('task.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Task title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="task_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Project</label>
                            <div class="col-sm-9">
                                <select class="select2-example" name="project_id">
                                    <option>Select</option>
                                    <option value="Theme Support">Theme Support</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Social">Social</option>
                                    <option value="Friends">Friends</option>
                                    <option value="Coding">Coding</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Priority</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="priority">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" action="{{ route('task.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Task title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="task_name" value="{{ $task->task_name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Project</label>
                            <div class="col-sm-9">
                                <select class="select2-example" name="project_id">
                                    <option selected value="{{ $task->project_id }}">{{ $task->project_id }}</option>
                                    <option value="Theme Support">Theme Support</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Social">Social</option>
                                    <option value="Friends">Friends</option>
                                    <option value="Coding">Coding</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="select2-example" name="status">
                                    <option selected value="{{ $task->status }}">{{ $task->status }}</option>
                                    <option value="pending"> Pending</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Priority</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="priority"
                                    value="{{ $task->priority }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="deleteTaskModal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="x-circle" class="w-16 h-16 text-theme-24 mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-gray-600 mt-2">
                            Do you really want to delete these records?
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center"
                        style="display: flex;position: relative !important; left: 25% !important;">
                        <button type="button" data-dismiss="modal"
                            class="btn btn-outline-secondary w-24 mr-1">Cancel</button>

                        <form action="{{ route('task.destroy', $task->id) }}" method="post">
                            {{ csrf_field() }}

                            <input name="_method" type="hidden" value="DELETE">

                            <button type="submit" class="btn btn-danger w-24">Delete</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->

    </div>
    <!-- ./ Content -->

@endsection

@push('scripts')
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>

@endpush
