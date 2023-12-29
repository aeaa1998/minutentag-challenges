<?php
namespace App\Http\Controllers;

class ProductController extends Controller
{
    /**
     * This function returns all of the stock and prices information inside the json file
     */
    public function stockAndPrices()
    {
        //Get the contents of the file and decode the json
        $stockPriceJson = $this->stockPriceJson();

        return response()->json($stockPriceJson);
    }

    /**
     * This function retrieves the stock and price of an specific sku of a product
     */
    public function stockAndPrice(int $sku)
    {
        //Get the contents of the file and decode the json
        $stockPriceJson = $this->stockPriceJson();

        //The sku is not in the json values
        //Return a invalid value
        if (!isset($stockPriceJson[$sku])) {
            return response()->json([
                "stock" => 0,
                "price" => 0,
            ]);
        }

        //Return the value of the desired sku

        return response()->json($stockPriceJson[$sku]);
    }

    /**
     * Function to get the stock and prices json file value
     * @return array the associative array representing that file
     */
    public function stockPriceJson(): array
    {
        //We stored the json inside the resource folder so use the utility function
        //to retrieve the path
        $stockPriceJsonFilePath = resource_path('/json/stock-price.json');

        //Get the contents of the file and decode the json

        return json_decode(file_get_contents($stockPriceJsonFilePath), true);
    }
}
