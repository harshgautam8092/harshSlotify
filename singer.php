<?php
include("Includes/includedFiles.php");

if(isset($_GET['id'])) {
	$singerId = $_GET['id'];
}else {
	header("Location: index.php");
}

$singer = new Singer($conn, $singerId);
?>

<div class="entityInfo borderBottom">
	<div class="centerSection">
		
		<div class="singerInfo">
			
			<h1 class="singerName"><?php  echo $singer->getName(); ?></h1>
			<div class="headerButtons">

				<button class="button green" onclick="playFirstSong()">
					PLAY
				</button>	
			</div>
		</div>
	</div>
</div>

<div class="tracklistContainer borderBottom">
	<h2>SONGS</h2>
	<ul class="tracklist">
		
		<?php
		$songIdArray = $singer->getSongIds();


		$i = 1;
		foreach($songIdArray as $songId) {

			if($i > 5) {
				break;
			}

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


