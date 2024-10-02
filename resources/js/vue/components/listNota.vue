<template>
    <div class="nota-card">
        <div class="nota-header">
            <h3 class="nota-title">{{ localNota.titulo }}</h3>
            <div class="nota-actions">
                <button @click="updateNota" class="update-button">Actualizar</button>
                <button @click="removeItem" class="trashcan">Eliminar</button>
            </div>
        </div>
        <div class="nota-item">
            <input type="text" v-model="localNota.descripcion" placeholder="Descripción" class="form-input" />
        </div>
        <div class="nota-item">
            <input type="date" v-model="localNota.fecha_creacion" class="form-input" />
            <input type="date" v-model="localNota.fecha_vencimiento" class="form-input" />
        </div>
    </div>
</template>

<script>

import axios from 'axios';

export default {
    props: ['nota'],
    data() {
        return {
            localNota: {
                ...this.nota,
                fecha_creacion: this.formatDate(this.nota?.fecha_creacion),
                fecha_vencimiento: this.formatDate(this.nota?.fecha_vencimiento),
                usuario_id: 1,
            },
        };
    },
    methods: {
        formatDate(dateString) {
            if (!dateString) return null;
            const date = new Date(dateString);
            return date.toISOString().split('T')[0];
        },
        updateNota() {
            this.localNota.fecha_creacion = this.formatDate(this.localNota.fecha_creacion);
            this.localNota.fecha_vencimiento = this.formatDate(this.localNota.fecha_vencimiento);

            axios.put(`/api/nota/${this.localNota.id}`, this.localNota)
                .then(response => {
                    if (response.status === 200) {
                        console.log('Nota actualizada:', response.config);
                        this.$emit('itemchanged');
                    } else {
                        console.error('Error actualizando la nota:', response);
                    }
                })
                .catch(error => {
                    console.error('Error en la actualización:', error.response ? error.response.data : error.message);
                    alert('Error en la actualización: ' + (error.response?.data?.message || error.message));
                });
        },
        removeItem() {
            axios.delete(`/api/nota/${this.localNota.id}`)
                .then(response => {
                    if (response.status === 200) {
                        this.$emit('itemchanged');
                    }
                })
                .catch(error => {
                    console.error('Error en la eliminación:', error);
                });
        }
    }
};
</script>
<style scoped>
.nota-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 10px;
    margin: 10px;
    width: 95%;
    max-width: 400px;
    transition: transform 0.2s ease;
}

.nota-card:hover {
    transform: translateY(-5px);
}

.nota-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nota-title {
    font-size: 1.2rem;
    color: #333;
    margin: 0;
}

.nota-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-input {
    flex: 1;
    margin-right: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-input:last-child {
    margin-right: 0;
}

.nota-actions {
    display: flex;
    justify-content: flex-end;
}

.update-button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    cursor: pointer;
    margin-right: 10px;
    transition: background-color 0.2s;
}

.update-button:hover {
    background-color: #0056b3;
}

.trashcan {
    background: red;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
}

.trashcan:hover {
    background: #d4d4d4;
}
</style>
