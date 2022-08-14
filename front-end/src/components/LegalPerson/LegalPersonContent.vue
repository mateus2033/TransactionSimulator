<template>
    <div>
        <div class="container">

            <div class="row">
                <div class="col s8">
                    <blockquote>
                        <h5>Gerenciar ações</h5>
                    </blockquote>
                </div>

                <div class="col s4">
                    Saldo:
                    <div class="input-field inline">
                        <input disabled id="value" type="text" class="validate" v-model="this.value">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s3">
                    <div class="card grey lighten-2">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img src="../../images/imageAll.jpg" @click="legalFundos()">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Meus Fundos<i
                                    class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Observações<i
                                    class="material-icons right">close</i></span>
                            <p>Here is some more information about this product </p>
                        </div>
                    </div>
                </div>

                <div class="col s3">
                    <div class="card grey lighten-2">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img src="../../images/pexels2.jpg" @click="legalDeposit()">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Depositar<i
                                    class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Card Title<i
                                    class="material-icons right">close</i></span>
                            <p>Here is some more information about this product </p>
                        </div>
                    </div>
                </div>

                <div class="col s3">
                    <div class="card grey lighten-2">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img src="../../images/imageAll.jpg" @click="legalWithdraw()">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Retirar<i
                                    class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Card Title<i
                                    class="material-icons right">close</i></span>
                            <p>Here is some more information about this product </p>
                        </div>
                    </div>
                </div>

                <div class="col s3">
                    <div class="card grey lighten-2">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img src="../../images/pexels2.jpg" @click="legalTransfer()">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Transferência<i
                                    class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Card Title<i
                                    class="material-icons right">close</i></span>
                            <p>Here is some more information about this product </p>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <blockquote>
                <h5>Historico</h5>
            </blockquote>
            <br>
            <table class="responsive-table table-status-sheet">
                <thead>
                    <tr>
                        <th class="center">Ação</th>
                        <th class="center">Mensagem</th>
                        <th class="center">Data</th>
                    </tr>
                </thead>

                <tbody>

                    <tr v-for="historico of vetor" :key="historico.id">
                        <td>{{ historico.action }}</td>
                        <td>{{ historico.message }}</td>
                        <td>{{ historico.data }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="footer">
            <FooterDashBoard></FooterDashBoard>
        </div>


    </div>
</template>

<script>

import account from '../../service/accountHolder'
import FooterDashBoard from '../Person/FooterDashBoard.vue';

export default {
    name: "LegalPersonContent",
    components: { FooterDashBoard },
    data() {
        return {
            value: '',
            vetor: []
        }
    },

    mounted() {
        var cnpj = this.formataCNPJ(JSON.parse(localStorage.getItem('user')).cnpj);
        var user = { user: cnpj };

        account.list(user).then((response) => {
            this.value = response.data.account.value
        })

        account.listHistoric(user).then((response) => {
            this.vetor = response.data
        })
    },

    methods: {

        legalFundos() {
            if (this.$route.path !== "/LegalFundos") this.$router.push("/LegalFundos")
        },

        legalDeposit() {
            if (this.$route.path !== "/LegalDeposit") this.$router.push("/LegalDeposit")
        },

        legalWithdraw() {
            if (this.$route.path !== "/LegalWithdraw") this.$router.push("/LegalWithdraw")
        },

        legalTransfer() {
            if (this.$route.path !== "/LegalTransfer") this.$router.push("/LegalTransfer")
        },

        formataCNPJ(cnpj) {
            cnpj = cnpj.replace(/[^\d]/g, "");
            return cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
        },

    }
}

</script>

<style>
tbody {
    display: block;
    height: 160px;
    overflow: auto;
}

thead,
tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}

thead {
    width: calc(100% - 1em)
}

table {
    width: 100%;
}
</style>