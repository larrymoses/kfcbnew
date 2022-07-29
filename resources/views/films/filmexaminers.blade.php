@extends('layouts.moderator')
@section('title', 'Film Management')
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <h3 class="page-title"> Films
                <small>All films in the System</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="{{url('films')}}">Films</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Films Manangement</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN TAB PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <button class="btn blue btn-outline sbold pull-right" onclick="window.print()"><span
                                    class="fa fa-print"></span></button>
                        </div>
                        @include('common.success')
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
                                    <th>Rated</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--Upload Film Modal--}}
        <div class="modal fade bs-example-modal-upload" id="uploadModal" tabindex="-1" role="dialog"
             data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                        <h4 class="modal-title">Upload video clip for the Film <code><a id="videosName"></a> </code>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="uploadvideo" enctype="multipart/form-data" method="post">
                            <div class="panel panel-default">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" name="id" id="videoID"/>
                                <input type="hidden" name="name" id="videoName"/>
                                <div class="panel-heading">
                                    <p> Select or Drag and Drop Film to Upload</p>
                                </div>
                                <div class="panel-body nopadding">
                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                    <input type="file" name="file1" id="file1"><br>
                                    <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
                                    <h3 id="status"></h3>
                                    <p id="loaded_n_total"></p>

                                </div><!-- panel-body -->
                                <div class="panel-footer">
                                    {{--<input type="button" class="btn btn-primary mr5" value="Upload File" onclick="uploadFile()">--}}
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div><!-- panel-footer -->
                            </div><!-- panel -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--End of Upload Film Modal--}}
        {{--Upload Poster Modal--}}
        <div class="modal fade bs-example-modal-removeexaminer" href="#stack2" tabindex="1" role="dialog"
             data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                        <h4 class="modal-title">Select Film Poster to Upload <code><a id="posterName"></a> </code></h4>
                    </div>
                    <div class="modal-body">
                        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <p> Select Film Poster to Upload </p>
                                </div>
                                <div class="panel-body nopadding">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="posterFilmID" id="uploadPosterID"/>
                                    <input type="hidden" name="posterFilmName" id="filmName"/>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                         style="width: 200px; height: 150px;">
                                                        <img
                                                            src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                            alt=""/></div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                         style="max-width: 500px; max-height: 450px;"></div>
                                                    <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="file" id="file"/>
                                                            </span>
                                                        <a href="javascript:;" class="btn default fileinput-exists"
                                                           data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="clearfix margin-top-10">
                                                    <span class="label label-danger">NOTE! </span>
                                                    <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- panel-body -->
                                <div class="panel-footer">
                                    <input class="btn green mr5" type="submit" value="Upload" class="submit"/>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div><!-- panel-footer -->
                            </div><!-- panel -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--End of Poster Film Modal--}}
        {{--Group Deactivate Windows--}}
        <div class="modal fade bs-example-modal-viewexaminers" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="deactivateID"/>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <p> The Following are the exerminers assigned to <code id="filmEName"></code></p>
                                <input type="hidden" id="filmExaminerID" name="filmExaminerID">
                            </div>
                            <div class="panel-body">
                                <table id="filmExaminersTable"
                                       class="display table table-striped table-bordered responsive">
                                    <thead>
                                    <tr>
                                        <th>Examiners Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div><!-- panel -->

                    </div>
                    <div class="modal-footer">
                        <button id="viewClose" type="button" class="btn btn-success">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{--End of Group Deactivate Modal Window--}}
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
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/profile.min.js')}}" type="text/javascript"></script>
    <script src="../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"
            type="text/javascript"></script>
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
                "sAjaxSource": "<?php echo url('films/get_examiners/') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'length'},
                    {mData: 'origin'},
                    {mData: 'year_of_production'},
                    {mData: 'rated'},
                    {mData: 'actions'}
                ]
            });
        });
        //Javascript code to create new Film
        $("#btnCreate").on('click', function (event) {

            var frm = $('#frmCreate');
            var btn = $('#btnCreate');
            var name = $('#name').val();
            var notification = $("#createNotification");
            notification.hide();
            var data = frm.serialize();
            $.ajax({
                method: "POST",
                url: "films",
                data: data,
                success: function (data, status) {
                    frm.hide();
                    btn.hide();
                    notification.show();
                    notification.html('<div class="alert alert-success">' + '<code>' + name + '</code> Created Successfully' + '</div>');
                },
                error: function (data) {
                    // Error...
                    var errors = data.responseJSON;

                    console.log(errors);

                    $.each(errors, function (index, value) {
                        notification.show();
                        notification.html('<div class="alert alert-danger">' + '<li>' + value + '</li>' + '</div>');
                    });
                }
            });
        });
        $(document).on("click", ".edit", function () {
            var notification = $("#editNotification");
            var frm = $("#frmEdit");
            var btnSaveEdit = $("#btnSaveEdit");
            var id = $(this).data('id');
            var name = $(this).data('name');
            var description = $(this).data('description');
            var cast = $(this).data('cast');
            var origin = $(this).data('origin');
            var length = $(this).data('length');
            var year_of_production = $(this).data('year_of_production');
            $.ajax({
                type: "GET",
                url: "/getfilm/" + id,
                data: {id: id},
                success: function (data, status) {
                    switch (status) {
                        case "success":

                            var res = jQuery.parseJSON(data);
                            document.getElementById("entityID").value = res.id;
                            document.getElementById("editName").value = res.name;
                            document.getElementById("editOrigin").value = res.origin;
                            document.getElementById("editDescription").value = res.description;
                            document.getElementById("editLength").value = res.length;
                            document.getElementById("editYear").value = res.year_of_production;
                            document.getElementById("editProducer").value = res.producer;
                            document.getElementById("editGenre").value = res.genre;
                            document.getElementById("editPoster").value = res.poster;
                            document.getElementById("editCategory").value = res.category;
                            $('#editModal').modal('show');
                            console(data);
                            break;

                        case "failed":
                            notification.html('<div class="alert alert-danger">' + data.message + ' </div>');
                            notification.show();
                            frm.hide();
                            break;
                        default :
                            alert("do nothing");
                    }
                }

            });
        });
        $("#uploadvideo").on('submit', (function (e) {
            e.preventDefault();
            var formdata = new FormData(this);
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.addEventListener("abort", abortHandler, false);
            ajax.open("POST", "<?php echo url('video');?>");
            ajax.send(formdata);
        }));

        function _(el) {
            return document.getElementById(el);
        }

        function uploadFile() {
            var file = _("file1");
            alert(file.name + " | " + file.size + " | " + file.type);
            var formdata = new FormData();
            formdata.append("file1", file);
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.addEventListener("abort", abortHandler, false);
            ajax.open("POST", "<?php echo url('video');?>");
            ajax.send(formdata);
        }

        function progressHandler(event) {
            _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
            var percent = (event.loaded / event.total) * 100;
            _("progressBar").value = Math.round(percent);
            _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
        }

        function completeHandler(event) {
            _("status").innerHTML = event.target.responseText;
            _("progressBar").value = 0;
        }

        function errorHandler(event) {
            _("status").innerHTML = "Upload Failed";
        }

        function abortHandler(event) {
            _("status").innerHTML = "Upload Aborted";
        }

        $("#uploadimage").on('submit', (function (e) {
            e.preventDefault();
            $("#message").empty();
            $('#loading').show();
            $.ajax({
                url: "<?php echo url('poster');?>", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData: false,        // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    alert('Poster Uploaded Successfully');
                    document.location.reload();
                }
            });
        }));
        $("#btnSaveEdit").click(function () {
            var editNotification = $("#editNotification");
            editNotification.hide();
            var frm = $("#frmEdit");
            var name = $("#editName").val();
            var origin = $("#editOrigin").val();
            var description = $("#editDescription").val();
            var producer = $("#editProducert").val();
            var genre = $("#editGenre").val();
            var poster = $("#editPoster").val();
            var category = $("#editCategory").val();
            var year_of_production = $("#editYear").val();
            var length = $("#editLength").val();
            var id = $("#entityID").val();

            $.ajax({
                method: "PUT",
                url: "films/" + id,
                data: {
                    id: id,
                    poster: poster,
                    category: category,
                    name: name,
                    genre: genre,
                    producer: producer,
                    description: description,
                    length: length,
                    year_of_production: year_of_production,
                    origin: origin
                },
                success: function (data, status) {
                    switch (status) {
                        case "success":
                            if (data.status === '00') {
                                frm.hide();
                                editNotification.html('<div class="alert alert-success" >' + data.message + '</div>');
                                editNotification.show();
                                $("#btnSaveEdit").hide();
                            } else if (data.status === '01') {
                                editNotification.hide().find('#ul').empty();
                                $.each(data.errors, function (index, error) {
                                    editNotification.html('<div class="alert alert-danger">' + '<li>' + data.error + '</li>' + '</div>');
                                });
                                createNotification.show();
                            }
                            break;
                        case "failed":
                            editNotification.html('<div class="alert alert-danger">' + data.message + ' </div>');
                            editNotification.show();
                            frm.hide();
                            break;
                        default :
                            alert("do nothing");
                    }
                }
            });
        });

        $(document).on("click", ".upload", function () {

            var id = $(this).data('id');
            var name = $(this).data('name');
            var sname = $(this).data('sname');
            document.getElementById('videoID').value = id;
            document.getElementById('videoName').innerHTML = name;
            document.getElementById('videosName').innerHTML = sname;
        });
        $(document).on("click", ".poster", function () {

            var id = $(this).data('id');
            var name = $(this).data('name');
            document.getElementById('uploadPosterID').value = id;
            document.getElementById('posterName').innerHTML = name;
            document.getElementById('filmName').value = name;
        });
        $(document).on("click", ".viewexaminers", function () {

            var id = $(this).data('id');
            var name = $(this).data('name');
            document.getElementById('filmExaminerID').value = id;
            document.getElementById('filmEName').innerHTML = name;
        });
        $(document).on("click", ".sremoveexaminer", function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            document.getElementById('filmExamID').value = id;
            document.getElementById('filmExamName').innerHTML = name;
            alert(id + ': ' + name)
        });
        $("#newClose").click(function () {
            pageReload();
        });
        $("#editClose").click(function () {
            pageReload();
        });
        $("#viewClose").click(function () {
            pageReload();
        });

        function pageReload() {
            document.location.reload();
        }
    </script>
@endsection
