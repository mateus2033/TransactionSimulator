<template>
    <div>
        <nav class="purple lighten-1">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">  
                    <a class='dropdown-trigger waves-effect waves-light btn-small purple orange' href='#' data-target='dropdown1'>Seja um correntista</a>
                    <ul id='dropdown1' class='dropdown-content'>
                        <li><a @click="physicalPersonCreate()" >Conta Fisica</a></li>
                        <li><a @click="legalPersonCreate()">Conta Juridica</a></li>
                    </ul>
                    <li><a class="waves-effect waves-light btn-small orange" @click="Login()">Login</a></li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>

document.addEventListener('DOMContentLoaded', function () {
    var options = {};
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);
});

export default {
    name: 'Header',

    methods: {

        home() { if (this.$route.path !== "/") this.$router.push("/"); },

        physicalPersonCreate() { if (this.$route.path !== "/FormPhysicalPerson") this.$router.push("/FormPhysicalPerson"); },

        legalPersonCreate() { if (this.$route.path !== "/FormLegalPerson") this.$router.push("/FormLegalPerson"); },

        Login() { if (this.$route.path !== "/Login") this.$router.push("/Login"); }

    },
}

</script>