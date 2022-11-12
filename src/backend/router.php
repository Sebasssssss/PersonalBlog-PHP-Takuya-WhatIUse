<?php

if(isset($_GET['r']) && $_GET['r'] != ""){
	$route = $_GET['r'];

	if($route == "cards"){

		include("views/cards_view.php");

	}elseif($route == "equipment"){

		include("views/equipment_view.php");	

	}elseif($route == "aboutme"){

		include("views/aboutme_view.php");	
	}
?>

<?php
}else{
?>

<main class="h-80 pt-[56px]">
	<div class="flex flex-col gap-4 justify-center text-center py-5 absolute w-full bg-cover h-80 drop-shadow-lg shadow-black overflow-hidden">
		<video src="../frontend/images/What-Video.mp4" muted="muted" autoplay="autoplay" loop="loop" class="absolute opacity-30 w-full h-[550px] md:h-full object-cover" playsinline></video>
		<h1 class="text-sm mt-6 z-10 uppercase">Welcome to</h1>
		<h1 class="text-4xl font-medium font-mplus z-10">The back<span class="text-orange-500">end!</span></h1>
	</div>
</main>

<section class="px-8 mx-auto max-w-3xl mt-20">
	<div>
		<p class="text-left indent-4">
		Welcome to the backend! Here you'll be able to upload the cards that will be shown
    in the frontend. You will also be able to edit the cards (titles, images, categories, etc..)
    and, delete every card that you do not like or just dont want it to be shown anymore! Followed by 
    more features that will be here in the backend. 
			<a href="https://github.com/Sebasssssss/" class="text-orange-500 inline-flex items-center gap-1 indent-1">Learn more about me
        <svg class="w-4 h-3" fill="currentColor" version="1.0" viewBox="0 0 256 256">
          <path d="M136.4 29.1c-8 7.8-10 11.8-8.9 17.7.6 3.2 4.8 7.8 29.3 32.4l28.7 28.8H98c-85.5 0-87.6.1-90.8 2-5.6 3.4-7.2 7.3-7.2 17.5 0 10.5 1.6 14.7 6.9 18.2l3.4 2.3h175.1l-28.6 28.7c-24.4 24.6-28.7 29.3-29.3 32.5-1.1 5.9.9 9.9 8.9 17.7l7.4 7.1h11.7l48.8-48.7c26.9-26.9 49.5-50 50.3-51.5 1.8-3.4 1.8-8.2 0-11.6-.8-1.5-23.4-24.6-50.3-51.5L155.5 22h-11.7l-7.4 7.1z"/>
        </svg>
      </a>
		</p>	
	</div>
	<div class="grid grid-cols-1 md:grid-cols-2 mt-8 gap-4">
	<?php
		foreach($listCards as $cards){
	?>
		<a href="#" class="w-[345px] mb-4 text-center">
			<img src="http://localhost/What-install/src/backend/files/images/<?=$cards['image1']?>" class="w-full border dark:border-slate-300 border-slate-700 rounded-xl h-44 object-cover">
			<h6 class="text-xl mt-3 font-semibold font-mplus"><?=$cards['cardName']?></h6>
			<h1 class="opacity-70"><?=$cards['title']?></h1>
		</a>
	<?php
	} 
	?>
	</div>
</section>
	
<?php
}
?>
