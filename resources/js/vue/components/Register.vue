<template>
    <div class="container">
      <div class="title">Registrarse</div>
      <div class="content">
        <form @submit.prevent="handleRegister">
          <div class="user-details">
            <div class="input-box">
              <span class="details">Nombre</span>
              <input type="text" v-model="name" placeholder="Introduce tu nombre" required />
            </div>
            <div class="input-box">
              <span class="details">Correo Electrónico</span>
              <input type="email" v-model="email" placeholder="Introduce tu correo" required />
            </div>
            <div class="input-box">
              <span class="details">Contraseña</span>
              <input type="password" v-model="password" placeholder="Introduce tu contraseña" required />
            </div>
            <div class="input-box">
              <span class="details">Confirmar Contraseña</span>
              <input type="password" v-model="password_confirmation" placeholder="Confirma tu contraseña" required />
            </div>
          </div>
          <div class="button">
            <button type="submit">Registrarse</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'Register',
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      };
    },
    methods: {
      handleRegister() {
        if (this.password !== this.password_confirmation) {
          alert('Las contraseñas no coinciden.');
          return;
        }
        const loginRegister = {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        };
  
        axios
          .post('api/register', loginRegister)
          .then((response) => {
            if (response.data.token) {
              alert('Usuario Registrado con Éxito');
            } else {
              alert('No se pudo registrar usuario');
            }
          })
          .catch((error) => {
            alert('Error: ' + (error.response?.data?.message || 'Error desconocido'));
          });
      },
    },
  };
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
  
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  
  .container {
    max-width: 700px;
    width: 100%;
    background-color: #fff;
    padding: 25px 30px;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
  }
  
  .title {
    font-size: 25px;
    font-weight: 500;
    margin-bottom: 20px;
    position: relative;
  }
  
  .title::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 30px;
    border-radius: 5px;
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
  }
  
  .content form .user-details {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 20px 0;
  }
  
  .input-box {
    margin-bottom: 15px;
    width: calc(100% / 2 - 20px);
  }
  
  .input-box span.details {
    display: block;
    font-weight: 500;
    margin-bottom: 5px;
  }
  
  .input-box input {
    height: 45px;
    width: 100%;
    outline: none;
    font-size: 16px;
    border-radius: 5px;
    padding-left: 15px;
    border: 1px solid #ccc;
    transition: all 0.3s ease;
  }
  
  .input-box input:focus {
    border-color: #9b59b6;
  }
  
  .button {
    height: 45px;
    width: 100%;
  }
  
  .button button {
    height: 100%;
    width: 100%;
    border-radius: 5px;
    border: none;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
    transition: all 0.3s ease;
  }
  
  .button button:hover {
    background: linear-gradient(-135deg, #71b7e6, #9b59b6);
  }
  </style>
  