import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import { NavBar, IconNavigationBar } from "./components/navigation"
import { Heading, Title } from "./components/typography"
import { Card, CardBody } from "./components/card"

const app = createApp(App)

app.use(createPinia())
app.use(router)
//Global registration of components
app
    .component('NavBar', NavBar)
    .component('IconNavigationBar', IconNavigationBar)
    .component('VHeading', Heading)
    .component('VTitle', Title)
    .component('Card', Card)
    .component('CardBody', CardBody)
app.mount('#app')

