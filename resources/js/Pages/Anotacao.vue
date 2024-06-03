<script setup>
import { ref } from 'vue';
import { route } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  agendamento: Object
});

// Usando um estado reativo para a anotação
const anotacao = ref(props.agendamento.anotacao);

const saveAnotacao = () => {
  Inertia.post(route('anotacao', agendamento.id))
   {onError: (errors) => {
      console.error(errors);
    }}
};
</script>   

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Sessão {{ props.agendamento.data }}
        <a href="/agendamentos/agenda" class="nav-button ml-4" v-if="$page.props.auth.user.permissao === 0" style="float: right;">Agendar</a>
      </h2>
    </template>

    <div class="container">
      <textarea v-model="anotacao" class="styled-textarea"></textarea>
      <button @click="saveAnotacao" class="btn btn-primary">Salvar</button>
    </div>
  </AuthenticatedLayout>
</template>

<style>
.container {
  margin: 20px;
}

.styled-textarea {
  width: 100%;
  height: 200px;
  padding: 10px;
  font-size: 1.25rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  resize: vertical;
}

.styled-textarea:focus {
  outline: none;
  border-color: #3182ce;
  box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.6);
}
</style>
