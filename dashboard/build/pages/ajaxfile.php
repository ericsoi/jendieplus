<?php
include 'config.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Custom Field value
$searchByName = $_POST['searchByName'];
$searchByGender = $_POST['searchByGender'];

## Search 
$searchQuery = " ";
if($searchByName != ''){
    $searchQuery .= " and (underwriter like '%".$searchByName."%' ) ";
}
if($searchByGender != ''){
    $searchQuery .= " and (coverage='".$searchByGender."') ";
}
if($searchValue != ''){
	$searchQuery .= " and (underwriter like '%".$searchValue."%' or 
        owner like '%".$searchValue."%' or 
        vehicleclass like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from tbl_product");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from tbl_product WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from tbl_product WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $owner = $row['owner'];
    $ownerquery = "SELECT * FROM tbl_user WHERE agency='$owner' order by time_created LIMIT 1";
    $ownerRecords = mysqli_query($con, $ownerquery);
    $agency = mysqli_fetch_assoc($ownerRecords);
    $class =explode(".", $row['vehicleclass'])[0]; $vehicle = explode(".", $row['vehicleclass'])[1];
    if($class<4){
        $vehicleclass = "Motorcycle " .  $vehicle;
    }elseif($class>3 && $class < 6){
        $vehicleclass = "Tricycle " .  $vehicle;
    }else{
        $vehicleclass = "Motorvehicle " .  $vehicle;
    }
    $data[] = array(
    		"underwriter"=>$row['underwriter'],
    		"vehicleclass"=>$vehicleclass,
    		"coverage"=>$row['coverage'],
    		"owner"=>$agency['companyname'],
    		"product_id"=>"<div class='flex space-x-2'>
                <div>
                    <a href='processor/handle_product.php?q=" . $row['product_id'] . "'><button type='button' class='justify-center inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out'>Edit</button></a>
                    <a href='processor/handle_product.php?q=" . $row['product_id'] .'&delete=true'."'><button type='button' class='justify-center inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out'>Delete</button></a>
                </div>
            </div>"
    );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
