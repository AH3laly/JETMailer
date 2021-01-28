@extends('layouts.default')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">JETMailer Emails</h4>
        <ol class="breadcrumb">
            <li>
                <a href="/">JETMailer</a>
            </li>
            <li class="active">
                Emails
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="7">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Subject</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">From Name <demo@domain.com></a></td>
                        <td>toemail@domain.com</td>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">Subject</a></td>
                        <td><span class="label label-table label-success">Status</span></td>
                    </tr>
                    <tr>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">From Name <demo@domain.com></a></td>
                        <td>toemail@domain.com</td>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">Subject</a></td>
                        <td><span class="label label-table label-danger">Status</span></td>
                    </tr>
                    <tr>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">From Name <demo@domain.com></a></td>
                        <td>toemail@domain.com</td>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">Subject</a></td>
                        <td><span class="label label-table label-inverse">Status</span></td>
                    </tr>
                    <tr>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">From Name <demo@domain.com></a></td>
                        <td>toemail@domain.com</td>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">Subject</a></td>
                        <td><span class="label label-table label-success">Status</span></td>
                    </tr>
                    <tr>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">From Name <demo@domain.com></a></td>
                        <td>toemail@domain.com</td>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">Subject</a></td>
                        <td><span class="label label-table label-danger">Status</span></td>
                    </tr>
                    <tr>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">From Name <demo@domain.com></a></td>
                        <td>toemail@domain.com</td>
                        <td><a data-toggle="modal" data-target="#myModal" style="cursor:pointer">Subject</a></td>
                        <td><span class="label label-table label-inverse">Status</span></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="text-right">
                                    <ul class="pagination pagination-split m-t-30 m-b-0">
                                    <li class="footable-page-arrow"><a data-page="first" href="#first">«</a></li>
                                    <li class="footable-page-arrow"><a data-page="prev" href="#prev">‹</a></li>    
                                    <li class="footable-page active"><a data-page="4" href="#">1</a></li>
                                    <li class="footable-page active"><a data-page="4" href="#">2</a></li>
                                    <li class="footable-page active"><a data-page="4" href="#">3</a></li>
                                    <li class="footable-page active"><a data-page="4" href="#">4</a></li>
                                    <li class="footable-page active"><a data-page="4" href="#">5</a></li>
                                    <li class="footable-page active"><a data-page="4" href="#">6</a></li>
                                    <li class="footable-page-arrow"><a data-page="next" href="#next">›</a></li>
                                    <li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                </div>
                <div class="modal-body">
                    <h4>Email Subject</h4>
                    <p>From Name <fromemail@domain.com> <b>To</b> toemail@domain.com</p>
                    <hr>
                    <p>Email Body</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<!--FooTable-->
<script src="assets/plugins/footable/js/footable.all.min.js"></script>
<script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>

@stop