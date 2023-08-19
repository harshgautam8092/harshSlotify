<?php
    class Album {

    	private $conn;
    	private $id;
        private $title;
        private $singerId;
        private $genre;
        private $artworkPath;

    	public function __construct($conn, $id) {
    		$this->conn = $conn;
    		$this->id = $id;

            $query = mysqli_query($this->conn, "SELECT * FROM albums WHERE id='$this->id'");
            $album = mysqli_fetch_array($query);

            $this->title = $album['title'];
            $this->singerId = $album['singer'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['artworkPath'];
    	}
    	public function getTitle() {
            return $this->title;
    	}

        public function getSinger() {
            return new Singer($this->conn, $this->singerId);
        }

        public function getGenre() {
            return $this->genre;
        }

        public function getArtworkPath() {
            return $this->artworkPath;

        }

        public function getNumberOfSongs() {
            $query = mysqli_query($this->conn, "SELECT id FROM songs WHERE album='$this->id'");
            return mysqli_num_rows($query);
        }

        public function getSongIds() {
            $query = mysqli_query($this->conn, "SELECT id FROM songs WHERE album ='$this->id' ORDER BY albumOrder ASC");

            $array = array();

            while($row = mysqli_fetch_array($query)) {
                array_push($array, $row['id']);
            }

            return $array;
        }
    }

?>