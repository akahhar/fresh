<?php

/**
 * Description of Project_Model
 *
 * @author NaYeM
 */
class Shift_Model extends MY_Model
{
    
    public $_table_name;
    public $_order_by;
    public $_primary_key;
    
    
    public function weekly_date($date)
    {
        $week = date('w', strtotime($date));
        $sdate = new DateTime($date);
        $firstDay = $sdate->modify("-" . $week . " day")->format("Y-m-d");
        $weekDays[] = $firstDay;
        for ($i = 1; $i <= 6; $i++) {
            $weekDays[$i] = date('Y-m-d', strtotime('+' . $i . ' days', strtotime($firstDay)));
        }
        return $weekDays;
    }
    
    public function get_data_by_week($date = null)
    {
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $default = array(get_row('tbl_shift', array('is_default' => 'Yes')));
        
        $all_date = $this->weekly_date($date);
        
        $all_user = get_staff_details();
        $public_holiday = $this->get_holiday(reset($all_date), end($all_date)); //tbl working Days Holidwhyay    
        $weekly_holidays = $this->get_weekly_holiday($all_date); //tbl working Days Holiday        
        foreach ($all_user as $value) {
            $on_leave = $this->get_on_leave($value->user_id, reset($all_date), end($all_date));
            $shift_mapping_regular = $this->get_shiftData($value->user_id, reset($all_date), end($all_date));
            $shift_mapping_recurring = $this->get_shiftRecData(end($all_date));
            foreach ($all_date as $date) {
                if (!empty($weekly_holidays[$date])) {
                    $data[$value->user_id][$date] = $weekly_holidays[$date];
                } else if (!empty($public_holiday[$date])) {
                    $data[$value->user_id][$date] = $public_holiday[$date];
                } else if (!empty($on_leave[$value->user_id][$date])) {
                    $data[$value->user_id][$date] = $on_leave[$value->user_id][$date];
                } else if (!empty($shift_mapping_regular[$value->user_id][$date])) {
                    $data[$value->user_id][$date] = $shift_mapping_regular[$value->user_id][$date];
                } else if (!empty($shift_mapping_recurring[$value->user_id][$date])) {
                    $data[$value->user_id][$date] = $shift_mapping_recurring[$value->user_id][$date];
                } else {
                    $data[$value->user_id][$date] = $default;
                }
            }
        }
        return $data;
    }
    
    public
    function get_shiftRecData($end_date, $user_id = null, $full = null)
    {
        
        $where = '';
        if (!empty($user_id)) {
            $where = "tbl_shift_mapping.s_user_id = $user_id AND ";
        }
        $where .= "tbl_shift.status = 'published' AND  tbl_shift.recurring = 'Yes'";
        $recurringData = $this->db->query("SELECT * FROM `tbl_shift_mapping`
LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
WHERE $where")->result();
        
        $data = array();
        if (!empty($recurringData)) {
            foreach ($recurringData as $v_rshift) {
                if (!empty($v_rshift)) {
                    $event_date = $v_rshift->start_date;
                    $event_end_date = $end_date;
                    $type = $v_rshift->recurring_type;
                    $repeat_every = $v_rshift->repeat_every; // 1 week
                    $day = strtotime($event_date);
                    $to = strtotime($event_end_date);
                    while ($day <= $to) {
                        $start = date("Y-m-d", $day);
                        $day = strtotime(date("Y-m-d", $day) . " +" . $repeat_every . ' ' . $type);
                        $dateArray = date("Y-m-d", $day);
                        $all_date = $this->GetDays($start, $dateArray);
                    }
                    if (!empty($all_date)) {
                        foreach ($all_date as $date) {
                            if ($v_rshift->m_status != NULL) {
                                $data[$v_rshift->user_id][$v_rshift->end_date][] = $v_rshift;
                            } else {
                                $data[$v_rshift->user_id][$date][] = $v_rshift;
                            }
                        }
                    }
                }
            }
        }
        if (!empty($user_id)) {
            return $data[$user_id][$end_date];
        } else {
            return $data;
        }
    }
    
    function get_shiftData($user_id, $start_date, $end_date, $clock = null)
    {
        $shiftData = $this->db->query("SELECT *
        FROM `tbl_shift_mapping`
        LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
        WHERE   (
        `s_user_id` <= '$user_id'
        AND `start_date` <= '$start_date'
        AND `end_date` >= '$end_date'
         )
        OR   (
        `start_date` >= '$start_date'
        AND `end_date` <= '$end_date'
         ) ORDER BY `tbl_shift_mapping`.`shift_mapping_id` DESC")->result();
        if (!empty($clock)) {
            return (!empty($shiftData) ? $shiftData[0] : false);
        }
        $app = array();
        if (!empty($shiftData)) {
            foreach ($shiftData as $v_shift) {
                if (!empty($v_shift)) {
                    $p_hday = $this->GetDays($v_shift->start_date, $v_shift->end_date);
                    foreach ($p_hday as $date) {
                        $app[$v_shift->s_user_id][$date] = array($v_shift);
                    }
                }
            }
        }
        return $app;
    }
    
    public function shiftMappingInfo($id)
    {
        return $this->db->query("SELECT * FROM `tbl_shift_mapping`
LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
WHERE tbl_shift_mapping.shift_mapping_id = $id")->row();
    }
    
    public
    function get_dashboard_shiftRecData($end_date)
    {
        $recurringData = $this->db->query("SELECT * FROM `tbl_shift_mapping`
LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
WHERE tbl_shift.status = 'published' AND tbl_shift_mapping.end_date IS NULL AND tbl_shift.recurring = 'Yes'")->result();
        if (!empty($recurringData)) {
            foreach ($recurringData as $v_rshift) {
                if (!empty($v_rshift)) {
                    $event_date = $v_rshift->start_date;
                    $event_end_date = $end_date;
                    $type = $v_rshift->recurring_type;
                    $repeat_every = $v_rshift->repeat_every; // 1 week
                    $day = strtotime($event_date);
                    $to = strtotime($event_end_date);
                    while ($day <= $to) {
                        $start = date("Y-m-d", $day);
                        $day = strtotime(date("Y-m-d", $day) . " +" . $repeat_every . ' ' . $type);
                        $dateArray = date("Y-m-d", $day);
                        $all_date = $this->GetDays($start, $dateArray);
                    }
                    if (!empty($all_date)) {
                        foreach ($all_date as $date) {
                            if ($v_rshift->m_status != NULL) {
                                $data[$v_rshift->end_date][] = $v_rshift;
                            } else {
                                $data[$date][] = $v_rshift;
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }
    
    function get_dashboard_shiftData($start_date, $end_date)
    {
        $shiftData = $this->db->query("SELECT * FROM `tbl_shift_mapping`
LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
WHERE tbl_shift.status = 'published' AND tbl_shift_mapping.end_date IS NOT NULL  AND (start_date BETWEEN '$start_date' AND '$end_date' || end_date BETWEEN '$start_date' AND '$end_date')")->result();
        $app = array();
        if (!empty($shiftData)) {
            foreach ($shiftData as $v_shift) {
                $p_hday = $this->GetDays($v_shift->start_date, $v_shift->end_date);
                foreach ($p_hday as $date) {
                    $app[$date][] = $v_shift;
                }
            }
        }
        return $app;
    }
    
    function get_conflic_shiftData($user_id, $start_date, $end_date)
    {
        
        $shiftData = $this->db->query("SELECT *
        FROM `tbl_shift_mapping`
        LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
        WHERE   (
        `s_user_id` <= '$user_id'
        AND `start_date` <= '$start_date'
        AND `end_date` >= '$end_date'
         )
        OR   (
        `start_date` >= '$start_date'
        AND `end_date` <= '$end_date'
         ) ORDER BY `tbl_shift_mapping`.`shift_mapping_id` DESC")->result();
        $app = array();
        if (!empty($shiftData)) {
            foreach ($shiftData as $v_shift) {
                $p_hday = $this->GetDays($v_shift->start_date, $v_shift->end_date);
                foreach ($p_hday as $date) {
                    $app[$date][] = $v_shift;
                }
            }
        }
        return $app;
    }
    
    public
    function get_conflic_shiftRecData($end_date, $user_id)
    {
        
        $recurringData = $this->db->query("SELECT * FROM `tbl_shift_mapping`
LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
WHERE tbl_shift.status = 'published' AND tbl_shift_mapping.s_user_id = '$user_id' AND tbl_shift_mapping.end_date IS NULL AND tbl_shift.recurring = 'Yes'")->result();
        if (!empty($recurringData)) {
            foreach ($recurringData as $v_rshift) {
                if (!empty($v_rshift)) {
                    $event_date = $v_rshift->start_date;
                    $event_end_date = $end_date;
                    $type = $v_rshift->recurring_type;
                    $repeat_every = $v_rshift->repeat_every; // 1 week
                    $day = strtotime($event_date);
                    $to = strtotime($event_end_date);
                    while ($day <= $to) {
                        $start = date("Y-m-d", $day);
                        $day = strtotime(date("Y-m-d", $day) . " +" . $repeat_every . ' ' . $type);
                        $dateArray = date("Y-m-d", $day);
                        $all_date[] = $this->GetDays($start, $dateArray);
                    }
                    if (!empty($all_date)) {
                        foreach ($all_date as $call_date) {
                            foreach ($call_date as $date) {
                                if ($v_rshift->m_status != NULL) {
                                    $data[$v_rshift->s_user_id][$v_rshift->end_date][] = $v_rshift;
                                } else {
                                    $data[$v_rshift->s_user_id][$date][] = $v_rshift;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }
    
    function checkConflicShift($user_id, $start_date, $end_date = null)
    {
        
        if (empty($end_date)) {
            $end_date = date('Y-m-d');
        }
        
        $shift_mapping_regular = $this->get_conflic_shiftData($user_id, $start_date, $end_date);;
        
        if (empty($shift_mapping_regular)) {
            $shift_mapping_regular = array();
        }
        $shift_mapping_regularr = $this->get_conflic_shiftRecData($end_date, $user_id)[$user_id];
        if (empty($shift_mapping_regularr)) {
            $shift_mapping_regularr = array();
        }
        
        $all_conflic[$user_id] = array_merge_recursive($shift_mapping_regular, $shift_mapping_regularr);
        
        $app = array();
        if (!empty($all_conflic[$user_id])) {
            foreach ($all_conflic[$user_id] as $date => $v_shift) {
                if (strtotime($date) >= strtotime($start_date) && strtotime($date) <= strtotime($end_date)) {
                    $app[$date] = $v_shift;
                }
            }
        }
        return $app;
    }
    
    public
    function get_on_leave($user_id, $start_date, $end_date)
    {
        $on_leave = $this->db->query("SELECT * FROM `tbl_leave_application`
LEFT JOIN `tbl_leave_category` ON `tbl_leave_category`.`leave_category_id` = `tbl_leave_application`.`leave_category_id`
WHERE user_id = '$user_id' AND application_status = 2 AND (leave_start_date BETWEEN '$start_date' AND '$end_date' || leave_end_date BETWEEN '$start_date' AND '$end_date')")->result();
        $app = array();
        if (!empty($on_leave)) {
            foreach ($on_leave as $v_leave) {
                if (!empty($v_leave)) {
                    $p_hday = $this->GetDays($v_leave->leave_start_date, $v_leave->leave_end_date);
                    foreach ($p_hday as $date) {
                        $app[$user_id][$date] = array($v_leave);
                    }
                }
            }
        }
        return $app;
    }
    
    
    public
    function shift_data($id, $start_date, $end_date)
    {
        $all_shift_mapping = $this->db->query("SELECT *
FROM `tbl_holiday`
LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
WHERE user_id = '$id' AND start_date BETWEEN '$start_date' AND '$end_date' || end_date BETWEEN '$start_date' AND '$end_date'")->result();
        return $all_shift_mapping;
    }
    
    public
    function get_holiday($start_date, $end_date)
    {
        $public_holiday = $this->db->query("SELECT * FROM `tbl_holiday` WHERE start_date BETWEEN '$start_date' AND '$end_date' || end_date BETWEEN '$start_date' AND '$end_date'")->result();
        $app = array();
        if (!empty($public_holiday)) {
            foreach ($public_holiday as $p_holiday) {
                $p_hday = $this->GetDays($p_holiday->start_date, $p_holiday->end_date);
                foreach ($p_hday as $date) {
                    $app[$date] = array($p_holiday);
                }
            }
        }
        return $app;
    }
    
    
    public
    function get_weekly_holiday($all_date)
    {
        $data = array();
        foreach ($all_date as $date) {
            $day_name = date('l', strtotime($date));
            $data[$date] = $this->common_model->get_holidays($day_name);
        }
        return $data;
    }
    
    public
    function get_shift_dashboard($date = null)
    {
        if (empty($date)) {
            $date = date('d-m-Y');
        }
        $all_date = $this->weekly_date($date);
        $default = array(get_row('tbl_shift', array('is_default' => 'Yes')));
        $all_shift = get_result('tbl_shift', array('status' => 'published'));
        $public_holiday = $this->get_holiday(reset($all_date), end($all_date)); //tbl working Days Holidwhyay        
        $weekly_holidays = $this->get_weekly_holiday($all_date); //tbl working Days Holiday
        
        
        $shift_mapping_regular = $this->get_dashboard_shiftData(reset($all_date), end($all_date));
        if (empty($shift_mapping_regular)) {
            $shift_mapping_regular = array();
        }
        $shift_mapping_regularr = $this->get_dashboard_shiftRecData(end($all_date));
        if (empty($shift_mapping_regularr)) {
            $shift_mapping_regularr = array();
        }
        $all_shiftData = array_merge_recursive($shift_mapping_regular, $shift_mapping_regularr);
        ksort($all_shiftData);
        
        foreach ($all_date as $date) {
            if (!empty($all_shiftData[$date])) {
                foreach ($all_shiftData[$date] as $ddd) {
                    $allData[$date][$ddd->s_user_id][] = ($ddd);
                }
            }
            if (!empty($allData[$date])) {
                foreach ($allData[$date] as $kddd) {
                    $allDatas[$kddd[0]->shift_id][$date][$kddd[0]->s_user_id] = ($kddd);
                }
            }
        }
        
        foreach ($all_shift as $value) {
            foreach ($all_date as $date) {
                $data[$value->shift_id][$date] = $default;
                if (!empty($weekly_holidays[$date])) {
                    $data[$value->shift_id][$date] = $weekly_holidays[$date];
                } else if (!empty($public_holiday[$date])) {
                    $data[$value->shift_id][$date] = $public_holiday[$date];
                } else if (!empty($on_leave[$value->shift_id][$date])) {
                    $data[$value->shift_id][$date] = $on_leave[$value->shift_id][$date];
                } else if (!empty($allDatas[$value->shift_id][$date])) {
                    $data[$value->shift_id][$date] = ($allDatas[$value->shift_id][$date]);;
                }
            }
        }
        
        return $data;
        
    }
    
    
    public
    function get_shift_data($date = null, $week = null)
    {
        if (empty($date)) {
            $date = date('F-Y');
        }
        
        if (!empty($week)) {
            $start_date = $date;
            $end_date = $week;
        } else {
            $date = new DateTime($date . '-01');
            $start_date = $date->modify('first day of this month')->format('Y-m-d');
            $end_date = $date->modify('last day of this month')->format('Y-m-d');
        }
        $all_shift_mapping = $this->db->query("SELECT *
FROM `tbl_shift_mapping`
LEFT JOIN `tbl_shift` ON `tbl_shift_mapping`.`shift_id` = `tbl_shift`.`shift_id`
WHERE start_date BETWEEN '$start_date' AND '$end_date' OR end_date BETWEEN '$start_date' AND '$end_date'")->result();
        foreach ($all_shift_mapping as $v_mapping) {
            $data[$v_mapping->user_id][] = $v_mapping;
        }
        return $data;
    }
    
    
    public function getConsecutiveDate($sortingDate)
    {
        $allSoritngDate = array();
        $allDate = array();
        $currentRange = array();
        if (!empty($sortingDate)) {
            foreach ($sortingDate as $id => $dates) {
                ksort($dates);
                $lastDate = null;
                if (!empty($dates)) {
                    foreach ($dates as $date) {
                        $date = new DateTime($date);
                        if (null === $lastDate) {
                            $currentRange[$id][] = $date;
                        } else {
                            $interval = $date->diff($lastDate);
                            if ($interval->days === 1) { // add this date to the current range                                                                                        
                                $currentRange[$id][] = $date;
                            } else { // store the old range and start anew                                                                          
                                $allSoritngDate[][$id] = $currentRange[$id];
                                $currentRange[$id] = array($date);
                            }
                        }
                        $lastDate = $date;
                    }
                }
            }
            $allSoritngDate[] = $currentRange;
            
            if (!empty($allSoritngDate)) {
                foreach ($allSoritngDate as $key => $all_date) {
                    foreach ($all_date as $id => $date) {
                        $startDate = array_shift($date);
                        $allDate[$key][$id][] = $startDate->format('Y-m-d');
                        if (count($date)) {
                            $endDate = array_pop($date);
                            $allDate[$key][$id][] = $endDate->format('Y-m-d');
                        }
                    }
                }
            }
            return $allDate;
        }
    }
}
