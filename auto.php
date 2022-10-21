<?php
    //database configuration
$dbhost = 'sql23.cpt1.host-h.net';
$dbusername = 'parishyphh_3';
$dbpassword = '14l1I8CvZxV86LfM0a3S';
$dbname = 'paris_CRM1';
    
    //connect with the database
    $db = new mysqli($dbhost,$dbusername,$dbpassword,$dbname);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM fac_job_panels  WHERE serial_no LIKE '%".$searchTerm."%' ORDER BY serial_no ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['serial_no'];
    }
    
    //return json data
    echo json_encode($data);
?>