<template>

    <div class="container">
        <form @submit.prevent="login">
            <div class="login">
                <div class="row">
                    <div class="col s12">
                        <h5 class="header">Login</h5>
                    </div>
                </div>
            </div>

            <div class="area">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" type="text" v-model="accountHolder.login" class="validate" required>
                        <label for="name">CPF/CNPJ</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" v-model="accountHolder.password" class="validate" required>
                        <label for="password">Senha</label>
                    </div>
                </div>
            </div>

            <div class="button">
                <div class="row">
                    <div class="col s6" style="text-align: right">
                        <button class="waves-effect waves-light btn-small deep-purple lighten-1">
                            Entrar<i class="material-icons left">save</i>
                        </button>
                    </div>

                    <div class="col s6" style="text-align: left">
                        <a href="/" class="waves-effect waves-light btn-small btn-small red darken-2">Cancelar<i
                                class="material-icons left">cancel</i></a>
                    </div>
                </div>
            </div>
        </form>
    </div>


</template>


<style>
.area {

    position: absolute;
    top: 50%;
    left: 50%;
    width: 25%;
    transform: translate(-50%, -50%);
}

.login {

    position: absolute;
    top: 25%;
    left: 48%;
    text-align: center;
    color: #505050;

}

.button {

    position: absolute;
    top: 65%;
    left: 42%;
    text-align: center;
}
</style>


<script>

import account from '../../service/accountHolder';
import VueJwtDecode from 'vue-jwt-decode';

export default {
    name: "FormLogin",

    data() {
        return {
            accountHolder: {
                login: '',
                password: '',
            },
            erros: {
                login: '',
                password: ''
            },
        };
    },

    methods: {

        async login() {
            account.login(this.accountHolder).then((response) => {
                this.jsonDecode(response)
                return response;
            }).catch((e) => {

                M.toast({ html: 'Usuario ou senha invalidos!', classes: 'red' })
                this.clearForm()
                return this.erros = e.response.data.error;
            });
        },

        clearForm() {
            this.accountHolder = {
                login: '',
                password: '',
            }
        },

        jsonDecode(response) {


            localStorage.setItem('token', response.data.token);
            let user = VueJwtDecode.decode(localStorage.getItem('token'));
            localStorage.setItem('user', JSON.stringify(user));


            if (typeof user.cpf != 'undefined') {
                this.$router.push('/PhysicalPersonDashBoard');
            }

            if (typeof user.cnpj != 'undefined') {
                this.$router.push('/LegalPersonDashboard');
            }
        }
    }
}

</script>