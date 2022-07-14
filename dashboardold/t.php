<?php

$agent_referal_perttern = "(^[0-9]{5,6}[-][0-9]+$)";
$sub_agent_referal_code = "(^[0-9]{5,6}[-][0-9]+[-][0-9]+$)";
$iralicense = "00001-0-2";
echo preg_match($sub_agent_referal_code,$iralicense);