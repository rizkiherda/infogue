@extends('private')

@section('title', '- Articles')

@section('content')

    <div id="content-wrapper">
        <header>
            <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
            <div class="title">
                <h1>Article</h1>
            </div>
            <div class="control hidden-xs">
                <div class="account clearfix">
                    <div class="avatar-wrapper">
                        <img src="images/contributors/cici.png" class="img-circle img-rounded">
                        <div class="notify"></div>
                    </div>
                    <p class="avatar-greeting pull-left hidden-sm">Hi, <strong>Imelda Agustine</strong></p>
                </div>
                <a href="admin_login.html" class="sign-out"><i class="fa fa-sign-out"></i> SIGN OUT</a>
            </div>
        </header>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="index.html">INFOGUE.ID</a></li>
                <li class="hidden-sm hidden-xs"><a href="admin_dashboard.html">Dashboard</a></li>
                <li class="active">Article</li>
            </ol>
            <div class="control">
                <a href="#search" data-toggle="modal" class="link"><i class="fa fa-search"></i> SEARCH</a>
                <a href="admin_article_create.html" class="link visible-xs"><i class="fa fa-plus"></i> CREATE ARTICLE</a>
                <a href="#" class="link print"><i class="fa fa-print"></i> PRINT</a>
            </div>
        </div>
        <div class="content" id="content">
            <div class="title-section">
                <div class="title-wrapper">
                    <h1 class="title">Article</h1>
                    <p class="subtitle">List of people post</p>
                </div>
                <div class="control">
                    <div class="filter">
                        <div class="dropdown select">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                TIMESTAMP
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">SORT BY</li>
                                <li><a href="#"><i class="fa fa-clock-o"></i> Timestamp</a></li>
                                <li><a href="#"><i class="fa fa-font"></i> Name</a></li>
                                <li><a href="#"><i class="fa fa-trophy"></i> Popularity</a></li>
                                <li><a href="#"><i class="fa fa-file-text"></i> Article</a></li>
                            </ul>
                        </div>
                        <div class="dropdown select">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                DESCENDING
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">METHOD</li>
                                <li><a href="#"><i class="fa fa-arrow-up"></i> Ascending</a></li>
                                <li><a href="#"><i class="fa fa-arrow-down"></i> Descending</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="group-control">
                        <a href="#delete" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> DELETE</a>
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> APPROVE</a>
                    </div>
                </div>
            </div>
            <div class="content-section">
                <table class="table table-responsive table-striped table-hover table-condensed mbs">
                    <thead>
                    <tr>
                        <th width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-all" class="css-checkbox">
                                <label for="check-all" class="css-label"></label>
                            </div>
                        </th>
                        <th>Title</th>
                        <th>Author</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-1" class="css-checkbox">
                                <label for="check-1" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">Reika make a dark theme on his new video clip</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/angga.jpg"/>
                                <a href="profile.html">Angga Ari</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-warning">PENDING</span></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-2" class="css-checkbox">
                                <label for="check-2" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">Surgery team X disease success healing...</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/pras.jpg"/>
                                <a href="profile.html">Wendi Putra</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-warning">PENDING</span></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="warning">
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-3" class="css-checkbox">
                                <label for="check-3" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">Doctor is the one of excellent job can...</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/eta.jpg"/>
                                <a href="profile.html">Rika Minami</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-success">PUBLISHED</span></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-4" class="css-checkbox">
                                <label for="check-4" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">Extreme sport now more popular lately</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/hadi.jpg"/>
                                <a href="profile.html">Yoga Prima</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-danger">SUSPEND</span></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="danger">
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-5" class="css-checkbox">
                                <label for="check-5" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">Young businessman become popular...</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/lukman.jpg"/>
                                <a href="profile.html">Deni Iswanto</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-success">PUBLISHED</span></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="danger">
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-6" class="css-checkbox">
                                <label for="check-6" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">Football Supporter are going to watch...</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/angga.jpg"/>
                                <a href="profile.html">Angga Ari</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-success">PUBLISHED</span></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-7" class="css-checkbox">
                                <label for="check-7" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">People grow old and dying like always</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/cindy.jpg"/>
                                <a href="profile.html">Mita Anggraeny</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-success">PUBLISHED</span></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-8" class="css-checkbox">
                                <label for="check-8" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">Blend various healthy vegetable on bre...</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/ratna.jpg"/>
                                <a href="profile.html">Rinda Ayaka</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-success">PUBLISHED</span></td>
                        <td class="text-center">
                            <div class="dropdown dropup">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-9" class="css-checkbox">
                                <label for="check-9" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">John Burn starting his career from a mod...</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/iyan.jpg"/>
                                <a href="profile.html">Bima Shakti</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-warning">PENDING</span></td>
                        <td class="text-center">
                            <div class="dropdown dropup">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-10" class="css-checkbox">
                                <label for="check-10" class="css-label"></label>
                            </div>
                        </td>
                        <td><a href="article.html" target="_blank">Google has release new concept od User...</a></td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/vivi.jpg"/>
                                <a href="profile.html">Dewi Ariyani</a>
                            </div>
                        </td>
                        <td class="text-center"><span class="label label-success">PUBLISHED</span></td>
                        <td class="text-center">
                            <div class="dropdown dropup">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#" class="approve"><i class="fa fa-check"></i> Approve</a></li>
                                    <li><a href="#" class="suspend"><i class="fa fa-remove"></i> Suspend</a></li>
                                    <li><a href="#" class="trending"><i class="fa fa-trophy"></i> Set Trending</a></li>
                                    <li><a href="#" class="headline"><i class="fa fa-star"></i> Set Headline</a></li>
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-info-circle"></i> Detail</a></li>
                                    <li><a href="admin_article_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="table-footer">
                    <div class="status">
                        <p class="text-muted">3/120 Rows selected</p>
                        <p>Showing 1 to 10 of 40 entries</p>
                    </div>
                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="First">FIRST</a>
                            </li>
                            <li>
                                <a href="#" aria-label="Previous">PREV</a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">NEXT</a>
                            </li>
                            <li>
                                <a href="#" aria-label="Last">LAST</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<div class="modal fade color" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" class="form-strip form-horizontal">
                <input type="hidden" class="form-control" value="0"/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-file-text-o"></i> ARTICLE INFO</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>TITLE</label>
                            </div>
                            <div class="col-sm-9">
                                <p><a href="article.html" target="_blank">Reika make a dark theme on his new video clip</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>TIMESTAMP</label>
                            </div>
                            <div class="col-sm-9">
                                <p>25 January at 08:30 AM</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>CATEGORY</label>
                            </div>
                            <div class="col-sm-9">
                                <p><a href="category.html">Entertainment</a> | <a href="category.html">Music</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>KEYWORDS</label>
                            </div>
                            <div class="col-sm-9">
                                <ul class="list-inline">
                                    <li><a class="tag" href="article.html" target="_blank">international</a></li>
                                    <li><a class="tag" href="article.html" target="_blank">usa</a></li>
                                    <li><a class="tag" href="article.html" target="_blank">video</a></li>
                                    <li><a class="tag" href="article.html" target="_blank">music</a></li>
                                    <li><a class="tag" href="article.html" target="_blank">clip</a></li>
                                    <li><a class="tag" href="article.html" target="_blank">release</a></li>
                                    <li><a class="tag" href="article.html" target="_blank">singer</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>AUTHOR</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="people">
                                    <img src="images/contributors/iyan.jpg"/>
                                    <a href="profile.html">Bima Shakti</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>RATING</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="rating-wrapper pn" data-rating="3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>VIEWS</label>
                            </div>
                            <div class="col-sm-9">
                                <p>3543 X</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-primary">CLOSE</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade no-line" id="delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE ARTICLE</h4>
                </div>
                <div class="modal-body">
                    <label class="mbn">Are you sure delete this article?</label>
                    <p class="mbn"><small class="text-muted">All related data will be deleted.</small></p>
                    <input type="hidden" class="form-control" value="0"/>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-primary">CANCEL</a>
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade no-line" id="search" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-search"></i> SEARCH QUERY</h4>
                </div>
                <div class="modal-body">
                    <label class="mbs">Search in Contributor Data</label>
                    <div class="search">
                        <input type="search" class="form-control pull-left" placeholder="Type keywords here"/>
                        <button type="submit" class="btn btn-primary pull-right">SEARCH</button>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>