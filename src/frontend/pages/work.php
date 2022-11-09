<?php

require_once("models/subpages_model.php");

$objWork = new subpages_model();

$listWork = $objWork->listWork();

?>
<!DOCTYPE html>
<html class="scroll-smooth">
<head>
  <title>Personal Blog</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../images/bleach.png">
  <link rel="stylesheet" href="../../../css/styles.css">
  <link rel="stylesheet" href="../../../css/global.css">
</head>
<body class="bg-orange-50 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-300 transition-colors duration-500">
	<header class="backdrop-blur-md w-full p-2 z-40 fixed">
		<div class="max-w-3xl mx-auto relative h-11">
			<nav class="flex items-center gap-3">
				<a href="../index.php" id="myName" class="group text-lg p-2 font-semibold font-mplus inline-flex items-center gap-1.5 text-center tracking-tighter">
          <svg class="w-5 h-5 -rotate-[20deg] group-hover:rotate-[0] transition-transform" fill="currentColor" version="1.0" viewBox="0 0 64 63">
            <path d="m8.1 8.9-8.2 9 3.1 6C4.7 27.3 6.4 30 6.9 30c1.7 0 3-2.5 2.1-4-1.4-2.1-1.2-8.4.2-9.8 1.5-1.5 7.8-1.5 9.8.1 4.6 3.6 6.8 12.5 3.8 15.5-1.6 1.6-5.3 1.5-8.7-.3-5.4-2.7-8 2.3-3.9 7.7.8 1.1 3.8 2.1 7.7 2.7 4.1.7 7.5 1.9 9.6 3.6 4.1 3.1 4.8 3.1 8.8.1 2-1.5 5.8-2.9 10-3.6 5.9-1.1 7-1.6 8.2-4.1 2-3.7 1.9-5.6-.3-6.8-1.2-.6-2.5-.5-4.2.5-3.1 1.7-7.2 1.8-8.8.2-3-3-.8-11.9 3.8-15.5 2-1.6 8.3-1.6 9.8-.1 1.4 1.4 1.6 7.7.2 9.8-.9 1.5.4 4 2.1 4 .5 0 2.2-2.7 3.9-6.1l3.1-6-8.2-9L47.8 0H16.2L8.1 8.9zM13 44.2C13 47 19.3 56 21.2 56c.5 0 .8-2.6.6-5.8l-.3-5.7-4.2-.6c-2.4-.3-4.3-.1-4.3.3z"/>
            <path d="m46.5 44-4 .5-.3 5.7c-.2 3.2.1 5.8.6 5.8 2 0 8.8-10 8-11.8-.2-.4-2.1-.5-4.3-.2zM24 49.4c0 6.2 1.2 9.6 4.1 11.7l2.9 2v-6.3c0-6.1-.1-6.4-3.5-8.6L24 46v3.4zm12.3-1c-3.1 2-3.3 2.4-3.3 8.4v6.3l2.9-2.1c3-2.1 4.8-7.8 3.9-12.7-.3-2-.3-2-3.5.1z"/>
          </svg>Sebass Rodriguez
        </a>
				<div class="items-center gap-6 hidden md:inline-flex pt-0.5">
          <a href="https://github.com/Sebasssssss/" class="text-md">About Me</a>
          <a href="https://github.com/Sebasssssss/PersonalBlog-PHP-Based-on-Takuya.git" class="inline-flex items-center text-md gap-1">
            <svg class="w-3.5 h-3.5" fill="currentColor" version="1.0" width="85.333" height="85.333" viewBox="0 0 64 64">
              <path d="M20.7 3C10.8 6.8 3.3 15.5 1 25.9c-3.1 13.5 4 28.9 16.2 35.2 5.4 2.8 6.8 2.5 6.8-1.4 0-3.1-.2-3.3-3.6-3.4-3.5-.1-7.4-2.6-7.4-4.8 0-.7-.9-2-2-3s-2-2.2-2-2.7c0-1.7 2.1-.7 5.9 2.7 4.5 4.1 7.3 4.4 9.6 1.2 1.4-2.1 1.4-2.3-.7-3.1-7.4-2.7-9-3.8-10.4-7.1-1.7-4.1-1.9-12.6-.3-14.2.7-.7 1.3-3.2 1.4-5.7.1-2.5.5-4.9.9-5.3.4-.4 2.1-.1 3.9.6 4.7 2 19.3 2.1 24.5.3 2.3-.8 4.5-1.2 4.9-.8.4.3.7 2.7.8 5.2.1 2.5.7 5 1.4 5.7 1.6 1.6 1.4 10.1-.3 14.2-1.4 3.4-4.7 5.6-9.9 6.9-2.3.5-2.6.9-1.7 2.6.5 1 1 4.6 1 7.9 0 6.9.7 7.3 6.8 4.2 8.6-4.4 15.7-14.8 16.9-24.9 1.1-10-4.2-22.6-12.1-28.7C43.2 1.1 30.3-.8 20.7 3z"/>
            </svg>Source
          </a>
        </div>
        <div class="text-xl list-none flex absolute right-12">
          <svg id="sun" class="w-5 h-6" fill="currentColor" version="1.0" width="170.667" height="170.667" viewBox="0 0 128 128">
            <path d="M60.2 1.6C58.2 2.9 58 4 58 11c0 8.8 1.2 11 6 11s6-2.2 6-11c0-7-.2-8.1-2.2-9.4C66.6.7 64.9 0 64 0c-.9 0-2.6.7-3.8 1.6zM19 19c-3.3 3.3-2.5 6.1 3.3 11.8 5.6 5.5 9.2 6.6 12.1 3.6 3.1-3 2-6.6-3.7-12.2C25 16.5 22.2 15.8 19 19zM97.2 22.3c-5.5 5.6-6.6 9.2-3.6 12.1 3 3.1 6.6 2 12.2-3.7 5.7-5.7 6.4-8.5 3.2-11.7-3.3-3.3-6.1-2.5-11.8 3.3zM53.6 33.9c-10.4 4.2-16.7 10.8-20.2 21.3-3.3 10 .2 23.3 8.1 31.3 12.2 12.1 32.8 12.1 45 0 12.1-12.2 12.1-32.8 0-45-8.4-8.3-22.7-11.6-32.9-7.6zM1.6 60.2c-2 2.8-2 4.8 0 7.6C2.9 69.8 4 70 11 70c8.8 0 11-1.2 11-6s-2.2-6-11-6c-7 0-8.1.2-9.4 2.2zM107.6 59.5c-.9.9-1.6 2.9-1.6 4.5 0 5 2.2 6.1 11.3 5.8 7.7-.3 8.2-.4 9.7-3.1 1.3-2.4 1.3-3 0-5.5-1.5-2.6-2-2.7-9.7-3-6.4-.2-8.4.1-9.7 1.3zM22.2 97.3c-5.7 5.7-6.4 8.5-3.2 11.7 3.3 3.3 6.1 2.5 11.8-3.3 5.5-5.6 6.6-9.2 3.6-12.1-3-3.1-6.6-2-12.2 3.7zM93.6 93.6c-3.1 3-2 6.6 3.7 12.2 5.7 5.7 8.5 6.4 11.7 3.2 3.3-3.3 2.5-6.1-3.3-11.8-5.6-5.5-9.2-6.6-12.1-3.6zM59.5 107.6c-1.2 1.3-1.5 3.3-1.3 9.7.3 7.7.4 8.2 3.1 9.7 2.4 1.3 3 1.3 5.5 0 2.6-1.5 2.7-2 3-9.7.3-9.1-.8-11.3-5.8-11.3-1.6 0-3.6.7-4.5 1.6z"/>
          </svg>
          <svg id="moon" class="w-5 h-6" fill="currentColor" version="1.0" viewBox="0 0 512 512">
            <path d="M204 4.4c-18.1 8-35.2 17.9-51 29.5C99.7 73.1 62.2 132.5 50.1 197c-3.6 19-4.5 29.2-4.5 51.5 0 17.8.5 24.8 2.3 36.5 4.5 29.1 11.7 52.1 24.6 78.5 20.4 41.9 50 76 88.9 102.6 33.8 23.2 72.9 37.9 116.6 44 12 1.7 50.2 1.7 63 0 37.5-4.9 71.2-16.2 102.2-34.2 7.9-4.6 21.8-13.7 21.8-14.3 0-.2-2.3.5-5.1 1.5-14.8 5.7-37.5 11-57.2 13.4-15.7 1.9-46.5 1.9-63 0-59-6.9-113.9-33.6-156.2-76-32.3-32.4-56-73.1-68-117-15.3-55.8-11.6-116.4 10.2-170 16-39.3 43.1-76.2 75.8-103.3 13.3-11 13.1-10.5 2.5-5.8z"/>
          </svg>
        </div>
        <div @click.away="open = false" class="absolute right-0" x-data="{ open: false }">
          <button @click="open = !open" class="rounded-md border border-zinc-400 dark:border-zinc-700 py-2 text-sm shadow-sm hover:bg-orange-200 dark:hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
            <svg class="w-[37px] h-5" fill="currentColor" version="1.0" viewBox="0 0 128 128">
              <path d="M24.1 36.6c-3.9 3.3-4.2 8-.8 11.2C25.6 50 25.9 50 64.6 50c30.8-.1 39.3-.3 40.7-1.4 1.2-.9 1.7-2.7 1.7-6.3 0-8.5 1.2-8.3-42.4-8.3H27.2l-3.1 2.6zm-.5 22c-3.4 3.4-3.4 7.7-.1 10.9l2.4 2.5h38.3c44.2 0 42.8.3 42.8-8s1.4-8-42.6-8H26.3l-2.7 2.6zm-.1 21.9c-3.4 3.3-3.3 7.4.3 10.8l2.8 2.7h37.7c43.7 0 42.7.2 42.7-8 0-8.3 1.8-8-42.4-8H25.9l-2.4 2.5z"/>
            </svg>
          </button>
					<div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-56 mt-2 origin-top-right rounded-md shadow-lg flex flex-col border border-zinc-400 dark:border-zinc-700 bg-orange-50 dark:bg-zinc-800 px-2 py-1">
						<h1 class="py-2 mx-1 text-left text-xs uppercase tracking-tighter font-bold">Categories</h1>
							<a href="tools.php" class="w-full text-left hover:bg-orange-200 dark:hover:bg-zinc-700 px-2 py-2 rounded text-sm">Equipment</a>
							<a href="work.php" class="w-full text-left hover:bg-orange-200 dark:hover:bg-zinc-700 px-2 py-2 rounded text-sm">Work</a>
							<a href="aboutMe.php" class="w-full text-left hover:bg-orange-200 dark:hover:bg-zinc-700 px-2 py-2 rounded text-sm">About Me</a>
					</div>
				</div>
			</nav>
		</div>
	</header>
  <main class="h-80 pt-[56px]">
    <div class="flex flex-col gap-4 justify-center text-center py-5 absolute w-full bg-cover h-80 drop-shadow-lg shadow-black overflow-hidden">
      <video src="../images/What-Video.mp4" muted="muted" autoplay="autoplay" loop="loop" class="absolute opacity-30 w-full h-[550px] md:h-full object-cover" playsinline></video>
      <h1 class="text-sm z-10 uppercase">Welcome to my</h1>
      <h1 class="text-4xl font-medium font-mplus z-10">Personal <span class="text-orange-500">blog</span></h1>
    </div>
  </main>
  <section class="px-8 mx-auto max-w-3xl mt-20">
    <div class="border-b border-opacity-10 w-max border-orange-400 hover:border-opacity-20 cursor-pointer transition-colors duration-600">
      <h1 class="group text-orange-700 dark:text-orange-500 font-mplus inline-flex items-center">
        <a href="../index.php">
          <svg class="fill-zinc-900 dark:fill-zinc-300 group-hover:translate-x-[2px] w-5 h-3 pr-2 opacity-40 lg:hover:opacity-50 transition ease-in-out duration-300" version="1.0" viewBox="0 0 504 512">
            <path d="M240.3 1.4c-9.2 3-16.7 9.8-20.9 19.1-3.6 7.9-3.8 18.2-.4 27 2.1 5.8 6.3 10.1 102.8 106.7l100.6 100.7-16.4 16.8c-9.1 9.2-53.6 54.3-99 100.1s-83.7 85.2-85.3 87.4c-8.7 13.1-6.3 32.3 5.5 43.4 7.3 6.8 12.6 8.9 22.8 8.9 15.1 0 10.5 3.9 90.8-77.3 141.3-143 156-158.2 159-164.2 2.4-4.8 2.7-6.7 2.7-15s-.3-10.2-2.7-15c-2.3-4.6-21.4-24.3-116.3-119.7C257.8-6.1 265.6 1 251.7.4c-4.3-.2-8.9.2-11.4 1z"/>
            <path d="M28.1 9.1C13.2 12 2.1 24.9 1.2 40.3c-.5 8.1 1 14.7 4.6 20.5 1.5 2.3 47.1 46.8 101.4 98.9 54.4 52.1 98.8 95 98.8 95.4 0 .4-40.8 40.2-90.8 88.5C5.6 449.6 7 448.2 4 454.5c-3.7 7.6-4 19.2-.8 27.2 5.7 14 16.7 21.5 31.5 21.5 12.6 0 15.1-1.6 43.8-30 40-39.6 66.8-65.7 117.5-114.7 91.4-88.2 88.8-85.4 91.2-98.3 1.5-7.8-.8-17.6-5.5-24.3-3.5-5-3.2-4.7-136.4-133.3-77-74.3-91.2-87.6-96.5-90.3C41.9 8.8 35 7.7 28.1 9.1z"/>
          </svg>
        </a>Work
      </h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 mt-5 gap-4">
    <?php
      foreach($listWork as $work){
    ?>
      <a href="cardsData.php?action=loadCard&cards=<?=$work['id']?>" class="w-[345px] mb-4 text-center">
        <img src="http://localhost/What-install/src/backend/files/images/<?=$work['image1']?>" class="w-full border border-slate-300 dark:border-slate-700 rounded-xl h-44 object-cover">
        <h6 class="text-xl mt-3 font-semibold font-mplus"><?=$work['cardName']?></h6>
        <h1 class="opacity-70"><?=$work['title']?></h1>
      </a>
    <?php
    } 
    ?>
    </div>
  </section>
<footer class="text-center mt-4 p-3">
		<h1 class="opacity-40">© 2022 Sebass. All rights reserved. Web based on </h1><a href="https://www.craftz.dog/" class="opacity-50">Takuya Matsuyama's work</a>
</footer>

<script src="../js/app.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>