<script setup>
import { route } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard 
                <a href="/register" class="nav-button ml-4" v-if="$page.props.auth.user.permissao === 2" style="float: right;">Cadastro.</a>
            </h2>
        </template>

    </AuthenticatedLayout>
</template>
