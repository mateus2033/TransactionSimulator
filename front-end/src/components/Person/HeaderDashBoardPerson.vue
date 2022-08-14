<template>
    <div>
        <nav class="purple lighten-1">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a>Olá, {{ data().person.name }}</a></li>
                    <li><a class="btn-small orange" @click="conta()">Minha Conta</a></li>
                    <li><a class="btn-small orange" @click="perfil()">Perfil</a></li>
                    <li><a class="btn-small orange" @click="logout()">Sair</a></li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>

export default {
    name: "HeaderDashBoardPerson",
    methods: {
        data() {
            return {
                person: {
                    name: JSON.parse(localStorage.getItem('user')).name,
                },
                erros: [],
            };
        },

        perfil() 
        {

            if (typeof JSON.parse(localStorage.getItem('user')).cpf != 'undefined') 
            {
                this.pushPhysicalPerson();
            }

            if (typeof JSON.parse(localStorage.getItem('user')).cnpj != 'undefined') 
            {
                this.pushLegalPerfil();
            }
        },
        
        conta() 
        {

            if (typeof JSON.parse(localStorage.getItem('user')).cpf != 'undefined') 
            {
                this.pushDashBoardPhysicalPerson();
            }

            if (typeof JSON.parse(localStorage.getItem('user')).cnpj != 'undefined') 
            {
                this.pushDashBoardLegalPerson();
            }
        },

        pushDashBoardPhysicalPerson()
        {
            if (this.$route.path !== "/PhysicalPersonDashBoard") this.$router.push("/PhysicalPersonDashBoard")
        },

        pushDashBoardLegalPerson()
        {
            if (this.$route.path !== "/LegalPersonDashboard") this.$router.push("/LegalPersonDashboard")
        },

        pushLegalPerfil() 
        {
            if (this.$route.path !== "/LegalPerfil") this.$router.push("/LegalPerfil")
        },

        pushPhysicalPerson() 
        {
            if (this.$route.path !== "/PhysicalPerfil") this.$router.push("/PhysicalPerfil")
        },

        logout() {
            localStorage.clear();
            this.$router.push('/Login');
        }
    }
}

</script>