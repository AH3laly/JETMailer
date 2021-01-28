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

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-6">
                    <form class="form-horizontal" role="form">                                    
                        <div class="form-group">
                            <label class="col-md-3 control-label">From Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="From Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="example-email">From Email</label>
                            <div class="col-md-9">
                                <input type="email" name="example-email" class="form-control" placeholder="From Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="example-email">Subject</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">To Email(s)</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="5"></textarea>
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
                                <textarea class="form-control" rows="5"></textarea>
                                <span class="help-block"><small>Email Message.</small></span>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-md-2 control-label">&nbsp;</label>
                            <button type="button" class="btn btn-purple waves-effect waves-light">Schedule Email</button>
                            <span class="label label-success">Status</span>
                        </div>
                        
                    </form>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

@stop