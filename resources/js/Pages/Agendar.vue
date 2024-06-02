<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { route } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  psicologos: Array,
  agendamentos: Array,
  users: Array,
});

const form = useForm({
  psicologo_id: '',
  data: '',
  hora: '',
});

const submit = () => {
  form.post(route('agendar'));
};
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Agenda
        <a
          href="/agendamentos"
          class="nav-button ml-4"
          v-if="$page.props.auth.user.permissao === 0"
          style="float: right;"
        >
          Voltar
        </a>
      </h2>
    </template>
    <div class="agenda-container">
      <div class="agenda">
        <div v-for="psicologo in psicologos" :key="psicologo.id" class="item">
          <p>Nome do Psicologo: {{ users[psicologo.user_id - 1].name }}</p>
          <form @submit.prevent="submit" class="form">
            <div>
              <label>
                <input
                  type="radio"
                  id="psicologo_id"
                  name="psicologo_id"
                  :value="psicologo.id"
                  v-model="form.psicologo_id"
                  class="radio-button"
                />
                Selecionar
              </label>
            </div>

            <div>
              <label for="data">Data:</label>
              <input v-model="form.data" id="data" type="date" />
            </div>

            <div>
              <label for="hora">Horário:</label>
              <select v-model="form.hora" id="hora">
                <option value="08:00">08h00</option>
                <option value="09:00">09h00</option>
                <option value="10:00">10h00</option>
                <option value="11:00">11h00</option>
                <option value="13:00">13h00</option>
                <option value="14:00">14h00</option>
                <option value="15:00">15h00</option>
              </select>
            </div>
            <button type="submit">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.page {
  font-family: 'Roboto', sans-serif;
  background-color: #fff;
  color: #333;
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.message {
  text-align: center;
  margin-bottom: 30px;
}

.button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: #0056b3;
}

.agenda-container {
  padding: 20px; /* Espaçamento entre as bordas da página */
}

.agenda {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: space-between; /* Separar as caixas */
}

.item {
  border: 1px solid gray;
  padding: 20px;
  width: calc(33.33% - 20px); /* Definindo a largura para 1/3 do espaço disponível */
  text-align: center;
  border-radius: 10px; /* Bordas arredondadas nas caixas */
  background-color: #f9f9f9; /* Adicione uma cor de fundo para melhor visualização */
  margin-bottom: 1rem; /* Margem inferior de 1 rem para separação entre os itens */
}

form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background: #fff;
}

div {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input,
select,
button {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

button {
  background: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
}

button:hover {
  background: #0056b3;
}

.radio-button {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  width: 20px;
  height: 20px;
  margin: 0;
  border: 2px solid #007bff;
  border-radius: 50%;
  outline: none;
  cursor: pointer;
  position: relative;
}

.radio-button:checked::before {
  content: '';
  display: block;
  width: 10px;
  height: 10px;
  background: #007bff;
  border-radius: 50%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
