import { createApp } from 'vue';
import HelloWorld from './vue/app.vue';
import Login from './vue/components/Login.vue'
import AddNotaForm from './vue/components/AddNotaForm.vue'
import Register from './vue/components/Register.vue'
import { createRouter, createWebHistory } from 'vue-router'; 
import 'bootstrap'; // Importa Bootstrap JS
import 'bootstrap/dist/css/bootstrap.min.css';
import ListView from './vue/components/listView.vue';


const routes = [
    {
      path: '/',
      component: HelloWorld, // Use your HelloWorld component for this route
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/add',
        name: 'AgregarNota',
        component: AddNotaForm
    }
    ,
    {
        path: '/notas',
        name: 'notas',
        component: ListView
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    }
  
  
  ];


  const router = createRouter({
    history: createWebHistory(),
    routes, // Pass the defined routes
  });
  
  
createApp(HelloWorld)
  .use(router) // Make sure to use the router
  .mount('#app');



