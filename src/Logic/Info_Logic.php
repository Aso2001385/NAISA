<?php
require_once 'Ex/Info_Ex.php';
class Info_Logic
{

    public static function get_multi($user_id){

        $info_ex = new Info_Ex();

        $act = $info_ex->get_by_user_id($user_id);

        if(!is_bool($act['data'])){
            if(array_values($act['data']) !== $act['data']) {
                $act['data'] = [$act['data']];
            } 
        }
        
        return $act;

    }

    public static function get_single($id){

        $info_ex = new Info_Ex();

        $act = $info_ex->get_by_id($id);

        return $act;
    }

    public static function link_converter($links,$contents)
    {

        $links = preg_split('/.*:/',$links);
        array_splice($links,0,1);

        $split = preg_split('/:end:#/',$contents);

        for($i=0; $i<count($links); $i++){
        
            $link = "<a href='{$links[$i]}'><div class='info_link'>";
            preg_match('/#:links:.*/',$split[$i],$before);
            $after = str_replace('#:links:',$link,$before);
            $contents = str_replace($before,$after,$contents);
        
        }

        $contents = str_replace(':end:#','</div></a>',$contents);

        return $contents;

    }
}

?>