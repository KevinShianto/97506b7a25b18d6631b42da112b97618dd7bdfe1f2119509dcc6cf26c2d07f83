<?php
include "../connect.php";

function get_parent_tree($db, $root, &$parents)
{
    $result = $db->read("
            SELECT tbl_member.name FROM member AS tbl_member JOIN
            (SELECT parent_id FROM member WHERE name = '$root') AS root 
            WHERE tbl_member.id = root.parent_id AND tbl_member.name != '$root';
    ");

    if (count($result) > 0) {
        array_push($parents, $result[0]["name"]);
        get_parent_tree($db, $result[0]["name"], $parents);
    }
}

function get_parents($name)
{
    $parents = array();
    $db = new Database();
    get_parent_tree($db, $name, $parents);
    return $parents;
}

echo json_encode(get_parents('Derpina'));
