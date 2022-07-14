<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    function grossCalculater(){
        $basic_premium = $_SESSION['basicpremium']; //from quote -> third party only/and theft and comprehensive
        $policy_holder_compensation_fund = (0.2/100) * $basic_premium;
        $training_levy = (0.25/100) * $basic_premium;
        $free_limit = 30000;
        $windscreen_value = 50000; //User Input
        $radio_cassete = 50000; // User Input
        $sum_insured = 1000000;// not included in third party. User Input
        $AA_ROAD_RESQUE = 3000;//not charging training levy and policy holder compensation fund. Included in third party
        $INFAMA_ROAD_RESQUE = 9280;//not charging training levy and policy holder compensation fund. Included in third party
        $AMREF = 3200;//not charging training levy and policy holder compensation fund. Included in third party
        $BIMALIFE = 500;//not charging training levy and policy holder compensation fund. Included in third party
        $PASSENGER_LEGAL_LIABILITY = 500;//not charging training levy and policy holder compensation fund (input enter number of passangers int)
        $EXCESS_PROTECTOR = (0.25/100) * $sum_insured;//
        $EXCESS_PROTECTOR = (0.45/100) * $EXCESS_PROTECTOR + $EXCESS_PROTECTOR;
        $POLITICAL_VIOLENCE_AND_TERRORISM = (0.25/100) * $sum_insured;//(PVT)
        $POLITICAL_VIOLENCE_AND_TERRORISM = (0.45/100) * $POLITICAL_VIOLENCE_AND_TERRORISM + $POLITICAL_VIOLENCE_AND_TERRORISM;
        $WINDSCREEN = ($windscreen_value - $free_limit)*10/100;//(input: Enter Value int(windscreen value)) Value below 0 = 0(No charge)
        $WINDSCREEN = (0.45/100) * $WINDSCREEN + $WINDSCREEN;
        $RADIO_CASSETE = ($radio_cassete - $free_limit)*10/100;//(input: enter Value of radio)
        $RADIO_CASSETE = (0.45/100) * $RADIO_CASSETE + $RADIO_CASSETE;
        $PERSONAL_ACCIDENT = 500; //Included in third party

        $stamp_duty = 40; //for new businesses.
        $gross_premium = $basic_premium + $training_levy + $policy_holder_compensation_fund + $stamp_duty;//+ Optional Benefits(in caps) new businesses 
        $gross_premium = round($gross_premium);
        $_SESSION["grosspremium"] = $gross_premium;
        #echo "training levy $training_levy \n";
        #echo "policy holder compensation fund $policy_holder_compensation_fund\n";
        #echo  "Windscreen $WINDSCREEN\n";
        #echo  "Radio Cassete $RADIO_CASSETE\n";
        return $gross_premium;
    }
?>