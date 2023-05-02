<?php defined('BASEPATH') or exit('No direct script access allowed');

function deals_details_tabs($id)
{
    // make details tab array and assign order,name,url,count
    $url = 'admin/deals/details/';
    $tabs = array(
        'details' => [
            'position' => 1,
            'name' => 'details',
            'url' => $url . $id,
            'count' => '',
            'view' => 'deals/deals_details/index'
        ],
        'call' => [
            'position' => 2,
            'name' => 'call',
            'url' => $url . $id . '/call',
            'count' => total_rows('tbl_calls', array('module' => "deals", 'module_field_id' => $id)),
            'view' => 'deals/deals_details/call'
        ],
        'comments' => [
            'position' => 3,
            'name' => 'comments',
            'url' => $url . $id . '/comments',
            'count' => total_rows('tbl_task_comment', array('module' => 'deals', 'module_field_id' => $id)),
            'view' => 'admin/common/comments'
        ],
        'attachments' => [
            'position' => 4,
            'name' => 'attachments',
            'url' => $url . $id . '/attachments',
            'count' => total_rows('tbl_attachments', array('module' => 'deals', 'module_field_id' => $id)),
            'view' => 'admin/common/attachments'
        ],
        'notes' => [
            'position' => 5,
            'name' => 'notes',
            'url' => $url . $id . '/notes',
            'count' => '',
            'view' => 'deals/deals_details/notes'
        ],
        
        'tasks' => [
            'position' => 6,
            'name' => 'tasks',
            'url' => $url . $id . '/tasks',
            'count' => total_rows('tbl_task', array('module' => "deals", 'module_field_id' => $id)),
            'view' => 'deals/deals_details/tasks'
        ],
        'mettings' => array(
            'position' => 7,
            'name' => 'mettings',
            'url' => $url . $id . '/mettings',
            'count' => total_rows('tbl_mettings', array('module' => "deals", 'module_field_id' => $id)),
            'view' => 'deals/deals_details/mettings',
        ),
        'email' => array(
            'position' => 8,
            'name' => 'email',
            'url' => $url . $id . '/email',
            'count' => total_rows('tbl_deals_email', array('deals_id' => $id)),
            'view' => 'deals/deals_details/email',
        ),
        'products' => array(
            'position' => 9,
            'name' => 'products',
            'url' => $url . $id . '/products',
            'count' => total_rows('tbl_deals_items', array('deals_id' => $id)),
            'view' => 'deals/deals_details/deals_items_details',
        ),
        'activites' => [
            'position' => 10,
            'name' => 'activites',
            'url' => $url . $id . '/activites',
            'count' => total_rows('tbl_activities', array('module' => 'deals', 'module_field_id' => $id)),
            'view' => 'admin/common/activites'
        ]
    );
    return apply_filters('deals_details_tabs', $tabs);
}
