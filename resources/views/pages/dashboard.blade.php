@extends('layouts.default')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Dashboard</h4>
        <p class="text-muted page-title-alt">Welcome to JETMailer !</p>
    </div>
</div>

@verbatim
<div class="row" id="app">
    <div class="col-sm-12">
        <div class="card-box widget-inline">
            <div class="row">
                <div class="col-lg-2 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-primary md md-email"></i> <b>{{stats.totalEmails}}</b></h3>
                        <h4 class="text-muted">Total Mails</h4>
                    </div>
                </div>
                
                <div class="col-lg-2 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-success md md-email"></i> <b>{{stats.scheduledEmails}}</b></h3>
                        <h4 class="text-muted">Scheduled Mails</h4>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-success md md-email"></i> <b>{{stats.deliveredEmails}}</b></h3>
                        <h4 class="text-muted">Delivered Mails</h4>
                    </div>
                </div>
                
                <div class="col-lg-2 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-pink md md-block"></i> <b>{{stats.failedEmails}}</b></h3>
                        <h4 class="text-muted">Failed Mails</h4>
                    </div>
                </div>
                
                <div class="col-lg-2 col-sm-6">
                    <div class="widget-inline-box text-center b-0">
                        <h3><i class="text-primary md md-flight"></i> <b>{{stats.totalMTAs}}</b></h3>
                        <h4 class="text-muted">Total MTAs</h4>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                    <div class="widget-inline-box text-center b-0">
                        <h3><i class="text-success md md-flight"></i> <b>{{stats.activeMTAs}}</b></h3>
                        <h4 class="text-muted">Active MTAs</h4>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endverbatim

<script type="text/javascript">
   jQuery(document).ready(function($) {
    
        // Activate Current Tab
        $("#sidebar-menu li").removeClass("active");
        $("#sidebar-menu li #tab-dashboard").addClass("active");

        // Vue Implementation
        var app = new Vue({
            el: '#app',
            data: {
                stats: {totalEmails:0, deliveredEmails:0, failedEmails:0, activeMTAs:0}
            },
            mounted () {
                axios
                .get(baseUrl + '/api/mail/statistics')
                .then(response => {
                    this.stats = response.data;
                })
            }
        });
    });
</script>

@stop