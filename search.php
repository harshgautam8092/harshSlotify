<?php 
include("Includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}else{
	$term = "";
}
?>

<div class="searchContainer">

	<h4>Search for an Singer, Album and Song</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing...." onfocus="this.value = this.value">
	
</div>

<script>

$(".searchInput").focus();

$(function() {
	
	$(".searchInput").keyup(function() {
		clearTimeout(timer);

		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val);
		}, 2000);

	})


})

</script>

<?php if($term == "") exit(); ?>

<div class="tracklistContainer borderBottom">
	<h2>SONGS</h2>
	<ul class="tracklist">
		
		<?php
		$songsQuery = mysqli_query($conn,"SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($songsQuery) == 0) {
			echo "<span class='noResults'>No songs found matching " . $term . "</span>"; 
		}


		$songIdArray = array();


		$i = 1;
		while($row = mysqli_fetch_array($songsQuery)) {

			if($i > 15) {
				break;
			}

			array_push($songIdArray, $row['id']);

			$albumSong = new Song($conn, $row['id']);
			$albumSinger = $albumSong->getSinger();

			echo   "<li class='tracklistRow'>
				        <div class='trackCount'>
					        <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
					        <span class='trackNumber'>$i</span>
				        </div>

				        <div class='trackInfo'>
							<span class='trackName'>" . $albumSong->getTitle() . "</span>
							<span class='singerName'>" . $albumSinger->getName() . "</span>
						</div>

						<div class='trackOptions'>
							<input type='hidden' class='songId' value=' " . $albumSong->getId() . "'>
						    <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
						</div>

						<div class='trackDuration'>
						    <span class='duration'>" . $albumSong->getDuration() . "</span>
						</div>

	    		    </li>";
     
			$i = $i + 1;
		}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
</div>

<div class="singersContainer borderBottom">

	<h2>SINGERS</h2>

	<?php

	$singersQuery = mysqli_query($conn, "SELECT id FROM singers WHERE name LIKE '$term%' LIMIT 10");

	if(mysqli_num_rows($singersQuery) == 0) {
		echo "<span class='noResults'>No singers found matching " . $term . "</span>"; 
	}

	while($row = mysqli_fetch_array($singersQuery)) {
		$singerFound = new Singer($conn, $row['id']);

		echo "<div class='searchResultRow'>
				<div class='singerName'>

					<span role='link' tabindex='0' onclick='openPage(\"singer.php?id=" . $singerFound->getId() ."\")'>
					"
					. $singerFound->getName() .
					"
					</span>
				</div>
			</div>";
	}
  ?>
</div>

<div class="gridViewContainer">

    <h2>ALBUM</h2>

	<?php
	    $albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");

	    if(mysqli_num_rows($albumQuery) == 0) {
		echo "<span class='noResults'>No albums found matching " . $term . "</span>"; 
	}

	    while($row = mysqli_fetch_array($albumQuery)) {

	    	echo "<div class='gridViewItem'>
	    	        <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
	                    <img src='". $row['artworkPath'] . "'>
	                    <div class='gridViewInfo'>"
	                       . $row['title'] .
	                    "</div>
                    </span>

	    	    </div>";
	    }

	?>
</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($conn, $userLoggedIn->getUsername()); ?>
</nav>
