<?php
include "../connect.php";

function get_children($name)
{
    $arr = array();
    $db = new Database();
    $result = $db->read("
            SELECT tbl_member.name FROM member AS tbl_member JOIN
            (SELECT id FROM member WHERE name = '$name') AS root 
            WHERE tbl_member.parent_id = root.id AND tbl_member.name != '$name';
    ");

    foreach ($result as $row) {
        array_push($arr, $row["name"]);
    }

    return $arr;
}

echo json_encode(get_children('Maya'));
