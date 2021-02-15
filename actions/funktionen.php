<?php

function getBGColor($difficulty)
{

    switch ($difficulty) {
        case 'easy':
            $cat = 'var(--clr-easy)';
            break;
        case 'intermediate':
            $cat = 'var(--clr-medium)';
            break;
        case 'hard':
            $cat = 'var(--clr-hard)';
            break;
        case 'crossfit':
            $cat = 'var(--clr-cf)';
            break;
        default:
            $cat = 'var(--clr-footer)';
    }

    return $cat;
}

// function getBGColor($cat)
// {

//     switch ($cat) {
//         case ($cat == "easy"):
//             $bgColor = "var(--clr-easy)";
//             break;
//         case ($cat == "intermediate"):
//             $bgColor = "var(--clr-medium)";
//             break;
//         case ($cat == "hard"):
//             $bgColor = "var(--clr-hard)";
//             break;
//         case ($cat == "crossfit"):
//             $bgColor = "var(--clr-cf)";
//             break;
//         default:
//             $bgColor = "white";
//     }

//     return $bgColor;
// }

function getPictureData($equiSetId)
{
    switch ($equiSetId) {
        case 1:
            $pic = '../images/icon/jumping-jacks.png';
            $picCol = '../images/icon/jumping-jacks.png';
            $picFromHome = 'images/icon/jumping-jacks.png';
            $pic_style = "width: 158px; height: 195px";
            $equipment = "Bodyweight - kein Wod";
            break;
        case 2:
            $pic = '../images/icon/pull-up.png';
            $picCol = '../images/icon/pull-up.png';
            $picFromHome = 'images/icon/pull-up.png';
            $pic_style = "width: 98px; height: 200px";
            $equipment = "Klimmzugstange";
            break;
        case 3:
            $pic = '../images/icon/boxjump.png';
            $picCol = '../images/icon/boxjump.png';
            $picFromHome = 'images/icon/boxjump.png';
            $pic_style = "width: 195px; height: 199px";
            $equipment = "Box";
            break;
        case 4:
            $pic = '../images/icon/vector_iron_cross_bw.svg';
            $picCol = '../images/icon/vector_iron_cross_color.svg';
            $picFromHome = 'images/icon/vector_iron_cross_bw.svg';
            $pic_style = "height: 200px";
            $equipment = "Ringe";
            break;
        case 5:
            $pic = '../images/icon/dumbbell.png';
            $picCol = '../images/icon/dumbbell.png';
            $picFromHome = 'images/icon/dumbbell.png';
            $pic_style = "width: 160px; height: 199px";
            $equipment = "Dumbbell/Hanteln";
            break;
        case 6:
            $pic = '../images/icon/snatch.png';
            $picCol = '../images/icon/snatch.png';
            $picFromHome = 'images/icon/snatch.png';
            $pic_style = "width: 105px; height: 200px";
            $equipment = "Kettlebell";
            break;
        case 7:
            $pic = '../images/icon/vector_resistance_band_bw.svg';
            $picCol = '../images/icon/vector_resistance_band_color.svg';
            $picFromHome = 'images/icon/vector_resistance_band_bw.svg';
            $pic_style = "height: 200px";
            $equipment = "Widerstandsband";
            break;
        case 8:
            $pic = '../images/icon/deadlift.png';
            $picCol = '../images/icon/deadlift.png';
            $picFromHome = 'images/icon/deadlift.png';
            $pic_style = "width: 183px; height: 200px";
            $equipment = "Gewichtsstange";
            break;
        case 9:
            $pic = '../images/icon/wallballshot.png';
            $picCol = '../images/icon/wallballshot.png';
            $picFromHome = 'images/icon/wallballshot.png';
            $pic_style = "width: 152px; height: 200px";
            $equipment = "Wallball";
            break;
        case 10:
            $pic = '../images/icon/DU.png';
            $picCol = '../images/icon/DU.png';
            $picFromHome = 'images/icon/DU.png';
            $pic_style = "width: 146px, height: 200px";
            $equipment = "Springschnur";
            break;
        default:
            $pic = '../images/icon/vector_all_equip_bw.svg';
            $picCol = '../images/icon/vector_all_equip_color.svg';
            $picFromHome = '../images/icon/vector_all_equip_bw.svg';
            $pic_style = "height:200px";
            $equipment = "Verschiedenes";
    }


    // $picData = getPictureData($equiSetId);
    // $pic = $picData[0];
    // $pic_style = $picData[1];

    return array($pic, $pic_style, $picFromHome, $picCol, $equipment);
}




function getStars($input)
{
    $rating = $input;

    switch ($rating) {


            // case ($rating < 1):
            //     //$stars = "0";
            //     $stars = "<span class='empty'>★ ★ ★ ★ ★ $rating</span>";
            //     break;
            // case ($rating < 2):
            //     // $stars = "1";
            //     $stars = "<span class='filled'>★</span><span class='empty'> ★ ★ ★ ★ $rating</span> ";
            //     break;
            // case (($rating >= 2) && ($rating < 3)):
            //     // $stars = "2";
            //     $stars = "<span class='filled'>★ ★</span><span class='empty'> ★ ★ ★ $rating</span> ";
            //     break;
            // case (($rating >= 3) && ($rating < 4)):
            //     $stars = "<span class='filled'>★ ★ ★</span><span class='empty'> ★ ★ $rating</span> ";
            //     break;
            // case (($rating >= 4) && ($rating < 5)):
            //     $stars = "<span class='filled'>★ ★ ★ ★</span><span class='empty'> ★ $rating</span> ";
            //     break;
            // case ($rating >= 5):
            //     $stars = "<span class='filled'>★ ★ ★ ★ ★ $rating </span>";
            //     break;
            // default:
            //     $stars = "<span class='empty'>★ ★ ★ ★ ★ $rating</span>";

        case ($rating < 1):
            //$stars = "0";
            $stars = "<span class='empty'>★ ★ ★ ★ ★</span>";
            break;
        case ($rating < 2):
            // $stars = "1";
            $stars = "<span class='filled'>★</span><span class='empty'> ★ ★ ★ ★</span> ";
            break;
        case (($rating >= 2) && ($rating < 3)):
            // $stars = "2";
            $stars = "<span class='filled'>★ ★</span><span class='empty'> ★ ★ ★</span> ";
            break;
        case (($rating >= 3) && ($rating < 4)):
            $stars = "<span class='filled'>★ ★ ★</span><span class='empty'> ★ ★</span> ";
            break;
        case (($rating >= 4) && ($rating < 5)):
            $stars = "<span class='filled'>★ ★ ★ ★</span><span class='empty'> ★</span> ";
            break;
        case ($rating >= 5):
            $stars = "<span class='filled'>★ ★ ★ ★ ★</span>";
            break;
        default:
            $stars = "<span class='empty'>★ ★ ★ ★ ★ </span>";
    }


    return $stars;
}
