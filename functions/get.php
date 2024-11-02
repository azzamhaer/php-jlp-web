<?php
function news($conn)
{
    $db = 'news';
    $query = "SELECT * FROM $db";

    $result = mysqli_query($conn, $query);

    return $result;
}

function news_by_id($conn, string $id)
{
    $db = 'news';
    $query = "SELECT * FROM $db WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    return $result;
}