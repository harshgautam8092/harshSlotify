<?php
    class Singer {

    	private $conn;
    	private $id;

    	public function __construct($conn, $id) {
    		$this->conn = $conn;
    		$this->id = $id;
    	}

    	public function getId() {
    		return $this->id;
    	}

	    public function getName() {
		    $singerQuery = mysqli_query($this->conn, "SELECT name FROM singers WHERE id='$this->id'");
		    $singer = mysqli_fetch_array($singerQuery);
		    return $singer['name'];
	    }

	    public function getSongIds() {
            $query = mysqli_query($this->conn, "SELECT id FROM songs WHERE singer ='$this->id' ORDER BY plays DESC");

            $array = array();

            while($row = mysqli_fetch_array($query)) {
                array_push($array, $row['id']);
            }

            return $array;
        }
    }

?>