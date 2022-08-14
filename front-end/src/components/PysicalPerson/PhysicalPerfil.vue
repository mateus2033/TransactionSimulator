<template>
    <div>
        <!-- Cabeçalho do Dashboard -->
        <div>
            <HeaderDashBoardPerson></HeaderDashBoardPerson>
        </div>

        <div class="container">
            <br>
            <blockquote>
                <h5>Usuário</h5>
            </blockquote>
            <br>

            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>CPF</th>
                        <th>rg</th>
                        <th>Nascimento</th>
                        <th>Telefone</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>{{ data().user.name }}</td>
                        <td>{{ data().user.cpf }}</td>
                        <td>{{ data().user.rg }}</td>
                        <td>{{ data().user.birthDate }}</td>
                        <td>{{ data().user.cellphone }}</td>
                    </tr>
                </tbody>
            </table>

            <br>
            <blockquote>
                <h5>Endereço</h5>
            </blockquote>
            <br>

            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Cep</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>{{ data().user.address.street }}</td>
                        <td>{{ data().user.address.number }}</td>
                        <td>{{ data().user.address.cep }}</td>
                        <td>{{ data().user.address.city }}</td>
                        <td>{{ data().user.address.uf }}</td>
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

export default {
    name: "PhysicalPerfil",
    components: { HeaderDashBoardPerson, FooterDashBoard },
    methods: {
        data() {
            return {
                user: {
                    name: JSON.parse(localStorage.getItem('user')).name,
                    cpf: JSON.parse(localStorage.getItem('user')).cpf,
                    rg: JSON.parse(localStorage.getItem('user')).rg,
                    birthDate: JSON.parse(localStorage.getItem('user')).birthDate,
                    cellphone: JSON.parse(localStorage.getItem('user')).cellphone,
                    address: {
                        street: JSON.parse(localStorage.getItem('user')).address.street,
                        number: JSON.parse(localStorage.getItem('user')).address.number,
                        cep: JSON.parse(localStorage.getItem('user')).address.cep,
                        city: JSON.parse(localStorage.getItem('user')).address.city,
                        uf: JSON.parse(localStorage.getItem('user')).address.uf,
                    }
                },
                erros: [],
            };
        }
    }
}
</script>