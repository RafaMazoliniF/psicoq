<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  agendamento: Object,
  user_psicologo: Object,
  user_paciente: Object,
});

// Initialize the form with the anotacao field from the props
const form = useForm({
  anotacao: props.agendamento.anotacao,
});

// Define the submit function
const submit = () => {
  form.post(route('nova-anotacao', { id: props.agendamento.id }), {
    onError: (errors) => {
      console.error('Form submission error:', errors);
      alert('Erro ao salvar anotação');
    }
  });
};

const showFicha = ref(false);

const toggleFicha = () => {
  showFicha.value = !showFicha.value;
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Sessão: {{ props.agendamento.data }} | {{ props.user_paciente.name }}
        <a href="/agendamentos/agenda" class="nav-button ml-4" v-if="$page.props.auth.user.permissao === 0" style="float: right;">Agendar</a>
      </h2>
    </template>


  <div>
    <button @click="toggleFicha" class="toggle-button">
      {{ showFicha ? 'Ficha' : 'Ficha' }}
    </button>
    <div v-if="showFicha" class="ficha-container">
      <h1>Ficha Paciente</h1>
      <div class="info-item">
        <strong>Nome:</strong> {{ user_paciente.name }}
      </div>
      <div class="info-item">
        <strong>Endereço:</strong> {{ user_paciente.endereco }}
      </div>
      <div class="info-item">
        <strong>Telefone:</strong> {{ user_paciente.telefone }}
      </div>
      <div class="info-item">
        <strong>Email:</strong> {{ user_paciente.email }}
      </div>
    </div>
  </div>



    <form class="container" @submit.prevent="submit" v-if="$page.props.auth.user.permissao === 1">
      <InputLabel for="anotacao" value="Anotação" />
      <TextInput id="anotacao" type="text" class="styled-textarea" v-model="form.anotacao" required autocomplete="Escreva aqui" />
      <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Salvar
      </PrimaryButton>
    </form>
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
.toggle-button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin: 20px;
}

.toggle-button:hover {
  background-color: #0056b3;
  margin: 20px;
}

.ficha-container {
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  background-color: #f9f9f9;
  width: 300px;
  margin: auto;
  text-align: left;
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
}

.info-item {
  font-size: 18px;
  margin-bottom: 10px;
}

strong {
  font-weight: bold;
}
</style>
