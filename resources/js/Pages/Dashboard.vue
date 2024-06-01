<script setup>
import { route } from '@inertiajs/inertia-vue3';
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard 
            </h2>
            <!-- Botão de acesso à rota /register -->
            <button v-if="$page.props.auth.user.permissao === 2" @click="redirectRegister" class="btn-register">
                Registrar
            </button>
        </template>

        <!-- Conteúdo do dashboard -->
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    components: {
        AuthenticatedLayout,
    },
    methods: {
        // Método para redirecionar para a rota /register
        redirectRegister() {
            route('/register');
        }
    }
};
</script>

<style>
/* Estilos para o botão */
.btn-register {
    position: absolute;
    top: 0;
    right: 0;
    margin-top: 50px;
    margin-right: 10px;
}
</style>
