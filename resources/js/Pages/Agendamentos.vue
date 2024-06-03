<script setup>
import { route } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { InertiaLink } from '@inertiajs/inertia-vue3';

defineProps({
  agendamentos_futuros: Array,
  agendamentos_passados: Array,
  psicologos: Array,
  pacientes: Array,
  users: Array,
});

const handleView = (agendamentoId) => {
  Inertia.get(route('/anotacao', { id: agendamentoId }));
};
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Agendamentos 
        <a href="/agendamentos/agenda" class="nav-button ml-4" v-if="$page.props.auth.user.permissao === 0" style="float: right;">Agendar</a>
      </h2>
    </template>
    <div class="container">
      <h2 class="titulo-secao">Agendamentos Passados</h2>
      <table class="tabela">
        <thead>
          <tr>
            <th>Nome Paciente</th>
            <th>Nome Psicologo</th>
            <th>Data</th>
            <th>Horário</th>
            <th v-if="$page.props.auth.user.permissao === 1">Anotação</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="agendamento in agendamentos_passados" :key="agendamento.id">
            <td>{{ users[pacientes[agendamento.paciente_id -1].user_id -1].name }}</td>
            <td>{{ users[psicologos[agendamento.psicologo_id -1].user_id -1].name }}</td>
            <td>{{ agendamento.data }}</td>
            <td>{{ agendamento.hora }}</td>
            <td v-if="$page.props.auth.user.permissao === 1"> {{ agendamento.anotacao }} </td>
          </tr>
        </tbody>
      </table>

      <div class="separador"></div>

      <h2 class="titulo-secao">Agendamentos Futuros</h2>
      <table class="tabela">
        <thead>
          <tr>
            <th>Nome Paciente</th>
            <th>Nome Psicologo</th>
            <th>Data</th>
            <th>Horário</th>
            <th v-if="$page.props.auth.user.permissao === 1">Anotação</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="agendamento in agendamentos_futuros" :key="agendamento.id">
            <td>{{ users[pacientes[agendamento.paciente_id -1].user_id -1].name }}</td>
            <td>{{ users[psicologos[agendamento.psicologo_id -1].user_id -1].name }}</td>
            <td>{{ agendamento.data }}</td>
            <td>{{ agendamento.hora }}</td>
            <td v-if="$page.props.auth.user.permissao === 1"><Inertia-link :href="`/anotacao/${agendamento.id}`">VER</Inertia-link></td>
          </tr>
        </tbody>
      </table>
    </div>
  </AuthenticatedLayout>
</template>

<style>
.container {
  margin: 20px;
}

.titulo-secao {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.tabela {
  width: 100%;
  border-collapse: collapse;
  background-color: #ffffff; /* fundo branco */
  margin-bottom: 20px;
}

.tabela th,
.tabela td {
  padding: 0.5rem;
  border: 1px solid #dee2e6;
  text-align: center; /* centraliza o texto */
}

.tabela th {
  background-color: #f2f2f2;
}

.separador {
  margin: 20px 0;
  border-bottom: 1px solid #dee2e6;
}
</style>
