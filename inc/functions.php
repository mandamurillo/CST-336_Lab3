<?php
    
    class cardObj
        {
            
            public $imgUrl = '';
            public $value = 0;
            
        }
    
    function initializePlayers() {
        global $allPlayers, $player1, $player2, $player3, $player4, $player5;
        $names = array('Faith','Eros','Jose','Brandon');
        
        shuffle($names);
        
        $player1 = array(
            'name' => $names[0],
            'imgURL' => './img/user_pics/' . $names[0]. '.jpg',
            'hand' => array(),
            'handPoints' => 0, //For suit Index/ point calculation
            'points' => 0
            );
        $player2 = array(
            'name' => $names[1],
            'imgURL' => './img/user_pics/' . $names[1] . '.jpg',
            'hand' => array(),
            'handPoints' => 0,
            'points' => 0
            );
        $player3 = array(
            'name' => $names[2],
            'imgURL' => './img/user_pics/' . $names[2] . '.jpg',
            'hand' => array(),
            'handPoints' => 0,
            'points' => 0
            );
        $player4 = array(
            'name' => $names[3],
            'imgURL' => './img/user_pics/' . $names[3] . '.jpg',
            'hand' => array(),
            'handPoints' => 0,
            'points' => 0
            );
        
        $player5 = array(
            'name' => 'Evelin',
            'imgURL' => './img/user_pics/Evelin.jpg',
            'hand' => array(),
            'handPoints' => 0,
            'points' => 0
            );
            
        $allPlayers = array(
            $player1,
            $player2,
            $player3,
            $player4,
            $player5
            );
    }
    
    function printGameState($allPlayers) {
        foreach ($allPlayers as $player) {
            echo "<img width='200' src='" . $player['imgURL'] . "' />";
            echo $player['name'] . "<br>";
            echo "<div id='player' >";
            for($i = 0; $i < count($player['hand']); ++$i){
               echo $player['hand'][$i]->imgUrl;
            }
            echo $player['handPoints'];
            echo "</div>";
        }
    }
    
    function calcPoints($allPlayers){
        foreach ($allPlayers as $player) {
            foreach ($player['handPoints'] as $num){
                $player['points'] += (int)substr($num, strlen($num) - 9, 1);
            }
            //echo "score: " . $player['points']; this works here but doesn't work in printGameState :(
        }
    }
    
    //pseudocode:
    //create an array of 52 cards
    //each card an associative array ==? suit, rank, imgURL, points
    //shuffle the array
    //pop off one card a time to generate the hand
    
    function getImgURLForCardIndex($index) {
        //get a number from 0 to 51
        //return an image url
        
        if($index > 0 && $index < 14) {
            $cardSuit = "clubs";
        } else if($index > 13 && $index < 27) {
            $cardSuit = "diamonds";
        } else if($index > 26 && $index < 41) {
            $cardSuit = "hearts";
        } else if($index > 40 && $index < 53) {
            $cardSuit = "spades";
        }
        
        $suitIndex = floor(($index%13) + 1);
        //echo $suitIndex . "<br>";
        $cardObj = new cardObj();
        $cardObj->value = $suitIndex;
        $cardObj->imgUrl = "<img src='img/cards/$cardSuit/$suitIndex.png' />";
        // echo $cardObj->imgUrl;
        //echo $cardObj->value;
        return $cardObj; //returns card objects now with value and img
    }
    
    
    function generateDeck() { //Shuffling deck, randomizing
        $cards = array(); // array of card objects
        for($i = 1; $i < 53; $i++) {
            array_push($cards, getImgURLForCardIndex($i));
        }
        shuffle($cards);
        return $cards; 
    }           
    

    function generateHand($deck) { //Generating players hand of 5 cards
        $deckMarker = 51; //Placeholder for deck
        $playerNum = 1;
        
        for($j = 0 ; $j < 5; ++$j ){
            ++$playerNum;
            $totalPoints = 0;
            for($i = 0; $totalPoints < 36; ++$i)
            {
                $GLOBALS['allPlayers']['player' . $playerNum]['hand'][$i] = $deck[$deckMarker];
                $GLOBALS['allPlayers']['player'.$playerNum]['handPoints'] += $deck[$deckMarker]->value;
                $totalPoints += $deck[$deckMarker] -> value;
                --$deckMarker;
            }
        }
    }  
    
    //going to work on a function to generate players scores
    
    
   // The total points per player is displayed properly	15 pts
    //The winner(s) is(are) displayed properly with the earned points
    /*function generatePoints() {
        
    }
   
       function displayWinner() {
    //global variables
    global $score; 
    global $player;//
    $winner = 0;
    $lowScore = 0;
    $totalScore = 0;
    $closest=$score[0];
    for( $i= 0; $i < 5; $i++ )// finds out who the winner is 
    { 
        $lowScore=($score[$i]-42);
        
        if($lowScore<$closest)
        {
            $closest = $lowScore;
            $winner = $i;
        }
    }
    
    for($j=0; $j<5; $j++) //prints out the winner out of the 5 players
    {
       if($j != $winner)
       {
        $totalScore = $totalScore + $score[$j];
       }
        }
        //prints out the winner
    echo 'The Winner is: ' . $player[$winner] . ' The Score is: ' . $totalScore;
    }
        */
        //echo $deck;
       
       
       
                
    

?>