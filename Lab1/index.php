<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $squares = $_GET['board'];
            $game = new Game($squares);

            if ($game->winner('x'))
                echo'You win. Lucky guesses!';
            else if ($game->winner('o')){
                echo 'I win. Muahahahahaha';
            }
            else{
                echo 'No winner yet, but you are losing.';
                $game->pick_move();
                $game->display();
            }
            
            class Game{
                var $position;
                function __construct($squares) {
                    $this->position = str_split($squares);
                }          
                function winner($token){
                    $won = false;
                    for ($row = 0 ; $row<3 ; $row++){
                        $result = true;
                        for($col = 0 ; $col < 3 ; $col++)
                            if ($this->position[3*$row+$col] != $token)
                                $result = false;
                        if ($result == true) 
                            $won = true;
                    }

                    for ($col = 0 ; $col<3 ; $col++){
                        $result = true;
                        for($row = 0 ; $row < 3 ; $row++)
                            if ($this->position[3*$row+$col] != $token)
                                $result = false;
                        if ($result == true)
                            $won = true;
                    }

                    if (($this->position[0] == $token) &&
                            ($this->position[4] == $token) &&
                            ($this->position[8] == $token)){
                        $won = true;
                    } else if (($this->position[2] == $token) &&
                            ($this->position[4] == $token) &&
                            ($this->position[6] == $token)){
                        $won = true;
                    }    
                    return $won;
                }        

                function display() { 
                    echo '<table cols=”3” style=”font­size:large; font­weight:bold”>'; 
                    echo '<tr>'; // open the first row 
                    for ($pos=0; $pos<9;$pos++) { 
                        echo $this->show_cell($pos);
                        if ($pos %3 == 2) 
                            echo '</tr><tr>'; // start a new row for the next square 
                    } 
                    echo '</tr>'; // close the last row 
                    echo '</table>';     
                }
                
                function show_cell($which) {
                    $token = $this->position[$which];
                    if ($token <> '-') 
                        return '<td>'.$token.'</td>';
                    $this->newposition = $this->position;
                    $this->newposition[$which] = 'x';
                    $move = implode($this->newposition);
                    $link = '/COMP4711-Labs/Lab1/?board='.$move;
                    return '<td><a href="'.$link.'">-</a><td>';
                }
                
                function pick_move() {
                    for($i = 0 ; $i<8 ; $i++){
                        if ($this->position[$i] == '-'){
                            $this->position[$i] = 'o';
                            //display();
                            break;
                        }
                    }
                }
            }
        ?>
    </body>
</html>
