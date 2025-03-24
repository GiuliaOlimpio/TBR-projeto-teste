import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Navbar.vue'
import EmployeeList from '../components/EmployeeList.vue'
import EmployeeInsert from '../components/EmployeeInsert.vue'
import EmployeeDelete from '../components/EmployeeDelete.vue'

const routes = [ //adicionando os paths para os componentes através do router
  { path: '/', component: EmployeeList },
  { path: '/list', component: EmployeeList },
  { path: '/insert', component: EmployeeInsert },
  { path: '/delete', component: EmployeeDelete },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
