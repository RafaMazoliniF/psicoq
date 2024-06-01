<script setup>
import { route } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Agendamentos 
                <a href="/agendamentos/agendar" class="nav-button ml-4" v-if="$page.props.auth.user.permissao === 0" style="float: right;">Agendar</a>
            </h2>
        </template>

    </AuthenticatedLayout>
</template>
