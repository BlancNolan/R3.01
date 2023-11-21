<?php
$dir = "./data";
$dh = opendir($dir);

while (false !== ($artist = readdir($dh))) {
    if($artist != "." && $artist != ".." && is_dir($dir . "/" . $artist)){
        
        $artist_dir = $dir . "/" . $artist;
        $artist_dh = opendir($artist_dir);

        while (false !== ($music = readdir($artist_dh))){
            if($music =="."||$music =="..") continue;
    
            $path_parts = pathinfo($music);
            if($path_parts['extension'] == "mp3"){
                echo $artist."|".$path_parts['filename']."\n";
            }
        }
    }
    

    
}

?>