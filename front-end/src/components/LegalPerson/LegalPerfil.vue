<template>
    <div>

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
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Registro Estadual</th>
                        <th>Data de Fundação</th>
                        <th>Celular</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>{{ data().user.name }}</td>
                        <td>{{ data().user.cnpj }}</td>
                        <td>{{ data().user.stateRegistration }}</td>
                        <td>{{ data().user.foundationDate }}</td>
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
                        <th>Cep Estadual</th>
                        <th>Cidade de Fundação</th>
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
    </div>
</template>

<script>

import HeaderDashBoardPerson from '../Person/HeaderDashBoardPerson.vue';

export default {
    name: "LegalPerfil",
    components: { HeaderDashBoardPerson },
    methods: {
        data() {
            return {
                user: {
                    name: JSON.parse(localStorage.getItem('user')).name,
                    cnpj: JSON.parse(localStorage.getItem('user')).cnpj,
                    stateRegistration: JSON.parse(localStorage.getItem('user')).stateRegistration,
                    foundationDate: JSON.parse(localStorage.getItem('user')).foundationDate,
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