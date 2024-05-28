<template>
  <nav class="navbar">
    <div class="navbar-container">
      <a href="/" class="navbar-brand">Clínica PsicoQ</a>
      <div class="navbar-links">
        <a href="#descricao"><button @click="scrollToSection" class="nav-button">Descrição</button></a>
        <a href="#depoimentos"><button @click="scrollToSection" class="nav-button ml-4">Depoimentos</button></a>
        <a href="#contato"><button @click="scrollToSection" class="nav-button ml-4">Entre em contato</button></a>
        <a href="/login" class="nav-button ml-4">Login</a>
      </div>
    </div>
  </nav>
</template>

<script setup>
const scrollToSection = (event) => {
  event.preventDefault();
  const href = event.target.closest('a').getAttribute('href');
  const section = document.querySelector(href);
  if (section) {
    section.scrollIntoView({ behavior: 'smooth' ,block :'start'});
  }
};
</script>

<style scoped>
.navbar {
  background-color: #236ae6; /* bg-gray-800 */
  padding: 2rem; 
}

.navbar-container {
  max-width: 1280px; /* container mx-auto */
  margin: 0 auto; /* mx-auto */
  display: flex; /* flex */
  align-items: center; /* items-center */
  justify-content: space-between; /* justify-between */
}

.navbar-brand {
  color: #ffffff; /* text-white */
  font-weight: bold; /* font-bold */
  text-decoration: none; /* no underline */
  font-size: 1.7rem; /* Custom larger font size */
  font-family: 'Arial', sans-serif; /* Custom font family */
}

.navbar-links {
  display: flex;
}

.nav-button {
  color: #00e1ff; /* text-white */
  font-weight: bold;
  background-color: #221e93;
  border-radius: 0.25rem;
  padding: 0.5rem 1rem;
  transition: background-color 0.3s ease;
  cursor: pointer;
}

.nav-button:hover {
  text-decoration: underline; /* hover:underline */
}

.ml-4 {
  margin-left: 1rem; /* ml-4 */
}
</style>
