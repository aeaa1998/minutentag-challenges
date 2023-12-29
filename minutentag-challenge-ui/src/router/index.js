import HomeView from '../views/HomeView.vue'
import ProductDetailView from '../views/ProductDetailView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import { Layout, NavigationStackLayout } from '@/components/layouts'
import { useProductStore } from '@/stores/product';
import { NotFound } from "@/components/views/errors"

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'layout',
            component: Layout,
            children: [
                {
                    path: '/',
                    component: HomeView,
                    name: 'Home'
                }

            ]
        },
        {
            path: '/',
            name: 'navigation-stack',
            component: NavigationStackLayout,
            children: [
                {
                    path: '/:productId-:productBrand',
                    component: ProductDetailView,
                    name: 'ProductDetailView',
                    //Guard to check that the product is valid before entering the page
                    beforeEnter: (to) => {
                        let valid = false
                        const productStore = useProductStore()
                        //Retrieve the function to pull info of the sku
                        const { productsMappedByIdAndBrand } = productStore
                        //We will check that the value is inside
                        try {
                            const product = productsMappedByIdAndBrand[to.params.productId][to.params.productBrand]
                            //The product exists
                            valid = product != undefined && product != null;
                        } catch (error) {
                        }
                        return valid || { name: 'NotFound' }
                    }
                }

            ]
        },
        {
            name: 'NotFound',
            component: NotFound,
            path: '/404'
        }
    ]
})

export default router
