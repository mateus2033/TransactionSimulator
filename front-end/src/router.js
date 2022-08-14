import Vue from 'vue'
import Router from 'vue-router'
import Home from './view/Home.vue'
import Login from './view/Login.vue'
import PhysicalPerfil from './components/PysicalPerson/PhysicalPerfil'
import LegalPerfil from './components/LegalPerson/LegalPerfil.vue'
import PhysicalPersonDashBoard from './components/PysicalPerson/PhysicalPersonDashBoard.vue'
import LegalPersonDashboard from './components/LegalPerson/LegalPersonDashboard'
import FormPhysicalPerson from './components/Forms/FormPhysicalPerson.vue'
import FormLegalPerson from './components/Forms/FormLegalPerson.vue'
import PhysicalFundos from './components/PysicalPerson/PhysicalFundos.vue'
import PhysicalDeposit from './components/PysicalPerson/PhysicalDeposit.vue'
import PhysicalWithdraw from './components/PysicalPerson/PhysicalWithdraw.vue'
import PhysicalTransfer from './components/PysicalPerson/PhysicalTransfer.vue'
import LegalFundos from './components/LegalPerson/LegalFundos.vue'
import LegalDeposit from './components/LegalPerson/LegalDeposit.vue'
import LegalWithdraw from './components/LegalPerson/LegalWithdraw.vue'
import LegalTransfer from './components/LegalPerson/LegalTransfer.vue'

Vue.use(Router)

Vue.config.productionTip = false

export default new Router({

    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/Login',
            name: 'Login',
            component: Login

        },
        {
            path: '/FormPhysicalPerson',
            name: 'FormPhysicalPerson',
            component: FormPhysicalPerson
        },
        {
            path: '/FormLegalPerson',
            name: 'FormLegalPerson',
            component: FormLegalPerson
        },
        {
            path: '/LegalPersonDashboard',
            name: 'LegalPersonDashboard',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: LegalPersonDashboard
        },
        {
            path: '/PhysicalPersonDashBoard',
            name: 'PhysicalPersonDashBoard',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: PhysicalPersonDashBoard
        },
        {
            path: '/LegalPerfil',
            name: 'LegalPerfil',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: LegalPerfil
        },
        {
            path: '/PhysicalPerfil',
            name: 'PhysicalPerfil',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: PhysicalPerfil
        },
        {
            path: '/PhysicalFundos',
            name: 'PhysicalFundos',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: PhysicalFundos
        },
        {
            path: '/PhysicalDeposit',
            name: 'PhysicalDeposit',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: PhysicalDeposit
        },
        {
            path: '/PhysicalWithdraw',
            name: 'PhysicalWithdraw',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: PhysicalWithdraw
        },
        {
            path: '/PhysicalTransfer',
            name: 'PhysicalTransfer',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: PhysicalTransfer
        },
        {
            path: '/LegalFundos',
            name: 'LegalFundos',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: LegalFundos
        },
        {
            path: '/LegalDeposit',
            name: 'LegalDeposit',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: LegalDeposit
        },
        {
            path: '/LegalWithdraw',
            name: 'LegalWithdraw',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: LegalWithdraw
        },
        {
            path: '/LegalTransfer',
            name: 'LegalTransfer',
            beforeEnter: function (to, from, next) {
                const token = localStorage.getItem('token')

                if (!token) {
                    next({ path: '/Login' });
                } else {
                    next()
                }
            },
            component: LegalTransfer
        }
    ]
})