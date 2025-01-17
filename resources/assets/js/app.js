/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component(
  "changeable-element",
  require("./components/ChangeableElement.vue")
);
Vue.component("super-input", require("./components/SuperInput.vue"));
Vue.component("changeable-row", require("./components/ChangeableRow.vue"));
Vue.component(
  "extendable-form-table",
  require("./components/ExtendableFormTable.vue")
);
Vue.component("advanced-select", require("./components/AdvancedSelect.vue"));


const app = new Vue({
  el: "#app"
});
