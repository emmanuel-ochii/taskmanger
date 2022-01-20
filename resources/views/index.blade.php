@extends('layout.taskapp')
@section('title', 'Task Manager - Home Page')

@section('content')

                        <div class="col-md-9 app-content">
                            <h3 class="mb-4">Task Listing</h3>
                            <div class="app-action">
                                <div class="action-right">
                                    <form class="d-flex mr-3">
                                        <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                                            <i data-feather="menu" class="width-15 height-15"></i>
                                        </a>
                                    </form>

                                </div>
                            </div>
                            <div class="card card-body app-content-body">
                                <div class="app-lists">
                                    <ul class="list-group list-group-flush">
                                        @if (count($tasks) > 0)
                                        @foreach ($tasks as $task)
                                        <li class="list-group-item task-list">
                                            <div class="mr-3">
                                                <a href="#" class="app-sortable-handle">
                                                    <i class="ti-line-double"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1"></label>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="add-star mr-3" title="Add stars">
                                                    <i class="fa fa-star-o font-size-16"></i>
                                                </a>
                                            </div>
                                            <div class="flex-grow-1 min-width-0">
                                                <div class="mb-1 d-flex align-items-center justify-content-between">
                                                    <div class="app-list-title text-truncate">{{ $task->task_name }}
                                                    </div>
                                                    <div class="pl-3 d-flex align-items-center">
                                                        <div class="mr-3 d-sm-inline d-none">
                                                            <div class="badge bg-primary-bright text-muted">Last
                                                                Updated at {{ $task->updated_at->diffForHumans() }}</div>
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{ route('task.edit', $task->id) }}">Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    @else
                                        <div id="basic-alert" class="p-5">
                                            <div class="preview">
                                                <div class="alert alert-dark show mb-2 text-center" role="alert">No Task To
                                                    Display</div>
                                            </div>
                                        </div>
                                    @endif
                                    </ul>
                                </div>
                                <!-- end::app-lists -->
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
                                                @if (count($categories) > 0)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->category_name }}</option>
                                                    @endforeach
                                                @else
                                                    <div id="basic-alert" class="p-5">
                                                        <div class="preview">
                                                            <div class="alert alert-dark show mb-2 text-center"
                                                                role="alert">No Category To Select. <span
                                                                    class="text-danger">Please Contact
                                                                    Admin.</span></div>
                                                        </div>
                                                    </div>
                                                @endif
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

                    <div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form autocomplete="off" action="{{ route('category.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="category_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-info">Add</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
            <!-- ./ Content -->

@endsection
