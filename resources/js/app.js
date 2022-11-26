require('./bootstrap');

console.log( 'Hello, World!' );

import { createApp } from "vue";
import AppHome from "./components/AppHome";

createApp( AppHome ).mount( '#app' );

