<?php
// 1) Please, fully explain this function: document iterations, conditionals, and the function objective as a whole
/**
 * This function is used to retrieve an array of products with the information of the product. The product representation is
 * creating depending on the values that are present on the parameters. We will have information like the quantity left,
 * the id and if it is deleted or not
 * @param array $p Represents a detail product representation as an array
 * @param array $o Represents an array value containing items data that we will use to fill the $items array
 * @param array $ext Represents an array of values that containt information about items with its id and the quantity left.
 *
 * @return array List of products computed
 */
function ($p, $o, $ext) {
    //Variable where we will store the product and its information
    $items = [];
    $sp    = false;
    $cd    = false;

    $ext_p = [];

    //We iterate the parameter $ext an use each one of the values assigned ($e) in the foreach loop
    foreach ($ext as $i => $e) {
        //On the array $e we enter we get the id by entering the price key and inside it there is another key array value
        //So we inter id to set it as the key value for $ext_p mapping the quantity into it.
        $ext_p[$e['price']['id']] = $e['qty'];
    }

    //We enter an array of values inside the $o variable that is an array itself. Inside $o we enter the items key and then enter the data key
    //To iterate each item
    foreach ($o['items']['data'] as $i => $item) {
        //We create a representation of a product first assigning the id retriving it from the $item variable by the ky id
        $product = [
            'id' => $item['id'],
        ];

        //We check if inside the $ext_p the price id is set to prevent accessing a key that is not set
        //This value if existing should be set in the previous loop
        if (isset($ext_p[$item['price']['id']])) {
            //We retrieve the quantity mapped to the price id
            $qty = $ext_p[$item['price']['id']];
            //If the quntity is less than one we will set the deleted key on the $product variable as true
            if ($qty < 1) {
                $product['deleted'] = true;
            } else {
                //Else set the number of items available in the product
                $product['qty'] = $qty;
            }
            //From the mapping of the items and the quantity we remove the value from that map.
            unset($ext_p[$item['price']['id']]);
        }
        // If the item price id is not found on $ext_p but is the same as the one $p variable has.
        else if ($item['price']['id'] == $p['id']) {
            //We set the flag $sp as true
            $sp = true;
        } else {
            //It was not found either as the detail product $p or in the mapping so we set that product as deleted
            $product['deleted'] = true;
            $cd                 = true;
        }

        //We push the product with its information into the array of $items
        $items[] = $product;
    }

    //Checking if $sp was set to true. This is needed because if if it was not then it means it $p product will be missing
    if (!$sp) {
        //We will add the $p product into the array of times with a fixed value of qty of 1
        $items[] = [
            'id'  => $p['id'],
            'qty' => 1,
        ];
    }

    //We iterate now the $ext_p which is the variable containing the mapping from id to quantity
    //This is because we want to check if there are values inside $ext_p that where not unset in the previous loop.
    foreach ($ext_p as $id => $qty) {
        //We will check the quantity mapped if it is less to one no need to add it into the items array
        if ($qty < 1) {
            continue;
        }

        //There is at least one we will add the missing product
        $items[] = [
            'id'  => $id,
            'qty' => $qty,
        ];
    }

    return $items;
};

//2) Write a class "LetterCounter" and implement a static method "CountLettersAsString" which receives a string parameter and returns a string that shows how many times each letter shows up in the string by using an asterisk (*).
// Example: "Interview" -> "i:**,n:*,t:*,e:**,r:*,v:*,w:*"
class LetterCounter
{
    /**
     * Static function that will allow us to retrieve the frequency of the $text string value provided
     * @param string $text The text to use to count the frequency
     * @param bool $caseSensitive We add this optional boolean that tells if the count should be case sensitive or not default: false.
     * @return array Array with the frequency of the values
     */
    public static function CountLettersAsString(string $text, bool $caseSensitive = false): array
    {
        //If it is not case sensitive we will lowercase the text
        if (!$caseSensitive) {
            $text = strtolower($text);
        }
        //We will store in a map the number of times a value appears in the $frequency array
        $frequency = [];

        //We iterate each character using the result of mb_str_split which returns the representation of the string as an iterable
        foreach (mb_str_split($text) as $key => $character) {
            //If the key of the character is not set it's meaning is the first time it appears so we set the value to one
            if (!isset($frequency[$character])) {
                $frequency[$character] = 1;
            } else {
                //Else just increment the value by one
                $frequency[$character] += 1;
            }
        }

        return $frequency;
    }
}

//3) Write a method that triggers a request to http://date.jsontest.com/, parses the json response and prints out the current date in a readable format as follows: Monday 14th of August, 2023 - 06:47 PM
function getReadableDateFromJsonTest(): string
{
    //We will just use file_get_contents function since we need only to do a basic GET request without any parameters or header values.
    //We also just need the data response.
    //We store the json response in the $response variable.
    //We use json_decode with associative with true flag to get the string representation of the json as an associative array instead of an object.
    $response = json_decode(file_get_contents("http://date.jsontest.com/"), associative: true);

    //From the milliseconds_since_epoch value in our response we have the value without needing to process date and time separately and just parsing
    //the timestamp into the desired format.

    $formattedDate = date("l jS \of F, Y - h:i A", (int) floor($response["milliseconds_since_epoch"] / 1000));

    return $formattedDate;
}

//Helper function to get a concatanated string of the $character value repeated $times value
function repeat(string $character, int $times): string
{
    $value = "";
    for ($i = 0; $i < $times; $i++) {
        $value .= $character;
    }

    return $value;
}

/**
 * 4) Write a method that triggers a request to http://echo.jsontest.com/john/yes/tomas/no/belen/yes/peter/no/julie/no/gabriela/no/messi/no, parse the json response.
 * Using that data print two columns of data. The left column should contain the names of the persons that responses 'no',
 * and the right column should contain the names that responded 'yes'
 */
function printYesNoTableResults(): void
{
    //We will just use file_get_contents function since we need only to do a basic GET request without any parameters or header values.
    //We store the result in the $response variable and parse it to be an associative array
    $response = json_decode(file_get_contents("http://echo.jsontest.com/john/yes/tomas/no/belen/yes/peter/no/julie/no/gabriela/no/messi/no"), associative: true);

    //Variable to store the results mapped
    $resultsMapped = [];
    //This variable will allow us to know the spacing in our table
    $largestName = 0;

    //We iterate the response and save group the names by answer
    foreach ($response as $name => $answer) {
        $resultsMapped[$answer][] = $name;
        $nameLength               = strlen($name);
        //If the name length is largest than the previous largest name we will set a new value
        if ($nameLength > $largestName) {
            $largestName = $nameLength;
        }
    }

    //We will get the maximum number of rows inside our table
    $maxNumberOfRows = max(count($resultsMapped["yes"]), count($resultsMapped["no"]));
    $columnLength    = $largestName + 2;

    //This function will help use to print the table in a more readable way
    function printNameIfItExists(array $mappedGroup, int $position, int $columnLength)
    {
        //Key index exist
        if (isset($mappedGroup[$position])) {
            //Get the length of the name
            $length = strlen($mappedGroup[$position]);
            //Print the value in the yes column
            echo $mappedGroup[$position] . repeat(" ", $columnLength - $length);
        } else {
            // Else just print whitespaces
            echo repeat(" ", $columnLength);
        }
    }

    //Print headers
    $columnAscii = repeat("-", $columnLength);
    echo "+$columnAscii+$columnAscii+\n";
    echo "+Yes" . repeat(" ", $columnLength - 3) . "|No" . repeat(" ", $columnLength - 2) . "+\n";
    echo "+$columnAscii+$columnAscii+\n";
    //We will iterate only in the maximum number of rows
    for ($i = 0; $i < $maxNumberOfRows; $i++) {
        echo "+";
        printNameIfItExists($resultsMapped["yes"], $i, $columnLength);
        //Print the separator in the table
        echo "|";
        printNameIfItExists($resultsMapped["no"], $i, $columnLength);
        echo "+\n";
    }
    echo "+$columnAscii+$columnAscii+\n";
}

/**
 * Uncoment the following lines to test each one of the excercises
 */
// echo "------ EXCERSISE #2 ----- \n";
// echo "Test value count (case insensitive): \n";
// var_dump(LetterCounter::CountLettersAsString("Test"));
// echo "\n";
// echo "Test value count (case sensitive): \n";
// var_dump(LetterCounter::CountLettersAsString("Test", true));
// echo "\n";
// echo "\n";

// echo "------ EXCERSISE #3 ----- \n";
// echo getReadableDateFromJsonTest();
// echo "\n";
// echo "\n";

// echo "------ EXCERSISE #4 ----- \n";
// printYesNoTableResults();
