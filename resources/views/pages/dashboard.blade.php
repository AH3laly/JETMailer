@extends('layouts.default')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Dashboard</h4>
        <p class="text-muted page-title-alt">Welcome to JETMailer !</p>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box widget-inline">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-primary md md-email"></i> <b>123</b></h3>
                        <h4 class="text-muted">Total Emails</h4>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-success md md-email"></i> <b>483</b></h3>
                        <h4 class="text-muted">Delivered Emails</h4>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-pink md md-block"></i> <b>3494</b></h3>
                        <h4 class="text-muted">Failed Emails</h4>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center b-0">
                        <h3><i class="text-purple md md-flight"></i> <b>3298</b></h3>
                        <h4 class="text-muted">Active MTAs</h4>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@stop