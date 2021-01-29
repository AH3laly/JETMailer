@extends('layouts.default')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">JETMailer MTAServers</h4>
        <ol class="breadcrumb">
            <li>
                <a href="/">JETMailer</a>
            </li>
            <li class="active">
                MTAServers
            </li>
        </ol>
    </div>
</div>

@verbatim
<div class="row" id="app">
    <div class="col-sm-12">
        <div class="card-box">
            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="7">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Host</th>
                        <th>Port</th>
                        <th>Security</th>
                        <th>Failures</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items">
                        <td>{{item.id}}</td>
                        <td>{{item.host}}</td>
                        <td>{{item.port}}</td>
                        <td>{{item.security.toUpperCase()}}</td>
                        <td>{{item.failures}}</td>
                        <td>{{item.created_at}}</td>
                        <td><span :class="[
                                item.enabled=='1' ? 'label-success' : '', 
                                item.enabled=='0' ? 'label-danger' : '', 
                            ]" class="label label-table">{{item.enabled ? 'Enabled' : 'Disabled'}}</span></td>
                        <td><a data-toggle="modal" data-target="#viewItem" v-on:click="viewItem(item)" style="cursor:pointer"><i class="md md-lock text-inverse"></i></a></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="text-right">
                                    <ul class="pagination pagination-split m-t-30 m-b-0">
                                    <li :class="[page==currentPage ? 'active' : '']" v-on:click="gotoPage(page)" v-for="page in pages" style="cursor:pointer" class="footable-page"><a>{{page}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Mail Preview Modal -->
    <div id="viewItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewItemLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="viewItemLabel">{{currentItem.host}}</h4>
                </div>
                <div class="modal-body">
                    <p><b>Username:</b> {{currentItem.username}}</p>
                    <p><b>Password:</b> {{currentItem.password}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endverbatim

<!--FooTable-->
<script src="assets/plugins/footable/js/footable.all.min.js"></script>
<script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>

<script type="text/javascript">
   jQuery(document).ready(function($) {
    
        // Activate Current Tab
        $("#sidebar-menu li").removeClass("active");
        $("#sidebar-menu li #tab-mtaservers").addClass("active");

        // Vue Implementation
        var app = new Vue({
            el: '#app',
            data: {
                items: [],
                itemsCount:0,
                pages:0,
                currentPage:1,
                currentItem: {}
            },
            mounted () {
                this.gotoPage(1);
            },
            methods: {
                gotoPage: function (page) {
                    axios
                    .get(baseUrl + '/api/mtaserver/?page=' + page)
                    .then(response => {
                        this.items = response.data.items;
                        this.itemsCount = response.data.itemsCount;
                        this.pages = response.data.pages;
                        this.currentPage = response.data.currentPage;
                    })
                },
                viewItem: function(item){
                    this.currentItem = item;
                }
            }
        });

    });

</script>

@stop