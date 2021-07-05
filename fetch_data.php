<?php
require_once 'connection.php';
include('includes/dbconfig.php');
$csv_path = 'C:\\xampp\\htdocs\\Gemastik-MealPlanner\\spoonacular_ingredients.csv';
$csv = fopen($csv_path, 'r');
$list_ingredients = array();
while (list($ingredient, $ingredient_id) = fgetcsv($csv, 1024, ';')) {

    $strings = explode(" ",$ingredient);
    $st = $strings[0];
    for ($i= 1; $i<count($strings); $i++) { 
        $st = $st.'%'.$strings[$i];
    }
    $object = array('name'=>$st, 'id'=>$ingredient_id);
    array_push($list_ingredients,$object);
    
}

// for ($i=10; $i <14; $i++) { 

//     $ingredient = $list_ingredients[$i];
//     $name = $ingredient['name'];
    
//     $url = SPOONACULAR_BASE_URL.'/recipes/findByIngredients?apiKey='.SPOONACULAR_KEY.'&number=10&ingredients='.$name;
//     $client = curl_init();
//     curl_setopt($client, CURLOPT_URL, $url);
//     curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
//     $responses = curl_exec($client);
//     $result = json_decode($responses);
//     foreach ($result as $res) {
//         $id = (int)$res->id;
//         // $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DB_NAME);
//         // $query = "SELECT `id` FROM `foods` WHERE `id`=" . $id;
//         $exist = false;
//         $ref = "foods/";
//         $fetch = $database->getReference($ref)->getValue();
//         if ($fetch != null) {
//             foreach ($fetch as $key => $row) {
//                 if ($row['id'] == $id) {
//                     $exist = true;
//                     break;
//                 }
//             }
//         }
//         // if ($res = $mysqli->query($query)) {
//         //     while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
//         //         $exist = true;
//         //     }
//         // }
//         if (!$exist) {
//             $url = SPOONACULAR_BASE_URL.'/recipes/'.$id. '/information?apiKey='.SPOONACULAR_KEY.'&includeNutrition=true';
//             $curl = curl_init();
//             curl_setopt($curl, CURLOPT_URL, $url);
//             curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//             $responses = curl_exec($curl);
//             $recipe = json_decode($responses);
//             $title = str_replace('\'', '\\', $recipe->title);
//             $vegetarian = filter_var($recipe->vegetarian,FILTER_VALIDATE_BOOLEAN);
//             //$vegetarian = json_encode($recipe->vegetarian);
//             $glutenFree = filter_var($recipe->glutenFree,FILTER_VALIDATE_BOOLEAN);
//             // $glutenFree = json_encode($recipe->glutenFree);
//             $dairyFree = filter_var($recipe->dairyFree,FILTER_VALIDATE_BOOLEAN);
//             // $dairyFree = json_encode($recipe->dairyFree);
//             $veryHealthy = filter_var($recipe->veryHealthy,FILTER_VALIDATE_BOOLEAN);
//             // $veryHealthy = json_encode($recipe->veryHealthy);
//             $cheap = filter_var($recipe->cheap,FILTER_VALIDATE_BOOLEAN);
//             // $cheap = json_encode($recipe->cheap);
//             $healthScore = (int)$recipe->healthScore;
//             $creditsText = $recipe->creditsText;
//             $pricePerServing = (double)$recipe->pricePerServing;
//             $extendedIngredients = array();
//             foreach ($recipe->extendedIngredients as $ing) {
//                 $string = '{"id":'.(int)$ing->id.',"aisle":"'. $ing->aisle.'","name":"'
//                 .$ing->name.'","amount":'.(int)$ing->amount.',"unit":"'.$ing->unit.'"}';
//                 $string = json_decode($string);
//                 array_push($extendedIngredients,$string);
//             }
//             $sourceUrl = str_replace('\'', '\\', $recipe->sourceUrl);
//             $image = str_replace('\'', '\\', $recipe->image);  
//             $nutrients = array();
//             foreach ($recipe->nutrition->nutrients as $key) {
//                 $string = '{"name":"'. $key->name.'","amount":'.(double)$key->amount . ',"unit":"' .$key->unit. '","percentOfDailyNeeds":' . (double)$key->percentOfDailyNeeds .'}';
//                 $string = json_decode($string);
//                 array_push($nutrients, $string);
//             }
//             $flavonoids = array();
//             foreach ($recipe->nutrition->flavonoids as $key) {
//                 $string = '{"name":"'.$key->name.'","amount":'.(double)$key->amount . ',"unit":"' .$key->unit. '"}';
//                 $string = json_decode($string);
//                 array_push($flavonoids, $string);
//             }
//             $ingredients = array();
//             foreach ($recipe->nutrition->ingredients as $key) {
//                 $nutrients_ingredients = array();
//                 foreach ($key->nutrients as $nut) {
//                     $nut_string = '{"name":"'.$nut->name.'","amount":'.(double)$nut->amount.',"unit":"'. $nut->unit.'"}';
//                     $nut_string = json_decode($nut_string);
//                     array_push($nutrients_ingredients,$nut_string);
//                 }
//                 $string = '{"id":'.(int)$key->id.',"name":"'.$key->name.'","amount":'.(double)$key->amount . ',"unit":"' . $key->unit . '","nutrients":'.json_encode($nutrients_ingredients).'}';
//                 $string = json_decode($string);
//                 array_push($ingredients, $string);
//             }
//             $caloricBreakdown = '{"percentProtein":'. (double)$recipe->nutrition->caloricBreakdown->percentProtein.',"percentFat":'. (double)$recipe->nutrition->caloricBreakdown->percentFat.',"percentCarbs":'. (double)$recipe->nutrition->caloricBreakdown->percentCarbs.'}';
//             $caloricBreakdown = json_decode($caloricBreakdown);
//             $weightPerServing = '{"amount":'. (int)$recipe->nutrition->weightPerServing->amount.',"unit":"'.$recipe->nutrition->weightPerServing->unit.'"}';
//             $weightPerServing = json_decode($weightPerServing);
//             $nutrition = '{
//                     "nutrients":'.json_encode($nutrients).',
//                     "flavonoids":'.json_encode($flavonoids).',
//                     "ingredients":'.json_encode($ingredients). ',
//                     "caloricBreakdown":' . json_encode($caloricBreakdown) . ',
//                     "weightPerServing":' . json_encode($weightPerServing) . '
//                 }';
//             $nutrition = json_decode($nutrition);
//             $summary = strip_tags($recipe->summary);
//             $dishTypes = array();
//             foreach ($recipe->dishTypes as $key) {
//                 array_push($dishTypes, $key);
//             }
//             $diets = array();
//             foreach ($recipe->diets as $key) {
//                 array_push($diets,$key);
//             }
//             $instructions = strip_tags($recipe->instructions);
//             $spoonacularSourceUrl = str_replace('\'', '\\', $recipe->spoonacularSourceUrl);
//             $final_recipe = '{
//                 "id":'.json_encode($id).',
//                 "title":'.json_encode($title).',
//                 "vegetarian":'.json_encode($vegetarian).',
//                 "glutenFree":'.json_encode($glutenFree).',
//                 "dairyFree":'.json_encode($dairyFree).',
//                 "veryHealthy":'.json_encode($veryHealthy).',
//                 "cheap":'.json_encode($cheap).',
//                 "healthScore":'.json_encode($healthScore).',
//                 "creditsText":'.json_encode($creditsText).',
//                 "pricePerServing":'.json_encode($pricePerServing).',
//                 "extendedIngredients":'.json_encode($extendedIngredients).',
//                 "sourceUrl":'.json_encode($sourceUrl).',
//                 "image":'.json_encode($image).',
//                 "nutrition":'.json_encode($nutrition).',
//                 "summary":'.json_encode($summary).',
//                 "dishTypes":'.json_encode($dishTypes).',
//                 "diets":'.json_encode($diets).',
//                 "instructions":'.json_encode($instructions).',
//                 "spoonacularSourceUrl":'.json_encode($spoonacularSourceUrl).'
//             }';
//             $final_recipe = json_decode($final_recipe);
//             $final_recipe->sourceUrl = $sourceUrl;
//             $final_recipe->image = $image;
//             $final_recipe->spoonacularSourceUrl = $spoonacularSourceUrl;
//         // $query = "INSERT INTO `foods`(`id`, `title`, `vegetarian`, `glutenFree`, `dairyFree`, `veryHealthy`, `cheap`, `healthScore`, `creditsText`, `pricePerServing`, `extendedIngredients`, `sourceUrl`, `image`, `nutrition`, `summary`, `dishTypes`, `diets`, `instructions`, `spoonacularSourceUrl`) VALUES ($id,'$title',$vegetarian,$glutenFree,$veryHealthy,$cheap,$dairyFree,$healthScore,'$creditsText',$pricePerServing,'".json_encode($extendedIngredients)."','$sourceUrl','$image','" . json_encode($nutrition) . "','$summary','" . json_encode($dishTypes) . "','" . json_encode($diets) . "','$instructions','$spoonacularSourceUrl')";
//         // echo $query;
//         // $result = mysqli_query($con, $query);
//         $ref = 'foods/'.$id;
//         $post = $database->getReference($ref)->set($final_recipe);
//         }
//     }
// }
$ref = "foods/";
$fetch = $database->getReference($ref)->getValue();
if ($fetch != null) {
    echo count($fetch);
}
?>
