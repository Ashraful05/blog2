@extends('front.master')
@section('title')
    Blog Details
@endsection
@section('body')
    <div class="container">
        <h1 class="mt-4 mb-3"></h1>
        <div class="row">

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('new-sign-up')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="" class="col-form-label col-md-3">First Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-md-3">Last Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-md-3">Email Address</label>
                                <div class="col-md-9">
                                    <input type="email" name="email_address" class="form-control" onblur="emailCheck(this.value);" >
                                    <span id="res" class="text-center"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-md-3">Password</label>
                                <div class="col-md-9">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-md-3">Phone Number</label>
                                <div class="col-md-9">
                                    <input type="number" name="phone_number" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-md-3">Address</label>
                                <div class="col-md-9">
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-md-3"></label>
                                <div class="col-md-9">
                                    <input type="submit" id="regBtn" name="btn" class="btn btn-success btn-block" value="Register">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                <div class="card mb-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="inpug-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Web Design</a>
                                    </li>
                                    <li>
                                        <a href="#">HTML</a>
                                    </li>
                                    <li>
                                        <a href="#">Freebies</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Side Widget</h5>
                    <div class="card-body">
                        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>

    <script>
        function emailCheck(email){
            // var xmlHttp = new XMLHttpRequest();
            // var serverPage = 'http://localhost/blog2/public/email-check/' + email;
            // xmlHttp.open('GET',serverPage);
            // xmlHttp.onreadystatechange = function (){
            //     if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
            //        document.getElementById('res').innerHTML = xmlHttp.responseText;
            //        if(xmlHttp.responseText == 'Email address exist'){
            //            document.getElementById('regBtn').disabled=true;
            //        }
            //        else{
            //            document.getElementById('regBtn').disabled=false;
            //        }
            //     }
            // }
            // xmlHttp.send();

            $.ajax({
                url     : 'http://localhost/blog2/public/email-check/' + email,
                method  :   'GET',
                data    : {email:email},
                dataType: 'JSON',
                success : function (res){
                    alert(res);
                    document.getElementById('res').innerHTML = res;
                    if(res == 'Email address exist'){
                        document.getElementById('regBtn').disabled=true;
                    }
                    else{
                        document.getElementById('regBtn').disabled=false;
                    }
                }
            });
        }
    </script>
@endsection


