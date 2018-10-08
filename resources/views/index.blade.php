@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="https://cv.beton.cloud">
                            <img class="rounded-circle cv" style="max-height:2%;" title="My CV" src="http://cv.beton.cloud/profile.jpg">
                        </a>
                        <h1>My secret server</h1>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#createSecret">Create my ticket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#getSecret">Get my ticket</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active" id="createSecret">

                                <create-secret></create-secret>

                            </div>
                            <div class="tab-pane container fade" id="getSecret">
                                <get-secret></get-secret>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card">

                    <div class="card-body">
                        <h4>API specification</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>GET</h5>
                                <b>URL:</b> http://api.codenamedynamite.com/api/secret/<u>{hash}</u>

                                <h6>Response</h6>
                                <ul>
                                    <li>200
                                        <ul>
                                            <li>{'secret':'secret text'}</li>
                                        </ul>
                                    </li>
                                    <li>520
                                        <ul>
                                            <li>{'{field}':[errorMessage]}</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <h5>POST</h5>
                                <b>URL:</b> http://api.codenamedynamite.com/api/secret

                                <h6>Parameters</h6>
                                <ul>
                                    <li>secret</li>
                                    <li>expireAfter</li>
                                    <li>expireAfterViews</li>
                                </ul>

                                <h6>Response</h6>
                                <ul>
                                    <li>200
                                        <ul>
                                            <li>{'hash':'ba40c2baffb...'}</li>
                                        </ul>
                                    </li>
                                    <li>520
                                        <ul>
                                            <li>{'{field}':[errorMessage]}</li>
                                        </ul>
                                    </li>
                                </ul>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection