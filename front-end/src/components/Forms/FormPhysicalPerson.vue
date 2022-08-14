<template>
    <div>

        <div>
            <Header></Header>
        </div>

        <div class="container">
            <form @submit.prevent="create">

                <div class="row">
                    <div class="col s12">
                        <h5 class="header" style="text-align:center; color: #505050;">Pessoa Física</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s3">
                        <input id="name" type="text" class="validate" required v-model="physicalPerson.name">
                        <label for="name">Nome</label>
                    </div>

                    <div class="input-field col s3">
                        <input id="cpf" type="text" maxlength="14" class="validate" required v-model="physicalPerson.cpf">
                        <label for="cpf">CPF</label>
                    </div>

                    <div class="input-field col s3">
                        <input id="rg" type="text" maxlength="18" class="validate" required v-model="physicalPerson.rg">
                        <label for="rg">RG</label>
                    </div>

                    <div class="input-field col s3">
                        <input id="birthDate" type="text" class="validate" required v-model="physicalPerson.birthDate">
                        <label for="birthDate">Data de Nascimento</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s3">
                        <input id="cellphone" type="text" class="validate" required v-model="physicalPerson.cellphone">
                        <label for="cellphone">Celular</label>
                    </div>

                    <div class="input-field col s9">
                        <input id="password" type="text" class="validate" required v-model="physicalPerson.password">
                        <label for="password">Senha</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="street" type="text" class="validate" required v-model="physicalPerson.address.street">
                        <label for="street">Rua</label>
                    </div>

                    <div class="input-field col s2">
                        <input id="number" type="text" class="validate" required v-model="physicalPerson.address.number">
                        <label for="number">Número</label>
                    </div>

                    <div class="input-field col s2">
                        <input id="cep" type="text" class="validate" required v-model="physicalPerson.address.cep">
                        <label for="cep">Cep</label>
                    </div>

                    <div class="input-field col s2">
                        <input id="city" type="text" class="validate" required v-model="physicalPerson.address.city">
                        <label for="city">Cidade</label>
                    </div>

                    <div class="input-field col s2">
                        <input id="uf" type="text" class="validate" required v-model="physicalPerson.address.uf">
                        <label for="uf">UF</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="value" type="text" class="validate" required v-model="physicalPerson.account.value">
                        <label for="value">Valor inicial da conta</label>
                    </div>
                </div>


                <div class="row">
                    <div class="col s6" style="text-align: right">
                        <button class="waves-effect waves-light btn-small deep-purple lighten-1">
                            Salvar<i class="material-icons left">save</i>
                        </button>
                    </div>

                    <div class="col s6" style="text-align: left">
                        <a href="/" class="waves-effect waves-light btn-small btn-small red darken-2">Cancelar<i
                                class="material-icons left">cancel</i></a>
                    </div>
                </div>
            </form>
        </div>


        <div class="footer">
            <Footer></Footer>
        </div>

    </div>
</template>

<script>

import Header from '../Header.vue'
import Footer from '../Footer.vue'
import account from '../../service/accountHolder'

export default {
    name: "FormPhysicalPerson",
    components: { Header, Footer },
    data() {
        return {
            physicalPerson: {
                name: '',
                cpf: '',
                password: '',
                rg: '',
                birthDate: '',
                cellphone: '',
                account: {
                    value: ''
                },
                address: {
                    street: '',
                    number: '',
                    cep: '',
                    city: '',
                    uf: ''
                }
            },
            erros: [],
        };
    },

    methods: {

        create() {
            console.log(this.physicalPerson)
            account.createPhysicalPerson(this.physicalPerson).then((response) => {
                this.cleanForm()
                this.message()
                this.$router.push("/login")
                return response;
            }).catch((e) => {

                console.log(e.response.data)
                M.toast({ html: 'Erro ao efetuar cadastro!', classes: 'red' })
                return this.erros = e.response.data.error;
            });
        },

        message() {
            var toastHTML = '<span class="message" >Cadastro efetuado com sucesso!</span><button class="btn-flat toast-action">Login</button>';
            M.toast({ html: toastHTML, classes: 'green lighten-1' });

            var toastHTML2 = '<span class="message" >Informe seus dados para logar no sistema!</span><button class="btn-flat toast-action">Login</button>';
            M.toast({ html: toastHTML2, classes: 'green' });
        },

        cleanForm() {
            this.physicalPerson = {
                name: '',
            }
        }
    }
}

</script>

<style>
.footer {
    margin-top: 0;
}
</style>