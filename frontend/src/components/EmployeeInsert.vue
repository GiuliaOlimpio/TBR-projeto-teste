<template>
   <h1>Adicionar funcionário</h1>
  <div class="visualizacao-funcionario">
    <form @submit.prevent="inserirFuncionario">
      <label for="nome_funcionario">Nome completo</label>
      <input type="text" v-model="nome_funcionario" id="nome_funcionario" required />

      <label for="email_funcionario">E-mail</label>
      <input type="text" v-model="email_funcionario" id="email_funcionario" required />

      <label>Cargo</label>
      <select v-model="cargo_funcionario" required>
        <option disabled value="">Selecione um cargo</option>
        <option v-for="cargo in cargos" :key="cargo.id_cargo" :value="cargo.id_cargo">
          {{ cargo.nome_cargo }}
        </option>
      </select>

      <button type="submit">Adicionar</button>
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
    justify-items: anchor-center;
  
  }

  .visualizacao-funcionario form label {
    font-size: 12px;
    text-transform: uppercase;
    display: block;
    width: 100%;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
  }

  .visualizacao-funcionario form input {
    font-size: 16px;
    display: block;
    background: #1a1a1a;
    color: white;
    width: 20rem;
    padding: 0.5rem;
    border: 2px solid white;
    border-radius: 5px;
 
  }

  .visualizacao-funcionario form select {
    font-size: 16px;
    display: block;
    background: #1a1a1a;
    color: white;
    width: 100%;
    padding: 0.5rem;
    border: 2px solid white;
    border-radius: 5px;
  }


  .visualizacao-funcionario form button {
    font-size: 18px;
    display: block;
    margin-top: 2rem;
    background-color: #ec344a;
    color: white;
    width: 100%;
    padding: 1rem;
    border-radius: 5px;
  }
  
  h1 {
  color: #ec344a;
  font-weight: bold;
  font-size: 24px;
  text-transform: uppercase;
  margin-bottom: 3rem;
  margin-top: 3rem;
  text-align: center;
}
</style>
