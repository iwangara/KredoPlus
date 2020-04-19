@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">mobile_screen_share</i>
                            </div>
                            <p class="card-category">Airtime Balance</p>
                            <h3 class="card-title"><small>Ksh.</small> 49950

                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">refresh</i>
                                <a href="#pablo">Refresh</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">attach_money</i>
                            </div>
                            <p class="card-category">Revenue</p>
                            <h3 class="card-title">Ksh. 34,245</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">refresh</i>
                                <a href="#pablo">Refresh</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">check_circle</i>
                            </div>
                            <p class="card-category">Complete</p>
                            <h3 class="card-title">75</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">timer</i> Since last reload
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">bug_report</i>
                            </div>
                            <p class="card-category">Failed</p>
                            <h3 class="card-title">245</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">timer</i> Since last reload
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Daily Sales</h4>
                            <p class="card-category">
                                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated 4 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <div class="ct-chart" id="websiteViewsChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Monthly Sales</h4>
                            <p class="card-category">Monthly Comparison</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated 4 minutes ago
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Transactions</h4>
                            <p class="card-category">New Transactions</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                <th>ID</th>
                                <th>Mpesa No</th>
                                <th>Airtel No</th>
                                <th>Amount</th>
                                <th>Status</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>254729790289</td>
                                    <td>254729790289</td>
                                    <td>5</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>254729790289</td>
                                    <td>254729790289</td>
                                    <td>5</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>254729790289</td>
                                    <td>254729790289</td>
                                    <td>5</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>254729790289</td>
                                    <td>254729790289</td>
                                    <td>5</td>
                                    <td>1</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
