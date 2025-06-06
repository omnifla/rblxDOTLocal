<?php
<<<<<<< HEAD
require($_SERVER['DOCUMENT_ROOT'] . "/config/includes.php");
try {

    $limit = (int) $_GET['limit'];

    $names = array(
        'Image' => 1,
        'TShirt' => 2,
        'Audio' => 3,
        'Mesh' => 4,
        'Lua' => 5,
        'Hat' => 8,
        'Place' => 9,
        'Model' => 10,
        'Shirt' => 11,
        'Pants' => 12,
        'Decal' => 13,
        'Head' => 17,
        'Face' => 18,
        'Gear' => 19,
        'Badge' => 21,
        'Animation' => 24,
        'Torso' => 27,
        'RightArm' => 28,
        'LeftArm' => 29,
        'LeftLeg' => 30,
        'RightLeg' => 31,
        'Package' => 32, // should be 32 but its broken if it is..
        'Gamepass' => 34,
        'Plugin' => 38,
        'Video' => 62
    );
=======
require($_SERVER['DOCUMENT_ROOT']."/config/includes.php");
try {
   
$limit = (int)$_GET['limit'];   
    
$names = array(
'Image' => 1,
'TShirt' => 2,
'Audio' => 3,
'Mesh' => 4,
'Lua' => 5,
'Hat' => 8,
'Place' => 9,
'Model' => 10,
'Shirt' => 11,
'Pants' => 12,
'Decal' => 13,
'Head' => 17,
'Face' => 18,
'Gear' => 19,
'Badge' => 21,
'Animation' => 24,
'Torso' => 27,
'RightArm' => 28,
'LeftArm' => 29,
'LeftLeg' => 30,
'RightLeg' => 31,
'Package' => 32, // should be 32 but its broken if it is..
'Gamepass' => 34,
'Plugin' => 38,
'Video' => 62
);
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
    $stmt = $con->prepare("SELECT * FROM library WHERE `type` = 'item' LIMIT $limit");
    $stmt->execute();
    $libraryItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $jsonObjects = [];

    foreach ($libraryItems as $item) {
<<<<<<< HEAD
        foreach ($names as $name => $number) {
            if ($name == $item['type2']) {
                $assetTypeId = $number;
                break;
            }
        }
        $stmt = $con->prepare("SELECT * FROM users WHERE `id` = :creatorid");
        $stmt->execute(['creatorid' => $item['creatorid']]);
        $creator = $stmt->fetch();
=======
    foreach ($names as $name => $number) {
    if ($name == $item['type2']) {
    $assetTypeId = $number;
    break;
    }
    }
    $stmt = $con->prepare("SELECT * FROM users WHERE `id` = :creatorid");
    $stmt->execute(['creatorid' => $item['creatorid']]);
    $creator = $stmt->fetch();
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
        $jsonObject = [
            "id" => $item["id"],
            "itemType" => "Asset",
            "assetType" => $assetTypeId,
            "name" => $item["name"],
            "description" => $item["description"],
            "productId" => $item["id"],
            "itemStatus" => [],
<<<<<<< HEAD
            "itemRestrictions" => [],
=======
            "itemRestrictions" => [], 
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
            "creatorHasVerifiedBadge" => (bool) $creator["Admin"],
            "creatorType" => "User",
            "creatorTargetId" => $item["creatorid"],
            "creatorName" => $creator["username"],
            "price" => $item["Robux"],
            "purchaseCount" => $item["sold"],
            "favoriteCount" => $item["favorite"],
            "offSaleDeadline" => null,
            "saleLocationType" => "NotApplicable"
        ];

        $jsonObjects[] = $jsonObject;
    }

    $response = [
        "keyword" => null,
        "elasticsearchDebugInfo" => [
            "elasticsearchQuery" => null,
            "isFromCache" => false,
            "indexName" => "",
            "isTerminatedEarly" => null,
            "isForceTerminationEnabledByRequest" => null
        ],
        "previousPageCursor" => null,
        "nextPageCursor" => null,
        "data" => $jsonObjects
    ];

    header('Content-Type: application/json');
<<<<<<< HEAD

=======
    
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
