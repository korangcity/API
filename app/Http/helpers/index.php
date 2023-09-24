<?php

function sanitize($data = ""): array|string
{
    if (is_array($data)) {
        $data1 = [];
        foreach ($data as $val) {
            $val = trim($val);
            $val = stripslashes($val);
            $data1[] = htmlspecialchars($val);
        }
        $data = $data1;
    } else {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }

    return $data;
}
