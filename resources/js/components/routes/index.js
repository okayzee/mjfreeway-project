import Vue from "Vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    base: "/",
    routes: [
        {
            path: "/",
            name: "dashboard",
            component: require("../ExampleComponent.vue").default,
            meta: {
                title: "Home"
            }
        },
    ]
});
