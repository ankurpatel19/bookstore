/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import { createApp } from "vue";
import moment from "moment";
import {
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess,
} from "vform/src/components/bootstrap5";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
app.component(HasError.name, HasError);
app.component(AlertError.name, AlertError);
app.component(AlertErrors.name, AlertErrors);
app.component(AlertSuccess.name, AlertSuccess);
app.mixin({
    methods: {
        dateFormat(value) {
            if (value) {
                return moment(String(value)).format("MM/DD/YYYY hh:mm");
            }
        },
    },
});
/* import ExampleComponent from "./components/ExampleComponent.vue";
app.component("example-component", ExampleComponent); */

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
const files = require.context("./", true, /\.vue$/i);
files
    .keys()
    .map((key) =>
        app.component(key.split("/").pop().split(".")[0], files(key).default)
    );
/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
if (document.querySelector("#app-book")) {
    app.mount("#app-book");
}
if (document.querySelector("#create-book")) {
    app.mount("#create-book");
}
if (document.querySelector("#edit-book")) {
    app.mount("#edit-book");
}
