<?php 

function field_data($data)
{
    $fields['key'] = '`' . implode('`, `', array_keys($data)) . '`';
    $fields['value']   = ':' . implode(', :', array_keys($data));
    $fields['data'] = $data;
    return $fields;
    // var_dump($fields);
    // var_dump($fields_data);
}

function field_edit($data){
    $numItems = count($data);
    $i = 0;
    $query = '';
    foreach ($data as $name => $value) {
        $query .= ' '.$name.' = :'.$name.','; 
        if(++$i === $numItems) {
            $query .= ' '.$name.' = :'.$name; 
        }
    }
    $fields['key'] = $query;
    $fields['data'] = $data;
    return $fields;
}