@extends('layouts.app')
@section('content')

    @if(isset($_GET["token"]))
        <div class="modal fade" id="apiFadeDesign">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title font-primary text-center padding" style="text-align:center;">Welcome to your new API</h4>
                    </div>
                    <div class="modal-body">

                        <div class="panel panel-default panel-custom">
                            <div class="panel-body route-listing">
                                <h5 class="font-primary bold">
                                    Retrieve all objects.
                                </h5>
                                <p class="font-primary">
                                    Will return a list of all objects within your collection.
                                </p>
                                <h5 class="font-primary bold">
                                    <span style="color:#50E3C2;">GET</span>
                                </h5>
                                <p>
                                    <a class="font-pre" href="{{url('api/'.$_GET["token"])}}">
                                        <pre>{{url('api/'.$_GET["token"])}}</pre>
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="panel panel-default panel-custom">
                            <div class="panel-body route-listing">
                                <h5 class="font-primary bold">
                                    Create an object.
                                </h5>
                                <p class="font-primary">
                                    Use this endpoint to create a new object, that will be appended to your collection.
                                </p>
                                <h5 class="font-primary bold">
                                    <span style="color:#50E3C2;">POST</span>
                                </h5>
                                <p>
                                        <pre>/api/{{$_GET["token"]}}</pre>
                                </p>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-inverse">
                                        <div class="panel-body">
                                            <p>
                                                Parameters:
                                                <br/>
                                                <pre style="font-weight: 100;">/api/{{$_GET["token"]}}/<span style="color:#50E3C2">id</span>/<span style="color:#F5A623">2</span></pre>
                                            </p>
                                            <p class="font-primary">
                                                <span style="color:#50E3C2;">
                                                    A unique or non-unique key within your objects in your collection.</span>
                                                <br/><span style="color:#F5A623;">
A conditional value that is queried against that key.
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default panel-custom">
                            <div class="panel-body route-listing">
                                <h5 class="font-primary bold">
                                    Update an object.
                                </h5>
                                <p class="font-primary">
                                    Use this endpoint to update an object.
                                </p>
                                <h5 class="font-primary bold">
                                    <span style="color:#50E3C2;">PUT/PATCH</span>
                                </h5>
                                <p>
                                <pre style="font-weight: 100;">/api/{{$_GET["token"]}}/<span style="color:#50E3C2">id</span>/<span style="color:#F5A623">2</span></pre>
                                </p>
                            </div>
                        </div>

                        <div class="panel panel-default panel-custom">
                            <div class="panel-body route-listing">
                                <h5 class="font-primary bold">
                                    Remove an object.
                                </h5>
                                <p class="font-primary">
                                    Use this endpoint to remove an object from your collection.
                                </p>
                                <h5 class="font-primary bold">
                                    <span style="color:#50E3C2;">DELETE</span>
                                </h5>
                                <p>
                                <pre style="font-weight: 100;">/api/{{$_GET["token"]}}/<span style="color:#50E3C2">id</span>/<span style="color:#F5A623">2</span></pre>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script async>
            $(document).ready(function(){
                $("#apiFadeDesign").modal();
            })
        </script>
        @endif

    <div class="jumbotron jumbotron-fluid jumbotron-custom">
        <div class="container">
            <h1 class="display-3">{json} <span class="bigger">2</span> ../api</h1>
            <p class="lead">Turn your JSON objects into a cloud API.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default panel-custom">
                    <div class="panel-body border">
                        <h5 class="font-primary light text-center" style="text-align: center">
                            <strong>
                                Paste your JSON object below &mdash; to create your RESTful API.
                            </strong>
                        </h5>
                        <br/>
                        <p style="text-align:center;">
                            <a class="btn btn-secondary" href="http://jsontoapi.com/?token=1a8471ef411bdeb926c8cf26d05a3a1a4bfebc46">API Sample</a>
                        </p>
                        <br/>
                        <form method="POST" action="{{url('/compute')}}">
                            {{csrf_field()}}
                        <textarea class="simpleton" name="jsonField" placeholder='{"id":1"title":"Hello World","body":"Lorem ipsum sit amet"}'></textarea>
                        <br/>
                        <button type="submit" class="btn btn-primary">
                            Turn into API
                        </button></form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection