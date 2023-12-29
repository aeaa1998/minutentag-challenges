import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import products from '@/assets/products.js';

/**
 * We create a store for the products information related information
 * as a setup store.
 */
export const useProductStore = defineStore('product', () => {
    /**
     * Map of the stocks and prices based on id
     */
    const stockAndPrices = ref({})
    const isLoadingStockAndPrices = ref(false)

    // Simulate popular products by getting the first three
    const popularProducts = computed(() => products.slice(0, 3))

    // Get the products mapped by id and brand to get it in the detail from the query params
    const productsMappedByIdAndBrand = computed(() =>
        products.reduce((carry, product) => {
            //Id is not in carry
            if (!(product.id in carry)) {
                //Create a new map inside
                carry[product.id] = {}
            }

            //Assign by id and brand
            carry[product.id][product.brand] = product
            return carry
        }, {})
    )

    /**
     * This function is usefull to use inside the home view to display the price
     * but for the detail we will use another function to keep updated the infomration
     */
    const fetchAllStockAndPrices = async () => {
        isLoadingStockAndPrices.value = true
        const result = await fetch('http://localhost:8000/api/stock-price')
        //It was successfull
        if (result.status == 200) {
            //We parse the result body into a json
            const jsonResult = await result.json()
            //And assign it into the list
            stockAndPrices.value = jsonResult
        }
        isLoadingStockAndPrices.value = false
    }

    /**
     * Function to fetch the information of the desired sku code of the product
     * we will update the information on the stockAndPrices variable to have one source of truth
     */
    const fetchSkuStockAndPrice = async (sku) => {
        const result = await fetch(`http://localhost:8000/api/stock-price/${sku}`)
        //It was successfull
        if (result.status == 200) {
            //We parse the result body into a json
            const jsonResult = await result.json()
            //And assign it into the list
            stockAndPrices.value[sku] = jsonResult
        }
    }


    return { products, popularProducts, productsMappedByIdAndBrand, fetchAllStockAndPrices, isLoadingStockAndPrices, stockAndPrices, fetchSkuStockAndPrice }
})
