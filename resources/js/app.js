import { createApp } from 'vue';

// Importa Bootstrap y jQuery
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import 'jquery';
window.$ = $;

// Aquí puedes importar tus componentes Vue, si los tienes
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});

app.component('example-component', ExampleComponent);

// Monta la aplicación en el elemento con id="app"
app.mount('#app');