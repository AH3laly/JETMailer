@extends('layouts.default')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">JETMailer Mails</h4>
        <ol class="breadcrumb">
            <li>
                <a href="/">JETMailer</a>
            </li>
            <li class="active">
                Mails
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
                        <th>From</th>
                        <th>To</th>
                        <th>Subject</th>
                        <th>Format</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items">
                        <td>{{item.id}}</td>
                        <td>{{item.fromName}} <{{item.fromEmail}}></td>
                        <td>{{item.toEmail}}</td>
                        <td><a data-toggle="modal" data-target="#myModal" v-on:click="viewEmail(item)" style="cursor:pointer">{{item.subject}}</a></td>
                        <td>{{item.format.toUpperCase()}}</td>
                        <td>{{item.created_at}}</td>
                        <td><span :class="[
                                item.status=='Delivered' ? 'label-success' : '', 
                                item.status=='Failed' ? 'label-danger' : '', 
                                item.status=='Scheduled' ? 'label-inverse' : '', 
                            ]" class="label label-table">{{item.status}}</span></td>
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
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">{{currentItem.subject}}</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <b>From:</b> {{currentItem.fromName}}<{{currentItem.fromEmail}}>
                    </p>
                    <p>
                        <b>To:</b> {{currentItem.toEmail}}
                    </p>
                    <p>
                        <b>Subject:</b>{{currentItem.subject}}
                    </p>
                    <hr>
                    <p>{{currentItem.body}}</p>
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
        $("#sidebar-menu li #tab-mails").addClass("active");

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
                    .get(baseUrl + '/api/mail/?page=' + page)
                    .then(response => {
                        this.items = response.data.items;
                        this.itemsCount = response.data.itemsCount;
                        this.pages = response.data.pages;
                        this.currentPage = response.data.currentPage;
                    })
                },
                viewEmail: function(email){
                    this.currentItem = email;
                }
            }
        });

    });

</script>

@stop