<template>
  <div class="listagem-funcionarios">
    <h1>Lista de Funcionários Cadastrados</h1>

    <div class="tabela">
      <div class="linha cabecalho">
        <div class="coluna">Nome completo</div>
        <div class="coluna">E-mail</div>
        <div class="coluna">Cargo</div>
      </div>

      <!-- linhas funcionários -->
      <div
        v-for="(funcionario, index) in funcionarios" :key="funcionario.id_funcionario" class="linha" :class="{ 'linha-zebra': index % 2 !== 0 }"> <!-- fazendo com que alterne a linha -->
        <div class="coluna">{{ funcionario.nome_funcionario }}</div>
        <div class="coluna">{{ funcionario.email_funcionario }}</div>
        <div class="coluna">{{ funcionario.nome_cargo }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const funcionarios = ref([])

const buscarFuncionarios = async () => {
  try {
    const response = await fetch('http://localhost/TBR-projeto-teste/backend/funcionarios/list.php')
    const data = await response.json()
    funcionarios.value = data
  } catch (error) {
    console.error('Erro ao buscar funcionários:', error)
  }
}

onMounted(() => {
  buscarFuncionarios()
})
</script>

<style scoped>
.listagem-funcionarios {
  text-align: center;
  max-width: 800px;
  margin: 0 auto;
}

h1 {
  color: #ec344a;
  font-weight: bold;
  font-size: 24px;
  text-transform: uppercase;
  margin-bottom: 3rem;
  margin-top: 3rem;
}

.tabela {
  display: flex;
  flex-direction: column;
  border: 1px solid #ccc;
  border-radius: 6px;
  overflow: hidden;
}

.linha {
  display: flex;
  padding: 10px 0;
  background-color: #2c2b2b;
}

.linha-zebra {
  background-color: #1a1a1a;
}

.cabecalho {
  background-color: #000000;
  color: white;
  font-weight: bold;
}

.coluna {
  flex: 1;
  padding: 0 10px;
  text-align: left;
  font-size: 16px;
}
</style>
