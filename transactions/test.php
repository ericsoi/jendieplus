<?php
$jd_data=$data = '{"Coords":[{"Accuracy":"65","Latitude":"53.277720488429026","Longitude":"-9.012038778269686","Timestamp":"Fri Jul 05 2013 11:59:34 GMT+0100 (IST)"},{"Accuracy":"65","Latitude":"53.277720488429026","Longitude":"-9.012038778269686","Timestamp":"Fri Jul 05 2013 11:59:34 GMT+0100 (IST)"},{"Accuracy":"65","Latitude":"53.27770755361785","Longitude":"-9.011979642121824","Timestamp":"Fri Jul 05 2013 12:02:09 GMT+0100 (IST)"},{"Accuracy":"65","Latitude":"53.27769091555766","Longitude":"-9.012051410095722","Timestamp":"Fri Jul 05 2013 12:02:17 GMT+0100 (IST)"},{"Accuracy":"65","Latitude":"53.27769091555766","Longitude":"-9.012051410095722","Timestamp":"Fri Jul 05 2013 12:02:17 GMT+0100 (IST)"}]}';
$data ='{"ResultCode":0,"ResultDesc":"Confirmation recieved successfu"}{"Body":{"stkCallback":{"MerchantRequestID":"61132-80136014-1","CheckoutRequestID":"ws_CO_21072022124155914722301062","ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1.00},{"Name":"MpesaReceiptNumber","Value":"QGL1TRVFVX"},{"Name":"TransactionDate","Value":20220721124213},{"Name":"PhoneNumber","Value":254722301062}]}}}}';
$data='{"ResultCode":0,"ResultDesc":"Confirmation recieved successfu"}{"Body":{"stkCallback":{"MerchantRequestID":"7767-32708356-1","CheckoutRequestID":"ws_CO_21072022130728788722301062","ResultCode":1037,"ResultDesc":"DS timeout user cannot be reached"}}}';
$data ='{"ResultCode":0,"ResultDesc":"Confirmation recieved successfu"}';


$data='{"Body":{"stkCallback":{"MerchantRequestID":"4602-33567431-1","CheckoutRequestID":"ws_CO_21072022161141436112770613","ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1.00},{"Name":"MpesaReceiptNumber","Value":"QGL3U5ZVM5"},{"Name":"Balance"},{"Name":"TransactionDate","Value":20220721161158},{"Name":"PhoneNumber","Value":254112770613}]}}}}';
$manage = json_decode($data, true);

echo 'Before: <br>';
print_r(("ss". $manage["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"]) . "\n");
print_r(("ss". $manage["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"]) . "\n");
print_r(("ss". $manage["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"]) . "\n");
print_r(("ss". $manage["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"]) . "\n");

?>

