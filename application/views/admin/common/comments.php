<style>
    .wd-100 {
        width: 100px !important;
    }

    .pointer {
        cursor: pointer !important;
    }

    .wd-0 {
        width: 0px !important;
    }
</style>
<?php

$comment_details = $this->common_model->get_comment_details($id, $module);
?><div class="panel panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title"><?= lang('comments') ?></h3>
    </div>
    <div class="panel-body chat" id="chat-box">
        <?php echo form_open(base_url("admin/common/save_comments"), array("id" => $module . "-comment-form", "class" => "form-horizontal general-form", "enctype" => "multipart/form-data", "role" => "form")); ?>
        
        <input type="hidden" name="module" value="<?php if (!empty($module)) {
            echo $module;
        } ?>">
        <input type="hidden" name="module_field_id" value="<?php if (!empty($id)) {
            echo $id;
        } ?>">
        
        
        <div class="form-group">
            <div class="col-sm-12">
                <?php
                echo form_textarea(array(
                    "id" => "comment_description",
                    "name" => "comment",
                    "class" => "form-control comment_description",
                    "placeholder" =>  $module.' '.lang('comments'),
                    "data-rule-required" => true,
                    "rows" => 4,
                    "data-msg-required" => lang("field_required"),
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div id="comments_file-dropzone" class="dropzone mb15">
                
                </div>
                <div id="comments_file-dropzone-scrollbar">
                    <div id="comments_file-previews">
                        <div id="file-upload-row" class="mt pull-left">
                            <div class="preview box-content pr-lg wd-100">
                                                <span data-dz-remove class="pull-right pointer">
                                                    <i class="fa fa-times"></i>
                                                </span>
                                <img data-dz-thumbnail class="upload-thumbnail-sm"/>
                                <input class="file-count-field" type="hidden" name="files[]" value=""/>
                                <div class="mb progress progress-striped upload-progress-sm active mt-sm"
                                     role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success wd-0"
                                         data-dz-uploadprogress></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        
        <div class="form-group">
            <div class="col-sm-12">
                <div class="pull-right">
                    <button type="submit" id="file-save-button"
                            class="btn btn-primary"><?= lang('post_comment') ?></button>
                </div>
            </div>
        </div>
        <hr/>
        <?php echo form_close(); ?>
        <?php $this->load->view('admin/common/comments_list', array('comment_type' => $module,
            'comment_details' => $comment_details)) ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#file-save-button').on('click', function (e) {
                    var ubtn = $(this);
                    ubtn.html('Please wait...');
                    ubtn.addClass('disabled');
                });
                $("#<?php echo $module; ?>-comment-form").appForm({
                    isModal: false,
                    onSuccess: function (result) {
                        $(".comment_description").val("");
                        $(".dz-complete").remove();
                        $('#file-save-button').removeClass("disabled").html(
                            '<?= lang('post_comment') ?>');
                        $(result.data).insertAfter(
                            "#<?php echo $module; ?>-comment-form");
                        toastr[result.status](result.message);
                    }
                });
                var fileSerial = 0;
                // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
                var previewNode = document.querySelector("#file-upload-row");
                previewNode.id = "";
                var previewTemplate = previewNode.parentNode.innerHTML;
                previewNode.parentNode.removeChild(previewNode);
                Dropzone.autoDiscover = false;
                var projectFilesDropzone = new Dropzone("#comments_file-dropzone", {
                    url: "<?= base_url() ?>admin/common/upload_file",
                    thumbnailWidth: 80,
                    thumbnailHeight: 80,
                    parallelUploads: 20,
                    previewTemplate: previewTemplate,
                    dictDefaultMessage: '<?php echo lang("file_upload_instruction"); ?>',
                    autoQueue: true,
                    previewsContainer: "#comments_file-previews",
                    clickable: true,
                    accept: function (file, done) {
                        if (file.name.length > 200) {
                            done("Filename is too long.");
                            $(file.previewTemplate).find(".description-field").remove();
                        }
                        //validate the file
                        $.ajax({
                            url: "<?= base_url() ?>admin/common/validate_project_file",
                            data: {
                                file_name: file.name,
                                file_size: file.size
                            },
                            cache: false,
                            type: 'POST',
                            dataType: "json",
                            success: function (response) {
                                if (response.success) {
                                    fileSerial++;
                                    $(file.previewTemplate).find(
                                        ".description-field").attr(
                                        "name", "comment_" + fileSerial);
                                    $(file.previewTemplate).append(
                                        "<input type='hidden' name='file_name_" +
                                        fileSerial + "' value='" + file
                                            .name + "' />\n\
                                     <input type='hidden' name='file_size_" + fileSerial + "' value='" + file.size +
                                        "' />");
                                    $(file.previewTemplate).find(
                                        ".file-count-field").val(
                                        fileSerial);
                                    done();
                                } else {
                                    $(file.previewTemplate).find("input")
                                        .remove();
                                    done(response.message);
                                }
                            }
                        });
                    },
                    processing: function () {
                        $("#file-save-button").prop("disabled", true);
                    },
                    queuecomplete: function () {
                        $("#file-save-button").prop("disabled", false);
                    },
                    fallback: function () {
                        //add custom fallback;
                        $("body").addClass("dropzone-disabled");
                        $('.modal-dialog').find('[type="submit"]').removeAttr(
                            'disabled');

                        $("#comments_file-dropzone").hide();

                        $("#file-modal-footer").prepend(
                            "<button id='add-more-file-button' type='button' class='btn  btn-default pull-left'><i class='fa fa-plus-circle'></i> " +
                            "<?php echo lang("add_more"); ?>" + "</button>");

                        $("#file-modal-footer").on("click", "#add-more-file-button",
                            function () {
                                var newFileRow =
                                    "<div class='file-row pb pt10 b-b mb10'>" +
                                    "<div class='pb clearfix '><button type='button' class='btn btn-xs btn-danger pull-left mr remove-file'><i class='fa fa-times'></i></button> <input class='pull-left' type='file' name='manualFiles[]' /></div>" +
                                    "<div class='mb5 pb5'><input class='form-control description-field'  name='comment[]'  type='text' style='cursor: auto;' placeholder='<?php echo lang("comment") ?>' /></div>" +
                                    "</div>";
                                $("#comments_file-previews").prepend(newFileRow);
                            });
                        $("#add-more-file-button").trigger("click");
                        $("#comments_file-previews").on("click", ".remove-file",
                            function () {
                                $(this).closest(".file-row").remove();
                            });
                    },
                    success: function (file) {
                        setTimeout(function () {
                            $(file.previewElement).find(".progress-striped")
                                .removeClass("progress-striped").addClass(
                                "progress-bar-success");
                        }, 1000);
                    }
                });

            })
        </script>
    </div>
</div>