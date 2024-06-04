<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';

const props = defineProps({
  agendamento: Object,
  user_psicologo: Object,
  user_paciente: Object,
});

// Initialize the form with the anotacao field from the props
const formAnotacao = useForm({
  anotacao: props.agendamento.anotacao,
});

// Initialize the form with the patient details from the props
const formFicha = useForm({
  name: props.user_paciente.name,
  endereco: props.user_paciente.endereco,
  telefone: props.user_paciente.telefone,
  email: props.user_paciente.email,
});

// Define the submit function for anotacao
const submitAnotacao = () => {
  formAnotacao.post(route('nova-anotacao', { id: props.agendamento.id }), {
    onError: (errors) => {
      console.error('Form submission error:', errors);
      alert('Erro ao salvar anotação');
    }
  });
};

// Define the submit function for updating the ficha
const submitFicha = () => {
  formFicha.put(route('update-ficha', { id: props.user_paciente.id }), {
    onError: (errors) => {
      console.error('Form submission error:', errors);
      alert('Erro ao atualizar ficha');
    }
  });
};

const showFicha = ref(false);
const editFicha = ref(false);

const toggleFicha = () => {
  showFicha.value = !showFicha.value;
}

const toggleEditFicha = () => {
  editFicha.value = !editFicha.value;
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
        {{ showFicha ? 'Esconder Ficha' : 'Mostrar Ficha' }}
      </button>
      <div v-if="showFicha" class="ficha-container">
        <h1>Ficha Paciente</h1>
        <button @click="toggleEditFicha" class="edit-button">
          {{ editFicha ? 'Cancelar' : 'Editar' }}
        </button>
        <div v-if="!editFicha">
          <div class="info-item">
            <strong>Nome:</strong> {{ props.user_paciente.name }}
          </div>
          <div class="info-item">
            <strong>Endereço:</strong> {{ props.user_paciente.endereco }}
          </div>
          <div class="info-item">
            <strong>Telefone:</strong> {{ props.user_paciente.telefone }}
          </div>
          <div class="info-item">
            <strong>Email:</strong> {{ props.user_paciente.email }}
          </div>
        </div>
        <div v-else>
          <form @submit.prevent="submitFicha">
            <div class="info-item">
              <label for="name" class="label">Nome</label>
              <TextInput id="name" v-model="formFicha.name" class="input-field" required></TextInput>
            </div>
            <div class="info-item">
              <label for="endereco" class="label">Endereço</label>
              <TextInput id="endereco" v-model="formFicha.endereco" class="input-field" required></TextInput>
            </div>
            <div class="info-item">
              <label for="telefone" class="label">Telefone</label>
              <TextInput id="telefone" v-model="formFicha.telefone" class="input-field" required></TextInput>
            </div>
            <div class="info-item">
              <label for="email" class="label">Email</label>
              <TextInput id="email" v-model="formFicha.email" class="input-field" required></TextInput>
            </div>
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': formFicha.processing }" :disabled="formFicha.processing">
              Salvar
            </PrimaryButton>
          </form>
        </div>
      </div>
    </div>

    <form class="container" @submit.prevent="submitAnotacao">
      <label for="anotacao" class="label">Anotação da Sessão</label>
      <TextArea id="anotacao" type="text" class="styled-textarea" v-model="formAnotacao.anotacao" required autocomplete="Escreva aqui"></TextArea>
      <PrimaryButton class="ml-4" :class="{ 'opacity-25': formAnotacao.processing }" :disabled="formAnotacao.processing">
        Salvar
      </PrimaryButton>
    </form>
  </AuthenticatedLayout>
</template>

<style>
.container {
  margin: 20px;
}

.label {
  font-weight: bold;
  margin-bottom: 20px;
}

.input-field {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  font-size: 1.25rem;
  border: 1px solid #ccc;
  border-radius: 8px;
}

.input-field:focus {
  outline: none;
  border-color: #3182ce;
  box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.6);
}

.styled-textarea {
  text-align: top;
  width: 100%;
  height: 200px;
  padding: 10px;
  font-size: 1.25rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  resize: vertical;
  white-space: pre-wrap; /* Ensures text breaks lines and wraps within the textarea */
}

.styled-textarea:focus {
  outline: none;
  border-color: #3182ce;
  box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.6);
}

.toggle-button, .edit-button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin: 20px;
}

.toggle-button:hover, .edit-button:hover {
  background-color: #0056b3;
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
