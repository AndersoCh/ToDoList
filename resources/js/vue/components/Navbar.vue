<!-- resources/js/vue/components/Navbar.vue -->
<template>
    <nav>
      <router-link to="/notas">Notas</router-link>
      <router-link to="/add">Agregar Nota</router-link>
      <router-link to="/login">Iniciar Sesión</router-link>
      <router-link to="/register">Registrarse</router-link>
    </nav>
  </template>
  
  <script>
  export default {
    name: 'Navbar',
  };
  </script>
  
  <style scoped>
  nav {
    margin-bottom: 20px;
    background-color: #f8f9fa;
    padding: 10px;
  }
  
  nav a {
    margin-right: 15px;
    text-decoration: none;
    color: #007bff;
  }
  
  nav a:hover {
    text-decoration: underline;
  }
  </style>
  