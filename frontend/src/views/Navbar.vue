<template>
  <div class="navbar">
    <h1 class="logo"><span>TBR</span> Produções</h1>
    <nav class="nav-links">
      <RouterLink to="/insert">Adicionar funcionário</RouterLink>
      <RouterLink to="/list">Listagem</RouterLink>
      <RouterLink to="/delete">Excluir</RouterLink>
    </nav>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
</script>

<style scoped>
.navbar {
  display: flex;
  top: 0px;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 10rem;
  background-color: #1a1a1a; /* cor do background da logo */
  color: white;
}

.logo {
  font-size: 24px;
  margin: 0;
}

.logo span {
  font-weight: bold;
  color: #ec344a;
}

.nav-links {
  display: flex;
  margin-right: 3rem;
}

.nav-links a {
  color: white;
  text-decoration: none;
  text-transform: uppercase;
  font-size: 16px;
  padding: 0.5rem 1rem;
  margin-left: 3rem;
  border-radius: 5px;
  
}

.nav-links a:hover {
  background-color: #2c2b2b;
}
</style>
