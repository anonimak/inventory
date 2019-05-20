<?php

function upload_file($data_file,$path,$old_file='',$array=false, $index=0){
    if ($array) {
        $file = $data_file['name'][$index];
        $tmp = $data_file['tmp_name'][$index];	
        $data['size'] = $data_file['size'][$index];
    } else {
        $file = $data_file['name'];
        $tmp = $data_file['tmp_name'];	
        $data['size'] = $data_file['size'];
    }
    // get uploaded file's extension
    $data['ext'] = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $filename = pathinfo($file, PATHINFO_FILENAME);
    $filename = str_replace(' ', '-', $filename); // Replaces all spaces with hyphens.
    $filename =  preg_replace('/[^A-Za-z0-9\-]/', '-', $filename); 
    // can upload same image using rand function
    $data['final_file'] = rand(1000,1000000).'_'.$filename.'.'.$data['ext'];
    $path_final = $path.strtolower($data['final_file']); 
     
    if(move_uploaded_file($tmp,$path_final)) 
        {
            $data['result'] = true;
        } else {
            $data['result'] = false;
        }
    if ($old_file != '') {
        $this::delete_file($path,$old_file);	
    }
    return $data;
}

function delete_file($path, $file){
    if (is_file($path.$file)) {
        unlink($path.$file);
    }
}

?>