

<template>
    <GuestLayout>
        <div v-if="$page.props.auth.user.permissao === 2">
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="permissao"/>
                <div>
                  <label>
                    <input type="radio" id="permissao" name="permissao" value="0" v-model="form.permissao">
                    Paciente
                  </label>
                  <label>
                    <input type="radio" id="permissao" name="permissao" value="1" v-model="form.permissao">
                    Psicologo
                  </label>
                </div>
                <InputError class="mt-2" :message="form.errors.permissao" />
            </div>
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="cep" value="CEP" />
                <TextInput id="cep" v-model="form.cep" @blur="pesquisacep" type="text" class="mt-1 block w-full" />
                <InputError :message="form.errors.cep" class="mt-2" />
            </div>

            <div>
                <InputLabel for="endereco" value="Endereço" />
                <TextInput id="endereco" v-model="form.endereco" type="text" class="mt-1 block w-full" readonly />
                <InputError :message="form.errors.endereco" class="mt-2" />
            </div>
            <InputLabel for="numero" value="Numero" />
                <TextInput id="numero" type="text" class="mt-1 block w-full" v-model="form.numero" required autofocus autocomplete="numero" />
                <InputError class="mt-2" :message="form.errors.numero" />
            <div>
                <InputLabel for="telefone" value="telefone" />
                <TextInput id="telefone" type="text" class="mt-1 block w-full" v-model="form.telefone" required autocomplete="telefone" />
                <InputError class="mt-2" :message="form.errors.telefone" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </div>
    
  <div v-if="$page.props.auth.user.permissao !== 2" class="page">
    <div class="message">Você não tem acesso</div>
    <a href="/dashboard" class="nav-button ml-4" >Voltar</a>
    
  </div>

    </GuestLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    permissao: '',
    name: '',
    email: '',
    endereco: '',
    numero:'',
    telefone: '',
    cep: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

function limpa_formulário_cep() {
    form.endereco = "";
}

async function pesquisacep() {
    const cep = form.cep.replace(/\D/g, '');
    if (cep !== "") {
        const validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            form.endereco = "...";
            try {
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                const data = await response.json();
                if (!("erro" in data)) {
                    form.endereco = `${data.logradouro}, ${data.localidade}`;
                } else {
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            } catch (error) {
                limpa_formulário_cep();
                alert("Erro ao buscar CEP.");
            }
        } else {
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } else {
        limpa_formulário_cep();
    }
}
</script>
