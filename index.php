<?php
function highlightNegativeNumbers($array) {
    if (!is_array($array)) {
        return false;
    }

    $output = "<p>Масив з від'ємними числами:</p><ul>";

    foreach ($array as $number) {
        if ($number < 0) {
            $output .= "<li style='color: red;'>$number</li>";
        } else {
            $output .= "<li>$number</li>";
        }
    }

    $output .= "</ul>";
    echo $output;

    return true;
}

$array = [1, -2, 3, -4, 5];
highlightNegativeNumbers($array);



function ConversionFromNumberToString(int $number) : string
{
    $StringToPrint= "";
    if(intval($number)/1000!=0)
    {
        $thousands = intval($number/1000);
        $StringToPrint .= match ($thousands)
        {
            0=>"",
            1=> "одна тисяча, ",
            2=>"дві тисячі, ",
            3=>"три тисячі, ",
            4=>"чотири тисячі, ",
            5=>"п'ять тисяч, ",
            6=>"шість тисяч, ",
            7=>"сім тисяч, ",
            8=>"вісім тисяч, ",
            9=>"дев'ять тисяч, ",
            default=> 'невідомо'
        };
    }
    if($number/100!=0)
    {
        $hundreds = (intval($number/100))%10;

        $StringToPrint .= match ($hundreds) {
            0 => "",
            1 => "сто",
            2 => "двісті",
            3 => "триста",
            4 => "чотириста",
            5 => "п'ятсот",
            6 => "шістсот",
            7 => "сімсот",
            8 => "вісімсот",
            9 => "дев'ятсот",
            default=> 'невідомо'
        };
    }

    $tens = intval(($number%100)/10);
    if($tens==1)
    {
        $tensAndUnit = intval($number%100);
        $StringToPrint .= match ($tensAndUnit) {
            0 => ".",
            10 => " десять.",
            11 => " одинадцять.",
            12 => " дванадцять.",
            13 => " тринадцять.",
            14 => " чотирнадцять.",
            15 => " п'ятнадцять.",
            16 => " шістнадцять.",
            17 => " сімнадцять.",
            18 => " вісімнадцять.",
            19 => " дев'ятнадцять.",
            default => 'невідомо'
        };
    }
    else {
        $StringToPrint .= match ($tens) {
            0=>"",
            2 => " двадцять",
            3 => " тридцять",
            4 => " сорок",
            5 => " п'ятдесят",
            6 => " шістдесят",
            7 => " сімдесят",
            8 => " вісімдесят",
            9 => " дев'яносто",
            default => 'невідомо'
        };
        $unit = $number%10;
        $StringToPrint .= match ($unit) {
            0 => ".",
            1 => " один.",
            2 => " два.",
            3 => " три.",
            4 => " чотири.",
            5 => " п'ять.",
            6 => " шість.",
            7 => " сім.",
            8 => " вісім.",
            9 => " дев'ять.",
            default => 'невідомо'
        };

    }

    return $StringToPrint;
}

$number = 6369;
echo $number . ": " . ConversionFromNumberToString($number);


function generateDiv($count) {
    if ($count <= 0) {
        return;
    }
    $x = rand(0, 100);
    $y = rand(0, 100);
    echo "<div style='position: absolute; left: $x%; top: $y%; width: 50px; height: 50px; background-color: black;'></div>";
    generateDiv($count - 1);
}
generateDiv(10);


function displayProduct($name, $image, $price) {
    echo "<div style='display: flex; flex-direction: column; justify-content: center; align-items: self-start; 
                    border: 2px solid green; width: 200px; padding: 15px 0 15px 0;'>";
    echo "<h2>$name</h2>";
    echo "<img src='$image' alt='$name' style='max-width: 200px; max-height: 200px;' />";
    echo "<p>Ціна: $price грн</p>";
    echo "<button>Придбати</button>";
    echo "</div>";
}

$samsungS24Name = "Samsung S24";
$samsungS24Image = "https://images.samsung.com/is/image/samsung/assets/ua/2401/local/md/s24_violet.png";
$samsungS24Price = 15000;

$iphone14Name = "iPhone 14";
$iphone14Image = "https://api.alo.md/media/media/darwin-apple-iphone-14-4-gb-128-gb-midnight-080_8YtphKu.webp";
$iphone14Price = 25000;


displayProduct($samsungS24Name, $samsungS24Image, $samsungS24Price);
displayProduct($iphone14Name, $iphone14Image, $iphone14Price);


$products = array(
    array('name' => $samsungS24Name, 'image' => $samsungS24Image, 'price' => $samsungS24Price),
    array('name' => $iphone14Name, 'image' => $iphone14Image, 'price' => $iphone14Price)
);

function calculateCart($products) {
    $cart = array();

    foreach($products as $product) {
        $found = false;
        foreach($cart as &$item) {
            if($item['name'] === $product['name']) {
                $item['count'] += 1;
                $item['total_price'] += $product['price'];
                $found = true;
                break;
            }
        }

        if(!$found) {
            $newItem = array(
                'name' => $product['name'],
                'image' => $product['image'],
                'count' => 1,
                'total_price' => $product['price']
            );
            $cart[] = $newItem;
        }
    }

    return $cart;
}

function printCart(array $cart)
{
    foreach ($cart as $item) {
        echo "
    <div style='display: inline-block;'>
        <div style='display: flex; flex-direction: column; justify-content: center; align-items: self-start; 
                    border: 2px solid green; width: 200px; padding: 15px 0 15px 0;'>
            <image src='$item[image]' style='width: 200px; height: 200px; max-width: 100%; max-height: 100%; align-self: center;'/>
            <p style='font-weight: bold; font-size: 16px; '>$item[name]</p>
            <div style='display: flex; flex-direction: row;'>
                <p style='font-size: 14px;'>Кількість: $item[count]</p>
                <p style='font-size: 14px; margin-left: 10px;'>Ціна: $item[total_price]грн</p>
            </div>
        </div>
    </div>
    ";
    }

}

$cart = calculateCart($products);
printCart($cart);

?>