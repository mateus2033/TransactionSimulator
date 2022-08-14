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

import HeaderDashBoardPerson from '../Person/HeaderDashBoardPerson.vue';
import FooterDashBoard from '../Person/FooterDashBoard.vue';
import account from '../../service/accountHolder';

export default {
    name: "LegalFundos",
    components: { HeaderDashBoardPerson, FooterDashBoard },
    data() {
        return {
            number: '',
            value: ''
        }
    },

    mounted() {
        var cnpj = this.formataCNPJ(JSON.parse(localStorage.getItem('user')).cnpj);
        var user = { user: cnpj };

        account.list(user).then((response) => {
            this.number = response.data.account.number
            this.value = response.data.account.value
        })
    },

    methods: {
        formataCNPJ(cnpj) {
            cnpj = cnpj.replace(/[^\d]/g, "");
            return cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
        }
    }
}

</script>