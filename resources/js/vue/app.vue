<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">To do</h2>

            <Navbar />
            <router-view></router-view>
            <Login @login-success="handleLogin" />

            <!--    <add-nota-form @add="addNota" v-on:reloadlist="getList" /> -->
        </div>
        <list-view v-if="$route.name === 'notas'" :notas="notas" @itemchanged="getList" @update-nota="handleUpdateNota"
            v-on:reloadlist="getList" />

         


    </div>
</template>

<script>

import axios from 'axios'; // Import axios
import ListView from './components/ListView.vue';
import Navbar from './components/Navbar.vue';
import Login from './components/Login.vue';



axios.interceptors.request.use(config => {
    const token = localStorage.getItem('authToken');
    console.log('Token en la solicitud:', token); 
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
}, error => {
    return Promise.reject(error);
});


export default {
    components: {
        Navbar,
        ListView,
        
        
    },
    data: function () {
        return { // Corrected syntax here
            notas: []
        };
    },
    methods: {
        handleLogin(token) {
            this.token = token; 
            localStorage.setItem('authToken', token);
        },
        handleUpdateNota(updatedNota) {
            const index = this.notas.findIndex(nota => nota.id === updatedNota.id);
            console.log("Nota que actualiza:" + response.data)
            if (index !== -1) {
                this.$set(this.notas, index, updatedNota);
            }
        },
        getList() {
            axios.get('api/notas')
                .then(response => {
                    this.notas = response.data;
                    console.log('Notas recuperadas:', response.data);
                })
                .catch(error => {
                    console.error('Error al obtener la lista de notas:', error.response ? error.response.data : error.message);
                    alert('Hubo un error al cargar las notas.'+ (error.response?.data?.message || error.message)); 
                });
        },
        addNota(nota) {
            this.notas.push(nota);
            this.getList();
        },
        removeNota(nota) {
            this.notas = this.notas.filter(item => item.id !== nota.id);
            this.getList();
        },

    },
    created() {
        this.getList(); // Fetch the notes when the component is created
    }
};
</script>




<style>
/* Estilos básicos para tu aplicación */
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