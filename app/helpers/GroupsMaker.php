<?php
final class GroupsMaker{
  public static function makeGroups($list, $nb_max){
    $A_groups = [];
    $nb_of_students = count($list);
    $nbTeams = floor($nb_of_students / $nb_max);
  
    for($i=1 ; $i < $nbTeams ; $i++){
        $teams[] = "Groups ".$i;
    }
  
    // what team are we adding to?
    $teamidx = 0;
    
    // loop through students, add them to a team
    // when you run out of teams, shuffle the team
    // order for giggles and start back at the first
    // team
    for($i=0;$i<$nb_of_students;$i++){
        $A_groups[$teams[$teamidx]][]=$list[$i];
        $teamidx++;
        if($teamidx==count($teams)){
            $teamidx=0;
            shuffle($teams);
        }
    }

    return $A_groups;
  }
}