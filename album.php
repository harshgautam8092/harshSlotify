<?php include("Includes/includedFiles.php"); 

if(isset($_GET['id'])) {
	$albumId = $_GET['id'];
}else {
	header("Location: index.php");
}

$album = new Album($conn, $albumId);
$singer = $album->getSinger();
?>

<div class="entityInfo">
	<div class="leftSection">
		<img src="<?php echo $album->getArtworkPath(); ?>">
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p>By <?php echo $singer->getName(); ?></p>
		<p><?php echo $album->getNumberOfSongs(); ?> Songs</p>
	</div>
</div>

<div class="tracklistContainer">
	<ul class="tracklist">
		
		<?php
		$songIdArray = $album->getSongIds();


		$i = 1;
		foreach($songIdArray as $songId) {

			$albumSong = new Song($conn, $songId);
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



<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($conn, $userLoggedIn->getUsername()); ?>
</nav>
