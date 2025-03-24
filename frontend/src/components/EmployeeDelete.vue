<template>
  <h1>Excluir Funcionário</h1>
  <div class="visualizacao-funcionario">
    <ul>
      <li v-for="funcionario in funcionarios" :key="funcionario.id_funcionario">
        {{ funcionario.nome_funcionario }} - {{ funcionario.email_funcionario }} - {{ funcionario.nome_cargo }}
        <button @click="excluirFuncionario(funcionario.id_funcionario)">Excluir</button>
      </li>
    </ul>
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

const excluirFuncionario = async (id) => {
  if (confirm('Tem certeza que deseja excluir este funcionário?')) {
    try {
      const response = await fetch('http://localhost/TBR-projeto-teste/backend/funcionarios/delete.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_funcionario: id })
      })

      const result = await response.json()

      if (result.success) {
        alert('Funcionário excluído com sucesso!')
        buscarFuncionarios()
      } else {
        console.error('Erro:', result.message)
        alert('Erro ao excluir funcionário!')
      }
    } catch (error) {
      console.error('Erro ao excluir funcionário:', error)
      alert('Erro ao excluir funcionário!')
    }
  }
}

onMounted(() => {
  buscarFuncionarios()
})
</script>

<style scoped>
  .visualizacao-funcionario {
    justify-items: anchor-center;
  
  }

  .visualizacao-funcionario ul {
    list-style-type: none;
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
