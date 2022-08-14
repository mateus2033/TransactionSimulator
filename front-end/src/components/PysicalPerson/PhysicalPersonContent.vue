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

            <br>

            <div class="row">
                <div class="col s3">
                    <div class="card grey lighten-2">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img src="../../images/imageAll.jpg" @click="physicalFundos()">
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
                            <img src="../../images/pexels2.jpg" @click="physicalDeposit()">
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
                            <img src="../../images/imageAll.jpg" @click="physicalWithdraw()">
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
                            <img src="../../images/pexels2.jpg" @click="physicalTransfer()">
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
                <thead class="bordered">
                    <tr>
                        <th class="center">Ação</th>
                        <th class="center">Mensagem</th>
                        <th class="center">Data</th>
                    </tr>
                </thead>

                <tbody>

                    <tr v-for="historic of vetor" :key="historic.id">
                        <td>{{ historic.action }}</td>
                        <td>{{ historic.message }}</td>
                        <td>{{ historic.data }}</td>
                    </tr>
                </tbody>
            </table>
        </div>



    </div>
</template>

<script>

import account from '../../service/accountHolder'
import FooterDashBoard from '../Person/FooterDashBoard.vue';

export default {

    name: "PhysicalPersonContent",
    components: { FooterDashBoard },
    data() {
        return {
            value: '',
            vetor: []
        }
    },

    mounted() {
        var cpf = this.formataCPF(JSON.parse(localStorage.getItem('user')).cpf);
        var user = { user: cpf };

        account.list(user).then((response) => {
            this.value = response.data.account.value
        })

        account.listHistoric(user).then((response) => {
            this.vetor = response.data
        })
    },


    methods: {

        physicalFundos() {
            if (this.$route.path !== "/PhysicalFundos") this.$router.push("/PhysicalFundos")
        },

        physicalDeposit() {
            if (this.$route.path !== "/PhysicalDeposit") this.$router.push("/PhysicalDeposit")
        },

        physicalWithdraw() {
            if (this.$route.path !== "/PhysicalWithdraw") this.$router.push("/PhysicalWithdraw")
        },

        physicalTransfer() {
            if (this.$route.path !== "/PhysicalTransfer") this.$router.push("/PhysicalTransfer")
        },

        formataCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, "");
            return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        },

        listHistoric() {
            var cpf = this.formataCPF(JSON.parse(localStorage.getItem('user')).cpf);
            var user = { user: cpf };
            account.listHistoric(user).then((response) => {
                console.log(response)
                this.vetorList = response.data.account
            })
        },

        formataCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, "");
            return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        }
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