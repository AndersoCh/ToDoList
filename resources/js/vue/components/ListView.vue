<template>
  <div class="notas-container">
    <div v-for="nota in notas" :key="nota.id" class="nota">
      <list-nota :nota="nota" v-on:itemchanged="$emit('reloadlist')" />
    </div>
  </div>
</template>

<script>
import listNota from './listNota.vue';

export default {
  props: ['notas'],
  components: {
    listNota
  },
  methods: {
    removeNota(nota) {
      this.$emit('remove', nota);
    }
  }
};
</script>

<style scoped>
.notas-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  
}

.nota {
  background: #e5e5e5;
  flex: 1 1 calc(2.33% );
  margin-bottom: 10px;
  margin-left: 10px;
}
</style>
