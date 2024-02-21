<?php
include '../../link.php';
function text_to_array($time_table)
{
    $periods = explode('&', $time_table);
    $new_time_table = [];
    foreach ($periods as $period) {
        $c = explode('=', $period);
        if (count($c) == 2) {
            $new_time_table[$c[0]] = $c[1];
        }
    }
    $final_time_table = [];
    foreach (array_keys($new_time_table) as $details) {
        $class = explode('_', $details)[0];
        $section = explode('_', $details)[1];
        $period_num = explode('_', $details)[3];
        $data = explode('<br>', $new_time_table[$details]);
        if (count($data) == 3 && $data[2] != "" && $data[2] != " " && $data[2] != NULL) {
            $final_time_table[$class][$section]['Period' . $period_num] = trim($data[0]) . ',' . trim(end($data));
        } else {
            $final_time_table[$class][$section]['Period' . $period_num] = trim($data[0]);
        }
    }
    return $final_time_table;
}
if (isset($_POST['Time_Table'])) {
    $time_table = $_POST['Time_Table'];

    //$final_time_table = text_to_array($time_table);
    if (isset($_POST['Allocated']) && $_POST['Allocated'] != "") {
        $allocated_time_table = $_POST['Allocated'];
        $final_allocated_time_table = text_to_array($allocated_time_table);

        //Updation
        $status = false;
        foreach (array_keys($final_allocated_time_table) as $class) {
            foreach (array_keys($final_allocated_time_table[$class]) as $section) {
                if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `time_table_temp` WHERE Class = '$class' AND Section = '$section'")) != 0) {
                    foreach (array_keys($final_allocated_time_table[$class][$section]) as $p) {
                        if ($final_allocated_time_table[$class][$section][$p] == "") {
                            $update_sql = "DELETE FROM `time_table_temp` WHERE Class = '$class' AND Section = '$section'";
                            if (mysqli_query($link, $update_sql)) {
                                $status = true;
                            } else {
                                $status = false;
                                break 2;
                            }
                        } else {
                            $update_sql = "UPDATE `time_table_temp` SET Period = '$p',Faculty = '" . $final_allocated_time_table[$class][$section][$p] . "' WHERE Class = '$class' AND Section = '$section'";
                            if (mysqli_query($link, $update_sql)) {
                                $status = true;
                            } else {
                                $status = false;
                                break 2;
                            }
                        }
                    }
                }
            }
        }
        if ($status) {
            echo "success,";
        } else {
            echo "failure,";
        }
    }


    //Insertion
    foreach (array_keys($final_time_table) as $class) {
        foreach (array_keys($final_time_table[$class]) as $section) {
            if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `time_table` WHERE Class = '$class' AND Section = '$section'")) == 0) {
                $insert_sql = mysqli_query($link, "INSERT INTO `time_table`(Class,Section) VALUES('$class','$section')");
            } else {
                continue;
            }
        }
    }

    //Updation
    $status = false;
    foreach (array_keys($final_time_table) as $class) {
        foreach (array_keys($final_time_table[$class]) as $section) {
            if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `time_table` WHERE Class = '$class' AND Section = '$section'")) != 0) {
                $update_sql = "UPDATE `time_table` SET ";
                $c = 1;
                foreach (array_keys($final_time_table[$class][$section]) as $p) {
                    if ($final_time_table[$class][$section][$p] == "") {
                        if ($c == 8) {
                            $update_sql .= $p . " = NULL";
                        } else {
                            $update_sql .= $p . " = NULL,";
                        }
                    } else {
                        //$final_time_table[$class][$section][$p] = str_replace('<br>', ', ', $final_time_table[$class][$section][$p]);
                        if ($c == 8) {
                            $update_sql .= $p . " = '" . $final_time_table[$class][$section][$p] . "'";
                        } else {
                            $update_sql .= $p . " = '" . $final_time_table[$class][$section][$p] . "',";
                        }
                    }
                    $c++;
                }
                $update_sql .= " WHERE Class = '" . $class . "' AND Section = '" . $section . "'";
                if (mysqli_query($link, $update_sql)) {
                    $status = true;
                } else {
                    $status = false;
                    break 2;
                }
            }
        }
    }
    if ($status) {
        echo "success,";
    } else {
        echo "failure,";
    }
}
