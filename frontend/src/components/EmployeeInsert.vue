<template>
  <div class="visualizacao-funcionario">
    <h1>Visualização de funcionário</h1>
    <form @submit.prevent="inserirFuncionario">
      <label for="nome_funcionario">Nome</label>
      <input type="text" v-model="nome_funcionario" id="nome_funcionario" required />

      <label for="email_funcionario">E-mail</label>
      <input type="text" v-model="email_funcionario" id="email_funcionario" required />

      <label>Cargo</label>
      <select v-model="cargo_funcionario" required>
        <option disabled value="">Selecione um cargo</option>
        <option v-for="c in cargos" :key="c.id_cargo" :value="c.id_cargo">
          {{ c.nome_cargo }}
        </option>
      </select>

      <button type="submit">Inserir</button>
    </form>
    <p v-if="mensagem">{{ mensagem }}</p>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'

const nome_funcionario = ref('')
const email_funcionario = ref('')
const cargo_funcionario = ref('')
const cargos = ref([]) // variável para armazenar os cargos carregados
const mensagem = ref('')

// carregar os cargos do banco de dados
const carregarCargos = async () => {
  try {
    const res = await fetch('http://localhost/TBR-projeto-teste/backend/funcionarios/getJobs.php')
    const data = await res.json()
    cargos.value = data
  } catch (err) {
    console.error('Erro ao carregar cargos:', err)
  }
}

// função para inserir funcionário via POST
const inserirFuncionario = async () => {
  const funcionario = {
    nome_funcionario: nome_funcionario.value,
    email_funcionario: email_funcionario.value,
    cargo_funcionario: cargo_funcionario.value
  }

  try {
    const response = await fetch('http://localhost/TBR-projeto-teste/backend/funcionarios/insert.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(funcionario)
    })

    const data = await response.json()

    if (data.sucesso) {
      mensagem.value = 'Funcionário inserido com sucesso!'
      nome_funcionario.value = ''
      email_funcionario.value = ''
      cargo_funcionario.value = ''
    } else {
      mensagem.value = 'Erro ao inserir funcionário: ' + data.erro
    }
  } catch (error) {
    console.error('Erro ao inserir funcionário:', error)
    mensagem.value = 'Erro ao conectar ao servidor.'
  }
}

onMounted(carregarCargos)
</script>

<style scoped>
  .visualizacao-funcionario {
    text-align: center;
    max-width: 80%;
    margin: auto;
  }

  .visualizacao-funcionario form label {
    font-size: 16px;
    text-transform: uppercase;
  }
  
  h1 {
  color: #ec344a;
  font-weight: bold;
  font-size: 24px;
  text-transform: uppercase;
  margin-bottom: 20px;
}
</style>
