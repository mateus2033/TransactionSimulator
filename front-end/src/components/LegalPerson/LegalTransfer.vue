<template>
    <div>

        <div>
            <HeaderDashBoardPerson></HeaderDashBoardPerson>
        </div>

        <div class="container">
            <br>
            <blockquote>
                <h5>Efetuar Transferência</h5>
            </blockquote>
            <br>

            <form @submit.prevent="transfer">
                <div class="row">
                    <div class="input-field col s3">
                        <input id="value" type="text" required class="validate" v-model="accountHolder.value">
                        <label for="value">Valor</label>
                    </div>

                    <div class="input-field col s3">
                        <input id="numberAccount" type="text" required class="validate"
                            v-model="accountHolder.numberAccount">
                        <label for="numberAccount">Número da conta</label>
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
                                    <td>{{ vetorList.number }}</td>
                                    <td>{{ vetorList.value }} </td>
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
    name: "LegalTransfer",
    components: { HeaderDashBoardPerson, FooterDashBoard, FooterDashBoard },
    data() {
        return {
            accountHolder: {
                user: this.formataCNPJ(JSON.parse(localStorage.getItem('user')).cnpj),
                numberAccount: '',
                value: '',
            },
            erros: [],
            vetorList: []
        };
    },

    mounted() {
        var cnpj = this.formataCNPJ(JSON.parse(localStorage.getItem('user')).cnpj);
        var user = { user: cnpj };

        account.list(user).then((response) => {
            this.vetorList = response.data.account
        })
    },

    methods: {

        list() {
            var cnpj = this.formataCNPJ(JSON.parse(localStorage.getItem('user')).cnpj);
            var user = { user: cnpj };
            account.list(user).then((response) => {
                this.vetorList = response.data.account
            })
        },

        transfer() {

            account.transfer(this.accountHolder).then((response) => {
                M.toast({ html: 'Transferencia realizada com sucesso!', classes: 'green lighten-1' })
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

                if (e.response.data.message == 'accountNotExists') {
                    M.toast({ html: 'Erro, conta não existe!', classes: 'orange' })
                    return;
                }

                if (e.response.data.message == 'The source account number cannot be the same as the transfer destination') {
                    M.toast({ html: 'Erro, número de conta inválido', classes: 'orange' })
                    return;
                }

                if (e.response.data.message == 'insufficient fund') {
                    M.toast({ html: 'Erro, saldo insuficiente', classes: 'orange' })
                    return;
                }

                M.toast({ html: 'Error ao efetuar operação!', classes: 'red' })
                return this.erros = e.response.data.error;
            });
        },


        back() {
            if (this.$route.path !== "/LegalPersonDashboard") this.$router.push("/LegalPersonDashboard")
        },

        formataCNPJ(cnpj) {
            cnpj = cnpj.replace(/[^\d]/g, "");
            return cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
        },
    }
}

</script>