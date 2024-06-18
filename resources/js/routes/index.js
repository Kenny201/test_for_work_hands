import {createRouter, createWebHistory} from "vue-router";
import MainComponent from "../components/MainComponent.vue";
import CreateComponent from "../components/CreateComponent.vue";
import DetailComponent from "../components/DetailComponent.vue";

const routes = [
    {
        path: "/",
        name: "MainComponent",
        component: MainComponent,
    },
    {
        path: "/create",
        name: "CreateComponent",
        component: CreateComponent,
    },
    {
        path: "/advertisements/:advertisement",
        name: "DetailComponent",
        component: DetailComponent,
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

