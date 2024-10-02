<template>
  <div class="wrapper">
    <div class="title">Iniciar Sesión</div>
    <form @submit.prevent="handleLogin">
      <div class="field">
        <input type="email" id="email" v-model="email" required />
        <label for="email">Correo Electrónico</label>
      </div>
      <div class="field">
        <input type="password" id="password" v-model="password" required />
        <label for="password">Contraseña</label>
      </div>
      <div class="content">
        <div class="checkbox">
          <input type="checkbox" id="remember-me" />
          <label for="remember-me">Recordarme</label>
        </div>
        <div class="pass-link">
          <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
      </div>
      <div class="field">
        <input type="submit" value="Iniciar Sesión" />
      </div>
      <div class="signup-link">
        ¿No eres miembro? <a href="#">Regístrate ahora</a>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    handleLogin() {
      if (this.email === '' || this.password === '') {
        alert('Por favor, rellene todos los campos');
        return;
      }

      const loginData = {
        email: this.email,
        password: this.password,
      };

      axios.post('/api/login', loginData)
        .then(response => {
            console.log('Respuesta del servidor:', response.data); // Muestra toda la respuesta

          if (response.data.token) {
            localStorage.setItem('authToken', response.data.token);
            alert('Inicio de sesión exitoso');
          } else {
            alert('Error en el inicio de sesión');
          }
        })
        .catch(error => {
          console.error('Error:', error.response.data);
          alert('Error: ' + (error.response?.data?.message || 'Error desconocido'));
        });
    },
  },
};
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
html, body {
  display: grid;
  height: 100%;
  width: 100%;
  place-items: center;
  background: #f2f2f2;
}
::selection {
  background: #4158d0;
  color: #fff;
}
.wrapper {
  width: 280px; /* Ajustado a 280px */
  background: #fff;
  border-radius: 15px;
  box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
}
.wrapper .title {
  font-size: 24px; /* Ajustado a 24px */
  font-weight: 600;
  text-align: center;
  line-height: 60px; /* Ajustado a 60px */
  color: #fff;
  border-radius: 15px 15px 0 0;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
}
.wrapper form {
  padding: 10px 15px 30px 15px; /* Ajustado a 15px */
}
.wrapper form .field {
  height: 35px; /* Ajustado a 35px */
  margin-top: 10px; /* Ajustado a 10px */
  position: relative;
}
.wrapper form .field input {
  height: 100%;
  width: 100%;
  outline: none;
  font-size: 14px; /* Ajustado a 14px */
  padding-left: 10px; /* Ajustado a 10px */
  border: 1px solid lightgrey;
  border-radius: 25px;
  transition: all 0.3s ease;
}
.wrapper form .field input:focus,
.wrapper form .field input:valid {
  border-color: #4158d0;
}
.wrapper form .field label {
  position: absolute;
  top: 50%;
  left: 15px; /* Ajustado a 15px */
  color: #999999;
  font-weight: 400;
  font-size: 14px; /* Ajustado a 14px */
  pointer-events: none;
  transform: translateY(-50%);
  transition: all 0.3s ease;
}
.wrapper form .field input:focus ~ label,
.wrapper form .field input:valid ~ label {
  top: 0%;
  font-size: 13px; /* Ajustado a 13px */
  color: #4158d0;
  background: #fff;
}
.wrapper form .content {
  display: flex;
  width: 100%;
  height: 40px; /* Ajustado a 40px */
  font-size: 14px; /* Ajustado a 14px */
  align-items: center;
  justify-content: space-between;
}
.wrapper form .content .checkbox {
  display: flex;
  align-items: center;
}
.wrapper form .field input[type="submit"] {
  color: #fff;
  border: none;
  font-size: 16px; /* Ajustado a 16px */
  font-weight: 500;
  cursor: pointer;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
  transition: all 0.3s ease;
  padding: 10px; /* Ajustado a 10px */
}
.wrapper form .field input[type="submit"]:active {
  transform: scale(0.95);
}
.wrapper form .signup-link {
  color: #262626;
  margin-top: 15px; /* Ajustado a 15px */
  text-align: center;
}
.wrapper form .pass-link a,
.wrapper form .signup-link a {
  color: #4158d0;
  text-decoration: none;
}
.wrapper form .pass-link a:hover,
.wrapper form .signup-link a:hover {
  text-decoration: underline;
}
</style>
