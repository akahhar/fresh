<style type="text/css">


    .distribution {
        font-weight: 700;
    }

    .products {
        font-size: 14px;
        color: rgba(79, 70, 229, 1);
        font-weight: 400;
    }

    .mb-0 {
        margin: 0;
    }

    .rounded-full {
        border-radius: 50%;
    }

    .progress-custom {
        margin: 0;
        padding: 0;
        list-style: none;
        border: 1px solid;
        border-color: rgba(203, 213, 225, 1);
        border-radius: .375rem;
        margin-bottom: 10px;
    }

    .progress-custom li {
        padding-left: 1rem;
        padding-right: 1rem;
        padding-bottom: 0.5rem;
        padding-top: 0.5rem;
        position: relative;
    }

    .svg-stock {
        position: absolute;
        top: 0;
        right: -5px;
    }

    .rounded-svg {
        background-color: rgba(16, 185, 129, 1);
        color: #fff;
        display: inline-block;
        line-height: 1;
        height: 2rem;
        width: 2rem;
        border: 1px solid rgba(16, 185, 129, 1);
    }

    .bg-none-color {
        background-color: transparent;
        color: rgba(16, 185, 129, 1);
    }

    .bg-lost-color .rounded-svg {
        border-color: rgb(227, 14, 14);
        color: rgb(227, 14, 14);
        background-color: rgb(227, 14, 14);;
    }

    .bg-lost-color {
        background-color: transparent;

    }

    .process-svg {
        display: flex;
        gap: 10px;
        line-height: 1.3;
        font-weight: 500;
        list-style: none;
        color: #001737;

    }

    .process-svg:hover {
        text-decoration: none;
    }

    .rounded {
        border-radius: .25rem;
    }

    .px-5 {
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }

    .mr-2 {
        margin-right: .5rem;
    }

    .ww-6 {
        width: 1.5rem;
    }

    .hh-6 {
        height: 1.5rem;
    }

    .inside-con {
        display: flex;
        align-items: center;
        gap: 30px;
        flex-direction: row-reverse;

    }

    .progress-custom li {
        display: inline-block;
    }

    .text-neutral-300 {
        color: rgba(203, 213, 225, 1);
    }

    .border-none {
        border: none;
        background-color: transparent;
    }

    .distribution-content a {
        color: inherit;
        text-decoration: none;
    }

    .process-svg.bg-none-color .rounded-svg {
        background-color: transparent;
        color: rgba(16, 185, 129, 1);
    }

    .process-svg.bg-none-color.color-other .rounded-svg {
        border-color: rgba(100, 116, 139, 1);
        color: rgba(100, 116, 139, 1);
    }

    .process-svg.bg-none-color.color-other .svg-title {
        color: rgba(100, 116, 139, 1);
    }
</style>
<?php


$propability = 0;


$all_stages = get_order_by('tbl_customer_group', array('type' => 'stages', 'description' => $deals_details->pipeline), 'order', true);
// total stages
if (!empty($all_stages)) {
    $total_stages = count($all_stages);
    foreach ($all_stages as $stage) {
        $res = round(100 / $total_stages);
        $propability += $res;
        if ($stage->customer_group_id == $deals_details->stage_id) {
            break;
        }
    }
}
if ($deals_details->status === 'won') {
    $propability = 100;
}
if ($deals_details->status === 'lost') {
    $propability = 0;
}

?>
<div class="p bg-white">
    <div class="row">
        <div class="col-xs-6">
            <div class="left-side">
                <div class="distribution-content">
                    <h3 class="distribution mb-0"><?= $deals_details->title ?>
                        <span class="products"><?=
                            total_rows('tbl_deals_items', array('deals_id' => $id)) . ' ' . lang('products') ?></span>
                    </h3>
                    <a href="#"
                       id="openPipeline"><span><?= (!empty($deals_details->pipeline_name) ? $deals_details->pipeline_name :
                                '-') ?></span> <i class="fa fa-angle-right"></i>
                        <span><?= (!empty($deals_details->customer_group) ? $deals_details->customer_group : '') ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <p><?= lang('created') . ' ' . lang('at') . ':' . date('F j, Y', strtotime($deals_details->created_at)) . ' ' . display_time($deals_details->created_at); ?>
                    
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right-side">
                <div class="inside-con">
                    
                    <div class="inline ">
                        <div class="easypiechart text-success"
                             data-percent="<?= $propability ?>"
                             data-line-width="5" data-track-Color="#f0f0f0"
                             data-bar-color="#<?php
                             if ($propability == 100) {
                                 echo '8ec165';
                             } elseif ($propability >= 40 && $propability <= 50) {
                                 echo '5d9cec';
                             } elseif ($propability >= 51 && $propability <= 99) {
                                 echo '7266ba';
                             } else {
                                 echo 'fb6b5b';
                             }
                             ?>" data-rotate="270" data-scale-Color="false"
                             data-size="50"
                             data-animate="2000">
                                                        <span class="small "><?= $propability ?>
                                                            %</span>
                        </div>
                    </div>
                    
                    <div>
                        <?php
                        if ($deals_details->status == 'won' || $deals_details->status == 'lost') {
                            ?>
                            <a href="<?= base_url('admin/deals/changeStatus/' . $id . '/open') ?>"
                               class="btn btn-warning btn-xs rounded px-5 mr-2 ">
                                <i class="fa fa-repeat"></i>
                                <?= lang('reopen') ?></a>
                            
                            <?php
                        }
                        if ($deals_details->status == 'open' || $deals_details->status == 'lost') {
                            ?>
                            <a data-toggle="modal" data-target="#myModal"
                               href="<?= base_url('admin/deals/changeStatus/' . $id . '/won') ?>"
                               class="btn btn-success btn-xs rounded px-5 mr-2 ">
                                <i class="fa fa-check"></i>
                                <?= lang('won') ?></a>
                            <?php
                        }
                        if ($deals_details->status == 'open' || $deals_details->status == 'won') {
                            ?>
                            <a data-toggle="modal" data-target="#myModal"
                               href="<?= base_url('admin/deals/changeStatus/' . $id . '/lost') ?>"
                               class="btn btn-danger btn-xs rounded px-5 mr-2">
                                <i class="fa fa-times"></i>
                                <?= lang('lost') ?></a>
                        <?php } ?>
                    </div>
                
                </div>
            
            
            </div>
        </div>
    
    </div>
    <div class="row">
        <div class="col-xs-12">
            <ul class="progress-custom">
                <?php
                // bg-none-color color-other
                $active_stage = 0;
                $class = '';
                $active_stage_key = array_search($deals_details->stage_id, array_column($all_stages, 'customer_group_id'));
                
                for ($skey = 0; $skey <= $active_stage_key; $skey++) {
                    $all_stages[$skey]->active = true;
                }
                $nextStage = $active_stage_key + 1;
                if (!empty($all_stages[$nextStage])) {
                    $all_stages[$nextStage]->next = true;
                }
                // if status == 'won'
                
                if ($deals_details->status == 'won') {
                    $dstatus = 'active';
                } elseif ($deals_details->status == 'lost') {
                    $dstatus = 'lost';
                }
                if (!empty($dstatus)) {
                    foreach ($all_stages as $stage) {
                        $stage->$dstatus = true;
                    }
                }
                $icon = '<svg xmlns="http://www.w3.org/2000/svg"
                                                                           fill="none"
                                                                           viewBox="0 0 24 24" width="1.75rem"
                                                                           height="1.75rem" stroke-width="1.5"
                                                                           stroke="currentColor" aria-hidden="true"
                                                                           class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M4.5 12.75l6 6 9-13.5"></path>
                                    
                                </svg>';
                if (!empty($all_stages)) {
                    foreach ($all_stages as $key => $stage) {
                        if (!empty($stage->lost)) {
                            $class = 'bg-lost-color';
                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-6 w-6 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>';
                        } else if (!empty($stage->active)) {
                            $class = '';
                        } elseif (!empty($stage->next)) {
                            $class = 'bg-none-color';
                        } else {
                            $class = 'bg-none-color color-other';
                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-neutral-500 dark:text-neutral-100"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>';
                        }
                        ?>
                        <li>
                            <a href="<?= base_url('admin/deals/changeStage/' . $id . '/' . $stage->customer_group_id) ?>"
                               class="process-svg <?= $class ?>">

                        <span><span class="rounded-svg rounded-full ">
                            <?= $icon ?>
                            </span></span>
                                <span class="svg-title"><?= $stage->customer_group ?></span>
                            </a>
                            <div class="svg-stock" aria-hidden="true">
                                <svg class="h-full w-full text-neutral-300 dark:text-neutral-600" width="1.75rem"
                                     height="3.3rem" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                                          stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            
            </ul>
        </div>
    </div>
</div>

