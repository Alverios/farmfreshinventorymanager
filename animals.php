<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>
            <li class="active">Animal</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Animal</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addAnimalModalBtn" data-target="#addAnimalModal"><i class="glyphicon glyphicon-plus-sign"></i> Add Animal </button>
                </div> <!-- /div-action -->

                <table class="table" id="manageAnimalTable">
                    <thead>
                        <tr>
                            <th>Animal Tag</th>
                            <th>Category</th>
                            <th>Availability</th>
                            <th style="width:15%;">Options</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add animal -->
<div class="modal fade" id="addAnimalModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitAnimalForm" action="php_action/createAnimals.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Animal</h4>
                </div>

                <div class="modal-body" style="max-height:450px; overflow:auto;">

                    <div id="add-animal-messages"></div>

                    <div class="form-group">
                        <label for="animalTag" class="col-sm-3 control-label">Animal Tag No: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="animalTag" placeholder="Animal Tag No" name="animalTag" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="categoryName" class="col-sm-3 control-label">Category: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select type="text" class="form-control" id="categoryName" placeholder="Category" name="categoryName">
                                <option value="">~~SELECT~~</option>
                                <?php
                                $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                $result = $connect->query($sql);

                                while ($row = $result->fetch_array()) {
                                    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                                } // while

                                ?>
                            </select>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="animalStatus" class="col-sm-3 control-label">Availability: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="animalStatus" name="animalStatus">
                                <option value="">~~SELECT~~</option>
                                <option value="1">Available</option>
                                <option value="2">Not Available</option>
                            </select>
                        </div>
                    </div> <!-- /form-group-->
                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                    <button type="submit" class="btn btn-primary" id="createAnimalBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                </div> <!-- /modal-footer -->
            </form> <!-- /.form -->
        </div> <!-- /modal-content -->
    </div> <!-- /modal-dailog -->
</div>
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editAnimalModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Animal</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">

                <div class="div-loading">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="div-result">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <!-- <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li> -->
                        <li role="presentation"><a href="#animalInfo" aria-controls="profile" role="tab" data-toggle="tab">Animal Info</a></li>
                    </ul>

                    -->
                    <div role="tabpanel" class="tab-pane" id="animalInfo">
                        <form class="form-horizontal" id="editAnimalForm" action="php_action/editAnimals.php" method="POST">
                            <br />

                            <div id="edit-animal-messages"></div>
                            <div class="form-group">
                                <label for="editAnimalTag" class="col-sm-3 control-label">Animal Tag No: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editAnimalTag" placeholder=" Edit Animal Tag No" name="editAnimalTag" autocomplete="off">
                                </div>
                            </div> <!-- /form-group-->

                            <div class="form-group">
                                <label for="editCategoryName" class="col-sm-3 control-label"> Category: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <select type="text" class="form-control" id="editCategoryName" name="editCategoryName">
                                        <option value="">~~SELECT~~</option>
                                        <?php
                                        $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                        $result = $connect->query($sql);

                                        while ($row = $result->fetch_array()) {
                                            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                                        } // while

                                        ?>
                                    </select>
                                </div>
                            </div> <!-- /form-group-->

                            <div class="form-group">
                                <label for="editAnimalStatus" class="col-sm-3 control-label">Availability: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="editAnimalStatus" name="editAnimalStatus">
                                        <option value="">~~SELECT~~</option>
                                        <option value="1">Available</option>
                                        <option value="2">Not Available</option>
                                    </select>
                                </div>
                            </div> <!-- /form-group-->

                            <div class="modal-footer editAnimalFooter">
                                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                                <button type="submit" class="btn btn-success" id="editAnimalBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                            </div> <!-- /modal-footer -->
                        </form> <!-- /.form -->
                    </div>
                    <!-- /animal info -->
                </div>

            </div>

        </div> <!-- /modal-body -->


    </div>
    <!-- /modal-content -->
</div>
<!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeAnimalModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Animal</h4>
            </div>
            <div class="modal-body">

                <div class="removeAnimalMessages"></div>

                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeAnimalFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="removeAnimalBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/animals.js"></script>

<?php require_once 'includes/footer.php'; ?>