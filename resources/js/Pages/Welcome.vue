<template>
  <div class="page-container">
    <Navbar />
    <div class="content-container">
      <div class="content">
        <h1 class="title">Clínica de psicologia PsicoQ</h1>
        <div class="text-content">
          <!-- Conteúdo do seu site -->
          <p>
            Na Clínica de PsicoQ, nossa equipe está empenhada em proporcionar um ambiente acolhedor e um atendimento eficaz para nossos clientes, visando o bem-estar e a saúde mental de cada um deles. Nosso compromisso se estende a oferecer um suporte clínico qualificado, utilizando métodos específicos adaptados para diversas situações individuais.
            Contamos com profissionais especializados em diferentes abordagens terapêuticas, garantindo uma ampla gama de recursos para atender às necessidades de cada paciente. Oferecemos sessões de terapia individuais, terapia de casal e familiar, bem como acompanhamento psicológico em situações específicas.
            Nossos serviços incluem um ambiente acolhedor e seguro para as sessões, uma variedade de recursos terapêuticos, como testes psicológicos e técnicas de intervenção comprovadas, e profissionais qualificados em diversas áreas da Psicologia Clínica.
            Para agendar uma consulta, entre em contato conosco por telefone. Estamos disponíveis 6 dias por semana (sujeito à disponibilidade de horários). Estamos prontos para ajudá-lo a dar o primeiro passo em direção a uma vida mais equilibrada e saudável.
          </p>
          <p id="descricao" class="section">
            <strong>Projeto:</strong> Este sistema não apenas fornecerá uma presença online para a PsicoQ, mas também servirá como uma ferramenta valiosa para nossos profissionais, incluindo psicólogos e atendentes. Com permissões de acesso adequadas, cada profissional poderá consultar e acrescentar informações dos clientes,
            garantindo uma gestão eficaz e segura de dados. Estamos comprometidos em criar uma plataforma intuitiva e de fácil utilização, tanto para nossos clientes quanto para nossos profissionais. Isso inclui recursos como agendamento de consultas online, acesso a informações sobre nossos serviços e abordagens terapêuticas, bem como a possibilidade de entrar em contato diretamente conosco para obter mais informações.
          </p>
          <p id="depoimentos" class="section">
            <strong>Depoimentos:</strong> Como funcionário da PsicoQ, estou entusiasmado em compartilhar nosso novo projeto de desenvolvimento de um sistema online que servirá como uma plataforma central para nossos clientes nos encontrarem na internet e também para conhecerem mais sobre nossa clínica.
          </p>
          <p id="contato" class="section">
            <strong>Contate-nos:</strong> Telefone: (19) 91923-1318 / (19) 99321-6555
          </p>
          <p class="cta">
            Agende sua consulta hoje e permita-se surpreender com os nossos serviços dedicados ao seu bem-estar psicológico.
          </p>
          <div class="contact-form">
        <div class="container mt-5">
            <h2>Entre em Contato!</h2>
            <div>
                <form @submit.prevent="submitForm">
                    <div>
                        <label for="name">Nome:</label>
                        <input type="text" id="name" v-model="form.name" required>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" v-model="form.email" required>
                    </div>
                    <div>
                        <label for="message">Mensagem:</label>
                        <textarea id="message" v-model="form.message" required></textarea>
                    </div>
                    <button type="submit">Enviar</button>
                </form>
                <p v-if="successMessage">{{ successMessage }}</p>
            </div>
        </div>
    </div>
        </div>
      </div>
    </div>
    <p id="Contatos" class="content-bottom">
      <strong>
        <div class="rectangle">
          <div class="text-center flex flex-wrap justify-evenly items-center">
            <div>
              <h3 class="text-lg font-semibold mb-4">Contato</h3>
              <p class="text-bottom">Clínica de PsicoQ</p>
              <p class="text-bottom">📍Rua Guerra Junqueira, 1232 - Nossa Senhora Auxiliadora</p>
              <p class="text-bottom">134027-71</p>
              <p class="text-bottom">📞(19) 91923-1318 / (19) 99321-6555</p>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-4">Horário de Funcionamento</h3>
              <p class="text-bottom">De segunda a sexta das 7:00 as 17:00</p>
              <p class="text-bottom">De sabádo das 9:00 as 13:00</p>
              <p class="text-bottom">Campinas, SP</p>
            </div>
          </div>
        </div>
      </strong>
    </p>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Navbar from './Navbar.vue';
import axios from 'axios';

const form = ref({
  name: '',
  email: '',
  message: ''
});

const successMessage = ref('');

const submitForm = async () => {
  try {
    const response = await axios.post('/api/contact', form.value);
    successMessage.value = response.data;
    form.value.name = '';
    form.value.email = '';
    form.value.message = '';
  } catch (error) {
    console.error('Erro ao enviar o formulário:', error);
  }
};
</script>

<style scoped>
.contact-form {
  background-color: #f0f8ff; /* Fundo azul claro */
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.contact-form h2 {
  color: #007bff; /* Cor do texto azul */
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  color: #007bff; /* Cor do texto azul */
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #007bff; /* Borda azul */
  border-radius: 4px;
}

.form-group textarea {
  resize: vertical;
}

button {
  background-color: #007bff; /* Fundo azul */
  color: #fff; /* Texto branco */
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3; /* Fundo azul escuro ao passar o mouse */
}

.page-container {
  background-color: #f7fbfc; /* bg-gray-100 */
  min-height: 100vh; /* min-h-screen */
  display: flex;
  flex-direction: column;
}

.content-container {
  max-width: 1280px; /* container mx-auto */
  margin: 0 auto; /* mx-auto */
  padding: 3rem 1rem; /* px-4 py-12 */
}

.content {
  max-width: 1024px; /* max-w-4xl */
  margin: 0 auto; /* mx-auto */
}

.title {
  font-size: 2.25rem; /* text-4xl */
  font-weight: bold; /* font-bold */
  text-align: left; /* text-center */
  color: #2d3748; /* text-gray-800 */
  margin-bottom: 2rem; /* mb-8 */
}

.text-content {
  font-family: 'Verdana', sans-serif; /* Escolha uma fonte diferente */
  text-align: justify; /* Texto justificado */
  margin-top: 1rem;
  font-size: 1.1rem;
}

.contact-info, .cta, .section {
  margin-top: 2rem; /* mt-8 */
}

.cta {
  margin-bottom: 3rem; /* mb-12 */
}

.footer {
  margin-top: 2rem; /* mt-8 */
}

.rectangle {
  background-color: #236ae6;
  max-width: 100%;
  padding: 2rem; /* Added padding for better spacing */
  color: white; /* Ensure text color contrasts with background */
}

.text-bottom {
  text-align: center;
  font-size: 1rem;
  margin-bottom: 1rem; /* Add margin bottom for spacing between lines */
}

.text-center {
  text-align: center;
}

.flex {
  display: flex;
}

.flex-wrap {
  flex-wrap: wrap;
}

.justify-evenly {
  justify-content: space-evenly;
}

.items-center {
  align-items: center;
}

h3 {
  font-size: 1.25rem; /* text-lg */
  font-weight: 600; /* font-semibold */
  margin-bottom: 1rem; /* mb-4 */
}
.contact-form {
            background-color: #f0f8ff; /* Light blue background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .contact-form h2 {
            color: #000;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .contact-form form {
            display: flex;
            flex-direction: column;
        }

        .contact-form label {
            margin-bottom: 5px;
            font-size: 16px;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: #007bff; /* Blue outline on focus */
        }

        .contact-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }

        .contact-form p {
            color: green;
            font-size: 14px;
            margin-top: 15px;
        }
</style>
