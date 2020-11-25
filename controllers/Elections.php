<?php
    require('../models/Elections.php');


    
    if(isset($_GET['polling_sheet'])){
        
        
        ini_set('display_errors', 1);
        
        //$elction_id = $_SESSION['ELECTION_ID'];
        //$constituency = $_SESSION['CONSTITUENCY'];
        //$polling_station_id = $_SESSION['STATION_ID'];
        
        $election_id = 1;
        $constituency=1;
        $polling_station_id=1;
        $presidential = get_standing_candidates(2, $constituency);
        $parliamentary = get_standing_candidates(1, $constituency);
        
        //$has_posted_parliamentary = has_posted_sheet($polling_station, $election_id, 1);
        //$has_posted_presidential = has_posted_sheet($polling_station, $election_id, 2);
        //$polling_station = get_polling_station_data($polling_station_id);
        
        include("../pages/polling_agent_sheet.php");
    }



    /*
    Save polling agent sheet
	*/
    if(isset($_POST['save'])){
        
        
        $votes = $_POST['votes'];
        $candidates = $_POST['candidates'];
        $election_type = $_POST['election_type'];
        $polling_station = $_POST['polling_station'];
        
        $elction_id = $_SESSION['ELECTION_ID'];
        insert_votes_summary($polling_station, $election_id, $election_type);
        
        $num_candidates = count($votes);
        for($i=0; $i<$num_candidates; $i++){
            
            $vote = $votes[$i];
            $candidate = $candidates[$i];
            //insert ignore candidates
            insert_candidates_polling_station($candidate, $polling_station);
            //save votes against candidates
            set_candidate_votes_polling_station($candidate, $polling_station, $votes);
        }
                
        $presidential = get_party_candidates_constituency($election_type=2, $constituency=1);
        $parliamentary = get_party_candidates_constituency($election_type=1, $constituency=1);
        include("../pages/polling_agent_sheet.php");
    }



    /*
    Post polling agent sheet to constituency
	*/
    if(isset($_POST['post'])){
        
        
        $votes = $_POST['votes'];
        $candidates = $_POST['candidates'];
        $election_type = $_POST['election_type'];
        $polling_station = $_POST['polling_station'];
        
        $num_candidates = count($votes);
        for($i=0; $i<$num_candidates; $i++){
            
            $vote = $votes[$i];
            $candidate = $candidates[$i];
            //insert ignore candidates
            insert_candidates_polling_station($candidate, $polling_station);
            //save votes against candidates
            set_candidate_votes_polling_station($candidate, $polling_station, $votes);
            //post sheet
            post_polling_agent_sheet($election_type, $polling_station);
        }
        
        $presidential = get_party_candidates_constituency($election_type=2, $constituency=1);
        $parliamentary = get_party_candidates_constituency($election_type=1, $constituency=1);
        include("../pages/polling_agent_sheet.php");
    }











?>