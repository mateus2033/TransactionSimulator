<template>
    <div>

        <div>
            <HeaderDashBoardPerson></HeaderDashBoardPerson>
        </div>

        <div class="container">
            <br>
            <blockquote>
                <h5>Efetuar retirada</h5>
            </blockquote>
            <br>

            <form @submit.prevent="withdraw">
                <div class="row">
                    <div class="input-field col s3">
                        <input id="value" type="text" required class="validate" v-model="accountHolder.value">
                        <label for="value">Valor</label>
                    </div>

                    <div style="padding:25px">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Salvar
                            <i class="material-icons right">send</i>
                        </button>
                        <a style="width:105px; height:36px; margin-left: 2px;"
                            class="waves-effect waves-light btn-small btn-small red darken-2" @click="back()">Cancelar<i
                                class="material-icons left">cancel</i></a>
                    </div>
                </div>

                <div class="row">
                    <div col s12>
                        <table>
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td> {{vetorList.number}} </td>
                                    <td>{{vetorList.value}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <div class="footer">
            <FooterDashBoard></FooterDashBoard>
        </div>

    </div>
</template>

<script>

import HeaderDashBoardPerson from '../Person/HeaderDashBoardPerson.vue'
import FooterDashBoard from '../Person/FooterDashBoard.vue'
import account from '../../service/accountHolder'

export default {
    name: "PhysicalWithdraw",
    components: { HeaderDashBoardPerson, FooterDashBoard },

    data() {
        return {
            accountHolder: {
                user: this.formataCPF(JSON.parse(localStorage.getItem('user')).cpf),
                value: '',
            },
            erros: [],
            vetorList: []
        };
    },

    mounted() {

        var cpf = this.formataCPF(JSON.parse(localStorage.getItem('user')).cpf);
        var user = { user: cpf };

        account.list(user).then((response) => {
            this.vetorList = response.data.account
        })
    },

    methods: {

        list() {

            var cpf = this.formataCPF(JSON.parse(localStorage.getItem('user')).cpf);
            var user = { user: cpf };
            account.list(user).then((response) => {
                this.vetorList = response.data.account
            })
        },

        withdraw() {

            account.withdraw(this.accountHolder).then((response) => {
                M.toast({ html: 'Retirada realizada com sucesso!', classes: 'green lighten-1' })
                this.list()
                return response;
            }).catch((e) => {

                if (e.response.data.message == 'accountExists') {
                    M.toast({ html: 'Erro, você já adicionou uma conta a este usuario!', classes: 'orange' })
                    return;
                }

                if (e.response.data.message == 'accountHolderNotFount') {
                    M.toast({ html: 'Erro, correntista não encontrado!', classes: 'orange' })
                    return;
                }

                if (e.response.data.message == 'onlyPositiveNumbers') {
                    M.toast({ html: 'Erro, insira apenas números positivos!', classes: 'orange' })
                    return;
                }

                if (e.response.data.message == 'insufficient fund') {
                    M.toast({ html: 'Erro, saldo insuficiente!', classes: 'orange' })
                    return;
                }

                M.toast({ html: 'Error ao efetuar operação!', classes: 'red' })
                return this.erros = e.response.data.error;
            });
        },

        back() {
            if (this.$route.path !== "/PhysicalPersonDashBoard") this.$router.push("/PhysicalPersonDashBoard")
        },

        formataCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, "");
            return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        }
    }
}
</script>