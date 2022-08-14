<template>
    <div>
        <div>
            <HeaderDashBoardPerson></HeaderDashBoardPerson>
        </div>

        <div class="container">
            <br>
            <blockquote>
                <h5>Saldo atual</h5>
            </blockquote>
            <br>
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Saldo</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ this.number }}</td>
                        <td>{{ this.value }}</td>
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

import FooterDashBoard from '../Person/FooterDashBoard.vue';
import HeaderDashBoardPerson from '../Person/HeaderDashBoardPerson.vue'
import account from '../../service/accountHolder';

export default {
    name: "PhysicalFundos",
    components: { HeaderDashBoardPerson, FooterDashBoard },
    data() {
        return {
            number: '',
            value: ''
        }
    },

    mounted() {
        var cpf = this.formataCPF(JSON.parse(localStorage.getItem('user')).cpf);
        var user = { user: cpf };

        account.list(user).then((response) => {
            this.number = response.data.account.number
            this.value = response.data.account.value
        })
    },

    methods: {
        formataCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, "");
            return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        }
    }
}
</script>


<style>
.footer {
    margin-top: 0;
}
</style>