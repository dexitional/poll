<?php
    require('../config/Database.php');


    /*
	Gets all candidates based on election type
	*/
	function get_all_candidates($id)
	{
		$sql = 'SELECT 
            FROM ems.candidates t1
            JOIN ems.election_types t2 ON t1.election_type_id=t2.id
            WHERE t2.id ='.$id;
        $conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetch();
		return $row;
	}
    
    /*
    Gets candidate details
	*/
	function get_candidate_data($id)
	{
		$sql = 'SELECT * FROM ems.candidates WHERE id= '.$id;
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetch();
		return $row;
	}

    /*
	Gets candidates standing in a constituency
	*/
	function get_standing_candidates($election_type, $constituency)
	{
		$sql = "SELECT t4.party_name, t4.party_code, CONCAT(t2.fname, ' ', t2.lname) candidate_name, t2.election_type_id, t2.id
          FROM ems.voting t1
          JOIN ems.candidates t2 ON t1.candidate_id=t2.id
          JOIN ems.constituencies t3 ON t2.constituency_id=t3.id
          JOIN ems.political_parties t4 ON t2.party_id=t4.id
          JOIN ems.election_types t5 ON t2.election_type_id=t5.id
          WHERE t2.election_type_id = ? AND t2.constituency_id = ? ";
        $conn = get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($election_type, $constituency));
        $row = $stmt->fetchAll();
		return $row;
	}




    












    /*
	Gets all regions
	*/
	function get_all_regions()
	{
		$sql = 'SELECT * FROM ems.regions WHERE status=1 ORDER BY region_name';
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetchAll();
		return $row;
	}

    /*
	Gets region data
	*/
	function get_region_data($id)
	{
		$sql = 'SELECT * FROM ems.regions WHERE id='.$id;
        $conn = get_connection();
		$results = $conn->query($sql);
        $row = $results->fetch();
		return $row;
	}

    /*
	Gets all constituencies
	*/
	function get_all_constituencies()
	{
		$sql = 'SELECT * FROM ems.constituencies WHERE status=1';
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetchAll();
		return $row;
	}

    /*
	Gets constituency data
	*/
	function get_constituency_data($id)
	{
		$sql = 'SELECT * FROM ems.constituencies WHERE id= '.$id;
		$conn = get_connection();
		$results = $conn->query($sql);
        $row = $results->fetch();
		return $row;
	}
    
    /*
	Gets regional constituencies
	*/
	function get_regional_constituencies($id)
	{
		$sql = 'SELECT 
            FROM ems.constituencies t1
            JOIN ems.districts t2 ON t1.id=t2.constituency_id
            JOIN ems.regions t3 ON t2.region_id=t3.id';
		return $results;
	}

    /*
	Gets all districts
	*/
	function get_all_districts()
	{
		$sql = 'SELECT * FROM ems.districts WHERE status=1 ORDER BY district_name';
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetchAll();
		return $row;
	}

    /*
	Gets district data
	*/
	function get_district_data($id)
	{
		$sql = 'SELECT * FROM ems.districts WHERE id= '.$id;
		$conn = get_connection();
		$results = $conn->query($sql);
        $row = $results->fetch();
		return $row;
	}

    /*
	Gets district constituencies
	*/
	function get_district_constituencies($id)
	{
		$sql = 'SELECT t1.*
            FROM ems.constituencies t1
            JOIN ems.districts t2 ON t1.district_id=t2.id 
            WHERE t2.id ='.$id;
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetchAll();
		return $row;
	}


    













    /*
	Gets all parties
	*/
	function get_all_political_parties()
	{
		$sql = 'SELECT * FROM ems.political_parties WHERE status=1 ORDER BY party_name';
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetchAll();
		return $row;
	}

    /*
	Gets party data
	*/
	function get_party_data($id)
	{
		$sql = 'SELECT * FROM ems.political_parties WHERE id ='.$id;
		$conn = get_connection();
		$results = $conn->query($sql);
        $row = $results->fetch();
		return $row;
	}











    /*
	Gets all polling stations
	*/
	function get_all_polling_stations()
	{
		$sql = 'SELECT * FROM ems.polling_stations WHERE status=1';
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetchAll();
		return $row;
	}

    /*
	Gets all polling station data
	*/
	function get_polling_station_data($id)
	{
		$sql = 'SELECT * FROM ems.polling_stations WHERE id ='.$id;
		$conn = get_connection();
		$results = $conn->query($sql);
        $row = $results->fetch();
		return $row;
	}

    /*
	Gets all polling stations in a constituency
	*/
	function get_constituency_stations($id)
	{
		$sql = 'SELECT t1.*
            FROM ems.polling_stations t1
            JOIN ems.constituencies t2 ON t1.constituency_id=t2.id
            WHERE t2.id ='.$id;
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetchAll();
		return $row;
	}





    /*
	Gets election types
	*/
	function get_election_types()
	{
		$sql = 'SELECT * FROM ems.election_types WHERE status=1 ';
		$conn = get_connection();
        $results = $conn->query($sql);
        $row = $results->fetchAll();
		return $row;
	}









    /*
	insert ignore candidates into voting table
    since each candidate will have multiple records based on polling_station
	*/
	function insert_candidates_polling_station($candidate, $polling_station)
	{
		$sql = "INSERT IGNORE INTO ems.voting(candidate_id, station_id)
            VALUES (?, ?) ";
        $conn = get_connection();
        $stmt = $conn->prepare($sql);
        $stmt = $stmt->execute(['candidate'=>$candidate, 'station'=>$polling_station]);
	}


    /*
	populate votes_header table with votes summary
	*/
	function insert_votes_summary($polling_station, $election_id, $election_type)
	{
		$sql = "INSERT IGNORE INTO ems.votes_head(station_id, election_id, election_type_id)
            VALUES (?, ?, ?) ";
        $conn = get_connection();
        $stmt = $conn->prepare($sql);
        $stmt = $stmt->execute(['station'=>$polling_station, 'election_id'=>$election_id, 'election_type'=>$election_type]);
	}


    /*
	set votes for a candidate of a polling station
	*/
	function set_candidate_votes_polling_station($candidate, $polling_station, $votes)
	{
		$sql = "UPDATE ems.voting SET valid_votes = ? WHERE candidate_id = ? AND station_id= ? ";
        $conn = get_connection();
        $stmt = $conn->prepare($sql);
        $stmt = $stmt->execute(['votes'=>$votes, 'candidate'=>$candidate, 'station'=>$polling_station]);
	}


    /*
	Post polling agent sheet
	*/
	function post_polling_agent_sheet($election_type, $polling_station)
	{
		$sql = "UPDATE ems.votes_head SET posted = 1 WHERE election_type_id = ? AND station_id= ? ";
        $conn = get_connection();
        $stmt = $conn->prepare($sql);
        $stmt = $stmt->execute(['election_type'=>$election_type, 'station'=>$polling_station]);
	}

    /*
	has posted sheet
	*/
	function has_posted_sheet($polling_station, $election_id, $election_type)
	{
		$sql = "SELECT * FROM ems.votes_head 
            WHERE station_id= ? AND election_id= ? AND election_type_id= ? AND posted=1 ";
        $conn = get_connection();
        $stmt = $conn->prepare($sql);
        $stmt = $stmt->execute(['election_type'=>$election_type, 'station'=>$polling_station]);
        $row = $stmt->fetch();
        return $row;
	}



    


?>