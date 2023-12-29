import { provide, reactive, inject, onBeforeMount } from "vue"

const key = 'NAV_STACK_LAYOUT'

//Function to allow us to create a navigation stack layout. This will be consumed later
export const setNavigationStackLayoutState = () => {
    const state = reactive({
        title: ""
    })
    provide(key, state)

    //Expose also the state
    return state
}


//Consume the injecteed state to make dynamic changes like the title of the navbar
export const useNavigationStackLayout = () => {
    const state = inject(key)

    onBeforeMount(() => {
        //Reset the value
        state.title = ""
    })
    //Expose the state
    return state
}