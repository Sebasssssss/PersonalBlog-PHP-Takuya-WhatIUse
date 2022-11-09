<?php
require_once("models/cards_model.php");
require_once("models/categories_model.php");

$routePage      = "cards";
$objCards        = new cards_model();
$objCategories  = new categories_model();

if(isset($_POST['action']) && $_POST['action'] == "uploadingData"){

	$file1 = $objCards->uploadImage($_FILES['image1'], "1080", "1920");
	$file2 = $objCards->uploadImage($_FILES['image2'], "1080", "1920");
	$file3 = $objCards->uploadImage($_FILES['image3'], "1080", "1920");
	if($file1 != "" && $file2 != "" && $file3 != ""){

		$data = array();
		$data['title']			  = isset($_POST['txtTitle'])?$_POST['txtTitle']:"";
		$data['cardName']	    = isset($_POST['txtCardName'])?$_POST['txtCardName']:"";
		$data['description']	= isset($_POST['txtDescription'])?$_POST['txtDescription']:"";
		$data['categorie']		= isset($_POST['txtCategorie'])?$_POST['txtCategorie']:"";
		$data['image1']			  = $file1;
		$data['image2']			  = $file2;
		$data['image3']			  = $file3;

		$objCards->constructor($data);
		$return = $objCards->addNewCard();

	}else{
		$arrayReturn = array();
		$arrayReturn['code']    = "Error";
		$arrayReturn['message'] = "There was an error uploading the image";
	}
}

if(isset($_POST["action"]) && $_POST['action'] == "delete" && isset($_POST["id"]) && $_POST['id'] != ""){

		$id = $_POST['id'];
		$objCards->load($id);
		$return = $objCards->delete();

    if($return){
      $objCards->load($id);
      
      unlink('files/images/'.$objCards->getImage1());
      unlink('files/images/'.$objCards->getImage2());
      unlink('files/images/'.$objCards->getImage3());
    }
}
	
	if(isset($_POST["action"]) && $_POST['action'] == "edit" ){
			
			$data = array();
			$data['title']			  = isset($_POST['txtTitle'])?$_POST['txtTitle']:"";
			$data['cardName']	    = isset($_POST['txtCardName'])?$_POST['txtCardName']:"";
			$data['description']	= isset($_POST['txtDescription'])?$_POST['txtDescription']:"";
			$data['categorie']		= isset($_POST['txtCategorie'])?$_POST['txtCategorie']:"";
			$data['id']		        = isset($_POST['txtId'])?$_POST['txtId']:"";

			$file1 = $objCards->uploadImage($_FILES['image1'], "1080", "1920");
			$file2 = $objCards->uploadImage($_FILES['image2'], "1080", "1920");
			$file3 = $objCards->uploadImage($_FILES['image3'], "1080", "1920");

			if($file1 != "" || $file2 != "" || $file3 != ""){
		    $id = $_POST['txtId'];
        $objCards->load($id);

        if($file1 != ""){
          unlink('files/images/'.$objCards->getImage1());
  			  $data['image1'] 	= $file1;
        }else{
				  $data['image1'] 	= "";
        }

        if($file2 != ""){
          unlink('files/images/'.$objCards->getImage2());
  			  $data['image2'] 	= $file2;
        }else{
				  $data['image2'] 	= "";
        }

        if($file3 != ""){
          unlink('files/images/'.$objCards->getImage3());
  			  $data['image3'] 	= $file3;
        }else{
				  $data['image3'] 	= "";
        }
      
			}else{
				$data['image1'] 	= "";
				$data['image2'] 	= "";
				$data['image3'] 	= "";
			}

		$objCards->constructor($data);
		$return = $objCards->edit();

	}

	$search = isset($_POST['searcher'])?$_POST['searcher']:"";
	if($search == "" && isset($_GET['searcher']) && ($_GET['searcher']) != ""){
		$search = $_GET['searcher'];
	}

	$arrayFilters = array("search"=>$search);
	$maximum = $objCards->maximumPages();
	if(isset($_GET['page']) && $_GET['page'] !=""){
		$page = (int)$_GET['page'];

		if($page < 1){
			$page = 1;
		}elseif($page > $maximum){
			$page = $maximum;
		}elseif(!is_int($page)){
			$page = 1;
		}

		$lastPage = $page - 1;
		if($lastPage < 1){
			$lastPage = 1;
		}

		$nextPage = $page + 1;
		if($nextPage > $maximum){
			$nextPage = $maximum;
		}
	}else{
		$page 			= 1;
		$lastPage	 	= 1;
		$nextPage	  = 2;
	}

	$arrayFilters['page'] = $page - 1;
	$cardsData = $objCards->listCards($arrayFilters);
	$listCategories = $objCategories->listSelect();
?>

<main class="h-80 pt-[56px]">
    <div class="flex flex-col gap-4 justify-center text-center py-5 absolute w-full bg-cover h-80 drop-shadow-lg shadow-black overflow-hidden">
    <video src="../frontend/images/What-Video.mp4" muted="muted" autoplay="autoplay" loop="loop" class="absolute opacity-30 w-full h-[550px] md:h-full object-cover" playsinline></video>
    <h1 class="text-sm z-10 uppercase">Welcome to the backend!</h1>
    <h1 class="text-4xl font-medium font-mplus z-10">Cards <span class="text-orange-500">section</span></h1>
  </div>
</main>
  <div id="modal-container" class="w-full h-screen z-40 fixed left-0 top-0 justify-center items-center flex backdrop-blur-sm opacity-0 invisible">
    <div id="modal-content" class="relative bg-orange-100 dark:bg-neutral-900 border border-slate-300 dark:border-slate-700 w-max sm:w-[700px] h-[600px] sm:h-[460px] z-30 rounded-lg shadow-2xl flex flex-col justify-evenly text-center items-center translate-y-0 translate-y-[-200%] transition-transform duration-300">
      <svg id="close" class="w-3 h-3 ml-[9px] hover:opacity-90 absolute top-4 right-4 cursor-pointer" fill="currentColor" xml:space="preserve" viewBox="0 0 121.31 122.876">
        <path fill-rule="evenodd" d="M90.914 5.296c6.927-7.034 18.188-7.065 25.154-.068 6.961 6.995 6.991 18.369.068 25.397L85.743 61.452l30.425 30.855c6.866 6.978 6.773 18.28-.208 25.247-6.983 6.964-18.21 6.946-25.074-.031L60.669 86.881 30.395 117.58c-6.927 7.034-18.188 7.065-25.154.068-6.961-6.995-6.992-18.369-.068-25.397l30.393-30.827L5.142 30.568c-6.867-6.978-6.773-18.28.208-25.247 6.983-6.963 18.21-6.946 25.074.031l30.217 30.643L90.914 5.296z" clip-rule="evenodd"/>
      </svg>
      <h1 class="text-lg font-semibold">Let's add some data!</h1>
      <form action="index.php?r=<?=$routePage?>" enctype="multipart/form-data" method="post">
        <div class="p-5 text-black grid grid-cols-1 sm:grid-cols-2 gap-5">
          <input placeholder="Title" name="txtTitle" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
          <input placeholder="Card Name" name="txtCardName" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
          <input name="image1" type="file" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all block file:w-18 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
          <input name="image2" type="file" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all block file:w-18 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-900 hover:file:bg-violet-100">
          <input name="image3" type="file" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all block file:w-18 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-800 hover:file:bg-violet-100">

          <select name="txtCategorie" value="<?=$listCategories['id']?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
            <option disabled selected>Choose a categorie</option>

            <?php
              foreach($listCategories as $categories){
            ?>
            <option value="<?=$categories['id']?>" class="py-2 rounded-md"><?=$categories['name']?></option>
            <?php
              }
            ?>

          </select>
        </div>
        <div class="px-5 pb-2">
          <textarea placeholder="Description" name="txtDescription" rows="4" class="rounded-lg p-2 w-full h-24 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all resize-none text-black"><?=$objCards->getDescription()?></textarea>
        </div>
        <button name="action" value="uploadingData" type="sumbit" class="rounded-lg shadow p-2 w-36 h-10 outline-0 border border-700 bg-amber-700 hover:bg-orange-200 dark:hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">Send Form!</button>
      </form>
    </div>
  </div>

  <?php 
    if(isset($return['code']) && $return['code'] == "Error"  ){
  ?>
  <div class="fixed bottom-2 right-2 z-20">
    <div class="container text-center bg-red-700 rounded-md w-max mx-auto p-4 m-4 mt-20 relative">
      <svg id="signsErrorSucces" class="w-3 h-3 hover:opacity-90 absolute top-2 right-2 cursor-pointer" fill="currentColor" xml:space="preserve" viewBox="0 0 121.31 122.876" onclick="hideSigns()">
        <path fill-rule="evenodd" d="M90.914 5.296c6.927-7.034 18.188-7.065 25.154-.068 6.961 6.995 6.991 18.369.068 25.397L85.743 61.452l30.425 30.855c6.866 6.978 6.773 18.28-.208 25.247-6.983 6.964-18.21 6.946-25.074-.031L60.669 86.881 30.395 117.58c-6.927 7.034-18.188 7.065-25.154.068-6.961-6.995-6.992-18.369-.068-25.397l30.393-30.827L5.142 30.568c-6.867-6.978-6.773-18.28.208-25.247 6.983-6.963 18.21-6.946 25.074.031l30.217 30.643L90.914 5.296z" clip-rule="evenodd"/>
      </svg>
      <h3 class="font-semibold text-lg inline-flex items-center">
      <svg class="w-5 h-5" fill="currentColor" version="1.0" viewBox="0 0 512 512">
        <path d="M243.3 47.9c-9.5 3.3-18.7 10.6-25.8 20.5-2.3 3.4-22.5 36-44.7 72.6-22.3 36.6-66.9 109.7-99 162.6-32.2 52.8-59.9 98.7-61.6 102-4.9 9.7-6.4 16.4-6 26.2.2 6.5.9 9.9 2.6 13.4 5 10 15.6 17.3 29.8 20.3 10.3 2.2 423.4 2.2 433.7 0 14.3-3 24.3-10 29.4-20.4 2.5-5 2.8-6.6 2.8-15.6-.1-8.7-.5-11-3.1-17.5-1.7-4.3-17.2-30.8-35.9-61.5-18.1-29.7-63.9-104.8-101.7-166.9-37.9-62.1-70.7-115.4-73.1-118.4-11.9-15.6-31.7-22.8-47.4-17.3zm29.2 108.2c2.3.7 5.7 2.8 8.1 5.3 2.5 2.4 4.6 5.8 5.3 8.1 1.5 5.6 1.5 137.4 0 143-1.5 5.2-8.2 11.9-13.4 13.4-5.2 1.4-28.8 1.4-34 0-5.2-1.5-11.9-8.2-13.4-13.4-1.5-5.5-1.5-137.4 0-142.9 1.4-5 7.3-11.3 12.4-13.1 4.9-1.7 29.1-2 35-.4zM266.4 360c7.2 2.7 13.9 8.8 17.3 15.8 2.4 4.9 2.8 6.9 2.7 13.7-.1 13.1-5.6 22-17.2 27.7-5.8 2.9-7.6 3.3-14.2 3.2-9.1-.1-15.3-2.7-21.8-9.2-14-13.9-11.5-36.7 5.2-48 2.7-1.7 6.2-3.6 8-4.1 5.5-1.6 14.2-1.2 20 .9z"/>
      </svg><?=$return['code']?></h3>
      <h6><?=$return['message']?></h6>
    </div>
  </div>
  <?php
    }
  ?>

<?php 
  if(isset($return['code']) && $return['code'] == "Succes"  ){
?>
  <div class="fixed bottom-2 right-2 z-20">
    <div class="container text-center bg-green-600 rounded-md w-max p-2 m-2 relative">
      <svg id="signsErrorSucces" class="w-3 h-3 hover:opacity-90 absolute top-2 right-2 cursor-pointer" fill="currentColor" xml:space="preserve" viewBox="0 0 121.31 122.876" onclick="hideSigns()">
        <path fill-rule="evenodd" d="M90.914 5.296c6.927-7.034 18.188-7.065 25.154-.068 6.961 6.995 6.991 18.369.068 25.397L85.743 61.452l30.425 30.855c6.866 6.978 6.773 18.28-.208 25.247-6.983 6.964-18.21 6.946-25.074-.031L60.669 86.881 30.395 117.58c-6.927 7.034-18.188 7.065-25.154.068-6.961-6.995-6.992-18.369-.068-25.397l30.393-30.827L5.142 30.568c-6.867-6.978-6.773-18.28.208-25.247 6.983-6.963 18.21-6.946 25.074.031l30.217 30.643L90.914 5.296z" clip-rule="evenodd"/>
      </svg>
      <h3 class="font-semibold text-lg inline-flex items-center">
      <svg class="w-5 h-5" fill="currentColor" version="1.0" viewBox="0 0 512 474">
        <path d="M492 9.6C382 75.8 263.8 189.8 159.5 330.5c-9.8 13.2-18.3 24.6-19 25.3-1.2 1.3-13.1-5.2-112-61.2L4.5 281l-1.7 2.2c-2 2.7-5.2-1.4 30.2 39.8 91 106.1 129.7 150.5 131.4 150.5 1.3 0 6.1-8.6 18.8-33 89.7-173.9 179.4-295 309.3-418.3 15.4-14.6 17.8-17.3 16.9-18.8-.6-1-1.5-1.9-2.1-2.1-.5-.2-7.4 3.5-15.3 8.3z"/>
      </svg><?=$return['code']?></h3>
      <h6><?=$return['message']?></h6>
    </div>
  </div>
<?php
}
?>

<div class="inline-flex items-center text-center w-full justify-center mx-auto mt-20 py-2 gap-2">
  <a class="cursor-pointer" href="index.php?r=<?=$routePage?>">
    <div class="bg-orange-100 dark:bg-amber-700 border-2 border-orange-200 dark:border-amber-900 text-center rounded-lg px-1 py-1 shadow-md">
      <svg class="w-6 h-6" fill="currentColor" version="1.0" viewBox="0 0 128 128">
        <path d="M53 24.6c-7.7 2.1-12.8 5.4-19.3 12.3C26 45.3 23.6 51.7 23.6 64c0 7.5.5 10.7 2.3 15.3 2.6 6.7 11 16.3 17.6 20.1 10.2 6 24.2 7 35.8 2.6 11.1-4.2 23.5-18.8 25.3-29.7.5-3.4.2-4.5-1.5-6.2-3.9-3.9-8.5-2.1-10.1 4.2-1.5 5.4-7 13.8-11.3 17.1-7.9 6-20.3 7.4-29.2 3.2-7.3-3.4-11-6.9-14.4-13.8C28.4 57.5 42.3 35 64 35c5 0 7.8.6 12 2.7l5.5 2.7-4.8.6c-5 .6-6.7 2-6.7 5.6C70 51 72.8 52 84.7 52c14.4 0 14.3.1 14.3-14.7 0-9.4-.3-11.2-1.8-12.6-3.5-3.2-8.2-1.5-9.7 3.3l-.7 2.1-3.2-2C76 23.3 63.1 21.9 53 24.6z"/>
      </svg>
    </div>
  </a>
  <form action="index.php?r=<?=$routePage?>" method="POST" class="relative">
    <input placeholder="Search" type="search" name="searcher" class="search input w-full py-1 pl-8 border-2 border-solid rounded-md outline-0 bg-white transition duration-300">
    <svg class="absolute left-3 top-2.5 w-4 h-4 fill-neutral-300" version="1.0" viewBox="0 0 128 128">
      <path d="M41.5 9.4c-7.2 2.3-12.8 5.8-18.5 11.5C5.7 38.1 6.2 65.4 24 82.4 37.7 95.5 55.3 98.2 72.9 90l6.5-3.1L96 103.5l16.5 16.5 3.8-3.7 3.7-3.8L103.5 96 87 79.5l3-4.5c4.2-6.3 7-15.9 7-24.1C97 32 84.8 15.5 66.7 9.8c-6.8-2.1-19.2-2.3-25.2-.4zm28.8 7.4c7.7 3.8 14.8 11.1 18.5 19 2.3 4.9 2.7 7 2.7 15.2 0 8.6-.3 10.1-3.2 16.2-16.1 34-65.6 27.2-72.3-10-3.4-18.8 9.5-38.5 28.4-43.3 1.7-.4 6.8-.7 11.3-.5 6.8.2 9.2.8 14.6 3.4z"/>
    </svg>
  </form>
  <a href="#" id="modalOpen" class="bg-orange-100 dark:bg-amber-700 border-2 border-orange-200 dark:border-amber-900 text-center rounded-lg px-4 py-1 shadow-md">Add data!</a>
</div>


<?PHP 
  if(isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['cards']) && $_GET['cards'] != ""  ){
?>
<div class="text-center h-32 w-max mx-auto border rounded-lg p-2 bg-orange-100 dark:bg-zinc-800 border-orange-200 dark:border-zinc-700 shadow-lg transition-colors duration-500">
  <form action="index.php?r=<?=$routePage?>" method="POST">
      <div class="py-2 text-md">
          <h3 class="font-semibold">Delete data</h3>
          <h4>Are you sure you want to delete <?=$_GET['cards']?>?</h4>
      </div>
      <input type="hidden" name="id" value="<?=$_GET['cards']?>">
      <div class="inline-flex items-center gap-2">
        <button type="submit" name="action" value="delete">
          <svg class="w-8 h-8 border bg-orange-200 dark:bg-orange-900 border-orange-300 dark:border-orange-700 rounded" fill="currentColor" version="1.0" viewBox="0 0 256 256">
            <path d="M54.1 116.3c-1.9.6-4.9 2.6-6.8 4.4-2.6 2.7-3.3 4.2-3.3 7.3 0 4.9 4.6 10 10.7 11.8 5.8 1.7 140.8 1.7 146.6 0 6.1-1.8 10.7-6.9 10.7-11.8s-4.6-10-10.7-11.8c-5.4-1.6-142.1-1.5-147.2.1z"/>
          </svg>
        </button>
        <button type="submit" value="cancel" class="w-8 h-8 border bg-orange-200 dark:bg-orange-900 border-orange-300 dark:border-orange-700 rounded">
          <svg class="w-3 h-3 ml-[9px]" fill="currentColor" xml:space="preserve" viewBox="0 0 121.31 122.876">
            <path fill-rule="evenodd" d="M90.914 5.296c6.927-7.034 18.188-7.065 25.154-.068 6.961 6.995 6.991 18.369.068 25.397L85.743 61.452l30.425 30.855c6.866 6.978 6.773 18.28-.208 25.247-6.983 6.964-18.21 6.946-25.074-.031L60.669 86.881 30.395 117.58c-6.927 7.034-18.188 7.065-25.154.068-6.961-6.995-6.992-18.369-.068-25.397l30.393-30.827L5.142 30.568c-6.867-6.978-6.773-18.28.208-25.247 6.983-6.963 18.21-6.946 25.074.031l30.217 30.643L90.914 5.296z" clip-rule="evenodd"/>
          </svg>
        </button>
      </div>
  </form>
</div>
<?php
}
?>
  
            
    <!-- EDIT CARDS -->			
<?PHP 
  if(isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['cards']) && $_GET['cards'] != ""  ){
    $objCards->load($_GET['cards']);
?>

<div class="text-center mx-auto w-[350px] sm:w-max bg-orange-100 dark:bg-neutral-900 border border-slate-300 dark:border-slate-700 rounded-lg shadow-2xl flex flex-col justify-evenly items-center transition ease-in-out duration-500"> 
  <h3 class="font-semibold sm:text-xl">Edit Card</h3>
  <form action="index.php?r=<?=$routePage?>" enctype="multipart/form-data" method="post">
    <div class="p-5 text-black grid grid-cols-1 md:grid-cols-2 gap-5">
      <input placeholder="Title" name="txtTitle" value="<?=$objCards->getTitle()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
      <input placeholder="Card Name" name="txtCardName" value="<?=$objCards->getCardName()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
      <input placeholder="Image" type="file" name="image1" value="<?=$objCards->getImage1()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all block file:w-18 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
      <input placeholder="Image" type="file" name="image2" value="<?=$objCards->getImage2()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all block file:w-18 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
      <input placeholder="Image" type="file" name="image3" value="<?=$objCards->getImage3()?>" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all block file:w-18 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
      <input name="txtId" type="hidden" value="<?=$objCards->getId()?>">
      <select name="txtCategorie" class="rounded-lg p-2 w-full h-10 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all">
          <option disabled selected>Choose a categorie</option>
          <?php
            foreach($listCategories as $categories){
          ?>
            <option value="<?=$categories['id']?>" class="py-2 rounded-md" <?php if($categories['id'] == $objCards->getCategorie()){ echo("selected");} ?>><?=$categories['name']?></option>
          <?php
            }
          ?>
      </select>
    </div>
    <div class="px-5">
      <textarea placeholder="Description" name="txtDescription" rows="4" class="rounded-lg p-2 w-full h-24 outline-0 border border-700 bg-white hover:bg-orange-200 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 transition-all resize-none text-black"><?=$objCards->getDescription()?></textarea>
    </div>
      <button type="submit" name="action" value="edit" class="bg-orange-100 dark:bg-slate-900 text-center rounded px-4 py-2 font-semibold text-sm">Send!</button>
      <button type="submit" value="cancel" class="bg-orange-100 dark:bg-slate-900 text-center rounded px-4 py-2 font-semibold text-sm">Cancel</button>	
  </form>
</div>
<?php
  }
?>

<div class="overflow-x-auto py-2">
  <table class="container mx-auto text-center w-[895px] shadow rounded-md font-mplus">
    <thead>
        <tr class="uppercase font-semibold text-xs border-gray-200 bg-orange-100 dark:bg-zinc-600 transition duration-500">
          <th class="py-5">images</th>
          <th>Title</th>
          <th>card Name</th>
          <th>description</th>
          <th>categorie</th>
          <th>Buttons</th>
        </tr>
    </thead>

    <tbody>

    <?php
      foreach($cardsData as $cards){

    ?>
      <tr class="border border-orange-100 dark:border-slate-700 text-sm">
          <td class="flex relative px-5 w-max mt-3"><img src="files/images/<?=$cards['image1']?>" class="w-12 h-12 rounded-full object-cover z-20 absolute md:relative shadow-sm left-0"><img src="files/images/<?=$cards['image2']?>" class="w-12 h-12 rounded-full object-cover z-10 absolute left-4 md:left-8 shadow-md"><img src="files/images/<?=$cards['image3']?>" class="w-12 h-12 rounded-full object-cover absolute left-7 md:left-11 shadow-lg"></td>
          <td class="py-5 px-2"><?=$cards['title']?></td>
          <td class="px-2"><?=$cards['cardName']?></td>
          <td class="whitespace-nowrap overflow-hidden text-ellipsis max-w-[100px] px-2"><?=$cards['description']?></td>
          <td class="px-2"><?=$cards['name']?></td>
          <td class="py-5">
          <div class="flex flex-col gap-4 md:flex-row md:gap-1">
            <a href="index.php?r=<?=$routePage?>&action=delete&cards=<?=$cards['id']?>">
              <svg class="w-8 h-8 border bg-orange-200 dark:bg-orange-900 border-orange-300 dark:border-orange-700 rounded transition duration-500" fill="currentColor" version="1.0" viewBox="0 0 256 256">
                <path d="M54.1 116.3c-1.9.6-4.9 2.6-6.8 4.4-2.6 2.7-3.3 4.2-3.3 7.3 0 4.9 4.6 10 10.7 11.8 5.8 1.7 140.8 1.7 146.6 0 6.1-1.8 10.7-6.9 10.7-11.8s-4.6-10-10.7-11.8c-5.4-1.6-142.1-1.5-147.2.1z"/>
              </svg>
            </a>
            <a href="index.php?r=<?=$routePage?>&action=edit&cards=<?=$cards['id']?>">
              <svg class="w-8 h-8 border bg-orange-200 dark:bg-orange-900 border-orange-300 dark:border-orange-700 rounded transition duration-500" fill="currentColor" version="1.0" viewBox="0 0 256 256">
                <path d="M178.5 42.4c-1.6.8-7 5.4-11.8 10.3l-8.8 8.9 18.1 18 18 17.9 10-10c9.3-9.4 10-10.3 10-14 0-3.8-.7-4.7-13.7-17.7-7.9-7.9-14.9-13.9-16.3-14.2-1.4-.3-3.8.1-5.5.8zm-84.3 82.9L41 178.5V215h35.5l53.5-53.5 53.5-53.5-18-18-18-18-53.3 53.3z"/>
              </svg>
            </a>
          </div>
        </td>
      </tr>
    <?php
      }
    ?>

        <!-- PAGINADOR -->

      <tr>
        <td colspan="8" class="right-0 left-0 ml-auto mr-auto absolute text-center w-max mt-2 border shadow-xl rounded-lg border-slate-300 dark:border-slate-700 text-sm">
          <ul class="inline-flex items-center conteiner py-3">
            <li>
              <a href="index.php?r=<?=$routePage?>&page=<?=$lastPage?>&searcher=<?=$search?>">
                <svg class="w-6 h-6 px-1" fill="currentColor" version="1.0" width="42.667" height="42.667" viewBox="0 0 32 32">
                  <path d="M14 9.4c-10.4 5.7-10.4 7.1-.3 13 11 6.5 11.7 6.2 12.4-4.9.7-9.5 0-12.6-2.9-12.4-.9.1-5.1 2-9.2 4.3z"/>
                </svg>
              </a>
            </li>

            <?php
              for($i = 1; $i <= $maximum; $i++){
                $class = "hover:opacity-90";
                if($i == $page){
                  $class = "bg-orange-200 dark:bg-amber-700 rounded";
              }
            ?>
              <li class="<?=$class?>">
                <a href="index.php?r=<?=$routePage?>&page=<?=$i?>&searcher=<?=$search?>" class="p-3 font-semibold"><?=$i?></a>
              </li>
            <?php
              }
            ?>

            <li>
              <a href="index.php?r=<?=$routePage?>&page=<?=$nextPage?>&searcher=<?=$search?>">
                <svg class="w-6 h-6 px-1" fill="currentColor" version="1.0" width="42.667" height="42.667" viewBox="0 0 32 32">
                  <path d="M6.4 6.3c-.3.8-.3 5.6-.2 10.8.4 11.6 1 11.9 12.1 5.4 10.1-5.9 10.1-7.1 0-12.9-8.1-4.7-11-5.5-11.9-3.3z"/>
                </svg>
              </a>
            </li>
          </ul>
        </td>
      </tr>
    </tbody>
  </table>
</div>

