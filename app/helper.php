<?php
//echo "hello bibek"; //sabai page ma hello bibek aaucha


// if (!function_exists('p')){
//     function p($data){
//         echo "<pre>";
//         print_r($data);
//         echo "<pre>";
//     }
// }

  
//yo chai date ko format change garna ko lagi
if(!function_exists('get_formatted_date')){
    function get_formatted_date($date,$format){
$formatdate=date($format,strtotime($date));  // strtotime le date format change garcha i.e 2078/5/6 lai may 6 2022 form ma
   return $formatdate;
}
}
//yeti garisake pachi view ma <td>{{get_formatted_date($data->dob,"d-M-Y")}} </td> foreach loop vako thau ma

?>