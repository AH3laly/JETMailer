@extends('layouts.default')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">New Email</h4>
        <ol class="breadcrumb">
            <li>
                <a href="/">JETMailer</a>
            </li>
            <li class="active">
                New Email
            </li>
        </ol>
    </div>
</div>

@verbatim
<div class="row" id="app">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-6">
                    <form class="form-horizontal" role="form">                                    
                        <div class="form-group">
                            <label class="col-md-3 control-label">From Name</label>
                            <div class="col-md-9">
                                <input v-model="email.fromName" type="text" class="form-control" placeholder="From Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="example-email">From Email</label>
                            <div class="col-md-9">
                                <input v-model="email.fromEmail" type="email" name="example-email" class="form-control" placeholder="From Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="example-email">Subject</label>
                            <div class="col-md-9">
                                <input v-model="email.subject"  type="text" class="form-control" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">To Email(s)</label>
                            <div class="col-md-9">
                                <textarea v-model="email.toEmail"  class="form-control" rows="5"></textarea>
                                <span class="help-block"><small>Comma separated email addresses.</small></span>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-6">
                    <form class="form-horizontal" role="form">                                    
                        
                    <div class="form-group">
                            <label class="col-md-2 control-label">Message</label>
                            <div class="col-md-10">
                                <textarea v-model="email.message"  class="form-control" rows="5"></textarea>
                                <span class="help-block"><small>Email Message.</small></span>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-md-2 control-label">&nbsp;</label>
                            <button v-on:click="scheduleEmail(email)" type="button" class="btn btn-purple waves-effect waves-light">Schedule Email</button>
                            <span :class="[statusCode==1 ? 'label-success' : '', statusCode==0 ? 'label-danger' : '']" class="label">{{statusMessage}}</span>
                        </div>
                        
                    </form>
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
    $("#sidebar-menu li #tab-newmail").addClass("active");

    // Vue Implementation
    var app = new Vue({
        el: '#app',
        data: {
            email: {},
            statusCode: 2,
            statusMessage: ""
        },
        methods: {
            scheduleEmail: function (email) {
                axios
                .post(baseUrl + '/api/mail/', email)
                .then(response => {
                    this.statusCode = response.data.statusCode;
                    this.statusMessage = response.data.statusMessage;
                })
            }
        }
    });

});

</script>

@stop