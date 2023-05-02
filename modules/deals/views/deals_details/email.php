<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php
$edited = can_action('56', 'edited');
$sub_active = 1;
$task_timer_id = $this->uri->segment(6);
if ($task_timer_id) {
    $sub_active = 2;
    $deals_email_details = get_row('tbl_deals_email', array('id' => $task_timer_id));
    $username_email_details = get_row('tbl_account_details', array('user_id' => $deals_email_details->user_id));
}

?>
<div class="nav-tabs-custom ">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $sub_active == 1 ? 'active' : ''; ?>"><a href="#all_email" data-toggle="tab"><?= lang('all_email') ?></a>
        </li>
        <?php if (!empty($edited)) { ?>
            <li class="<?= $sub_active == 2 ? 'active' : ''; ?>"><a href="#new_email" data-toggle="tab"><?= lang('new_email') ?></a>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $sub_active == 1 ? 'active' : ''; ?>" id="all_email">
            <div class="table-responsive">
                <table class="table table-striped " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?= lang('mail_to') ?></th>
                            <th><?= lang('subject') ?></th>
                            <th><?= lang('mail_from') ?></th>
                            <th><?= lang('message_time') ?></th>
                            <th class="col-options no-sort"><?= lang('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $all_deals_email = get_result('tbl_deals_email', array('deals_id' => $deals_details->id));

                        if (!empty($all_deals_email)) :
                            foreach ($all_deals_email as $v_emails) :
                        ?>
                                <tr id="table-meeting-<?= $v_emails->id ?>">
                                    <td>
                                        <?php
                                        $file_ext = explode(";", $v_emails->email_to);
                                        foreach ($file_ext as $key => $item) {
                                            echo $item . "<br>";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $v_emails->subject ?></td>
                                    <td><?= $v_emails->email_from ?></td>
                                    <td><?= strftime(config_item('date_format'), strtotime($v_emails->message_time)) ?>

                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/deals/email_details/' . $v_emails->id) ?>" class="btn btn-xs btn-info" data-placement="top" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-list "></i></a>
                                        <?= btn_edit('admin/deals/details/' . $deals_details->id . '/email/' . $v_emails->id) ?>
                                        <?php echo ajax_anchor(base_url("admin/deals/delete_deals_email/" . $deals_details->id . '/' . $v_emails->id), "<i class='btn btn-danger btn-xs fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table-meeting-" . $v_emails->id)); ?>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane <?= $sub_active == 2 ? 'active' : ''; ?>" id="new_email">
            <form role="form" id="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/deals/send_mail/<?php
                                                                                                                            if (!empty($deals_email_details->id)) {
                                                                                                                                echo $deals_email_details->id;
                                                                                                                            }
                                                                                                                            ?>" method="post" class="form-horizontal form-groups-bordered">
                <input type="hidden" name="deals_id" class="form-control" value="<?= $deals_details->id ?>">
                <div class="box box-primary">
                    <div class="box-body row">
                        <div class="form-group col-md-12">
                            <input class="form-control" value="<?php
                                                                if (!empty($deals_email_details->email_to)) {
                                                                    echo $deals_email_details->email_to;
                                                                }
                                                                ?>" type="text" required="" name="email_to" placeholder="<?= lang('you_can_sent_multiple_mail_semicolon_separated') ?>" />
                        </div>
                        <div class="form-group col-md-12">
                            <input class="form-control" value="<?php
                                                                if (!empty($deals_email_details->subject)) {
                                                                    echo $deals_email_details->subject;
                                                                }
                                                                ?>" type="text" required="" name="subject" placeholder="Subject:" />
                        </div>
                        <div class="form-group col-md-12">
                            <textarea class="form-control text-justify textarea_" name="message_body"><?php
                                                                                                        if (!empty($deals_email_details->message_body)) {
                                                                                                            echo $deals_email_details->message_body;
                                                                                                        }
                                                                                                        ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <div id="comments_file-dropzone" class="dropzone mb15">

                            </div>
                            <div id="comments_file-dropzone-scrollbar">
                                <div id="comments_file-previews">
                                    <div id="file-upload-row" class="mt pull-left">

                                        <div class="preview box-content pr-lg" style="width:100px;">
                                            <span data-dz-remove class="pull-right" style="cursor: pointer">
                                                <i class="fa fa-times"></i>
                                            </span>
                                            <img data-dz-thumbnail class="upload-thumbnail-sm" />
                                            <input class="file-count-field" type="hidden" name="files[]" value="" />
                                            <div class="mb progress progress-striped upload-progress-sm active mt-sm" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!empty($deals_email_details->attach_file)) {
                                $uploaded_file = json_decode($deals_email_details->attach_file);
                            }
                            if (!empty($uploaded_file)) {
                                foreach ($uploaded_file as $v_files_image) {
                            ?>
                                    <div class="pull-left mt pr-lg mb" style="width:100px;">
                                        <span data-dz-remove class="pull-right existing_image" style="cursor: pointer"><i class="fa fa-times"></i></span>
                                        <?php if ($v_files_image->is_image == 1) { ?>
                                            <img data-dz-thumbnail src="<?php echo base_url() . $v_files_image->path ?>" class="upload-thumbnail-sm" />
                                        <?php } else { ?>
                                            <span data-toggle="tooltip" data-placement="top" title="<?= $v_files_image->fileName ?>" class="mailbox-attachment-icon"><i class="fa fa-file-text-o"></i></span>
                                        <?php } ?>

                                        <input type="hidden" name="path[]" value="<?php echo $v_files_image->path ?>">
                                        <input type="hidden" name="fileName[]" value="<?php echo $v_files_image->fileName ?>">
                                        <input type="hidden" name="fullPath[]" value="<?php echo $v_files_image->fullPath ?>">
                                        <input type="hidden" name="size[]" value="<?php echo $v_files_image->size ?>">
                                        <input type="hidden" name="is_image[]" value="<?php echo $v_files_image->is_image ?>">
                                    </div>
                                <?php }; ?>
                            <?php }; ?>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $(".existing_image").on("click", function() {
                                        $(this).parent().remove();
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
                                        accept: function(file, done) {
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
                                                success: function(response) {
                                                    if (response.success) {
                                                        fileSerial++;
                                                        $(file.previewTemplate).find(".description-field").attr("name", "comment_" + fileSerial);
                                                        $(file.previewTemplate).append("<input type='hidden' name='file_name_" + fileSerial + "' value='" + file.name + "' />\n\
                                                                        <input type='hidden' name='file_size_" + fileSerial + "' value='" + file.size + "' />");
                                                        $(file.previewTemplate).find(".file-count-field").val(fileSerial);
                                                        done();
                                                    } else {
                                                        $(file.previewTemplate).find("input").remove();
                                                        done(response.message);
                                                    }
                                                }
                                            });
                                        },
                                        processing: function() {
                                            $("#file-save-button").prop("disabled", true);
                                        },
                                        queuecomplete: function() {
                                            $("#file-save-button").prop("disabled", false);
                                        },
                                        fallback: function() {
                                            //add custom fallback;
                                            $("body").addClass("dropzone-disabled");
                                            $('.modal-dialog').find('[type="submit"]').removeAttr('disabled');

                                            $("#comments_file-dropzone").hide();

                                            $("#file-modal-footer").prepend("<button id='add-more-file-button' type='button' class='btn  btn-default pull-left'><i class='fa fa-plus-circle'></i> " + "<?php echo lang("add_more"); ?>" + "</button>");

                                            $("#file-modal-footer").on("click", "#add-more-file-button", function() {
                                                var newFileRow = "<div class='file-row pb pt10 b-b mb10'>" +
                                                    "<div class='pb clearfix '><button type='button' class='btn btn-xs btn-danger pull-left mr remove-file'><i class='fa fa-times'></i></button> <input class='pull-left' type='file' name='manualFiles[]' /></div>" +
                                                    "<div class='mb5 pb5'><input class='form-control description-field'  name='comment[]'  type='text' style='cursor: auto;' placeholder='<?php echo lang("comment") ?>' /></div>" +
                                                    "</div>";
                                                $("#comments_file-previews").prepend(newFileRow);
                                            });
                                            $("#add-more-file-button").trigger("click");
                                            $("#comments_file-previews").on("click", ".remove-file", function() {
                                                $(this).closest(".file-row").remove();
                                            });
                                        },
                                        success: function(file) {
                                            setTimeout(function() {
                                                $(file.previewElement).find(".progress-striped").removeClass("progress-striped").addClass("progress-bar-success");
                                            }, 1000);
                                        }
                                    });

                                })
                            </script>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> <?= lang('send') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- /. box -->

            </form>

        </div>
        <link href="<?php echo base_url() ?>asset/css/select2.css" rel="stylesheet" />
        <script src="<?php echo base_url() ?>asset/js/select2.js"></script>
    </div>
</div>
