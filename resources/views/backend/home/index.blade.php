@section('title')
Dashboard
@endsection
@extends('backend.master')
@section('content')
    
        <div class="page-wrapper">
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card radius-15">
                                <div class="card-body">
                                    <div class="d-flex mb-2">
                                        <div>
                                            <p class="mb-0 font-weight-bold">Sessions</p>
                                            <h2 class="mb-0">501</h2>
                                        </div>
                                        <div class="ml-auto align-self-end">
                                            <p class="mb-0 font-14 text-primary"><i class='bx bxs-up-arrow-circle'></i> <span>1.01% 31 days ago</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card radius-15">
                                <div class="card-body">
                                    <div class="d-flex mb-2">
                                        <div>
                                            <p class="mb-0 font-weight-bold">Visitors</p>
                                            <h2 class="mb-0">409</h2>
                                        </div>
                                        <div class="ml-auto align-self-end">
                                            <p class="mb-0 font-14 text-success"><i class='bx bxs-up-arrow-circle'></i> <span>0.49% 31 days ago</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card radius-15">
                                <div class="card-body">
                                    <div class="d-flex mb-2">
                                        <div>
                                            <p class="mb-0 font-weight-bold">Page Views</p>
                                            <h2 class="mb-0">2,346</h2>
                                        </div>
                                        <div class="ml-auto align-self-end">
                                            <p class="mb-0 font-14 text-danger"><i class='bx bxs-down-arrow-circle'></i> <span>130.68% 31 days ago</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
            <!--end page-content-wrapper-->
        </div>
  
@endsection

