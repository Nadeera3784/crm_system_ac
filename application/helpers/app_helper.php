<?php
if (!function_exists('is_session_exist')){
    
function is_session_exist($key, $current_session){
    if(array_key_exists($key,$_SESSION) && !empty($_SESSION[$key])) {
        return $current_session;
    }else{
        return false;
    }
}

}

if(!function_exists('alert')){
    function alert($type, $message){
        echo '<div class="alert alert-'.$type.'" role="alert">';
        echo  $message;
        echo '</div>';
    }
}

if(!function_exists('alert-dismissable')){
    function alert_dismissable($type, $message){
        switch ($type) {
            case "success":
                $icon = "check";
                break;
            case "info":
                $icon = "info-outline";
                break;
            case "warning":
                $icon = "alert-circle-o";
                break;
            default:
                $icon = "block";
                break;
        }
        echo '<div class="alert alert-'.$type.' alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-'. $icon.'"></i>'. $message.'</div>';
    }
}

if(!function_exists('get_extension')){
    function get_extension($str){
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
}


if(!function_exists('status_transformer')){
function status_transformer($status){
    $retval = '';
    switch ($status) {
        case 'in_progress':
            $retval = 'In Progress';
            break;
        case 'on_hold':
            $retval = 'On Hold';
            break;
        case 'inhouse':
            $retval = 'In-house';
            break;
        case 'onsite':
            $retval = 'On-Site';
            break;
        case 'free-of-charge':
            $retval = 'Free-Of-Charge';
            break;
        case 'printer-installation':
            $retval = 'Printer installation';
            break;
        case 'software-installation':
            $retval = 'Software Installation';
            break;
        case 'payment-collection':
            $retval = 'Payment Collection';
            break;
        case 'pick-up-delivery':
            $retval = 'Pick up / Delivery';
            break;
        case 'id-card-printer':
            $retval = 'ID Card Printer';
            break;
        case 'no_power':
            $retval = 'No Power';
            break;
        case 'poor_print_quality':
            $retval = 'Poor Print Quality';
            break;
        case 'natural_damage':
            $retval = 'Natural Damage';
            break;
        case 'not_detecting':
            $retval = 'Not Detecting';
            break;
        case 'not_scanning':
            $retval = 'Not Scanning';
            break;
        case 'paper_jam':
            $retval = 'Paper Jam';
            break;
        case 'paper_not_feeding':
            $retval = 'Paper Not Feeding';
            break;
        case 'usb_cable':
            $retval = 'USB Cable';
            break;
        case 'power_cord':
            $retval = 'Power Cord';
            break;
        case 'ice_technologies':
            $retval = 'ICE Technologies';
            break;
        case 'abc_trade_investments':
            $retval = 'ABC Trade & Investments';
            break;
        default:
          $retval = $status;
    }
    return $retval;
}

}






