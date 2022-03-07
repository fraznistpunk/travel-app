<?php
class Logger {
    private $user;
    private $file = 'activity.log';
    private $action;
    
    public function __construct($username) {
        $this->user = $username;
    }

    public function log_action($action, $name_of_action, $type = "") {
        date_default_timezone_set('Asia/Calcutta');
        $log = fopen("../../".$this->file, 'a');
        $log_time = date("j F Y ")."@".date(" h:i A"); // h:i:s
        switch ($action) {
            case 'insert':
                $message = json_encode(array(
                    "message" => $this->user.': created '.'"'.$name_of_action.'" '.$type,
                    "time" => $log_time))."\n";
                fwrite($log, $message);
                break;
            case 'update':
                $message = json_encode(array(
                    "message" => $this->user.': updated '.'"'.$name_of_action.'" '.$type,
                    "time" => $log_time))."\n";
                fwrite($log, $message);
                break;
            case 'delete':
                $message = json_encode(array(
                    "message" => $this->user.': deleted '.'"'.$name_of_action.'" '.$type,
                    "time" => $log_time))."\n";
                fwrite($log, $message);
                break;
            case 'approval':
                $message = json_encode(array(
                    "message" => $this->user.': approved '.'"'.$name_of_action,
                    "time" => $log_time))."\n";
                fwrite($log, $message);
                break;
            case 'pending':
                $message = json_encode(array(
                    "message" => $this->user.': changed '.'"'.$name_of_action.'" to pending.',
                    "time" => $log_time))."\n";
                fwrite($log, $message);
                break;
            case 'new_query':
                $message = json_encode(array(
                    "message" => $this->user.': has queried for '.'"'.$name_of_action.'"',
                    "time" => $log_time))."\n";
                fwrite($log, $message);
                break;
        }
        fclose($log);
    }
    public function get_log() {
        $contents = file($this->file);
        $res = array();
        foreach($contents as $line) {
            $arr = json_decode($line);
            @$tmp = (object)$arr;
            array_push($res, json_encode(array(
                "message" => $tmp->message,
                "time" => $tmp->time
            )));
        }
        return $res;
    }
}
?>