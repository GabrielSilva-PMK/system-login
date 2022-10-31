@extends('layouts.authBase')

@section('content')

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                        <div class="card-body">

                            @if (\Session::has('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{!! \Session::get('errors') !!}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden=true>&times;</span>
                                    </button>
                                </div>
                            @endif

                            <!-- <form id="formLogin" name="formLogin"> -->
                            <form action="{{route('login-autentication')}}" method="POST">
                                {{ csrf_field() }}
                                @csrf
                                @method('POST')
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email" class="form-control" name="email" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Enter
                                    </button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $('#formLogin').submit(function(e){
            e.preventDefault();
            // var dados = new FormData(this);
            var formdata = new FormData($("form[id='formLogin']")[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route("login-autentication")}}',
                type: "POST",
                data: formdata,
                processData: false,
                cache: false,
                contentType: false,
                success: function( data ) {
                    console.log(data);
                    redirect('home');
                },
                error: function (request, status, error) {
                    alert("error");
                }
            });
            return false;
        });
    });

</script>
