<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>CareerVibe | Find Best Jobs</title>
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>

<body data-instant-intensity="mousedown">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="{{ route('home')}}" id="title-nav">KERJABAGUS.COM</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-0 me-0 me-lg-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" aria-current="page" href="{{ route('home')}}">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'jobs' ? 'active' : '' }}" aria-current="page" href="{{ route('jobs') }}">Find Jobs</a>
                        </li>
                    </ul>
                    
                    
                    @if (!Auth::check())
                        <a class="btn btn-outline-primary me-2" href="{{ route('account.login') }}" type="submit">Login</a>
                        @else
                        <a class="btn btn-outline-primary me-2" href="{{ route('account.profile') }}" type="submit">Account</a>
                    @endif


                    <a class="btn btn-primary px-4" href="{{route('account.createJob')}}" type="submit">Post a Job</a>
                </div>
            </div>
        </nav>
    </header>

    @yield('main')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="profilePicForm" name="profilePicForm" action="" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <p class="text-danger" id="image-error"></p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-3">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <a class="navbar-brand" href="{{ route('home')}}" id="title-nav">KERJABAGUS.COM</a>
    
        <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        </a>
    
        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('home')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('jobs') }}">Find Jobs</a>
            </li>
         
        </ul>

        
        @if (!Auth::check())
        <a class="btn btn-outline-primary me-2 mx-1" href="{{ route('account.login') }}" type="submit">Login</a>
        @else
        <a class="btn btn-outline-primary me-2 mx-1" href="{{ route('account.profile') }}" type="submit">Account</a>
        @endif
      </footer>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        $('.textarea').trumbowyg();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#profilePicForm").submit(function(e){
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{route("account.updateProfilePic")}}',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.status == false){
                        var errors = response.errors;
                        if(errors.image){
                            $("#image-error").html(errors.image)
                        }
                    }else{
                        window.location.href = '{{ url()->current() }}';
                    }
                }
            });
        })
    </script>


    @yield('customJs')

</body>

</html>
