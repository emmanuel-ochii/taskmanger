<!doctype html>
<html ang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Task Manager - Default Page')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/media/image/favicon.png') }}" />

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('vendors/bundle.css') }}" type="text/css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- quill -->
    <link href="{{ asset('vendors/quill/quill.snow.css') }}" rel="stylesheet" type="text/css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}" type="text/css">

    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}" type="text/css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="dark horizontal-navigation">

    <!-- Layout wrapper -->
    <div class="layout-wrapper">

        <!-- Header -->
        <div class="header d-print-none">
            <div class="header-container">
                <div class="header-left">
                    <div class="navigation-toggler">
                        <a href="#" data-action="navigation-toggler">
                            <i data-feather="menu"></i>
                        </a>
                    </div>

                    <div class="header-logo">
                        <a href=index.html>
                            <h1>Task Manager</h1>
                        </a>
                    </div>
                </div>

                <div class="header-body">
                    <div class="header-body-left">
                        <ul class="navbar-nav">
                        </ul>
                    </div>

                    <div class="header-body-right">
                        <ul class="navbar-nav">


                            <li class="nav-item dropdown d-none d-md-block">
                                <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                    <i class="maximize" data-feather="maximize"></i>
                                    <i class="minimize" data-feather="minimize"></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                                    <figure class="avatar avatar-sm">
                                        <img src="{{ asset('assets/media/image/user/man_avatar3.jpg') }}"
                                            class="rounded-circle" alt="avatar">
                                    </figure>
                                    <span class="ml-2 d-sm-inline d-none">User</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                    <div class="text-center py-4">
                                        <figure class="avatar avatar-lg mb-3 border-0">
                                            <img src="{{ asset('assets/media/image/user/man_avatar3.jpg') }}"
                                                class="rounded-circle" alt="image">
                                        </figure>
                                        <h5 class="text-center">User</h5>
                                        <div class="mb-3 small text-center text-muted">@user</div>
                                        <a href="{{ route('welcome') }}"
                                            class="btn btn-outline-light btn-rounded">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item header-toggler">
                        <a href="#" class="nav-link">
                            <i data-feather="arrow-down"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ./ Header -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- begin::navigation -->
            <div class="navigation">
                <div class="navigation-header">
                    <span>Logout</span>
                    <a href="{{ route('welcome') }}">
                        <i class="ti-close"></i>
                    </a>
                </div>
                <div class="px-3 py-4">
                    <a href="{{ route('welcome') }}">
                        <span class="nav-link-icon"> <i data-feather="log-out"></i> </span>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
            <!-- end::navigation -->
            <!-- Content body -->
            <div class="content-body">
                <!-- Content -->
                <div class="content web-app">
                    <div class="content web-app">

                        <div class="row no-gutters app-block">
                            <div class="col-md-3 app-sidebar">
                                <button class="btn btn-primary btn-block mb-3" data-toggle="modal"
                                    data-target="#newTaskModal">
                                    Add Task
                                </button>
                                <div class="app-sidebar-menu">
                                    <div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your
                                                input.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif
                                        @if ($message = Session::get('deleted'))
                                            <div class="alert alert-danger">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif
                                        <div class="list-group list-group-flush">
                                            <a href="{{ route('task.index') }}"
                                                class="list-group-item active d-flex align-items-center">
                                                <i class="ti-list list-group-icon mr-2"></i>All Tasks
                                            </a>
                                        </div>
                                    </div>

                                    <button class="btn btn-info btn-block mt-4" data-toggle="modal"
                                        data-target="#newCategoryModal">
                                        Add Category
                                    </button>
                                    {{-- <div class="list-group list-group-flush">
                                        @if (is_countable($categories) && count($categories) > 0)
                                            @foreach ($categories as $category)
                                                <a href="#" class="list-group-item d-flex align-items-center">
                                                    <span class="text-warning fa fa-circle mr-2"></span>
                                                    {{ $category->category_name }}
                                                    <span class="small ml-auto">5</span>
                                                </a>
                                            @endforeach
                                        @else
                                            <div id="basic-alert" class="p-5">
                                                <div class="preview">
                                                    <div class="alert alert-dark show mb-2 text-center" role="alert">No
                                                        Category To
                                                        Available</div>
                                                </div>
                                            </div>
                                        @endif
                                    </div> --}}
                                </div>
                            </div>

                            @yield('content')



                            <!-- Footer -->
                            <footer class="content-footer">
                                <div>© 2022 Task Manager - All Rights Reserved</div>
                                <div>
                                    <nav class="nav">
                                        <a href="#" target="_blank">Emmanuel Ochubili</a>
                                    </nav>
                                </div>
                            </footer>
                            <!-- ./ Footer -->
                        </div>
                        <!-- ./ Content body -->
                    </div>
                    <!-- ./ Content wrapper -->
                </div>
                <!-- ./ Layout wrapper -->

                <!-- Main scripts -->
                <script src="{{ asset('vendors/bundle.js') }}"></script>

                <!-- quill -->
                <script src="{{ asset('vendors/quill/quill.js') }}"></script>

                <!-- Select2 -->
                <script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
                <script src="{{ asset('assets/js/examples/select2.js') }}"></script>

                <script>
                    $('.select2-example').select2({
                        placeholder: 'Select'
                    });
                </script>


                <!-- Todo list example -->
                <script src="{{ asset('assets/js/examples/todo-list.js') }}"></script>

                <!-- Sweet alert -->
                <script src="{{ asset('assets/js/examples/sweet-alert.js') }}"></script>

                <!-- App scripts -->
                <script src="{{ asset('assets/js/app.min.js') }}"></script>
                @stack('scripts')


</body>

</html>
