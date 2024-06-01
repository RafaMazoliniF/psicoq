<script setup>
import { ref } from 'vue';
import { route } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineProps({
    psicologos: Array,
  });
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
          <div
          v-for="psicologo in psicologos" :key="psicologo.id"
            class="item"
          >
            <p>Id Psicologo:  {{  psicologo.id }}</p>
            <div class="times">
            </div>
          </div>
        </div>
      </div>

    </AuthenticatedLayout>
  </template>
  
  <style scoped>
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
  
  .times {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
  }
  
  .time-button {
    border: 1px solid gray;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px; /* Bordas arredondadas nos botões */
    background-color: #ffffff; /* Adicione uma cor de fundo para melhor visualização */
  }
  </style>