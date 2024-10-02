<template>
  <Login @login-success="handleLogin" />

  <div class="addItem">
    <input type="text" v-model="nota.titulo" placeholder="Agregar título" class="input" />
    <input type="text" v-model="nota.descripcion" placeholder="Agregar descripción" class="input" />
    <input type="date" v-model="nota.fecha_creacion" placeholder="Fecha de creación" class="input" />
    <input type="date" v-model="nota.fecha_vencimiento" placeholder="Fecha de vencimiento" class="input" />
    <input type="number" v-model="nota.usuario_id" placeholder="ID de usuario" class="input" />
    <button class="btn btn-primary" @click="addNota">
      <i class="bi bi-plus-lg"></i>
    </button>
  </div>
</template>

<script>
import axios from 'axios'; // Asegúrate de importar axios

axios.interceptors.request.use(config => {
  const token = localStorage.getItem('authToken');
  console.log("El token para agregar en add: " + token); // Asegúrate de que se esté obteniendo correctamente el token
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});
export default {
  data() {
    return {
      nota: {
        titulo: "",
        descripcion: "",
        fecha_creacion: new Date().toISOString().slice(0, 10),
        fecha_vencimiento: new Date().toISOString().slice(0, 10),
        usuario_id: 1
      }
    };
  },
  methods: {
    handleLogin(token) {
      this.token = token;
      localStorage.setItem('authToken', token);
    },
    addNota() {
      if (this.nota.titulo === '') {
        return;
      }

      const token = localStorage.getItem('authToken');
      console.log("Token enviado:", token);

      axios.post('api/nota/store', this.nota)
        .then(response => {
          if (response.status === 201) {
            this.nota = {
              titulo: "",
              descripcion: "",
              fecha_creacion: new Date().toISOString().slice(0, 10),
              fecha_vencimiento: new Date().toISOString().slice(0, 10),
              usuario_id: 1
            };
            this.$emit('reloadlist');
          }
        })
        .catch(error => {
          console.error('Error en la solicitud:', error);
          if (error.response) {
            console.error('Respuesta del servidor:', error.response.data);
          } else if (error.request) {
            console.error('La solicitud fue hecha pero no se recibió respuesta:', error.request);
          } else {
            console.error('Error al configurar la solicitud:', error.message);
          }
        });
    }
  }
};
</script>

<style scoped>
.addItem {
  display: flex;
  flex-direction: column;
  /* Cambiado a columna para que los inputs estén apilados */
  justify-content: center;
  align-items: center;
}

.input {
  background: #f7f7f7;
  border: 1px solid #ccc;
  /* Añadido borde para mayor claridad */
  outline: none;
  padding: 5px;
  margin: 5px 0;
  /* Ajustado margen */
  width: 200px;
  /* Ajusta el ancho según sea necesario */
}
</style>