<?php
  
  require_once("models/aboutme_model.php");
  
  $objAboutme = new aboutme_model();
  $routePage = "aboutme";
	

if(isset($_POST["action"]) && $_POST['action'] == "editProfile" ){
    

    $data = array();
    $data['name']		  	  = isset($_POST['txtName'])?$_POST['txtName']:"";
    $data['description']	= isset($_POST['txtDescription'])?$_POST['txtDescription']:"";
    $data['dateOfBirth']	= isset($_POST['txtDateOfBirth'])?$_POST['txtDateOfBirth']:"";
    $data['location']		  = isset($_POST['txtLocation'])?$_POST['txtLocation']:"";
    $data['id']		        = isset($_POST['txtId'])?$_POST['txtId']:"";

  $file = $objAboutme->uploadImage($_FILES['profilePicture'], "512", "512");
  if($file){
    $id = $_POST['txtId'];
    $objAboutme->load($id);
    
    unlink('files/images/'.$objAboutme->getProfilePicture());
    $data['profilePicture'] 	= $file;
    
  }else{

    $data['profilePicture'] 	= "";

  }
  $objAboutme->constructor($data);
  $return = $objAboutme->edit();

  }

  $profileData = $objAboutme->profileData();
  
  $listCards = $objAboutme->listCardsAboutMe();

?>
<!DOCTYPE html>
<html>
<body>
  
<main class="h-[22rem] md:h-[25rem]">
	<div class="flex flex-col font-mplus gap-2 justify-center text-center py-5 absolute w-full bg-cover h-72 md:h-96 drop-shadow-lg shadow-black">
		<video src="../frontend/images/What-Video.mp4" muted="muted" autoplay="autoplay" loop="loop" class="absolute opacity-30 w-full h-96 object-cover" playsinline></video>

<?php
foreach($profileData as $profile){
?>
    <img src="files/images/<?=$profile['profilePicture']?>" class="rounded-full w-24 mx-auto z-20 border border-slate-300 dark:border-slate-700 opacity-90 h-24 object-cover">
    <h1 class="z-20 text-lg"><?=$profile['name']?></h1>
<?php
}
?>
	</div>
</main>

<?PHP 
	if(isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['aboutme']) && $_GET['aboutme'] != ""  ){
		$objAboutme->load($_GET['aboutme']);
?>
<div class="text-center mx-auto w-96 sm:w-max bg-orange-100 dark:bg-neutral-900 border border-slate-300 dark:border-slate-700 z-30 rounded-lg shadow flex flex-col justify-evenly text-center items-center p-5 transition ease-in-out duration-500"> 
	<h3 class="font-semibold sm:text-xl font-mplus">Let's edit your profile!</h3>
	<form action="index.php?r=<?=$routePage?>" enctype="multipart/form-data" method="post">
		  <div class="p-5 text-black grid grid-cols-1 sm:grid-cols-2 gap-5">
			  <input type="file" name="profilePicture" value="<?=$objAboutme->getProfilePicture()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all block file:w-18 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
        <input placeholder="Name" name="txtName" value="<?=$objAboutme->getName()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
        <input placeholder="Date of Birth" name="txtDateOfBirth" type="date" value="<?=$objAboutme->getDateOfBirth()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
        <input placeholder="Location" name="txtLocation" type="txt" value="<?=$objAboutme->getLocation()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
        <input type="hidden" name="txtId" value="<?=$objAboutme->getId()?>">
      </div>
      <div class="px-5">
        <textarea placeholder="Description" name="txtDescription" rows="4" class="rounded-lg p-2 w-full h-24 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all resize-none text-black"><?=$objAboutme->getDescription()?></textarea>
      </div>
          <button type="submit" name="action" value="editProfile" class="border bg-orange-200 dark:bg-orange-900 border-orange-200 dark:border-orange-700 text-center rounded px-4 py-2 font-semibold text-sm shadow">Send!</button>
          <button type="submit" value="cancel" class="border bg-orange-200 dark:bg-orange-900 border-orange-200 dark:border-orange-700 text-center rounded px-4 py-2 font-semibold text-sm shadow">Cancel</button>	
  </form>
</div>
<?php
	}
?>

<?PHP 
	if(isset($answer['code']) && $answer['code'] == "Error"  ){
?>
  <div class="container text-center bg-red-700 rounded-md w-max mx-auto p-4">
      <h3 class="font-semibold text-lg"><i class="fi fi-br-cross px-2 text-sm"></i><?=$answer['code']?></h3>
      <h6><?=$answer['message']?></h6>
  </div>
<?PHP
	}
?>

<?PHP 
	if(isset($answer['code']) && $answer['code'] == "Succes"  ){
?>
  <div class="container text-center bg-green-600 rounded-md w-max mx-auto p-4">
      <h3 class="font-semibold text-lg"><i class="fi fi-sr-comment-check px-2 text-sm"></i><?=$answer['code']?></h3>
      <h6><?=$answer['message']?></h6>
  </div>
<?PHP
	}
?>
<section class="px-8 mx-auto max-w-3xl">
<?php
    foreach($profileData as $profile){
?>
  <div class="w-full text-right">
    <a href="index.php?r=<?=$routePage?>&action=edit&aboutme=<?=$profile['id']?>" class="p-2 bg-orange-200 dark:bg-zinc-800 rounded transition duration-500 shadow-md inline-flex items-center gap-2"><span class="uppercase">Edit profile</span>
      <svg class="w-4 h-4" fill="currentColor" version="1.0" viewBox="0 0 256 256">
        <path d="M178.5 42.4c-1.6.8-7 5.4-11.8 10.3l-8.8 8.9 18.1 18 18 17.9 10-10c9.3-9.4 10-10.3 10-14 0-3.8-.7-4.7-13.7-17.7-7.9-7.9-14.9-13.9-16.3-14.2-1.4-.3-3.8.1-5.5.8zm-84.3 82.9L41 178.5V215h35.5l53.5-53.5 53.5-53.5-18-18-18-18-53.3 53.3z"/>
      </svg>
    </a>
  </div>
	<div class="border-b border-opacity-10 w-max border-orange-400 hover:border-opacity-20 cursor-pointer transition-colors duration-600">
		<h1 id="categorysText" class="group text-orange-700 dark:text-orange-500 font-mplus inline-flex items-center">
      <a href="index.php">
        <svg class="fill-zinc-900 dark:fill-zinc-300 group-hover:translate-x-[2px] w-5 h-3 pr-2 opacity-40 lg:hover:opacity-70 transition ease-in-out duration-300" version="1.0" viewBox="0 0 504 512">
          <path d="M240.3 1.4c-9.2 3-16.7 9.8-20.9 19.1-3.6 7.9-3.8 18.2-.4 27 2.1 5.8 6.3 10.1 102.8 106.7l100.6 100.7-16.4 16.8c-9.1 9.2-53.6 54.3-99 100.1s-83.7 85.2-85.3 87.4c-8.7 13.1-6.3 32.3 5.5 43.4 7.3 6.8 12.6 8.9 22.8 8.9 15.1 0 10.5 3.9 90.8-77.3 141.3-143 156-158.2 159-164.2 2.4-4.8 2.7-6.7 2.7-15s-.3-10.2-2.7-15c-2.3-4.6-21.4-24.3-116.3-119.7C257.8-6.1 265.6 1 251.7.4c-4.3-.2-8.9.2-11.4 1z"/>
          <path d="M28.1 9.1C13.2 12 2.1 24.9 1.2 40.3c-.5 8.1 1 14.7 4.6 20.5 1.5 2.3 47.1 46.8 101.4 98.9 54.4 52.1 98.8 95 98.8 95.4 0 .4-40.8 40.2-90.8 88.5C5.6 449.6 7 448.2 4 454.5c-3.7 7.6-4 19.2-.8 27.2 5.7 14 16.7 21.5 31.5 21.5 12.6 0 15.1-1.6 43.8-30 40-39.6 66.8-65.7 117.5-114.7 91.4-88.2 88.8-85.4 91.2-98.3 1.5-7.8-.8-17.6-5.5-24.3-3.5-5-3.2-4.7-136.4-133.3-77-74.3-91.2-87.6-96.5-90.3C41.9 8.8 35 7.7 28.1 9.1z"/>
        </svg>
      </a>
      About me
    </h1>
	</div>
	<div class="pt-5">
		<p class="text-left indent-4">
        <?=$profile['description']?>
		</p>	
	</div>
  <h1 class="py-4 flex items-center">
    <svg class="w-7 h-7 pr-2" fill="currentColor" version="1.0" viewBox="0 0 128 128">
      <path d="M60.5 14.6c-3.6 5.6-3.7 12.4-.2 14.6 1.9 1.1 4-1.2 2.6-2.9-.9-1-.9-1.7-.1-2.5 1.9-1.9 4.2-.1 4.2 3.3 0 2.7.2 3 1.5 1.9.9-.8 1.5-2.9 1.5-5.6 0-3.4-.7-5.1-3.1-7.9-1.7-1.9-3.5-3.5-3.9-3.5-.4 0-1.5 1.2-2.5 2.6z"/>
      <path d="M64.4 25.8c1 3.1-2 7.2-5.3 7.2h-2.6l.3 9 .3 9H45.7c-6.4 0-12.2.3-13.1.6-1.2.5-1.6 2.1-1.6 6.6v6l2.8-.7c3.6-.9 6.2-3.3 6.2-5.9.1-5.3 3.4-5.8 4.5-.7.9 4.4 4 6.6 9.1 6.6 5 0 7.3-1.8 8.3-6.6.7-3.7 2.8-5 3.7-2.2 1.9 5.7 2.9 7.2 5.5 8.3 5.1 2.2 11.9-1 11.9-5.5 0-3 2.2-4.9 3.8-3.3.7.7 1.2 2 1.2 2.9 0 2.5 3.1 5.7 6.3 6.5l2.7.6v-6c0-4.5-.4-6.1-1.6-6.6-.9-.3-6.7-.6-13.1-.6H70.8l.4-10.6c.3-9.6.2-10.5-1.4-10-5.7 1.8-6.3 1.9-5 .5 1.5-1.6 1.6-5.5.1-6.5-.7-.4-.9 0-.5 1.4z"/>
      <path d="M39.1 65.7C37.2 67 34.7 68 33.4 68c-2 0-2.3.6-2.6 4.2-.3 3.6-.7 4.3-2.8 4.8-2.3.5-2.5 1.1-2.8 7.3-.3 6.2-.1 6.7 1.8 6.7 4.5 0 7.8-2.8 8.7-7.2.7-3.3 1.3-4.3 2.8-4.3 1.4 0 2.2 1 2.8 3.7 1.3 5.4 3.9 7.3 10.2 7.3 6.4 0 9.1-2 10-7.6.9-5.3 3.2-4.8 5.4 1.1 3.7 10 17.3 9.4 19.9-1 .9-4 4.4-5 5-1.5 1 6.2 4.2 9.5 9.3 9.5 1.8 0 2-.6 1.7-6.7-.3-6.2-.5-6.8-2.8-7.3-2.1-.5-2.5-1.2-2.8-4.8-.3-3.6-.6-4.2-2.6-4.2-1.3 0-3.8-1-5.7-2.3l-3.4-2.3-3.4 2.3C80.2 67 77.2 68 75.3 68 71.5 68 65 65.4 65 63.9c0-.5-1.3 0-2.9 1.2-4.6 3.4-11.8 3.7-16.1.7l-3.5-2.4-3.4 2.3z"/>
      <path d="M38 91c0 1.4-7.7 4.9-10.7 5-2.1 0-2.3.5-2.3 5 0 4.3-.3 5-2 5-3.7 0-5.4 6.5-2.4 9.4 1.4 1.4 6.7 1.6 43.8 1.6 31.5 0 42.5-.3 43.4-1.2 1.6-1.6 1.6-7 0-8.6-.7-.7-2-1.2-3-1.2-1.5 0-1.8-.8-1.8-4.9v-4.8l-3.9-.7c-2.2-.3-5.3-1.7-6.9-3.1-2.9-2.4-3-2.4-4.7-.5-4.1 4.6-15.1 5.1-20.6 1.1L64 90.9 61.2 93c-5.6 4.1-14.9 3.8-20.2-.6-1.6-1.4-3-2.1-3-1.4z"/>
    </svg><?=$profile['dateOfBirth']?>
  </h1>
  <h1 class="inline-flex items-center">
    <svg class="w-7 h-7 pr-2" fill="currentColor" version="1.0" viewBox="0 0 128 128">
      <path d="M54.2 8.8c-13.9 5-23.3 19.2-21.9 33.1.8 7.5 8.1 22.3 19.5 39.1 5 7.4 10 14.6 11 15.9l1.9 2.3 5-6.8c9.6-13 16.4-23.9 21.5-34.2 6-12.2 7.2-20.3 4.4-28.8C90 12.6 70.6 3 54.2 8.8zM71 27.5c3.8 1.9 6 6.3 6 11.6 0 3.3-.6 4.7-3.3 7.4-8.7 8.7-22.6 2.6-21.4-9.5 1-8.8 10.5-13.7 18.7-9.5z"/>
      <path d="M30.3 80.4c-21.5 7-27.6 18-15.7 28.5 9 7.9 26.5 12.1 50.3 12.1 22.6 0 39.5-4.2 48.4-12.1 7.8-6.8 8.1-13.5 1.1-20.1-3.7-3.4-14.1-8.2-21.7-9.8-5.3-1.2-5.8-1.2-7.1.6-1.4 1.8-1 2 5.7 3.7 9 2.1 19 7 21.7 10.4 3.1 3.9 2.6 7.1-1.9 11.4-7.1 6.6-21 10.6-41.1 11.6-31.4 1.5-59.5-8.4-56.6-20 1.2-5.1 12.9-11.5 25.6-13.9 6.6-1.3 6.6-1.3 5-3.3-1.7-2.1-5.2-1.8-13.7.9z"/>
      <path d="M46 92.2c-4 2.1-4.5 2.7-4.5 5.8 0 3.2.4 3.7 5 6 4.1 2 6.9 2.5 15.1 2.8 12.6.5 20.5-1 24.7-4.8 2.9-2.5 3-3 1.9-5.4-.7-1.7-3-3.5-5.8-4.7-4.4-2-4.6-2-5.9-.2-1.3 1.6-1 2 3.1 3.7 2.5 1 4.3 2.4 4.1 3-1.3 4-25.2 5.6-33.9 2.3-2.7-1-4.8-2.2-4.8-2.7 0-.7 2.4-1.8 7.3-3.4 1.5-.5 1.6-.9.5-2.6-1.6-2.5-1.4-2.5-6.8.2z"/>
    </svg><?=$profile['location']?>.
  </h1>	
<?php
}
?>
  <div class="grid grid-cols-1 md:grid-cols-2 mt-8 gap-4">
	<?php
		foreach($listCards as $cards){
	?>
		<a href="#" class="w-[345px] mb-4 text-center">
			<img src="http://localhost/What-install/src/backend/files/images/<?=$cards['image1']?>" class="w-full border border-slate-300 dark:border-slate-700 rounded-xl h-44 object-cover">
			<h6 class="text-xl mt-3 font-semibold font-mplus"><?=$cards['cardName']?></h6>
			<h1 class="opacity-70"><?=$cards['subtitle']?></h1>
		</a>
	<?php
	} 
	?>
	</div>
</section>

</body>
</html>
