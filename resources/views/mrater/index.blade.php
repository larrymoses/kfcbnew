@extends('layouts.moderator')
@section('title', 'Unrated Films')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN TAB PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <!-- <a class="btn green btn-outline sbold uppercase" href="{{url('rater')}}" data-toggle="modal">
                                <i class="fa fa-share"></i>Go Back</a> -->
                    </div>
                    <div class="portlet-body">
                        <table id="filmTable"
                               class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Film Name</th>
                                <th>Film Length</th>
                                <th>Country of Origin</th>
                                <th>Year of Production</th>
                                <th>Genre</th>
                                <th>Producer</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pagelevel')
    <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables/media/assets/js/datatables.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('assets/js/datatables/extras/TableTools/media/js/TableTools.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('assets/js/datatables/extras/TableTools/media/js/ZeroClipboard.min.js')}}"></script>
    <script type='text/javascript' charset="utf-8">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            oTable = $('#filmTable').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('/get_m_films_to_rate/') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'length'},
                    {mData: 'origin'},
                    {mData: 'year_of_production'},
                    {mData: 'genre'},
                    {mData: 'producer'},
                    {mData: 'actions'}
                ]
            });
        });
    </script>
@endsection
