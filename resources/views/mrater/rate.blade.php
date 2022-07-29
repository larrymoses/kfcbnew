@extends('layouts.mwizard')
@section('title', 'Unrated Films')
@section('content')

    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div id="frmCreate">
                    <div class="portlet light " id="form_wizard_1">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Rating Wizard -
                                                <span class="step-title"> Step 1 of 4 </span>
                                            </span>
                            </div>
                            <div class="caption pull-right">
                                <i class=" icon-film font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> {{$film->name }}</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="#" class="form-horizontal" id="submit_form" method="POST">
                                <div class="form-wizard">
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li>
                                                <a href="#tab1" data-toggle="tab" class="step">
                                                    <span class="number"> 1 </span>
                                                    <span class="desc">
                                                                    <i class="fa fa-check"></i> Watch and Rate Film </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab2" data-toggle="tab" class="step">
                                                    <span class="number"> 2 </span>
                                                    <span class="desc">
                                                                    <i class="fa fa-check"></i> Parameter Capture </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab3" data-toggle="tab" class="step active">
                                                    <span class="number"> 3 </span>
                                                    <span class="desc">
                                                                    <i class="fa fa-check"></i> Review Ratings Captured</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab4" data-toggle="tab" class="step">
                                                    <span class="number"> 4 </span>
                                                    <span class="desc">
                                                                    <i class="fa fa-check"></i>Enter Rating and Submit </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div id="bar" class="progress progress-striped" role="progressbar">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                <h3 class="block">Provide your account details</h3>
                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <!-- BEGIN Portlet PORTLET-->
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-check"></i>Rating
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body">
                                                                <table
                                                                    class="table table-striped table-bordered responsive dataTable table-condensed dtr-inline">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Theme</th>
                                                                        <th colspan="2" align="center">Occurrence</th>
                                                                        <th>Hits</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>Violence and Crime</td>
                                                                        <td>
                                                                            <button class="btn btn-primary btn-sm"
                                                                                    id="btnTheme1">Add
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm"
                                                                                    id="btnTheme11">Reduce
                                                                            </button>
                                                                        </td>
                                                                        <td><strong><a id="theme1">0</a></strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>Sex, Obscenity and Nudity</td>
                                                                        <td>
                                                                            <button class="btn btn-primary btn-sm"
                                                                                    id="btnTheme2">Add
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm"
                                                                                    id="btnTheme22">Reduce
                                                                            </button>
                                                                        </td>
                                                                        <td><strong><a id="theme2">0</a></strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3</td>
                                                                        <td>Horror and Occult</td>
                                                                        <td>
                                                                            <button class="btn btn-primary btn-sm"
                                                                                    id="btnTheme3">Add
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm"
                                                                                    id="btnTheme33">Reduce
                                                                            </button>
                                                                        </td>
                                                                        <td><strong><a id="theme3">0</a></strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>4</td>
                                                                        <td>Drugs, Smoking, Tobacco, Solvents and
                                                                            Alcohol
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-primary btn-sm"
                                                                                    id="btnTheme4">Add
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm"
                                                                                    id="btnTheme44">Reduce
                                                                            </button>
                                                                        </td>
                                                                        <td><strong><a id="theme4">0</a></strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>5</td>
                                                                        <td>Profanity,Religion and Community</td>
                                                                        <td>
                                                                            <button class="btn btn-primary btn-sm"
                                                                                    id="btnTheme5">Add
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm"
                                                                                    id="btnTheme55">Reduce
                                                                            </button>
                                                                        </td>
                                                                        <td><strong><a id="theme5">0</a></strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>6</td>
                                                                        <td>Propaganda for War, hate Speech and
                                                                            Incitement Parameters
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-primary btn-sm"
                                                                                    id="btnTheme6">Add
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm"
                                                                                    id="btnTheme66">Reduce
                                                                            </button>
                                                                        </td>
                                                                        <td><strong><a id="theme6">0</a></strong></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                        <!-- END Portlet PORTLET-->
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <!-- BEGIN Portlet PORTLET-->
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-play"></i>Video Widget
                                                                </div>

                                                            </div>
                                                            <div class="portlet-body">
                                                                @if($film->clip===1)
                                                                    <div align="center"
                                                                         class="embed-responsive embed-responsive-16by9">
                                                                        <video width="320" height="240"
                                                                               controls="controls" autoplay="autoplay">
                                                                            <source
                                                                                src="{{asset('/').$film->clip_path}}"
                                                                                type="video/mp4">
                                                                            <object data="" width="320" height="240">
                                                                                <embed width="320" height="240"
                                                                                       src="{{asset('').$film->clip_path}}">
                                                                            </object>
                                                                        </video>
                                                                    </div>
                                                                    <h1 align="center">
                                                                        <time id="timer">00:00:00</time>
                                                                    </h1>
                                                                    <div class="clearfix">
                                                                        <button class="btn btn-success btnStart btn-lg"
                                                                                id="start"><span
                                                                                class="glyphicon glyphicon-play"> START</span>
                                                                        </button>
                                                                        <button class="btn btn-danger btnStop btn-lg"
                                                                                id="stop"><span
                                                                                class="glyphicon glyphicon-stop"> STOP</span>
                                                                        </button>
                                                                        <button
                                                                            class="btn btn-primary btn-lg pull-right"
                                                                            id="clear"><span
                                                                                class="glyphicon glyphicon-refresh"> RESTART</span>
                                                                        </button>
                                                                    </div>
                                                                @elseif($film->clip===0)
                                                                    <div class="portlet solid purple">
                                                                        <div class="portlet-title">
                                                                            <div class="caption">
                                                                                <i class="fa fa-timer"></i>
                                                                            </div>

                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            <h1 align="center">
                                                                                <time id="timer">00:00:00</time>
                                                                            </h1>
                                                                            <div class="clearfix">
                                                                                <button
                                                                                    class="btn btn-success btnStart btn-lg"
                                                                                    id="start"><span
                                                                                        class="glyphicon glyphicon-play"> START</span>
                                                                                </button>
                                                                                <button
                                                                                    class="btn btn-danger btnStop btn-lg "
                                                                                    id="stop"><span
                                                                                        class="glyphicon glyphicon-stop"> STOP</span>
                                                                                </button>
                                                                                <button
                                                                                    class="btn btn-primary btn-lg pull-right"
                                                                                    id="clear"><span
                                                                                        class="glyphicon glyphicon-refresh"> RESTART</span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- END Portlet PORTLET-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <h3 class="block">Select Parameters that Applied to the Film</h3>
                                                <div class="row">
                                                    <div class="thm1">
                                                        <div class="col-md-12">
                                                            <!-- BEGIN Portlet PORTLET-->
                                                            <div class="portlet box blue">
                                                                <div class="portlet-title">
                                                                    <div class="caption">
                                                                        <i class="fa fa-check"></i>Violence and Crime
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <table id="violenceTable"
                                                                           class="display table table-condensed table-striped table-bordered responsive dataTable no-footer dtr-inline"
                                                                           cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </thead>

                                                                        <tfoot>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <!-- END Portlet PORTLET-->
                                                        </div>
                                                    </div>
                                                    <div class="thm2">
                                                        <div class="col-md-12 ">
                                                            <!-- BEGIN Portlet PORTLET-->
                                                            <div class="portlet box blue">
                                                                <div class="portlet-title">
                                                                    <div class="caption">
                                                                        <i class="fa fa-play"></i>Sex, Obscenity and
                                                                        Nudity
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <table id="sexTable"
                                                                           class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline"
                                                                           cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </thead>

                                                                        <tfoot>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <!-- END Portlet PORTLET-->
                                                        </div>
                                                    </div>
                                                    <div class="thm3">
                                                        <div class="col-md-12 ">
                                                            <!-- BEGIN Portlet PORTLET-->
                                                            <div class="portlet box blue">
                                                                <div class="portlet-title">
                                                                    <div class="caption">
                                                                        <i class="icon-ghost"></i>Horror and Occult
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <table id="occultTable"
                                                                           class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline"
                                                                           cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </thead>

                                                                        <tfoot>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>


                                                                </div>
                                                            </div>
                                                            <!-- END Portlet PORTLET-->
                                                        </div>
                                                    </div>
                                                    <div class="thm4">
                                                        <div class="col-md-12">
                                                            <!-- BEGIN Portlet PORTLET-->
                                                            <div class="portlet box blue">
                                                                <div class="portlet-title">
                                                                    <div class="caption">
                                                                        <i class="fa fa-play"></i>Drugs, Smoking,
                                                                        Tobacco, Solvents and Alcohol
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <table id="drugsTable"
                                                                           class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline"
                                                                           cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </thead>

                                                                        <tfoot>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <!-- END Portlet PORTLET-->
                                                        </div>
                                                    </div>
                                                    <div class="thm5">
                                                        <div class="col-md-12 ">
                                                            <!-- BEGIN Portlet PORTLET-->
                                                            <div class="portlet box blue">
                                                                <div class="portlet-title">
                                                                    <div class="caption">
                                                                        <i class="fa fa-check"></i>Profanity,Religion
                                                                        and Community
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <table id="religionTable"
                                                                           class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline"
                                                                           cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </thead>

                                                                        <tfoot>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <!-- END Portlet PORTLET-->
                                                        </div>
                                                    </div>
                                                    <div class="thm6">
                                                        <div class="col-md-12 ">
                                                            <!-- BEGIN Portlet PORTLET-->
                                                            <div class="portlet box blue">
                                                                <div class="portlet-title">
                                                                    <div class="caption">
                                                                        <i class="fa fa-play"></i>Propaganda for War,
                                                                        Hate Speech and Incitement
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <table id="propagandaTable"
                                                                           class="display table table-striped table-bordered responsive dataTable no-footer dtr-inline"
                                                                           cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </thead>

                                                                        <tfoot>
                                                                        <tr>

                                                                            <th>Parameter Name</th>
                                                                            <th>Check</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <!-- END Portlet PORTLET-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <h3 class="block">Confirm your rating details</h3>
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <!-- BEGIN Portlet PORTLET-->
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-check"></i>Rating
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body">
                                                                <table
                                                                    class="table table-striped table-bordered responsive dataTable table-condensed dtr-inline">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Theme Name</th>
                                                                        <th>Total Occurrence</th>
                                                                        <th>Score</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr class="thm1">
                                                                        <td>Violence and Crime</td>
                                                                        <td><strong><a id="occurance1">0</a></strong>
                                                                        </td>
                                                                        <td>
                                                                            <select
                                                                                class="bs-select  form-control input-xsmall themeSelect"
                                                                                data-style="green">
                                                                                <option value="0" selected>0
                                                                                </option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="thm2">
                                                                        <td>Sex, Obscenity and Nudity</td>
                                                                        <td><strong><a id="occurance2">0</a></strong>
                                                                        </td>
                                                                        <td>
                                                                            <select
                                                                                class="bs-select form-control input-xsmall  themeSelect"
                                                                                data-style="green">
                                                                                <option value="0" selected>0
                                                                                </option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>
                                                                    <tr class="thm3">
                                                                        <td>Horror and Occult</td>
                                                                        <td><strong><a id="occurance3">0</a></strong>
                                                                        </td>
                                                                        <td>
                                                                            <select
                                                                                class="bs-select form-control input-xsmall themeSelect"
                                                                                data-style="green">
                                                                                <option value="0" selected>0
                                                                                </option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>
                                                                    <tr class="thm4">
                                                                        <td>Drugs, Smoking, Tobacco, Solvents and
                                                                            Alcohol
                                                                        </td>
                                                                        <td><strong><a id="occurance4">0</a></strong>
                                                                        </td>
                                                                        <td>
                                                                            <select
                                                                                class="bs-select form-control input-xsmall themeSelect"
                                                                                data-style="green">
                                                                                <option value="0" selected>0
                                                                                </option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>
                                                                    <tr class="thm5">
                                                                        <td>Profanity,Religion and Community</td>
                                                                        <td><strong><a id="occurance5">0</a></strong>
                                                                        </td>
                                                                        <td>
                                                                            <select
                                                                                class="bs-select form-control input-xsmall themeSelect"
                                                                                data-style="green">
                                                                                <option value="0" selected>0
                                                                                </option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>
                                                                    <tr class="thm6">
                                                                        <td>Propaganda for War, hate Speech and
                                                                            Incitement Parameters
                                                                        </td>
                                                                        <td><strong><a id="occurance6">0</a></strong>
                                                                        </td>
                                                                        <td>
                                                                            <select
                                                                                class="bs-select form-control input-xsmall themeSelect"
                                                                                data-style="green">
                                                                                <option value="0" selected>0
                                                                                </option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- END Portlet PORTLET-->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <!-- BEGIN Portlet PORTLET-->
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-list-alt"></i>Selected Parameters
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body">
                                                                <table id="viewTempParameter"
                                                                       class="display table table-striped table-bordered responsive dataTable dtr-inline"
                                                                       cellspacing="0" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Parameter Name</th>

                                                                    </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- END Portlet PORTLET-->
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <!-- BEGIN Portlet PORTLET-->
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-list-alt"></i>Theme Occurrence
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body">
                                                                <table id="viewThemeTimeOccurance"
                                                                       class="display table table-striped table-bordered responsive dataTable dtr-inline"
                                                                       cellspacing="0" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Theme Name</th>
                                                                        <th>Time(Approx)</th>
                                                                    </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- END Portlet PORTLET-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <h3 class="block">Confirm your account</h3>
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <!-- BEGIN Portlet PORTLET-->
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-save"></i>Save and Submit
                                                                </div>

                                                            </div>
                                                            <div class="portlet-body">
                                                                <div class="alert display-none" id="createNotification">
                                                                    <ul id="ul" class="ul"></ul>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span class="col-sm-6 control-label">System Suggested Rating is:</span>
                                                                    <div class="col-sm-6">
                                                                        <span class="text-danger text-bold"
                                                                              id="sysRating">0 </span>:<span
                                                                            class="text-danger text-bold"
                                                                            id="sysRatingWords">GE</span>
                                                                    </div>
                                                                </div>
                                                                <div class="divider"></div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Select Final
                                                                        Rating</label>
                                                                    <div class="col-sm-9">
                                                                        <select id="enterRatingScore"
                                                                                name="enterRatingScore"
                                                                                class="col-md-12 form-control" required>
                                                                            <option value="">Select Final Rating...
                                                                            </option>
                                                                            <option value="1">1 GE (General Exhition )
                                                                            </option>
                                                                            <option value="2">2 PG (Parental Guidance
                                                                                Recommended)
                                                                            </option>
                                                                            <option value="3">3 16 (Not Suitable to
                                                                                persons Under 16Yrs)
                                                                            </option>
                                                                            <option value="4">4 18 (Restricted To
                                                                                Persons above 18Yrs)
                                                                            </option>
                                                                            <option value="5">5 R (Restricted)</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @if($synopsis==$me)
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Enter
                                                                            Synopsis</label>
                                                                        <div class="col-sm-9">
                                                                            <textarea class="form-control" rows="3"
                                                                                      id="enterSynopsis"
                                                                                      name="enterSynopsis"
                                                                                      required></textarea>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Enter
                                                                        Justification</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="form-control" rows="3"
                                                                                  id="enterComment" name="enterSynopsis"
                                                                                  required></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END Portlet PORTLET-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="javascript:;" class="btn default button-previous">
                                                    <i class="fa fa-angle-left"></i> Back </a>
                                                <a href="javascript:;" class="btn btn-outline green button-next"
                                                   id="button-next"> Continue
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <a href="javascript:;" class="btn green button-submit"
                                                   id="btnSubmitAll"> Submit
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="editNotifications">
                    <div id="editNotification">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('pagelevel')

    <script type="text/javascript" src="{{asset('assets/js/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables/media/assets/js/datatables.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('assets/js/datatables/extras/TableTools/media/js/TableTools.min.js')}}"></script>
@endsection
@section('end')
    <script type='text/javascript' charset="utf-8">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-smRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var countClicks = 0;
            var theme1 = 0;
            var theme2 = 0;
            var theme3 = 0;
            var theme4 = 0;
            var theme5 = 0;
            var theme6 = 0;
            var sysRating = 0;
            var index = 0;
            var h1 = document.getElementsByTagName('h1')[0],
                start = document.getElementById('start'),
                stop = document.getElementById('stop'),
                clear = document.getElementById('clear'),
                seconds = 0, minutes = 0, hours = 0,
                t;
            var next = $('#button-next');
            var btnStart = $('.btnStart');
            var btnStop = $('.btnStop');
            next.hide();
            btnStart.hide();
            $(".thm1").hide();
            $(".thm2").hide();
            $(".thm3").hide();
            $(".thm4").hide();
            $(".thm5").hide();
            $(".thm6").hide();

            function add() {
                seconds++;
                if (seconds >= 60) {
                    seconds = 0;
                    minutes++;
                    if (minutes >= 60) {
                        minutes = 0;
                        hours++;
                    }
                }

                h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

                timer();
            }

            function timer() {
                t = setTimeout(add, 1000);
            }

            timer();


            /* Start button */
            start.onclick = timer;

            /* Stop button */
            stop.onclick = function () {
                clearTimeout(t);
            };

            /* Clear button */
            clear.onclick = function () {
                h1.textContent = "00:00:00";
                seconds = 0;
                minutes = 0;
                hours = 0;
            };
            $("#btnTheme11").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 11;
                theme1 = document.getElementById("theme1").innerHTML;
                theme1 = theme1 - 1;
                if (theme1 <= 0) {
                    $(".thm1").hide();
                } else {
                    $(".thm1").show();
                }
                document.getElementById("theme1").innerHTML = theme1;
                document.getElementById("occurance1").innerHTML = theme1;
            });
            $("#btnTheme22").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 22;
                theme2 = document.getElementById("theme2").innerHTML;
                theme2 = theme2 - 1;
                if (theme2 <= 0) {
                    $(".thm2").hide();
                } else {
                    $(".thm2").show();
                }
                document.getElementById("theme2").innerHTML = theme2;
                document.getElementById("occurance2").innerHTML = theme2;
            });
            $("#btnTheme33").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 33;
                theme3 = document.getElementById("theme3").innerHTML;
                theme3 = theme3 - 1;
                if (theme3 <= 0) {
                    $(".thm3").hide();
                } else {
                    $(".thm3").show();
                }
                document.getElementById("theme3").innerHTML = theme3;
                document.getElementById("occurance3").innerHTML = theme3;
            });
            $("#btnTheme44").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 44;
                theme4 = document.getElementById("theme4").innerHTML;
                theme4 = theme4 - 1;
                if (theme4 <= 0) {
                    $(".thm4").hide();
                } else {
                    $(".thm4").show();
                }
                document.getElementById("theme4").innerHTML = theme4;
                document.getElementById("occurance4").innerHTML = theme4;
            });
            $("#btnTheme55").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 55;
                theme5 = document.getElementById("theme5").innerHTML;
                theme5 = theme5 - 1;
                if (theme5 <= 0) {
                    $(".thm5").hide();
                } else {
                    $(".thm5").show();
                }
                document.getElementById("theme5").innerHTML = theme5;
                document.getElementById("occurance5").innerHTML = themeR;
            });
            $("#btnTheme66").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 66;
                theme6 = document.getElementById("theme6").innerHTML;
                theme6 = theme6 - 1;
                if (theme6 <= 0) {
                    $(".thm6").hide();
                } else {
                    $(".thm6").show();
                }
                document.getElementById("theme6").innerHTML = theme6;
                document.getElementById("occurance6").innerHTML = theme6;
            });
            $("#btnTheme1").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 1;
                theme1 += 1;
                document.getElementById("theme1").innerHTML = theme1;
                document.getElementById("occurance1").innerHTML = theme1;
                if (theme1 <= 0) {
                    $(".thm1").hide();
                } else {
                    $(".thm1").show();
                }
                var time_at = hours + ":" + minutes + ":" + seconds;
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var token = $(this).data('token');
                var dataString = {filmID: filmID, userID: userID, themeID: themeID, _token: token, time_at: time_at};
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('storeTimeOccurance'); ?>",
                    data: dataString,
                    cache: false,
                    success: function (data, status) {
                        drawDataTable1();
                    }
                });

            });
            $("#btnTheme2").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 2;
                theme2 += 1;
                document.getElementById("theme2").innerHTML = theme2;
                document.getElementById("occurance2").innerHTML = theme2;
                if (theme2 <= 0) {
                    $(".thm2").hide();
                } else {
                    $(".thm2").show();
                }
                var time_at = hours + ":" + minutes + ":" + seconds;
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var token = $(this).data('token');
                var dataString = {filmID: filmID, userID: userID, themeID: themeID, _token: token, time_at: time_at};
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('storeTimeOccurance'); ?>",
                    data: dataString,
                    cache: false,
                    success: function (data, status) {
                        drawDataTable1();
                    }
                });
            });
            $("#btnTheme3").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 3;
                theme3 += 1;
                document.getElementById("theme3").innerHTML = theme3;
                document.getElementById("occurance3").innerHTML = theme3;
                if (theme3 <= 0) {
                    $(".thm3").hide();
                } else {
                    $(".thm3").show();
                }
                var time_at = hours + ":" + minutes + ":" + seconds;
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var token = $(this).data('token');
                var dataString = {filmID: filmID, userID: userID, themeID: themeID, _token: token, time_at: time_at};
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('storeTimeOccurance'); ?>",
                    data: dataString,
                    cache: false,
                    success: function (data, status) {
                        drawDataTable1();
                    }
                });
            });
            $("#btnTheme4").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 4;
                theme4 += 1;
                document.getElementById("theme4").innerHTML = theme4;
                document.getElementById("occurance4").innerHTML = theme4;
                if (theme4 <= 0) {
                    $(".thm4").hide();
                } else {
                    $(".thm4").show();
                }
                var time_at = hours + ":" + minutes + ":" + seconds;
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var token = $(this).data('token');
                var dataString = {filmID: filmID, userID: userID, themeID: themeID, _token: token, time_at: time_at};
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('storeTimeOccurance'); ?>",
                    data: dataString,
                    cache: false,
                    success: function (data, status) {
                        drawDataTable1();
                    }
                });

            });
            $("#btnTheme5").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 5;
                theme5 += 1;
                document.getElementById("theme5").innerHTML = theme5;
                document.getElementById("occurance5").innerHTML = theme5;
                if (theme5 <= 0) {
                    $(".thm5").hide();
                } else {
                    $(".thm5").show();
                }
                var time_at = hours + ":" + minutes + ":" + seconds;
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var token = $(this).data('token');
                var dataString = {filmID: filmID, userID: userID, themeID: themeID, _token: token, time_at: time_at};
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('storeTimeOccurance'); ?>",
                    data: dataString,
                    cache: false,
                    success: function (data, status) {
                        drawDataTable1();
                    }
                });

            });
            $("#btnTheme6").click(function () {
                var id = "<?php echo $film->id; ?>";
                var themeID = 6;
                theme6 += 1;
                document.getElementById("theme6").innerHTML = theme6;
                document.getElementById("occurance6").innerHTML = theme6;
                if (theme6 <= 0) {
                    $(".thm6").hide();
                } else {
                    $(".thm6").show();
                }
                var time_at = hours + ":" + minutes + ":" + seconds;
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var token = $(this).data('token');
                var dataString = {filmID: filmID, userID: userID, themeID: themeID, _token: token, time_at: time_at};
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('storeTimeOccurance'); ?>",
                    data: dataString,
                    cache: false,
                    success: function (data, status) {
                        drawDataTable1();
                    }
                });
            });
            drawDataTable = function () {
                var filmID = "<?php echo $film->id; ?>"; //get film id
                oTable = $('#viewTempParameter').DataTable({
                    responsive: true,
                    stateSave: true,
                    destroy: true,
                    "sAjaxSource": "<?php echo url('/get_temp_param/') ?>/" + filmID,
                    "aoColumns": [
                        {mData: 'name'},
                    ]
                });
            };
            drawDataTable1 = function () {
                var filmID = "<?php echo $film->id; ?>"; //get film id
                oTable = $('#viewThemeTimeOccurance').DataTable({
                    responsive: true,
                    stateSave: true,
                    destroy: true,
                    "sAjaxSource": "<?php echo url('/get_theme_time_occurance/') ?>/" + filmID,
                    "aoColumns": [
                        {mData: 'name'},
                        {mData: 'time_at'},
                    ]
                });
            };

            drawDataTable();
            drawDataTable1();

            oTable = $('#violenceTable').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('getParameter/1') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'actions'},
                ]
            });
            oTable = $('#sexTable').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('getParameter/2') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'actions'},
                ]
            });
            oTable = $('#occultTable').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('getParameter/3') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'actions'}
                ]
            });
            oTable = $('#drugsTable').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('getParameter/4') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'actions'}
                ]
            });
            oTable = $('#religionTable').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('getParameter/5') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'actions'}
                ]
            });
            oTable = $('#propagandaTable').DataTable({
                responsive: true,
                stateSave: true,
                "sAjaxSource": "<?php echo url('getParameter/6') ?>",
                "aoColumns": [
                    {mData: 'name'},
                    {mData: 'actions'}
                ]
            });

            $("#btnSubmitAll").click(function () {
                var editNotification = $("#editNotification");
                var editNotifications = $("#editNotifications");
                var createNotification = $("#createNotification");
                var frm = ("frmCreate");
                var index = "<?php echo $synopsis;?>";
                var me = "<?php echo $me;?>";
                editNotifications.hide();
                var filmID = "<?php echo $film->id; ?>";
                var filmName = "<?php echo $film->name; ?>";
                var one = document.getElementById("occurance1").innerHTML;
                var two = document.getElementById("occurance2").innerHTML;
                var three = document.getElementById("occurance3").innerHTML;
                var four = document.getElementById("occurance4").innerHTML;
                var five = document.getElementById("occurance5").innerHTML;
                var six = document.getElementById("occurance6").innerHTML;
                var system = document.getElementById("sysRating").innerHTML;
                if (index == me) {
                    var synopsis = document.getElementById("enterSynopsis").value;
                }
                var ratescore = document.getElementById("enterRatingScore").value;
                var comment = document.getElementById("enterComment").value;
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('rate'); ?>/" + filmID,
                    data: {
                        filmID: filmID,
                        filmName: filmName,
                        system: system,
                        comment: comment,
                        synopsis: synopsis,
                        ratescore: ratescore,
                        one: one,
                        two: two,
                        three: three,
                        four: four,
                        five: five,
                        six: six
                    },
                    success: function (data, status) {
                        switch (status) {
                            case "success":
                                if (data.status === '00') {
                                    $("#frmCreate").hide();
                                    editNotification.html('<div class="alert alert-success" >' + data.message + ' <div class="row"><div class="col-md-12"><div class="col-md-offset-6 col-md-6"><a href="<?php echo url('rater')?>" class="btn btn-primary " id="submitBtns">Go Back <i class="fa fa-arrow-circle-left"></i></a></div></div></div></div>');
                                    editNotifications.show();

                                } else if (data.status === '01') {
                                    createNotification.hide().find('#ul').empty();
                                    $.each(data.errors, function (index, error) {
                                        createNotification.html('<div class="alert alert-danger">' + '<li>' + data.error + '</li>' + '</div>');
                                    });
                                    createNotification.show();
                                }
                                break;
                            case "failed":
                                createNotification.html('<div class="alert alert-danger">' + data.errors + ' </div>');
                                createNotification.show();
                                frm.hide();
                                break;
                            default :
                                alert("do nothing");

                        }
                    }
                });
            });


            $(document).on('click', '.selectParam', function () {
                var paramID = $(this).data('id'); // get the ID
                var name = $(this).data('name'); // get the Name
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var dataString = {filmID: filmID, paramID: paramID, userID: userID, name: name};

                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('storerate'); ?>",
                    data: dataString,
                    cache: false,
                    success: function (data, status) {
                        // alert(data.message);

                    }
                });
                drawDataTable();
            });
            $(document).on('click', '.removeParam', function () {
                var paramID = $(this).data('id'); // get the ID
                var name = $(this).data('name'); // get the Name
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var dataString = {filmID: filmID, paramID: paramID, userID: userID, name: name};

                // // AJAX Code To Submit Form.
                // $.ajax({
                // type: "DELETE",
                // url: "<?php echo url('storerate'); ?>",
                // data: dataString,
                // cache: false,
                //     success: function(data, status){
                //     alert(data.message);
                //     }
                // });
            });
            $(document).on('click', '.btnStop', function () {
                next.show();
                btnStop.hide();
                btnStart.show();
            });
            $(document).on('click', '.btnStart', function () {
                next.hide();
                btnStop.show();
                btnStart.hide();
            });
            $(document).on('change', '.checkMe', function () {
                var paramID = $(this).data('id'); // get the ID
                var name = $(this).data('name'); // get the Name
                var filmID = "<?php echo $film->id; ?>"; //get film id
                var userID = "<?php echo Auth::User()->id?>";
                var token = $(this).data('token');
                var dataString = {filmID: filmID, paramID: paramID, userID: userID, name: name, _token: token};

                if (this.checked) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo url('storerate'); ?>",
                        data: dataString,
                        cache: false,
                        success: function (data, status) {
                            // alert(data.message);

                        }
                    });
                    drawDataTable();
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo url('removerate'); ?>",
                        data: {
                            _method: 'delete',
                            _token: token,
                            filmID: filmID,
                            paramID: paramID,
                            userID: userID,
                            name: name
                        },
                        cache: false,
                        success: function (data, status) {
                            // alert(data.message);

                        }
                    });
                    drawDataTable();
                }
            });
            $('.themeSelect').change(function () {
                var themeVal = $(this).val();
                var currentValue = document.getElementById("sysRating").innerHTML;
                if (themeVal > currentValue) {
                    document.getElementById('sysRating').innerHTML = themeVal;
                    if (themeVal == "1") {
                        document.getElementById('sysRatingWords').innerHTML = "GE General Exhition";
                    } else if (themeVal == "2") {
                        document.getElementById('sysRatingWords').innerHTML = "PG Parental Guidance Recommended";
                    }
                    if (themeVal == "3") {
                        document.getElementById('sysRatingWords').innerHTML = "Not Suitable to persons Under 16 Years";
                    }
                    if (themeVal == "4") {
                        document.getElementById('sysRatingWords').innerHTML = "Restricted to persons above 18 Years";
                    }
                    if (themeVal == "5") {
                        document.getElementById('sysRatingWords').innerHTML = "Restricted";
                    }
                }
            });
        });
    </script>
@endsection
